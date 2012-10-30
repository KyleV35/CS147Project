<?php
    function require_login($failurePage) {
        $username = $_SESSION["username"];
	if ($username == null) {
		$_SESSION["flash"] = "You must be logged in to use this page!";
        header("Location: '$failurePage'");
        exit();
	}
    }
?>
