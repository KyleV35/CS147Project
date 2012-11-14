<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$siteID = $_GET["siteID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$site = get_site_for_siteID($siteID);
$site_name = $site->get_site_name();
$title = "Select Feed for: ".$site_name;
$extra_header = "<a href=\"../views/add_source_view.php?streamID=$streamID\" class=\"ui-btn-left\" data-prefetch>Sites</a>";
    
?>

<!DOCTYPE html>
<html>
<head>
<?php
    include '../utils/meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page" data-url="<?=$_SERVER["REQUEST_URI"]?>">

	<?php
	include '../views/header.php';
        echo "<div data-role=\"content\">";
        // Error Messages
	if ($_SESSION["flash"] != null) {
            echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
            unset($_SESSION["flash"]);
        }
        
        echo "<ul data-role=\"listview\" data-filter=\"true\" data-filter-placeholder=\"Filter Feeds...\" data-autodividers=\"true\">";
        $rss_feed_array = get_rss_feeds_for_siteID($siteID);
        foreach ($rss_feed_array as $rss_feed) {
            $rss_feed_filter = $rss_feed->get_filter();
            $rssID = $rss_feed->get_rssID();
            echo "<li><a href=\"../controllers/add_feed_to_stream.php?streamID=$streamID&rssID=$rssID\">$rss_feed_filter</a></li>";
        }
                
        echo "</ul>";
        
        ?>
        
    </div><!-- /content -->
    <script>
    $(document).ready(function() {
        saveState(<?=$userID?>,"<?=$_SERVER["REQUEST_URI"]?>");
    });
    </script>
</div><!-- /page -->

</body>
</html>