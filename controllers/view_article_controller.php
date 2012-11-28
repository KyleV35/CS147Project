<?php
    include_once "../utils/database_functions.php";
    $userID = $_POST["userID"];
    add_article_link_view($userID);
?>
