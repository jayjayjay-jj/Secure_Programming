<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki-Medic</title>
    <link rel="shortcut icon" href="../pics/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../header.css">
</head>

<?php
    if(isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $i => $err_msg) {            
?>
    <div class="alert-error"><?= $err_msg ?></div>
<?php
        }
    }
    unset($_SESSION['error']);
?>

<?php
    if(isset($_SESSION['success'])) {
        foreach ($_SESSION['success'] as $i => $success_msg) {            
?>
    <div class="alert-success"><?= $success_msg ?></div>
<?php
        }
    }
    unset($_SESSION['success']);
?>

<body>
    <div>
        <form action="controllers/authController.php" method="POST">
            <fieldset>
                <label for="email">Email</label>
                <input id="email" name="email" type="text" placeholder="" class="form-control">
            </fieldset>
            <fieldset>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="" class="form-control">
            </fieldset>
            <br>
            <div>
                <button class="button" name="login" value="Login">Login</button>
            </div>
        </form>
    </div>
    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>

</html>