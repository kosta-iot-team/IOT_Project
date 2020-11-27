<?php
session_start();
session_destroy();
unset($_POST);
?>
<script>
    location.href='index.php';
</script>