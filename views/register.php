<?php
    session_start();
    unset($_SESSION['registration_message']);

    if(isset($_SESSION['user']) && $_SESSION['user']['UserRole'] === "Admin") {
        header("Location: medicine.php");
    } else if(isset($_SESSION['user']) && $_SESSION['user']['UserRole'] === "Guest") {
        header("Location: home.php");
    }

    if(!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = uniqid('token', TRUE);
    }

    $csrf_token = $_SESSION['csrf_token'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/general.css">
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="../../styles/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Wiki-Medic</title>
</head>
<body>
    <header>

    </header>

    <main>
        <div class="container">
            <div class="title">Sign Up</div>
            <br><br>

            <?php if (empty($registrationMessage)) : ?>
                <form action="../../controllers/signUpController.php" method="POST">
                    <div class="form-div">
                        <label for="username" class="form-label">
                            Username
                        </label>
                        
                        <input type="text" placeholder="Username" name="username" id="username" class="form-input" autocomplete="off" required>
                    </div>

                    <div class="form-div">
                        <label for="password" class="form-label">
                            Password
                        </label>
                        
                        <input type="password" placeholder="Password" name="password" id="password" class="form-input" autocomplete="off" required>
                    </div>

                    <div class="form-div">
                        <label for="password" class="form-label">
                            Confirm Password
                        </label>
                        
                        <input type="password" placeholder="Confirm Password" name="conf-password" id="conf-password" class="form-input" autocomplete="off" required>
                    </div>
        
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                    <button name="register" type="submit" class="button">
                        Register
                    </button>
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
                <br><br>
                Already have an account? <a href="login.php">Sign In</a>
            </div>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>
</html>
