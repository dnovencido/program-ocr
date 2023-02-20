<?php
    include 'session.php';
?>

<?php include "_header.php"; ?>
    <div class="container">
        <h1>Hello <?= $_SESSION['fname'] ?> </h1>
    </div>
<?php include '_footer.php' ?>