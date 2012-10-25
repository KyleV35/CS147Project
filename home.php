<!DOCTYPE html>
<html>
<head>
<?php
    $title = "Home!";
    echo '<title>'.$title.'</title>';
    include 'meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page">

	<?php
	    include 'header.php'
	?>

	<div data-role="content">	
		<div id="logo"></div>
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>