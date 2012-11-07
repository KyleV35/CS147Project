<?php
    include_once '../utils/config.php';
    session_start();
    $streamID = (int)$_POST["streamID"];
    $new_name = $_POST["new_stream_name"];
    update_name_for_stream($streamID,$new_name);
    header("Location: ../views/home.php");  
?>