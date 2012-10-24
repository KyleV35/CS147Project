<?php
    include 'config.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    echo '<p>'.$username.'</p>';
    echo '<p>'.$password.'</p>';
?>