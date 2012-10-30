<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = $stream_name;
$extra_header = "<a href=\"../views/home.php\" class=\"ui-btn-left\">Streams List</a>
<a href=\"../views/manage_stream.php?streamID=$streamID\" class=\"ui-btn-right\" 
    data-icon=\"gear\">Manage</a>";
    
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
        
        $rss_feed_array = get_rss_feeds_for_stream($streamID);
        echo "<ul data-role=\"listview\" data-filter=\"true\">";
        foreach ($rss_feed_array as $rss_feed) {
            $article_array = $rss_feed->get_article_list();
            foreach ($article_array as $article) {
                $article_title = $article->get_title();
                $article_link = $article->get_link();
                $article_description = $article->get_description();
                echo "<li>
                    <a href=\"$article_link\ data-role=\"button\">
                        <div class=\"article_stub_div\">
                        <h3 class=\"allow_overflow\">$article_title</h3>
                        <p class=\"allow_overflow\">$article_description</p>
                        </div>
                    </a>
                    </li>";
            }
        }
                
        echo "</ul>";
        ?>
        
    </div><!-- /content -->
</div><!-- /page -->

</body>
</html>
