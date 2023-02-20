<?php
    $servername = "mysql_db";
    $username = "root";
    $password = "root";
    $databasename = "projdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>