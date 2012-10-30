<?php
    session_start();
    
    include_once '../utils/config.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    login($username, $password, '../views/mobile.php', '../views/home.php');
?>