<?php

    // require_once "../config/database.php";
    
    $config = [
        'server' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'database' => 'jvfrh_db',
    ];

    $conn = new mysqli(
        $config["server"],
        $config["username"],
        $config["password"],
        $config["database"]
    );

?>