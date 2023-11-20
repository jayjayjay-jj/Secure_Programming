<?php
    require(__DIR__.'/connection.php');

    session_start();
    $is_register = false;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        
        if (isset($_POST['username'], $_POST['password'])) {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
            $confPassword = htmlspecialchars(trim($_POST['conf-password']));
    
            if (empty($username) || empty($password) || empty($confPassword)){
                $_SESSION['error_message'] = "All field be filled";
                header('Location: ../views/register.php?error=1');

            } else if (strlen($password) < 8) {
                $_SESSION['error_message'] = "Password must be at least 8 characters";
                header('Location: ../views/register.php?error=1');
                
            } else if(strcmp($password, $confPassword) != 0) {
                $_SESSION['error_message'] = "Password and Confirm Password must be the same";
                header('Location: ../views/register.php?error=1');

            } else {
                $id = "UI" . uniqid();
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO msuser (UserId, Username, UserPassword, UserRole) VALUES (?, ?, ?, 'Guest')");

                $stmt->bind_param("sss", $id, $username, $hashed_password);

                var_dump($stmt);
    
                if ($stmt->execute()){
                    $_SESSION['username'] = hash('sha256', $username . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                    $registrationMessage = "Registration Successful!";

                    $_SESSION['is_register'] = true;
                    $_SESSION['registration_message'] = $registrationMessage;

                    header('Location: ../views/login.php');
                    exit();

                }else{
                    $registrationMessage = "Registration Failed! " . $stmt->error;
                    $_SESSION['error_message'] = "Registration Failed!";

                    header('Location: ../views/register.php?error=1');
                }
    
                $stmt->close();
            }

        } else {
            $registrationMessage = "Form fields are not set";
        }
    }
?>