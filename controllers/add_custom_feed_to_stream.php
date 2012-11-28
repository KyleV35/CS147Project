<?php
include_once '../utils/config.php';
session_start();
$streamID = $_POST["streamID"];
$search_filter = $_POST["search_filter"];
$rss_url = "https://news.google.com/news/feeds?hl=en&q=".urlencode($search_filter);
if (insert_custom_rss_feed($rss_url, $search_filter, $streamID)) {
    $_SESSION["info"]= "Feed successfully added to stream!";
} else {
    $_SESSION["flash"]= "Something happened on our side, we'll work to fix it!";
}
header("Location: ../views/manage_stream?streamID=$streamID");
?>
