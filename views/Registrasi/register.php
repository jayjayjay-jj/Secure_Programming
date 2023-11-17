<?php
session_start();
require "../../config/database.php";

$registrationMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    
    if (isset($_POST['username'], $_POST['password'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars(trim($_POST['password']));

        if (empty($username) || empty($password)){
            $registrationMessage = "Username and Password must be filled";
        }elseif (strlen($password) < 8) {
            $registrationMessage = "Password must be at least 8 characters";
        }else{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()){
                $_SESSION['username'] = hash('sha256', $username . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                $registrationMessage = "Registration Successful!";
                header('Location: ../view/homepage/home.php');
                exit();
            }else{
                $registrationMessage = "Registration Failed! " . $stmt->error;
            }

            $stmt->close();
        }
    }else{
        $registrationMessage = "Form fields are not set";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="signup-container">
        <header>Sign Up</header>

        <?php if (empty($registrationMessage)) : ?>
            <form action="../../controllers/authController.php" method="POST">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" placeholder="username" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" placeholder="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field">
                    <button name="register" class="btn">Register</button>
                </div>
            </form>
        <?php endif; ?>

        <div class="message">
            <?php echo $registrationMessage; ?>
        </div>

        <div class="links">
            Already have an account? <a href="login.php">Sign In</a>
        </div>
    </div>
</div>
</body>
</html>
