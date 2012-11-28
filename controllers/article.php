<?php
    include_once "../utils/database_functions.php";
    session_start();
    $_SESSION["description"] = $_POST["description"];
    $_SESSION["source"] = $_POST["source"];
    $_SESSION["link"] = $_POST["link"];
    $_SESSION["pub_date"] = $_POST["pub_date"];
    $userID = $_POST["userID"];
    add_article_description_view($userID);
?>
