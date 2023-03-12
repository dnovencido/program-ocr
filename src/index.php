<?php
    use thiagoalessio\TesseractOCR\TesseractOCR;
    require 'vendor/autoload.php';
    include 'session.php';
    include 'check_login.php';
    include 'functions.php';

    $errors = [];
    $res = [];
    $message = [];
    $image_path = "";

    if (isset($_POST['upload-file'])) {
        $file_name = $_FILES['file']['name'];
        
        $tmp_file = $_FILES['file']['tmp_name'];

        $file_name = $_SESSION['uid'] . '_' . time() . '_' . str_replace(array('!', "@", '#', '$', '%', '^', '&', ' ', '*', '(', ')', ':', ';', ',', '?', '/' . '\\', '~', '`', '-'), '_', strtolower($file_name));

        $image_path = 'uploads/' . $file_name;

        if (move_uploaded_file($tmp_file, 'uploads/' . $file_name)) {
            try {
    
                $fileRead = (new TesseractOCR('uploads/' . $file_name))
                    ->setLanguage('eng')
                    ->run();
                    
                    $res = explode(" ",$fileRead);
    
            } catch (Exception $e) {
    
                echo $e->getMessage();
    
            }
        } else {
            $errors[] = 'File failed to upload';
        }
    }

    if(isset($_POST['save-details'])) {
        $image_path = $_POST['filename'];
        $errors = validate_form_transaction($_POST['refnum'], $_POST['number'], $_POST['amount'], $_POST['name']);
        if(empty($errors)) {
            if(!check_existing_reference_num($_POST['refnum'])) {
                $transaction_id = save_details($_POST['refnum'], $_POST['number'], $_POST['amount'], $_POST['name']);
                if($transaction_id != null ) {
                    $message[] = "Successfully saved";
                    //Record trace action
                    if(save_trace("transaction-create", $_SESSION['uid'], $transaction_id)) {
                        unset($_POST);
                        $image_path = "";
                    }
                }
            } else {
                $errors[] = "The reference number entered is already existing.";
            }
        }
    }
?>
<?php include '_header.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (!empty($errors)) { ?>
                    <?php include "shared/_error-message.php" ?>
                <?php } ?>
                <?php if (!empty($message)) { ?>
                    <?php include "shared/_success-message.php" ?>
                <?php } ?>
                <div class="card">
                    <div class="card-body">
                        <h1 class="h3 mb-3 fw-normal">Add transaction </h1>
                        <div class="mb-3">
                            <form method="post" enctype="multipart/form-data">
                                <label for="file" class="form-label">Upload image:</label>
                                <input class="form-control form-control-sm" id="file" name="file" type="file">
                                <input type="submit" class="btn btn-success btn-sm mt-3" name="upload-file" value="Upload" />
                            </form>
                        </div>
                        <div class="mb-3 preview-image ">
                            <img src="<?= ($image_path) ? $image_path : ''  ?>"  width="50%" class="ms-auto me-auto d-block"/>
                        </div>
                        <div class="mb-3">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="refnum" class="form-label">Reference Number: </label>
                                    <input type="hidden" name="filename" value="<?= (isset($_POST['filename'])) ?  $_POST['filename'] : $image_path ?>"/>
                                    <?php $refnum = (isset($res[18])) ? $res[19] . $res[20] . $res[21] : ""  ?>
                                    <input type="text" class="form-control" id="refnum" name="refnum" value= "<?= (isset($_POST['refnum'])) ? $_POST['refnum'] : $refnum ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">Number: </label>
                                    <?php $number = (isset($res[13])) ? $res[13] : "" ?>
                                    <input type="text" class="form-control" id="number" name="number" value= "<?= (isset($_POST['number'])) ? $_POST['number'] : $number ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">Amount: </label>
                                    <?php $amount = (isset($res[14])) ? $res[14] : "" ?>
                                    <input type="text" class="form-control" id="amount" name="amount" value= "<?= (isset($_POST['amount'])) ? $_POST['amount'] : $amount ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name: </label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : "" ?>" />
                                </div>
                                <input type="submit" name="save-details" class="btn btn-primary" value="Save" />
                            </form>
                        </div>
                        <div class="mb-3">
                            <label for="search-transaction" class="form-label">Search reference number</label>
                            <input type="text" class="form-control" id="search-transaction" placeholder="Enter reference number">
                        </div>
                        <div class="result-container">
                            <ul id="result" class="list-group">
                                <li class="list-group-item">Results will be placed here.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include '_footer.php'; ?>