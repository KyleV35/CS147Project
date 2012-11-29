<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$article_title = $_GET["article_title"];
$title = $article_title;
$extra_header = "<a href=\"../views/favorites_view.php\" 
    class=\"ui-btn-left\" data-prefetch>Back</a>";
$article = get_favorite_article_by_title($userID, $title);
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
        
    <h1 class="article_title title_size"><?=stripcslashes($article->get_title())?></h1>
    <p class="pub_date"><?=$article->formatted_date?></p>
    <div class="description_background">
    <?php
        if ($article->get_description()!=null) {
            $cleaned_description = stripcslashes($article->get_description());
            echo "<p class=\"description_text\">$cleaned_description</p>";
        } else {
            echo "<p class=\"description_text\">Sorry, no description was available!</p>";
        }
    ?>
    </div>
    <a id="view_article_button" data-role="button" href="<?=$article->get_link()?>">View this Article!</a>
    
    
        
    </div><!-- /content -->
    
    <script>
        $(document).ready(function() {
           $("#view_article_button").click(function() {
               $.post("../controllers/view_article_controller.php", {
                   userID: <?=$userID?>
               }, function(data) {
                   
               }) ;
           });
        });
    </script>
    
</div><!-- /page -->


</body>
</html>
