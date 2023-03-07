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
                <a href="index.php" class="navbar-brand">
                    Program
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <?php if (isset($_SESSION['uid'])) { ?>
                        <li><a href="transactions.php" class="nav-link px-2 link-dark">Transactions</a></li>
                        <li><a href="trace.php" class="nav-link px-2 link-dark">Audit Trail</a></li>
                    <?php } else { ?>
                        <li><a href="signin.php" class="nav-link px-2 link-dark">Login</a></li>
                        <li><a href="signup.php" class="nav-link px-2 link-dark">Signup</a></li>
                    <?php } ?>
                </ul>

                <?php if (isset($_SESSION['uid'])) { ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['fname'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="logout.php?logout=true">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </header>