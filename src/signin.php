<?php
    include 'functions.php';
    include 'session.php';

    $errors = []; 

    if($_POST['submit']) {
        if(!$_POST['username']) {
            $errors[] = "Username is required.";
        }
        if(!$_POST['password']) {
            $errors[] = "Password is required.";
        }

        if(empty($error)) {
            $user = login_account($_POST['username'], $_POST['password']);
            if(!empty($user)) {
                $_SESSION['uid'] = $user['uid'];
                $_SESSION['fname'] = $user['fname'];

                header("Location: /");
            } else {    
                $errors[] = "The username that you've entered does not match any account.";
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
                <form method="POST">
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?= $_POST
                        ['username'] ?>">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="<?= $_POST['password'] ?>">
                        <label for="password">Password</label>
                    </div>
                    <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Sign in" />
                </form>
            </div>
        </div>
    </div>
<?php include '_footer.php' ?>