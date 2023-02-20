<?php
    include 'db.php';

    function escape_string($field) {
        global $conn;

        return mysqli_real_escape_string($conn, $field);
    }

    function login_account($username, $password) {
        global $conn;
        $user = [];

        $query = "SELECT * FROM `tbl_user` WHERE `uname` = '".mysqli_real_escape_string($conn, $username)."'";

        if ($result = $conn->query($query)) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
        }

        if(!empty($row)) {
            $hashed_password = md5(md5($row['uid'].$password));
            if ($hashed_password == $row['pass']) {
                $user = [
                    'uid' => $row['uid'],
                    'fname' => $row['fname']
                ];
            }
        }

        return $user;
    }

    function check_existing_username($username) {
        global $conn ;
        $flag = false;

        $query = "SELECT `uid` FROM `tbl_user` WHERE `uname` = '".escape_string($username)."' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result->num_rows > 0) {
            $flag = true;
        }

        return $flag;
    }    

    function save_registration($username, $lname, $fname, $position, $password) {
        global $conn;
        $user = [];

        $entry_date = date('Y-m-d H:i:s');
        $query = "INSERT INTO `tbl_user` (`uname`, `lname`, `fname`, `position`, `entry_date`) VALUES ('".escape_string($username)."', '".escape_string(($lname))."', '".escape_string(($fname))."', '".escape_string(($position))."', '".$entry_date."')";

        if ($conn->query($query)) {
            $id = $conn->insert_id;
            $encrypted_password = md5(md5($id . $password));

            $query = "UPDATE `tbl_user` SET pass = '".$encrypted_password."' WHERE `tbl_user`.`uid` = ".$id." LIMIT 1";
            
            if($conn->query($query)) {
                $query = "SELECT * FROM `tbl_user` WHERE `tbl_user`.`uid` = '".$id."' AND `tbl_user`.`pass` = '".mysqli_escape_string($conn, $encrypted_password)."'  LIMIT 1";
    
                if($result = $conn->query($query)) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $user = [
                        'id' => $row['id'],
                        'name' => $row['name']
                    ];
                }
            }
        }

        return $user;
    }    
?>