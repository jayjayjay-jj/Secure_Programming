<?php
    session_start();
    unset($_SESSION['registration_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="title">Sign Up</div>
        <br><br><br>

        <?php if (empty($registrationMessage)) : ?>
            <form action="../../controllers/authController.php" method="POST">
                <div class="form-div">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" placeholder="Username" name="username" id="username" class="form-input" autocomplete="off" required>
                </div>
                <div class="form-div">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" placeholder="Password" name="password" id="password" class="form-input" autocomplete="off" required>
                </div>
                <button name="register" type="submit" class="button">Register</button>
            </form>
        <?php endif; ?>

        <?php 
            if(isset($_GET['error']) && $_GET['error']) {
                if(isset($_SESSION["error_message"])) {
                    $errorMessage = $_SESSION["error_message"];
                    echo '<br><div style="color:red;">' . $errorMessage . '</div>';
                }
            }

            unset($_SESSION['error_message']);
        ?>

        <div class="links">
            <br><br><br>
            Already have an account? <a href="login.php">Sign In</a>
        </div>
    </div>
</body>
</html>
