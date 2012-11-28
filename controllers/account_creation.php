<?php
    
    /* Executed Code */
    session_start();

    include_once '../utils/config.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $bad_username_message = "Your username must be at least one character!";
    $bad_password_message = "Your password must be at least one character!";
    $bad_info_page = "../views/create_account.php";
    require_length($username, 1, $bad_username_message, $bad_info_page);
    require_length($password, 1, $bad_password_message, $bad_info_page);
    
    // Check if account already exists, otherwise make account!
    if (account_already_exists($username)) {
        $_SESSION['flash'] = "Account by this username already exists!  Please select another username";
        header( "Location: ../views/create_account.php");
        exit();
    } else {
        create_user($username, $password);
    }

?>