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
    
    $query = "Select * from User where username = \"".$username."\";";
    
    $result = mysql_query($query);
    
    if (!$result) {
        $_SESSION['flash'] = "There was an issue on our side!";
        header( "Location: create_account.php");
    }
    
    if (mysql_num_rows($result) >= 1) {
        $_SESSION['flash'] = "Account by this username already exists!  Please select another username";
        header( "Location: create_account.php");
        exit();
    } else {
    
        $encrypted_password = crypt($password, $salt);
        $insert_query = "INSERT INTO User VALUES (NULL,\"".$username."\",\"".$encrypted_password."\");";
        if (mysql_query($insert_query)) {
            $_SESSION["username"] = $username;
            header ("Location: home.php");
            exit();
        } else {
            $_SESSION['flash'] = "Something went wrong on our end!  We'll work to fix it!";
            header("Location: create_account.php");
            exit();
        }
        
    }

?>