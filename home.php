<?php
    include 'config.php';
    session_start();
    $title = "Your feeds!";
    $extra_header = "<a href=\"logout.php\" class=\"ui-btn-right\">Logout</a>";
    $username = $_SESSION["username"];
	if ($username == null) {
		$_SESSION["flash"] = "You must be logged in to use this page!";
        header('Location: mobile.php');
        exit();
	}
	// Fetch userID
	$query = "Select userID from User where username = \"".$username."\";";
	echo "Query: ".$query;
	echo "Username: ".$username;
    $result = mysql_query($query);
    if (!$result or mysql_num_rows($result) <= 0) {
        $_SESSION["flash"] = "The stream could not be created.  We'll work to fix this!";
        header('Location: home.php');
        exit();
    }
    $userID_row = mysql_fetch_row($result);
    $userID = $userID_row[0];
        
?>

<!DOCTYPE html>
<html>
<head>
<?php
    echo '<title>'.$title.'</title>';
    include 'meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page">

	<?php
	    include 'header.php';
	?>

	<div data-role="content">	
	
	<?php
		if ($_SESSION["flash"] != null) {
		    echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
		    unset($_SESSION["flash"]);
		}
		
		
        $stream_query = "Select * from Stream where userID = ".$userID.";";
        $result = mysql_query($stream_query);
        echo "<ul data-role=\"listview\">";
        while ($row = mysql_fetch_assoc($result)) {
            echo "<li><a href=\"#\">".$row['streamName']."</a></li>";
        }
        echo "<a id=\"create_feed_button\" href=\"#create_stream_popup\" data-rel=\"popup\" data-role=\"button\">Create New Feed!</a>";
        echo "</ul>";
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