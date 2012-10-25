<!DOCTYPE html>
<html>
<head>
<?php
    session_start();
    $title = "Create Account!";
    include 'meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
    <?php
    include 'header.php';
    ?>
    
    <div data-role="content">	
		<div id="logo"></div>
		<p> Please enter the following information: </p>
		<?php
		    if ($_SESSION['flash'] != null) {
		        echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
		        $_SESSION['flash'] = null;
		    }
		?>
		<form action="account_creation.php" method="post">
            <input type="text" name="username" value="" placeholder="Username" />
            <input type="password" name="password" value="" placeholder="Password" />
            <input type="submit" value="Create Account!"/>
		</form>
	</div><!-- /content -->
    
</body>
</html>