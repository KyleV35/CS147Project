<?php
    function get_userID_from_username($username, $failure_page) {
        $query = "Select userID from User where username = \"".$username."\";";
        $result = mysql_query($query);
        if (!$result or mysql_num_rows($result) <= 0) {
            $_SESSION["flash"] = "User ID could not be fetched!";
            header("Location: '$failure_page'");
            exit();
        }
        $result_array = mysql_fetch_assoc($result);
        $userID = $result_array["userID"];
        return $userID;
    }
?>
