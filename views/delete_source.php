<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = "Manage";
$extra_header = "<a href=\"../views/manage_stream.php?streamID=$streamID\" class=\"ui-btn-left\">Back</a>";
    
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
            echo "<li>
                    <div class=\"feed_title_for_management\">$rss_feed_site_name - $rss_feed_filter</div>
                    <div class=\"delete_button_div\">
                    <div class=\"delete_button\" data-role=\"button\" rss_id=\"$rss_feed_id\" data-inline=\"true\" data-theme=\"delete\">Delete!</div>
                    </div>
                <div class=\"placeholder\"></div>
                </li>";
        }
        echo "<a id=\"add_source_button\" href=\"../views/manage_stream.php?streamID=$streamID\" 
            data-role=\"button\" data-prefetch>Done Removing Sources!</a>";
        echo "</ul>";
        echo "</div>";
        
        ?>
        
    </div><!-- /content -->
    
    <script>
    $( document ).ready(function(){
        $( ".delete_button" ).click(function(event) {
            var button= $(this);
            var rss_id = button.attr("rss_id");
            $.post("../controllers/remove_source_from_stream.php",
            {
                rssID : rss_id,
                streamID : <?php echo $streamID ?>,
            }, function(data) {
                if (data == "Success") {
                    button.parent().parent().remove();
                } else {
                    alert("Failure");
                }
            });
        });
    });
    </script>
</div><!-- /page -->

</body>
</html>