<?php

    /* This function redirects the user to $failure_page if the
     * the user is not logged in.
     * $failure_page = relative OR absolute url of page to go to if user is not
     *                  logged in
     * Returns: username of logged in user.
     */
    function require_login($failure_page) {
        $username = $_SESSION["userID"];
	if ($username == null) {
            $_SESSION["flash"] = "You must be logged in to use this page!";
            header("Location: '$failure_page'");
            exit();
	} else{
            return $username;
        }
    }
    
    /*
     * This function requires a string to be of a certain length.  Redirects
     * the user to $failure_page with a $failure_message if the string is too
     * short.
     * $string = string whose length is being checked
     * $length = minimum length of string
     * $failure_message = flash message to be displayed
     * $failure_page = page to be redirected to upon a failure
     * Returns: None
     */
    function require_length($string, $length, $failure_message, $failure_page) {
        if (strlen($string) < $length) {
            $_SESSION['flash'] = $failure_message;
            header( "Location: $failure_page");
            exit();
        }
    }
?>
