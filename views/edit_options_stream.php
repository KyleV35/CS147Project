<?php
    include_once '../utils/config.php';
    session_start();
    $title = "Edit!";
    $extra_header = "<a href=\"../views/edit_streams.php\" class=\"ui-btn-left\">Streams</a>";
    $userID = require_login("mobile.php");
    $streamID = $_GET["streamID"];
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
        
        echo "<a href=\"#update_name_popup\" data-role=\"button\" data-rel=\"popup\">Update Name!</a>";
        echo "<a href=\"#delete_stream_popup\" data-role=\"button\" data-rel=\"popup\">Delete Stream!</a>";
	?>
	    
        
        <!-- Update Name Popup -->
        <div data-role="popup" id="update_name_popup" class="popup">
	    <form action="../controllers/update_stream_name.php?streamID=<?=$streamID?>" method="post">
                <input type="text" name="new_stream_name" value="" placeholder="New Stream Name" />
                <a href="#" data-rel="back" data-role="button" data-inline="true">Cancel</a>
                <input data-inline="true" data-theme="b" type="submit" value="Update Stream Name!"/>
            </form>
	</div>
	<!-- /Update Name Popup -->
        
        <!-- Delete Stream Popup -->
        <div data-role="popup" id="delete_stream_popup" class="popup">
            <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	    <form action="../controllers/delete_stream.php?streamID=<?=$streamID?>" method="get">
                <p>Are you sure you want to delete this stream?</p>
                <a href="#" data-rel="back" data-role="button" data-inline="true">Cancel</a>
                <input data-theme="delete" data-inline="true" type="submit" value="Delete Stream!"/>
            </form>
	</div>
	<!-- /Delete Stream Popup -->
        
	</div><!-- /content -->
        
        <script>
        $(document).ready(function() {
            saveState(<?=$userID?>,"<?=$_SERVER["REQUEST_URI"]?>"); 
        });
        </script>
	
</div><!-- /page -->

</body>