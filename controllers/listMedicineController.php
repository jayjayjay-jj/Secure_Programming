<?php
    require "connection.php";

    function getAllMedicine(){
        global $conn;
        $q = "select * from msmedicine;";
        $d = $conn->query($q);
        return $d;
    }
?>