<?php
    @ini_set('session.gc_maxlifetime', 3600);

    @session_set_cookie_params(3600);
    
    if (!isset($_SESSION)) {
        session_start();
    }
?>