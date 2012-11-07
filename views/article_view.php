<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$article_link = $_GET["article_link"];
$title = "Article";
$extra_header = "<a href=\"../views/stream_view.php?streamID=$streamID\" 
    class=\"ui-btn-left\" data-prefetch>Back</a>";
    
?>

<!DOCTYPE html>
<html>
<head>
<?php
    include_once '../utils/meta.php' //Always include this file, has many necessary, but redundant files
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
        echo "<a href=\"$article_link\">Article!</a>";
        ?>
    
    
        
    </div><!-- /content -->
    
    <script>
    $(document).ready(function() {
            saveState(<?=$userID?>,"<?=$_SERVER["REQUEST_URI"]?>");
    });
    </script>
</div><!-- /page -->


</body>
</html>
