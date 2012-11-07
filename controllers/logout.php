<?php
    session_start();
    session_destroy();
?>
<body>
<div data-role="page">

<script>
    $(document).ready(function() {
       if (clearState()) {
           alert("Cleared");
           window.location = "../views/mobile.php";
       } else {
           alert("Not Cleared");
       }
    });
</script>
</div><!-- /page -->


</body>

