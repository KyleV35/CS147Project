<?php

    include_once '../models/stream.php';

    $link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147kvermeer', 'booboo35');
    mysql_select_db('c_cs147_kvermeer');
    
    function get_userID_from_username($username, $failure_page) {
        $query = "Select userID from User where username = \"$username\";";
        $result = mysql_query($query);
        if (!$result or mysql_num_rows($result) <= 0) {
            $_SESSION["flash"] = "User ID could not be fetched!";
            header("Location: '$failure_page'");
            exit();
        }
        $result_array = mysql_fetch_assoc($result);
        $userID = $result_array["userID"];
        return $userID;
    }
    
    function login($username, $password, $failure_page, $success_page) {
        $encrypted_password = crypt($password, $GLOBALS["salt"]);
        $query = "Select * from User where username = \"$username\" and password = \"$encrypted_password\";";
        $result = mysql_query($query); // Returns FALSE on error
    
        if (!result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: $failure_page");
        }
        if (!$result or mysql_num_rows($result) == 0) {
            //Login unsuccessful
            $_SESSION["flash"] = "Username and/or password is incorrect.";
            header("Location: $failure_page");
            exit();
        } else {
            //Login successful
            $result_array = mysql_fetch_assoc($result);
            $_SESSION["userID"] = $result_array["userID"];
            header("Location: $success_page");
            exit();
        }
    }
    
    function account_already_exists($username) {
        $query = "Select * from User where username = \"".$username."\";";
        $result = mysql_query($query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/create_account.php");
        } else if (mysql_num_rows($result) >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function get_streams_for_userID($userID) {
        
        $stream_query = "Select * from Stream where userID = ".$userID.";";
        $result = mysql_query($stream_query);
        if (!result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $stream_array = array();
        while ($row = mysql_fetch_assoc($result)) {
            $stream = new Stream($row["streamName"], $row["userID"], $row["streamID"]);
            array_push($stream_array, $stream);
        }
        return $stream_array;
    }
?>
