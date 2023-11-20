<?php
    session_start();
    
    if(isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }

    session_regenerate_id(true);
    header("Location: ../views/login.php");
?>