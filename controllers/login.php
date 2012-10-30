<?php
    session_start();
    
    include 'config.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $encrypted_password = crypt($password, $salt);
    
    if (strlen($username) == 0) {
        $_SESSION["flash"] = "Username and/or password is incorrect.";
        header( "Location: mobile.php");
        exit();
    }
    
    $query = "Select * from User where username = \"".$username."\" and password = \"".$encrypted_password."\";";
    
    
    $result = mysql_query($query); // Returns FALSE on error
    
    if (!$result or mysql_num_rows($result) == 0) {
        //Login unsuccessful
        $_SESSION["flash"] = "Username and/or password is incorrect.";
        header('Location: mobile.php');
        exit();
    } else {
        //Login successful
        $result_array = mysql_fetch_assoc($result);
        $_SESSION["userID"] = $result_array["userID"];
        header('Location: home.php');
        exit();
    }
?>