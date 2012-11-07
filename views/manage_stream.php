<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = "Manage ".$stream_name;
$extra_header = "<a href=\"../views/stream_view.php?streamID=$streamID\" class=\"ui-btn-left\">$stream_name</a>";
    
?>

<!DOCTYPE html>
<html>
<head>
<?php
    include '../utils/meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page">

	<?php
	include '../views/header.php';
        echo "<div data-role=\"content\">";
        // Error Messages
	if ($_SESSION["flash"] != null) {
            echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
            unset($_SESSION["flash"]);
        }
        
        echo "<div class=\"stream_list_container\">";
        echo "<ul data-role=\"listview\">";
        $rss_feed_array = get_rss_feeds_for_stream($streamID, FALSE);
        foreach ($rss_feed_array as $rss_feed) {
            $rss_feed_site_name= $rss_feed->get_site_name();
            $rss_feed_filter= $rss_feed->get_filter();
            $rss_feed_id= $rss_feed->get_rssID();
            echo "<li>
                <div class=\"feed_title_for_management\">$rss_feed_site_name - $rss_feed_filter</div>
                <div class=\"feed_activation_slider\">
                <select class=\"feed_slider\" feed=\"$rss_feed_id\" name=\"flip-1\" data-role=\"slider\">
                    <option value=\"off\">Hide</option>
                    <option value=\"on\" SELECTED>Show</option>
                </select> 
                </div>
                <div class=\"placeholder\"></div>
                </li>";
        }
        echo "<a id=\"add_source_button\" href=\"../views/add_source_view.php?streamID=$streamID\" data-role=\"button\">Add new source!</a>";
        echo "</ul>";
        echo "</div>";
        
        ?>
        
    </div><!-- /content -->
    
    <script>
    $( document ).ready(function(){
        $( ".feed_slider" ).bind( "change", function(event, ui) {
            var slider= $(this);
            var active_status = slider.val();
            alert(active_status);
            $.post("../controllers/update_active_status_for_feed.php",
            {
                rssID : slider.attr("feed"),
                streamID : <?php echo $streamID ?>,
                active : active_status
            });
        });
    });
</script>
</div><!-- /page -->

</body>
</html>
