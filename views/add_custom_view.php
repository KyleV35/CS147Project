<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = "Add Custom!";
$extra_header = "<a href=\"../views/manage_stream.php?streamID=$streamID\" class=\"ui-btn-left\" data-prefetch>Cancel</a>";
    
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
        
        ?>
    <form action="../controllers/add_custom_feed_to_stream.php" method="post">
        <p class="custom_search_header">Want to have completely custom news?</p>
        <p>Enter the topic for your custom feed below:</p>
        <input type="text" name="search_filter" placeholder="Custom Feed Topic"/>
        <input type="hidden" name="streamID" value="<?=$streamID?>"/>
        <input type="submit" value="Create Custom Source!"/>
    </form>
    
    
    </div> <!-- /Content -->
</div><!-- /page -->

</body>
</html>