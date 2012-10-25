<?php
    session_start();
    $title = "Your feeds!";
    $extra_header = "<a href=\"logout.php\" class=\"ui-btn-right\">Logout</a>";
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
	    
        <ul data-role="listview">
	        <li><a href="acura.html">Acura</a></li>
	        <li><a href="audi.html">Audi</a></li>
	        <li><a href="bmw.html">BMW</a></li>
        </ul>
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>