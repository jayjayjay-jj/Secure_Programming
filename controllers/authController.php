<?php
    // session_start();
    require "connection.php";

    global $conn;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST["register"])){
            // $username = $_POST["username"];
            // $password = $_POST["password"];
            // $id = "UI" . uniqid();
            // $q = "insert into msuser (UserID, Username, UserPassword, UserRole) values ('$id', '$username', '$password', 'Guest');";

            // if ($conn->query($q) === TRUE) {
            //     echo "Data inserted successfully.";
            // }
            // header("Location: ../views/register.php");
            // $conn->close();
        };
    }
    echo "asd";
?>