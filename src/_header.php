<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="navbar-brand">
                    Program
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <?php if (isset($_SESSION['uid'])) { ?>
                    <?php } else { ?>
                        <li><a href="signin.php" class="nav-link px-2 link-dark">Login</a></li>
                        <li><a href="signup.php" class="nav-link px-2 link-dark">Signup</a></li>
                    <?php } ?>
                </ul>

                <?php if (isset($_SESSION['uid'])) { ?>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle show" id="dropdownUser" data-bs-toggle="dropdown">
                        <?= $_SESSION['fname'] ?>
                    </a>
                    <ul class="dropdown-menu text-small show" aria-labelledby="dropdownUser" data-popper-placement="bottom-start">
                        <li><a class="dropdown-item" href="logout.php?logout=true">Sign out</a></li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </header>