<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
//$article_link = $_GET["article_link"];
$title = "Article";
$extra_header = "<a href=\"../views/stream_view.php?streamID=$streamID\" 
    class=\"ui-btn-left\" data-prefetch>Back</a>";
$article_title = $_GET["article_title"];
$article_description = urldecode($_GET["description"]);
$article_link = urldecode($_GET["link"]);
$article_source = urldecode($_GET["source"]);
$article_pub_date = urldecode($_GET["pub_date"]);
//$article_description = $_SESSION["description"];
//$article_source = $_SESSION["source"];
//$article_link = urldecode($_SESSION["link"]);
//$article_pub_date = $_SESSION["pub_date"];
?>

<!DOCTYPE html>
<html>
<head>
<?php
    include_once '../utils/meta.php' //Always include this file, has many necessary, but redundant files
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
        ?>
        
    <h1 class="article_title title_size"><?=stripcslashes($article_title)?></h1>
    <p class="article_site_large"><?=$article_source?></p>
    <p class="pub_date"><?=$article_pub_date?></p>
    <div class="description_background">
    <?php
        if ($article_description!=null) {
            $cleaned_description = stripcslashes($article_description);
            echo "<p class=\"description_text\">$cleaned_description</p>";
        } else {
            echo "<p class=\"description_text\">Sorry, no description was available!</p>";
        }
    ?>
    </div>
    <a id="view_article_button" data-role="button" href="<?=$article_link?>">View this Article!</a>
    <a id="favorite_button" data-role="button" href="#">Favorite This Article!</a>
    
    
        
    </div><!-- /content -->
    
    <script>
        $(document).ready(function() {
           /*$("#view_article_button").click(function() {
               $.post("../controllers/view_article_controller.php", {
                   userID: <?=$userID?>
               }, function(data) {
                   
               }) ;
           });
           */
           $("#favorite_button").click(function() {
              $.post("../controllers/add_favorite.php", {
                        userID: <?=$userID?>,
                        article_title: "<?=$article_title?>",
                        article_source: "<?=urlencode($article_link)?>",
                        pub_date: "<?=$article_pub_date?>",
                        description: "<?=urlencode($article_description)?>"
                    }, function(data) {
                        alert("You Have Favorited this article");
                    }
              );
           });
        });
    </script>
    
</div><!-- /page -->


</body>
</html>
