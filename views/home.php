<?php
    include 'utils/config.php';
    include 'utils/utils.php';
    include 'utils/database_functions.php';
    include 'models/stream.php';
    session_start();
    $title = "Your feeds!";
    $extra_header = "<a href=\"logout.php\" class=\"ui-btn-left\">Logout</a>";
    $userID = require_login("mobile.php");
    
        
?>

<!DOCTYPE html>
<html>
<head>
<?php
    include 'meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page">

	<?php
	include 'header.php';
        echo "<div data-role=\"content\">";
        // Error Messages
	if ($_SESSION["flash"] != null) {
            echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
            unset($_SESSION["flash"]);
        }
        
        /* Populate stream list with streams */
        $stream_array = get_streams_for_userID($userID);
        echo "<div class=\"stream_list_container\">";
        echo "<ul data-role=\"listview\">";
        foreach ($stream_array as $stream) {
            $stream_name = $stream->get_stream_name();
            echo "<li><a href=\"#\">".$stream_name."</a></li>";
        }
        echo "<a id=\"create_feed_button\" href=\"#create_stream_popup\" data-rel=\"popup\" data-role=\"button\">Create New Feed!</a>";
        echo "</ul>";
        echo "</div>";
	?>
	    
        
        <!-- Create Stream Popup -->
        <div data-role="popup" id="create_stream_popup" class="popup">
            <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	        <form action="createStream.php" method="post">
                <input type="text" name="streamName" value="" placeholder="Stream Name" />
                <input type="submit" value="Create Stream!"/>
		    </form>
	    </div>
	    <!-- /Create Stream Popup -->
        
	</div><!-- /content -->
	
</div><!-- /page -->



<script>

</script>

</body>
</html>