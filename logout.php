<?php
    session_start();
    session_destroy();
    header('Location: mobile.php');
?>