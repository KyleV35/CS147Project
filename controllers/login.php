<?php
    session_start();
    
    include 'utils/config.php';
    include 'utils/utils.php';
    include 'utils/database_functions.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    login($username, $password, 'mobile.php', 'home.php');
?>