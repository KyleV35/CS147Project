<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$title = "Favorites";
$extra_header = "<a href=\"../views/home.php\" class=\"ui-btn-left\" data-prefetch>Back</a>";
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
        
        echo "<ul data-role=\"listview\" data-filter=\"true\" data-filter-placeholder=\"Filter Articles...\">";
        $all_articles_array = get_favorites($userID);
        if (empty($all_articles_array)) {
            echo "<p class=\"no_article_info\">You haven't favorited anything yet! Create a feed then start favoriting articles!</p>";
        } else {
            foreach ($all_articles_array as $article) {
                    $article_title = $article->get_title();
                    $article_link = $article->get_link();
                    $url_encoded_link = urlencode($article_link);
                    $url_encoded_title = urlencode($article_title);
                    $date = $article->formatted_date;
                    echo 
                    "<li> 
                        <a class=\"article_stub\" href=\"../views/favorite_article_view.php?article_title=$url_encoded_title\">
                            <div class=\"article_stub_div\">
                            <p class=\"article_link\">$url_encoded_link</p>
                            <h3 class=\"allow_overflow article_title\">$article_title</h3>
                            <p class=\"pub_date allow_overflow\">$date</p>
                            </div>
                        </a>
                        </li>";
            }
        }
                
        echo "</ul>";
        ?>
        
    </div><!-- /content -->
    
    <script>
        $(document).ready(function() {
            $(".delete_tooltip").click(function() {
               alert("Clicked!"); 
            });
        });
    </script>
</div><!-- /page -->

</body>
</html>
