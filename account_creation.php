<?php
    session_start();

    include 'config.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (strlen($password) == 0) {
        $_SESSION['flash'] = "Your password must be at least one character!";
        header( "Location: create_account.php");
        exit();
    }
    
    $query = "Select * from Users where username = \"".$username."\";";
    
    $result = mysql_query($query);
    
    if (mysql_num_rows($result) >= 1) {
        $_SESSION['flash'] = "Account by this username already exists!  Please select another username";
        header( "Location: create_account.php");
        exit();
    } else {
    
        $salt = 'kv35';
        $encrypted_password = crypt($password, $salt);
        $insert_query = "INSERT INTO Users VALUES (\"".$username."\",\"".$encrypted_password."\");";
        header ("Location: home.php");
        exit();
    }

?>