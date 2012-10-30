<?php

include_once '../utils/config.php';
session_start();
$title = "Your feeds!";
$extra_header = "<a href=\"../controllers/logout.php\" class=\"ui-btn-left\">Logout</a>";
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
	include '../views/header.php';
        echo "<div data-role=\"content\">";
        // Error Messages
	if ($_SESSION["flash"] != null) {
            echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
            unset($_SESSION["flash"]);
        }
        
        ?>
    </div><!-- /content -->
</div><!-- /page -->

</body>
</html>
