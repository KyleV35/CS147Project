<?php
    session_start();
    session_destroy();
?>
<body>
<div data-role="page">

<script>
    $(document).ready(function() {
       if (clearState()) {
           window.location = "../views/mobile.php";
       } else {
           window.location = "../views/mobile.php";
       }
    });
</script>
</div><!-- /page -->


</body>

