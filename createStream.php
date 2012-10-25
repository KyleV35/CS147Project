<?php
    session_start();
    
    include 'config.php';
    
    $stream_name = $_POST['streamName'];
    if (strlen($stream_name) <= 0 ) {
         $_SESSION["flash"] = "The stream name must be at least 1 character!";
        header('Location: home.php');
        exit();
    }
    
    if ($_SESSION["username"] == null) {
        $_SESSION["flash"] = "You must log in to perform this action!";
        header('Location: mobile.php');
        exit();
    }
    
    $username = $_SESSION["username"];
    //echo "HELLO ".$username;
    // Fetch user ID
    $query = "Select userID from User where username = \"".$username."\";";
    $result = mysql_query($query);
    if (!$result or mysql_num_rows($result) <= 0) {
        $_SESSION["flash"] = "The stream could not be created.  We'll work to fix this!";
        header('Location: home.php');
        exit();
    }
    $userID_row = mysql_fetch_row($result);
    $userID = $userID_row[0];
    
    $insert_stream_query = "INSERT INTO Stream VALUES (NULL,".$userID.",\"".$stream_name."\");";
    //echo $insert_stream_query;
    
    $result = mysql_query($insert_stream_query);
    
    //echo $result;
    
    if ($result) {
        header('Location: home.php');
        exit();
    } else {
        $_SESSION["flash"] = "The stream could not be created.  We'll work to fix this!";
        header('Location: home.php');
        exit();
    }

?>