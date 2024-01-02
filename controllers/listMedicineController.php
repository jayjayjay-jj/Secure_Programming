<?php
    require "connection.php";
    require "config.php";

    function getAllMedicine(){
        global $conn;
        $q = "select * from msmedicine;";
        $d = $conn->query($q);
        return $d;
    }
?>