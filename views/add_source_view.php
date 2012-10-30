<?php

include_once '../utils/config.php';
session_start();
$userID = require_login("mobile.php");
$streamID = $_GET["streamID"];
$stream = get_stream_for_streamID($streamID);
$stream_name = $stream->get_stream_name();
$title = "Add a source to: ".$stream_name;
$extra_header = "<a href=\"../views/manage_stream.php?streamID=$streamID\" class=\"ui-btn-left\">Cancel</a>";
    
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
        
        echo "<ul data-role=\"listview\" data-filter=\"true\" data-autodividers=\"true\">";
        $site_array = get_all_sites();
        foreach ($site_array as $site) {
            $site_name = $site->get_site_name();
            $siteID = $site->get_siteID();
            echo "<li><a href=\"../views/select_rss_view.php?siteID=$siteID&streamID=$streamID\">$site_name</a></li>";
        }
                
        echo "</ul>";
        
        ?>
        
    </div><!-- /content -->
</div><!-- /page -->

</body>
</html>