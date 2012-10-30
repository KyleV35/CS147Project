<?php
    session_start();
    if ($_SESSION["userID"] != null) {
        header('Location: home.php');
        exit();
    }
    $title = "Whats up?";
?>

<!DOCTYPE html>
<html>
<head>
<?php
    echo '<title>'.$title.'</title>';
    include 'utils/meta.php'; //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page">

	<?php
	    include 'header.php'
	?>

	<div data-role="content">	
		<div id="logo"></div>
		<?php
		    if ($_SESSION["flash"] != null) {
		        echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
		        unset($_SESSION["flash"]);
		    }
		?>
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