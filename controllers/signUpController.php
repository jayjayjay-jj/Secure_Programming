<?php
    require(__DIR__.'/connection.php');
    require(__DIR__.'/util.php');
    require(__DIR__.'/config.php');

    session_start();
    $is_register = false;

    function checkUsername($username) {
        global $conn;

        $query = "SELECT * FROM MsUser WHERE Username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            return false;
        }

        return true;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        
        if (isset($_POST['username'], $_POST['password'])) {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
            $confPassword = htmlspecialchars(trim($_POST['conf-password']));
    
            if(Util::isInvalidCSRFToken($_POST['csrf_token'], $_SESSION['csrf_token'])) {
                $registrationMessage = "Anti-CSRF token invalid";
                $_SESSION['error_message'] = $registrationMessage;
    
                header('Location: ../views/register.php?error=1');
    
            } else if (Util::isEmptyInput($username) || Util::isEmptyInput($password) || Util::isEmptyInput($confPassword)){
                $_SESSION['error_message'] = "All field must be filled";
                header('Location: ../views/register.php?error=1');

            } else if(!checkUsername($username)) {
                $_SESSION['error_message'] = "Username must be unique!";
                header('Location: ../views/register.php?error=1');
                
            } else if (strlen($password) < 8) {
                $_SESSION['error_message'] = "Password must be at least 8 characters";
                header('Location: ../views/register.php?error=1');
                
            } else if (!preg_match('/[A-Z]/', $password)) {
                $_SESSION['error_message'] = "Password must contain at least one uppercase letter.";
                header('Location: ../views/register.php?error=1');
                
            } else if (!preg_match('/[a-z]/', $password)) {
                $_SESSION['error_message'] = "Password must contain at least one lowercase letter.";
                header('Location: ../views/register.php?error=1');
                
            } else if (!preg_match('/\d/', $password)) {
                $_SESSION['error_message'] = "Password must contain at least one digit.";
                header('Location: ../views/register.php?error=1');
                
            } else if (!preg_match('/[^a-zA-Z\d]/', $password)) {
                $_SESSION['error_message'] = "Password must contain at least one special character.";
                header('Location: ../views/register.php?error=1');
                
            } else if(strcmp($password, $confPassword) != 0) {
                $_SESSION['error_message'] = "Password and Confirm Password must be the same";
                header('Location: ../views/register.php?error=1');

            } else {
                $id = "UI" . uniqid();
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $stmt = $conn->prepare("INSERT INTO msuser (UserId, Username, UserPassword, UserRole) VALUES (?, ?, ?, 'Guest')");
                $stmt->bind_param("sss", $id, $username, $hashed_password);
    
                if ($stmt->execute()){
                    $registrationMessage = "Registration Successful!";

                    $_SESSION['is_register'] = true;
                    $_SESSION['registration_message'] = $registrationMessage;

                    header('Location: ../views/login.php');
                    exit();

                }else{
                    $registrationMessage = "Registration Failed!";
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