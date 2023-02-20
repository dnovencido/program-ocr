<?php
    include 'functions.php';
    include 'session.php';
    
    $errors = []; 

    if($_POST['submit']) {
        if(!$_POST['username']) {
            $errors[] = "Name is required.";
        }

        if(!$_POST['password']) {
            $errors[] = "Password is required.";
        }

        if(!$_POST['lastname']) {
            $errors[] = "Last name is required.";
        }

        if(!$_POST['firstname']) {
            $errors[] = "First name is required.";
        }

        if(!$_POST['position']) {
            $errors[] = "Position is required.";
        }

        if($_POST['password'] != $_POST['confirm_password']) {
            $errors[] = "You must confirm your password.";
        }

        if(empty($errors)) {
            if(!check_existing_username($_POST['username'])) {
                $user = save_registration($_POST['username'],$_POST['firstname'], $_POST['lastname'], $_POST['position'], $_POST['password']);
                if(!empty($user)) {
                    $_SESSION['uid'] = $user['uid'];
                    $_SESSION['fname'] = $user['fname'];

                    header("Location: account.php");
                } else {
                    $errors[] = "There was an error logging in your account.";
                }
            } else {
                $errors[] = "The username was already taken";
            }
        }
    }
?>
<?php include '_header.php'; ?>
    <div class="container">
        <div id="register">
            <div id="register-form">
                <h1>Register an account.</h1>
                <?php if (!empty($errors)) { ?>
                    <div class="alert alert-danger">
                        <ul>
                        <?php foreach ($errors as $row) { ?>
                        <li><?= $row ?></li>
                        <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <form method="post">
                    <div class="form-group mb-3">
                        <label for="username">Username: </label>
                        <input type="text" name="username" class="form-control" value="<?= $_POST['username'] ?>" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="fname">First name: </label>
                        <input type="text" name="firstname" class="form-control"value="<?= $_POST['firstname'] ?>" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="fname">Last name: </label>
                        <input type="text" name="lastname" class="form-control" value="<?= $_POST['lastname'] ?>" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="position">Position: </label>
                        <input type="text" name="position" class="form-control" value="<?= $_POST['position'] ?>" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password: </label>
                        <input type="password" name="password" class="form-control" value="<?= $_POST['password'] ?>" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirm_password">Confirm: </label>
                        <input type="password" name="confirm_password" class="form-control" />
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Register" />
                    </div>
                </form>
            </div>                
        </div>
    </div>
<?php include '_footer.php' ?>