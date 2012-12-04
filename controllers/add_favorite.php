<?php
include_once '../utils/config.php';
session_start();
$userID = $_POST["userID"];
$article_title = stripcslashes($_POST["article_title"]);
$article_description = stripcslashes(urldecode($_POST["description"]));
$article_url = urldecode($_POST["article_source"]);
$pub_date = $_POST["pub_date"];
if (add_favorite($userID, $article_title, $article_url, $pub_date, $article_description)) {
    echo "It worked!";
} else {
    echo "Failure!";
}
?>
