<?php
    session_start();
    
    include_once '../utils/config.php';
    
    $stream_name = $_POST['streamName'];
    if (strlen($stream_name) <= 0 ) {
         $_SESSION["flash"] = "The stream name must be at least 1 character!";
        header('Location: ../views/wrong.php');
        exit();
    }
    
    $userID = require_login("mobile.php");
    
    $insert_stream_query = "INSERT INTO Stream VALUES (NULL,".$userID.",\"".$stream_name."\");";
    
    $result = mysql_query($insert_stream_query);
    
    
    if ($result) {
        header('Location: ../views/home.php');
        exit();
    } else {
        $_SESSION["flash"] = "The stream could not be created.  We'll work to fix this!";
        header('Location: ../views/home.php');
        exit();
    }

?>