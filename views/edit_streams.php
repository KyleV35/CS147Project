<?php
    include_once '../utils/config.php';
    session_start();
    $title = "Edit!";
    $extra_header = "<a href=\"../views/home.php\" class=\"ui-btn-left\">Back</a>";
    $userID = require_login("mobile.php");
?>
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
        
        /* Populate stream list with streams */
        echo "<p class=\"info_text\">Select a stream to edit!</p>";
        $stream_array = get_streams_for_userID($userID);
        echo "<div class=\"stream_list_container\">";
        echo "<ul data-role=\"listview\">";
        foreach ($stream_array as $stream) {
            $stream_name = $stream->get_stream_name();
            $streamID = $stream->get_streamID();
            echo "<li><a href=\"../views/edit_options_stream.php?streamID=$streamID\">".$stream_name."</a></li>";
        }
        echo "</ul>";
        echo "</div>";
	?>
	    
        
        <!-- Create Stream Popup -->
        <div data-role="popup" id="create_stream_popup" class="popup">
            <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	    <form action="../controllers/createStream.php" method="post">
                <input type="text" name="streamName" value="" placeholder="Stream Name" />
                <input type="submit" value="Create Stream!"/>
            </form>
	</div>
	<!-- /Create Stream Popup -->
        
	</div><!-- /content -->
        
        <script>
        $(document).ready(function() {
            saveState(<?=$userID?>,"<?=$_SERVER["REQUEST_URI"]?>"); 
        });
        </script>
	
</div><!-- /page -->

</body>