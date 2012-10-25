<!DOCTYPE html>
<html>
<head>
<?php
    $title = "Login!";
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
		<form action="login.php" method="post">
            <input type="text" name="username" value="" placeholder="Username" />
            <input type="password" name="password" value="" placeholder="Password" />
            <input type="submit" value="Login!"/>
		</form>
		<p class="no_account_info"> Don't have an account? Make one! </p>
		<a href="create_account.php" data-role="button">Create Account!</a>
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>