<?php
    include_once "../utils/global.php";
    include_once '../utils/utils.php';
    include_once '../utils/database_functions.php';
    include_once '../models/stream.php';
    $link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147kvermeer', 'booboo35');
    mysql_select_db('c_cs147_kvermeer');
    
?>