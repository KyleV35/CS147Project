<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$siteID = $_GET["siteID"];
$rss_feed_array = get_rss_feeds_for_siteID($siteID);
$title = "RSS URLS";
    
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
        
        echo "<ul data-role=\"listview\" data-filter=\"true\">";
        foreach ($rss_feed_array as $rss_feed) {
            $article_array = $rss_feed->get_article_list();
            foreach ($article_array as $article) {
                $article_title = $article->get_title();
                $article_link = $article->get_link();
                echo "<li><a href=\"$article_link\">$article_title</a></li>";
            }
        }
                
        echo "</ul>";
        
        ?>
        
    </div><!-- /content -->
</div><!-- /page -->

</body>
</html>