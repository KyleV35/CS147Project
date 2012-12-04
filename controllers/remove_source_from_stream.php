<?php
    include_once '../utils/config.php';
    session_start();
    $streamID = $_POST["streamID"];
    $rssID = $_POST["rssID"];
    if (remove_source_from_stream($rssID, $streamID)) {
        echo "Success";
    } else {
        echo "Failure";
    }
?>