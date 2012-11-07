<?php
    session_start();
    $userID = $_POST["userID"];
    $_SESSION["userID"] = $userID;
?>
