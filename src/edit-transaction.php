<?php
    include 'session.php';
    include 'functions.php';

    $errors = [];

    if (array_key_exists("id", $_GET)) {
        $transaction = get_transaction($_GET['id']);
        if(isset($_POST['update-details'])) {
            $errors = validate_form_transaction($_POST['refnum'], $_POST['number'], $_POST['amount'], $_POST['name']);
            if(update_transaction($transaction['tranID'], $_POST['refnum'], $_POST['number'], $_POST['amount'], $_POST['name'])) {
                $message[] = "Transaction successfully updated. ";
                // header("Location: edit-transaction.php?id=".$transaction['tranID']);
            } else {
                $errors[] = "Could not update a transaction. Please try again later.";
            }
        }
    }

?>
<?php include '_header.php'; ?>
<div class="container">
    <?php if (!empty($errors)) { ?> 
        <?php include "shared/_error-message.php" ?>
    <?php } ?>
    <?php if (!empty($message)) { ?>
        <?php include "shared/_success-message.php" ?>
    <?php } ?>
    <a href="transactions.php" class="btn btn-outline-secondary btn-sm mb-3">Go back to transaction list</a>
    <h1 class="h3 mb-3 fw-normal"> Edit Transaction | Reference Number : <?= $transaction['refnum'] ?> </h1>
    <form method="post">
        <div class="mb-3">
            <label for="refnum" class="form-label">Reference Number: </label>
            <input type="text" class="form-control" id="refnum" name="refnum" value= "<?= isset($_POST['refnum']) ? $_POST['refnum'] : $transaction['refnum'] ?>" />
        </div>
        <div class="mb-3">
            <label for="number" class="form-label">Number: </label>
          
            <input type="text" class="form-control" id="number" name="number" value= "<?= isset($_POST['number']) ? $_POST['number'] : $transaction['number'] ?>" />
        </div>
        <div class="mb-3">
            <label for="number" class="form-label">Amount: </label>
            <input type="text" class="form-control" id="amount" name="amount" value= "<?= isset($_POST['amount']) ? $_POST['amount'] : $transaction['amount'] ?>" />
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name: </label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : $transaction['name'] ?>" />
        </div>
        <input type="submit" name="update-details" class="btn btn-primary" value="Save" />
    </form>
</div>
<?php include '_footer.php'; ?>