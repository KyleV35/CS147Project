<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$article_link = $_GET["article_link"];
$title = "Article";
$extra_header = "<a href=\"../views/stream_view.php?streamID=$streamID\" 
    class=\"ui-btn-left\" data-prefetch>Back</a>";
$article_title = $_GET["article_title"];
$article_description = $_SESSION["description"];
$article_source = $_SESSION["source"];
$article_link = urldecode($_SESSION["link"]);
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
        
    <h1 class="article_title text_center"><?=stripcslashes($article_title)?></h1>
    <p class="text_center article_site">Source: <?=$article_source?></p>
    <div class="description_background">
    <?php
        if ($article_description!=null) {
            $cleaned_description = stripcslashes($article_description);
            echo "<p>$cleaned_description</p>";
        } else {
            echo "<p>Sorry, no description was available!</p>";
        }
    ?>
    </div>
    <a data-role="button" href="<?=$article_link?>">View this Article!</a>
    
    
        
    </div><!-- /content -->
    
</div><!-- /page -->


</body>
</html>
