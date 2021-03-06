<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = "Manage";
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
<div data-role="page" data-url="<?=$_SERVER["REQUEST_URI"]?>">

	<?php
	include '../views/header.php';
        echo "<div data-role=\"content\">";
        // Error Messages
	if ($_SESSION["flash"] != null or $_SESSION["info"] != null) {
            echo "<div class=\"info_box\">";
            if ($_SESSION["flash"]!=null) {
                echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
            }
            if ($_SESSION["info"]!=null) {
                echo "<p class=\"info_text\">".$_SESSION["info"]."</p>";
            }
            echo "</div>";
            unset($_SESSION["flash"]);
            unset($_SESSION["info"]);
        }
        // End of Error Message
        
        echo "<div class=\"stream_list_container\">";
        echo "<ul data-role=\"listview\">";
        // Need to implement a way to find out whether stream is active for user
        $feed_array = get_filter_rssID_active_siteName_for_streamID($streamID);
        foreach ($feed_array as $filter_rssID_active) {
            $rss_feed_site_name= $filter_rssID_active["siteName"];
            $rss_feed_filter= $filter_rssID_active["filter"];
            $rss_feed_id= $filter_rssID_active["rssID"];
            $rss_active_status = $filter_rssID_active["active"];
            if ($rss_active_status==0) {
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
            } else {
                echo "<li>
                    <div class=\"feed_title_for_management\">$rss_feed_site_name - $rss_feed_filter</div>
                    <div class=\"feed_activation_slider\">
                    <select class=\"feed_slider\" feed=\"$rss_feed_id\" name=\"flip-1\" data-role=\"slider\">
                        <option value=\"off\" SELECTED>Hide</option>
                        <option value=\"on\">Show</option>
                    </select> 
                    </div>
                <div class=\"placeholder\"></div>
                </li>";
            }
        }
        echo "<a id=\"add_source_button\" href=\"../views/add_source_view.php?streamID=$streamID\" 
            data-role=\"button\" data-prefetch>Add News Source!</a>";
        echo "<a id=\"add_custom_source_button\" href=\"../views/add_custom_view.php?streamID=$streamID\"
            data-role=\"button\" data-prefetch>Add Custom Source!</a>";
        echo "<a id=\"add_source_button\" href=\"../views/delete_source.php?streamID=$streamID\" 
            data-role=\"button\" data-prefetch>Remove A Source!</a>";
        echo "<a id=\"done_button\" href=\"../views/stream_view.php?streamID=$streamID\"
            data-role=\"button\" data-prefetch>Done Managing Feed!</a>";
        echo "</ul>";
        echo "</div>";
        
        ?>
        
    </div><!-- /content -->
    
    <script>
    $( document ).ready(function(){
        $( ".feed_slider" ).bind( "change", function(event, ui) {
            var slider= $(this);
            var active_status = slider.val();
            $.post("../controllers/update_active_status_for_feed.php",
            {
                rssID : slider.attr("feed"),
                streamID : <?php echo $streamID ?>,
                active : active_status
            }, function() {
                //$.mobile.loadPage("../views/stream_view.php?streamID=<?php echo $streamID?>", {showLoadMsg:true});
            });
        });
    });
    </script>
</div><!-- /page -->

</body>
</html>
