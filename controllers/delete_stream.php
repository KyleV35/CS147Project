<?php
    include_once '../utils/config.php';
    session_start();
    $streamID = $_GET["streamID"];
    delete_stream($streamID);
    header("Location: ../views/home.php");
    
?>
