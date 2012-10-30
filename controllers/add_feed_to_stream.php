<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$rssID = $_GET["rssID"];
$streamID = $_GET["streamID"];
$success = add_feed_to_stream($rssID, $streamID);
if ($success) {
    $_SESSION["info"]= "Feed successfully added to stream!";
} else {
    $_SESSION["flash"]= "Something happened on our side, we'll work to fix it!";
}
header("Location: ../views/stream_view?streamID=$streamID");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
