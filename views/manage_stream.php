<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = "Manage ".$stream_name;
$extra_header = "<a href=\"../views/stream_view.php?streamID=$streamID\" class=\"ui-btn-left\">$stream_name</a>";
    
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
        
        echo "<div class=\"stream_list_container\">";
        echo "<ul data-role=\"listview\">";
        echo "<a id=\"add_source_button\" href=\"../views/add_source_view.php?streamID=$streamID\" data-role=\"button\">Add new source!</a>";
        echo "</ul>";
        echo "</div>";
        
        ?>
    
        <!-- Add Source Popup -->
        <div data-role="popup" id="add_source_popup" class="popup">
            <ul data-role="listview" data-filter="true" data-autodividers="true">
                <li>A</li>
                <li>B</li>
                <li>C</li>
                <li>D</li>
                <li>E</li>
                <li>F</li>
                <li>G</li>
                <li>H</li>
            </ul>
            <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	    <form action="../controllers/createStream.php" method="post">
                <input type="text" name="sourceURL" value="" placeholder="Source URL" />
                <input type="submit" value="Add source!"/>
            </form>
	</div>
	<!-- Add Source Popup -->
        
    </div><!-- /content -->
</div><!-- /page -->

</body>
</html>
