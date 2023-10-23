<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="../controllers/authController.php" method="POST">
            <input type="text" placeholder="username" name="username" id="username">
            <br>
            <input type="text" placeholder="password" name="password" id="password">
            <br>
            <button name="register">register</button>
        </form>
    </div>
</body>
</html>