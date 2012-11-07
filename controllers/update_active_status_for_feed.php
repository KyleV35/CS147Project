<?php

include_once '../utils/config.php';

$streamID = $_POST["streamID"];
$rssID = $_POST["rssID"];
$should_be_active = $_POST["active"];

echo "streamID ".$streamID;
echo "rssID ".$rssID;
echo "should_be_active ".$should_be_active;

if (strcmp($should_be_active,"on") == 0) {
    set_active_for_feed($streamID, $rssID, TRUE);
} else {
    set_active_for_feed($streamID, $rssID, FALSE);
}




?>
