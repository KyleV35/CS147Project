<?php
    /* Functions */
    
    function create_user($username, $password) {
        $encrypted_password = crypt($password, $GLOBALS["salt"]);
        $insert_query = "INSERT INTO User VALUES (NULL,\"$username\",\"$encrypted_password\");";
        if (mysql_query($insert_query)) {
            $userID = mysql_insert_id();
            $_SESSION["userID"] = $userID;
            header ("Location: home.php");
            exit();
        } else {
            $_SESSION['flash'] = "Something went wrong on our end!  We'll work to fix it!";
            header("Location: create_account.php");
            exit();
        }
    }
    
    /* Executed Code */
    session_start();

    include 'utils/config.php';
    include 'utils/utils.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $bad_username_message = "Your username must be at least one character!";
    $bad_password_message = "Your password must be at least one character!";
    $bad_info_page = "create_account.php";
    require_length($username, 1, $bad_username_message, $bad_info_page);
    require_length($password, 1, $bad_password_message, $bad_info_page);
    
    // Check if account already exists, otherwise make account!
    if (account_already_exists($username)) {
        $_SESSION['flash'] = "Account by this username already exists!  Please select another username";
        header( "Location: create_account.php");
        exit();
    } else {
        create_user($username, $password);
    }

?>