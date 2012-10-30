<?php

    /* This function redirects the user to $failure_page if the
     * the user is not logged in.
     * $failure_page = relative OR absolute url of page to go to if user is not
     *                  logged in
     * Returns: username of logged in user.
     */
    function require_login($failure_page) {
        $username = $_SESSION["username"];
	if ($username == null) {
            $_SESSION["flash"] = "You must be logged in to use this page!";
            header("Location: '$failure_page'");
            exit();
	} else{
            return $username;
        }
    }
?>
