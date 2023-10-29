<?php
    // session_start();
    require "connection.php";

    global $conn;

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $q = "SELECT * FROM msmedicine";
        if ($conn->query($q) === TRUE) {
            echo "Got the data";
        }
        header("Location: ../views/homepage/home.php");
        $conn->close();    
    }
?>