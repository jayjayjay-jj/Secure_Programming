<?php
    session_start();
    require "../config/database.php";
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['register'])) {
        $username = htmlspecialchars(trim($_POST['Username']));
        $password = htmlspecialchars(trim($_POST['Password']));

        if (empty($username) || empty($password)) {
            echo "Username and Password must be filled";
            exit();
        }

        if (strlen($password) < 8) {
            echo "Password must be at least 8 characters";
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['username'] = hash('sha256', $username . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
            header('location: ../views/homepage/home.php');
            echo '<div class="message">
                    <p>Registration Successfully!</p>
                  </div>';
            exit();
        } else {
            echo '<div class="message">
                    <p>Registration Failed!</p>
                  </div>';
        }

        $stmt->close();
        $conn->close();
    }
}
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