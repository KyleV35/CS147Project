<?php
    //Set no caching
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
    header("Cache-Control: no-store, no-cache, must-revalidate"); 
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    include_once "../utils/global.php";
    include_once '../utils/utils.php';
    include_once '../utils/database_functions.php';
    include_once '../models/stream.php';
    include_once '../models/site.php';
    include_once '../models/rss_feed.php';
    include_once '../models/article.php';
    $link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147kvermeer', 'booboo35');
    mysql_select_db('c_cs147_kvermeer');
    
?>