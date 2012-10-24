<?php
    include 'config.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $query = "Select * from Users where username = \"".$username."\" and password = \"".$password."\";";
    
    
    $rows = mysql_query($query);
    
    if ($rows != FALSE) {
        header('Location: loginSucessful.php');
    } else {
        echo '<p>'.$username.'</p>';
        echo '<p>'.$password.'</p>';
    }
?>