<!DOCTYPE html>
<html>
<head>
<title>Test Page</title>
<?php
    include 'meta.php' //Always include this file, has many necessary, but redundant files
?>
</head>
<body>
    <?php
    include 'header.php';
    ?>
    <div id="logo"></div>
    <div id="login_button" class="button"><p class="button_text">Login!</p></div>
    <div id="create_account_button" class="button"><p class="button_text">Create Account!</p></div>
    
    <script>
        $("#login_button").click(function() {
            window.location.href = 'login.php';
        });
        $("#create_account_button").click(function() {
            window.location.href = 'create_account.php';
        });
    </script>
</body>
</html>