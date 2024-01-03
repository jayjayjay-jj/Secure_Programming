<?php
    header_remove("X-Powered-By");
    header('X-Frame-Options: DENY, SAMEORIGIN');
    header("Location: ./views/login.php");
?>