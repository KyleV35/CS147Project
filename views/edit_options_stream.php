<?php
    include_once '../utils/config.php';
    session_start();
    $title = "Edit!";
    $extra_header = "<a href=\"../views/edit_streams.php\" class=\"ui-btn-left\" data-prefetch>Streams</a>";
    $userID = require_login("mobile.php");
    $streamID = $_GET["streamID"];
?>

<!DOCTYPE html>
<html>
<head>
<?php
    echo '<title>'.$title.'</title>';
    include '../utils/meta.php'; //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page" data-url="<?=$_SERVER["REQUEST_URI"]?>">

	<?php
	include '../views/header.php';
        echo "<div data-role=\"content\">";
        // Error Messages
	if ($_SESSION["flash"] != null or $_SESSION["info"]) {
            echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
            unset($_SESSION["flash"]);
        }
        
        echo "<p>Change the name of the stream:</p>";
        echo "<a href=\"#update_name_popup\" data-role=\"button\" data-rel=\"popup\">Update Name!</a>";
        echo "<p>Manage the sources displayed for this feed:</p>";
        echo "<a href=\"manage_stream.php?streamID=$streamID\" data-role=\"button\">Manage Sources</a>";
        echo "<p>Delete this stream!</p>";
        echo "<a href=\"#delete_stream_popup\" data-theme=\"delete\" data-role=\"button\" data-rel=\"popup\">Delete Stream!</a>";
	?>
	    
        
        <!-- Update Name Popup -->
        <div data-role="popup" id="update_name_popup" class="popup">
	    <form action="../controllers/update_stream_name.php" method="post">
                <input type="text" name="new_stream_name" value="" placeholder="New Stream Name" />
                <input type="hidden" name="streamID" value="<?=$streamID?>" />
                <a href="#" data-rel="back" data-role="button" data-inline="true">Cancel</a>
                <input data-inline="true" data-theme="b" type="submit" value="Update!"/>
            </form>
	</div>
	<!-- /Update Name Popup -->
        
        <!-- Delete Stream Popup -->
        <div data-role="popup" id="delete_stream_popup" class="popup">
	    <form action="../controllers/delete_stream.php?streamID=<?=$streamID?>" method="get">
                <p>Are you sure you want to delete this stream?</p>
                <a href="#" data-rel="back" data-role="button" data-inline="true">Cancel</a>
                <input data-theme="delete" data-inline="true" type="submit" value="Delete!"/>
            </form>
	</div>
	<!-- /Delete Stream Popup -->
        
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>