<!DOCTYPE html>
<html>
<head>
<?php
    $title = "Login Sucessful!";
    echo '<title>'.$title.'</title>';
    include 'meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page">

	<div data-role="header">
		<h1>
		<?php
		echo $title;
		?>
		</h1>
	</div><!-- /header -->

	<div data-role="content">	
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>