<?php
    session_start();
    $title = "Create Account!";
    $extra_header = "<a href=\"mobile.php\" data-icon=\"arrow-l\" class=\"ui-btn-left\">Back</a>";
?>

<!DOCTYPE html>
<html>
<head>
<?php
    include '../utils/meta.php'; //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
<div data-role="page">
    <?php
    include '../views/header.php';
    ?>
    
    <div data-role="content">	
		<div id="logo"></div>
		<p> Please enter the following information: </p>
		<?php
		    if ($_SESSION['flash'] != null) {
		        echo "<p class=\"red_text\">".$_SESSION["flash"]."</p>";
		        unset($_SESSION['flash']);
		    }
		?>
	<form action="../controllers/account_creation.php" method="post">
            <input type="text" name="username" value="" placeholder="Username" />
            <input type="password" name="password" value="" placeholder="Password" />
            <input type="submit" value="Create Account!"/>
	</form>
    </div><!-- /content -->
</div><!-- /page -->
</body>
</html>