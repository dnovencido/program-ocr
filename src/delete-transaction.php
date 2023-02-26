<?php
    include "functions.php";
    
    $result = [];

    if(array_key_exists("tranID", $_GET)) {
        $result['deleted'] = false;
        $is_deleted = delete_transaction($_GET['tranID']);

        if($is_deleted) {
            $result['deleted'] = true;
        } 
    }

    echo json_encode($result);
?>