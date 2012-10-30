<?php
    session_start();
    
    include_once '../utils/config.php';
    
    $stream_name = $_POST['streamName'];
    if (strlen($stream_name) <= 0 ) {
         $_SESSION["flash"] = "The stream name must be at least 1 character!";
        header('Location: ../views/wrong.php');
        exit();
    }
    
    $userID = require_login("../views/mobile.php");
    
    $streamID = create_stream($userID, $stream_name);
    
    if ($streamID) {
        header("Location: ../views/manage_stream.php?streamID=$streamID");
        exit();
    } else {
        $_SESSION["flash"] = "The stream could not be created.  We'll work to fix this!";
        header('Location: ../views/home.php');
        exit();
    }

?>