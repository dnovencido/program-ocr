<?php 
    if(!isset($_SESSION['uid'])) {
        header("Location: signin.php ");
    }
?>