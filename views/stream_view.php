<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = $stream_name;
$url_safe_streamID = urlencode($streamID);
$extra_header = "<a href=\"../views/home.php\" class=\"ui-btn-left\">Streams List</a>
<a href=\"../views/manage_stream.php?streamID=$url_safe_streamID\" class=\"ui-btn-right\" 
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
<div data-role="page" data-url="<?=$_SERVER["REQUEST_URI"]?>">

	<?php
	include '../views/header.php';
        echo "<div data-role=\"content\">";
        // Error Messages
	if ($_SESSION["flash"] != null) {
            echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
            unset($_SESSION["flash"]);
        }
        
        $rss_feed_array = get_rss_feeds_for_stream($streamID, TRUE);
        echo "<ul data-role=\"listview\" data-filter=\"true\" data-filter-placeholder=\"Filter Articles...\">";
        $all_articles_array = array();
        foreach ($rss_feed_array as $rss_feed) {
            $all_articles_array = array_merge($all_articles_array,$rss_feed->get_article_list());
        }
        $sorted_articles = uasort($all_articles_array, 'compare_articles');
        foreach ($all_articles_array as $article) {
                $article_title = $article->get_title();
                $article_link = $article->get_link();
                $article_site_name = $article->get_site_name();
                $article_description = $article->get_description();
                $rss_filter = $article->get_filter();
                $date = $article->get_date();
                $day = $date->get_day();
                $time = $date->get_time();
                echo "<li> 
                    <a class=\"article_stub\" href=\"$article_link\">
                        <div class=\"article_stub_div\">
                        <h3 class=\"allow_overflow article_title\">$article_title</h3>
                        <p class=\"allow_overflow article_site\">$article_site_name - 
                            $rss_filter</p>
                        <p class=\"description allow_overflow\">$article_description</p>
                        </div>
                    </a>
                    </li>";
                /*"<li> 
                    <a class=\"article_stub\" href=\"../views/article_view.php?streamID=$streamID&article_title=$article_title&article_link=$article_link\">
                        <div class=\"article_stub_div\">
                        <h3 class=\"allow_overflow article_title\">$article_title</h3>
                        <p class=\"allow_overflow article_site\">$article_site_name - 
                            $rss_filter</p>
                        <p class=\"description allow_overflow\">$article_description</p>
                        <p class=\"allow_overflow\">$day $time</p>
                        </div>
                    </a>
                    </li>";
                 /*
                 
     
                    "<a onclick=\"parent.location='$article_link'\">
                        <div class=\"article_stub_div\">
                        <h3 class=\"allow_overflow article_title\">$article_title</h3>
                        <p class=\"allow_overflow article_site\">$article_site_name - 
                            $rss_filter</p>
                        <p class=\"allow_overflow\">$article_description</p>
                        </div>
                    </a>
                    </li>";
                   */ 
        }
                
        echo "</ul>";
        ?>
        
    </div><!-- /content -->
    
    <script>
        $(document).ready(function() {
            saveState(<?=$userID?>,"<?=$_SERVER["REQUEST_URI"]?>"); 
        });
    </script>
    <!--
    <script>
        $(document).ready(function() {
            saveState(<?=$userID?>,"<?=$_SERVER["REQUEST_URI"]?>"); 
            $(".article_stub").live('click',function(event) {
                event.preventDefault();
                var link = this;
                var description = $(this).children(".article_stub_div").children(".description").text();
                $.post("../controllers/article.php", {
                    description: description
                }, function() {               
                    //window.location= link.valueOf();
                });
            });
        });
    </script>
    -->
</div><!-- /page -->

</body>
</html>
