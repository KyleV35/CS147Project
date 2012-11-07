<?php

    include_once '../models/stream.php';
    include_once '../models/site.php';
    include_once '../models/rss_feed.php';

    $link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147kvermeer', 'booboo35');
    mysql_select_db('c_cs147_kvermeer');
    
    function get_userID_from_username($username, $failure_page) {
        $query = "Select userID from User where username = \"$username\";";
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
    
    function login($username, $password, $failure_page, $success_page) {
        $encrypted_password = crypt($password, $GLOBALS["salt"]);
        $query = "Select * from User where username = \"$username\" and password = \"$encrypted_password\";";
        $result = mysql_query($query); // Returns FALSE on error
    
        if (!result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: $failure_page");
        }
        if (!$result or mysql_num_rows($result) == 0) {
            //Login unsuccessful
            $_SESSION["flash"] = "Username and/or password is incorrect.";
            header("Location: $failure_page");
            exit();
        } else {
            //Login successful
            $result_array = mysql_fetch_assoc($result);
            $_SESSION["userID"] = $result_array["userID"];
            header("Location: $success_page");
            exit();
        }
    }
    
    function account_already_exists($username) {
        $query = "Select * from User where username = \"".$username."\";";
        $result = mysql_query($query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/create_account.php");
        } else if (mysql_num_rows($result) >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function get_streams_for_userID($userID) {
        
        $stream_query = "Select * from Stream where userID = ".$userID.";";
        $result = mysql_query($stream_query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $stream_array = array();
        while ($row = mysql_fetch_assoc($result)) {
            $stream = new Stream($row["streamName"], $row["userID"], $row["streamID"]);
            array_push($stream_array, $stream);
        }
        return $stream_array;
    }
    
    function get_stream_for_streamID($streamID) {
        $stream_query = "Select * from Stream where streamID = ".$streamID.";";
        $result = mysql_query($stream_query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $row = mysql_fetch_assoc($result);
        $stream = new Stream($row["streamName"], $row["userID"], $row["streamID"]);
        return $stream;
    }
    
    function get_all_sites() {
        $site_query = "Select * from Sites ORDER BY siteName;";
        $result = mysql_query($site_query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $site_array = array();
        while ($row = mysql_fetch_assoc($result)) {
            $site = new Site($row["siteID"], $row["siteName"]);
            array_push($site_array,$site);
        }
        return $site_array;
    }
    
    function get_site_for_siteID($siteID) {
        $site_query = "Select * from Sites where siteID=$siteID;";
        $result = mysql_query($site_query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $row = mysql_fetch_assoc($result);
        $site = new Site($row["siteID"], $row["siteName"]);
        return $site;
    }
    
    function create_stream($userID, $stream_name) {
        $insert_stream_query = "INSERT INTO Stream VALUES (NULL,".$userID.",\"".$stream_name."\");";
        $result = mysql_query($insert_stream_query);
        
        if (!$result) {
            return FALSE;
        } else {
            return mysql_insert_id();
        }
    }
    
    function get_rss_feeds_for_siteID($siteID) {
        $rss_query = "Select * from RSS_Feeds where siteID = ".$siteID." ORDER BY filter;";
        $result = mysql_query($rss_query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $rss_array = array();
        while ($row = mysql_fetch_assoc($result)) {
            $rss_feed = new RSS_Feed($row["rssID"], $row["siteID"], 
                    $row["filter"], $row["url"]);
            array_push($rss_array, $rss_feed);
        }
        return $rss_array;
    }
    
    function add_feed_to_stream($rssID,$streamID) {
        $insert_query = "INSERT INTO Has_Feed VALUES ($streamID,$rssID,'true');";
        $result = mysql_query($insert_query);
        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function get_rss_feeds_for_stream($streamID, $only_active) {
        $rss_feed_query = null;
        if ($only_active) {
            $rss_feeds_query = "SELECT * from RSS_Feeds where rssID in
            (select rssID from Has_Feed where streamID=$streamID and active=0);";
        } else {
            $rss_feeds_query = "SELECT * from RSS_Feeds where rssID in
            (select rssID from Has_Feed where streamID=$streamID);";
        }
        $result = mysql_query($rss_feeds_query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $rss_array = array();
        while ($row = mysql_fetch_assoc($result)) {
            $rss_feed = new RSS_Feed($row["rssID"], $row["siteID"], 
                    $row["filter"], $row["url"]);
            array_push($rss_array, $rss_feed);
        }
        return $rss_array;
    }
    
    /* Returns an array of arrays.  The inner array is built such that
     * array["filter"] is the filter, array["rssID"] is the rssID,
     * and array["active"] is the active status, and array["siteName"] is
     * the siteName.
     */
    function get_filter_rssID_active_siteName_for_streamID($streamID) {
        $query = "SELECT filter, Has_Feed.rssID AS rssID, active, siteName
                  FROM ((Has_Feed JOIN RSS_Feeds ON Has_Feed.rssID = RSS_Feeds.rssID)
                            JOIN Sites ON RSS_Feeds.siteID = Sites.siteID)
                  WHERE streamID=$streamID;";
        $result = mysql_query($query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
        $result_array = array();
        while ($row = mysql_fetch_assoc($result)) {
            $filter_rssID_active = array();
            $filter_rssID_active["filter"] = $row["filter"];
            $filter_rssID_active["rssID"] = $row["rssID"];
            $filter_rssID_active["active"] = $row["active"];
            $filter_rssID_active["siteName"] = $row["siteName"];
            array_push($result_array, $filter_rssID_active);
        }
        return $result_array;
    }
    
    function set_active_for_feed($streamID, $rssID, $should_be_active) {
        $update_query= null;
        if ($should_be_active) {
            $update_query= "UPDATE Has_Feed SET active=0 WHERE streamID=$streamID and rssID = $rssID;";
        } else {
            $update_query= "UPDATE Has_Feed SET active=1 WHERE streamID=$streamID and rssID = $rssID;";
        }
        echo $update_query;
        $result = mysql_query($update_query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
    }
    
    function delete_stream($streamID) {
        $query = "DELETE FROM Stream WHERE streamID=$streamID;";
        $result = mysql_query($query);
        if (!$result) {
            $_SESSION['flash'] = "There was an issue on our side!";
            header( "Location: ../views/error.php");
        }
    }
?>
