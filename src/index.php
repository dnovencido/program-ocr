<?php
    include 'session.php';
    use thiagoalessio\TesseractOCR\TesseractOCR;

    require 'vendor/autoload.php';

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
            $file_name = $_FILES['file']['name'];
            $tmp_file = $_FILES['file']['tmp_name'];


            if (!session_id()) {
                session_start();
                $unq = session_id();
            }

            $file_name = $unq . '_' . time() . '_' . str_replace(array('!', "@", '#', '$', '%', '^', '&', ' ', '*', '(', ')', ':', ';', ',', '?', '/' . '\\', '~', '`', '-'), '_', strtolower($file_name));

            if (move_uploaded_file($tmp_file, 'uploads/' . $file_name)) {
                try {
        
                    $fileRead = (new TesseractOCR('uploads/' . $file_name))
                        ->setLanguage('eng')
                        ->run();
                        
                        $sam = explode(" ",$fileRead);

        
                } catch (Exception $e) {
        
                    echo $e->getMessage();
        
                }
            } else {
                $errors[] = 'File failed to upload';
            }

        }
    }
?>
<?php include '_header.php'; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (!empty($errors)) { ?>
                    <?php include "_error-message.php" ?>
                <?php } ?>
                <div class="card">
                    <div class="card-body">
                        <h1 class="h3 mb-3 fw-normal">Transactions </h1>
                        <div class="mb-3">
                            <form method="post" enctype="multipart/form-data">
                                <label for="file" class="form-label">Upload image:</label>
                                <input class="form-control form-control-sm" id="file" name="file" type="file">
                                <button class="btn btn-success btn-sm mt-3" type="submit" name="submit">Open</button>
                            </form>
                        </div>
                        <hr>
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