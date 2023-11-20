<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Wiki-Medic</title>
</head>
<body>
    <header>

    </header>

    <main>
        <div class="container">
            <div class="title">Sign In</div>
            <br><br>

            <form action="../../controllers/signInController.php" method="POST">
                <div class="form-div">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="text" placeholder="" class="form-input">
                </div>
                <div class="form-div">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" placeholder="" class="form-input">
                </div>
                
                <button class="button" name="login" value="Login">
                    Login
                </button>
            </form>

            <div class="links">
                <br><br>
                Don't have an account yet? <a href="./register.php">Sign Up</a>
            </div>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>
</html>