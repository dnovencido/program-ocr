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

    function save_registration($username, $fname, $lname, $position, $password) {
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
                        'uid' => $row['uid'],
                        'fname' => $row['fname']
                    ];
                }
            }
        }

        return $user;
    } 
    

    function validate_form_transaction($refnum, $number, $amount, $name) {
        $validation_errors = [];

        if(!$refnum) {
            $validation_errors[] = "Reference number is required.";
        }
        if(!$number) {
            $validation_errors[] = "Number is required.";
        }
        if(!$amount) {
            $validation_errors[] = "Amount is required.";
        }
        if(!$name) {
            $validation_errors[] = "Name is required.";
        }

        return $validation_errors;
    }

    
    function save_details($reference_number, $number, $amount, $name) {
        global $conn;
        $flag = false;

        $date_created = date('Y-m-d H:i:s');
        $query = "INSERT INTO `tbl_transaction` (`refnum`, `number`, `amount`, `name`, `date_created`) VALUES ('".escape_string($reference_number)."', '".escape_string(($number))."', '".escape_string(($amount))."', '".escape_string(($name))."', '".$date_created."')";
        
        if ($conn->query($query)) {
            $flag = true;
        }

        return $flag;
    }

    function update_transaction($tranID, $refnum, $number, $amount, $name) {
        global $conn;
        $flag = false;

        $query = "UPDATE `tbl_transaction` SET `refnum` = '".escape_string($refnum)."', `number` = '".escape_string($number)."', `amount` = '".escape_string($amount)."', `name` = '".escape_string($name)."' WHERE `tranID` = '".escape_string($tranID)."' ";
        
        if ($conn->query($query)) {
            $flag = true;
        }

        return $flag;
    }

    function get_all_transactions($offset, $total_records_per_page) {
        global $conn;
        $transactions= [];

        $query = "SELECT * FROM `tbl_transaction` LIMIT $offset, $total_records_per_page";
       
        if ($result = $conn->query($query)) {
            $transactions = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $transactions;
    }  
    

    function check_existing_reference_num($reference_number) {
        global $conn;
        $flag = false;

        $query = "SELECT * FROM `tbl_transaction` WHERE `refnum` = '".escape_string($reference_number)."' ";

        if ($result = $conn->query($query)) {
            if ($result->num_rows > 0) {
                $flag = true;
            }
        }

        return $flag;
    }

    
    function get_transaction($transaction_id) {
        global $conn;
        $transaction = [];
        $query = "SELECT * FROM `tbl_transaction` WHERE `tranID` = $transaction_id";

        if ($result = $conn->query($query)) {
            $transaction = $result->fetch_array(MYSQLI_ASSOC);
        }

        return $transaction;

    }

    function delete_transaction($tranID) {
        global $conn;
        $flag = false;

        $query = "DELETE FROM tbl_transaction WHERE tranID = '".escape_string($tranID)."'";

        if ($conn->query($query)) {
            $flag = true;
        }

        return $flag;
    }

    function get_total_number_records() {
        global $conn;
        $total = 0;

        $query = "SELECT * FROM `tbl_transaction`";

        if ($result = $conn->query($query)) {
            $total = $result->num_rows;
        }
    
        return $total;
    }

    function get_total_number_trace_records($search, $date) {
        global $conn;
        $total = 0;
        $search_field = false;

        $query = "SELECT * FROM `tbl_trace`";
        
        if($search != null) {
            $query .= "WHERE (`tbl_trace`.`uname` = '".escape_string($search)."' OR `tbl_trace`.`action` = '".escape_string($search)."')";
            $search_field = true;
        }
    
        if($date != null) {
            $query .= ($search_field) ? ' AND ' : '';  
            $query .= "(`tbl_trace`.`date` LIKE '".date("Y-m-d", strtotime(escape_string($date)))."%')";
        }

        if ($result = $conn->query($query)) {
            $total = $result->num_rows;
        }
    
        return $total;
    }
    

    function get_all_trace_transactions($offset, $total_records_per_page, $search, $date) {
        global $conn;
        $transactions = [];
        $search_field = false;

        $query = "SELECT * FROM `tbl_trace`";
        
        if($search != null) {
            $query .= "WHERE (`tbl_trace`.`uname` = '".escape_string($search)."' OR `tbl_trace`.`action` = '".escape_string($search)."')";
            $search_field = true;
        }
    
        if($date != null) {
            $query .= ($search_field) ? ' AND ' : '';  
            $query .= "(`tbl_trace`.`date` LIKE '".date("Y-m-d", strtotime(escape_string($date)))."%')";
        }

        $query .= " LIMIT $offset, $total_records_per_page";

        if ($result = $conn->query($query)) {
            $transactions = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $transactions;
    }      

    function save_trace($action, $uid) {
        global $conn;
        $flag = false;

        $user = find_by_id($uid);

        $date_created = date('Y-m-d H:i:s');
        $query = "INSERT INTO `tbl_trace` (`action`, `uname`, `date`) VALUES ('".$action."', '".$user['uname']."', '".$date_created."')";
        
        if ($conn->query($query)) {
            $flag = true;
        }

        return $flag;
    }

    function find_by_id($uid) {
        global $conn;
        $user = [];

        $query = "SELECT `uname` FROM `tbl_user` WHERE `tbl_user`.`uid` = $uid";
       
        if ($result = $conn->query($query)) {
            $user = $result->fetch_array(MYSQLI_ASSOC);
        }

        return $user;
    }
?>