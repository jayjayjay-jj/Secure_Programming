<?php
    require(__DIR__.'/connection.php');
    require(__DIR__.'/util.php');

    session_start();
    $is_login = false;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        
        if(Util::isInvalidCSRFToken($_POST['csrf_token'], $_SESSION['csrf_token'])) {
            $loginMessage = "Anti-CSRF token invalid";
            $_SESSION['error_message'] = $loginMessage;

            header('Location: ../views/login.php?error=1');

        } else if (isset($_POST['username'], $_POST['password'])) {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
    
            if (Util::isEmptyInput($username) || Util::isEmptyInput($password)){
                $_SESSION['error_message'] = "All field must be filled";
                header('Location: ../views/login.php?error=1');

            } else {
                $stmt = $conn->prepare("SELECT * FROM MsUser WHERE Username = ?");

                if (!$stmt) {
                    die('Error in preparing statement');
                }

                $stmt->bind_param("s", $username);
                $stmt->execute();

                $result = $stmt->get_result();
    
                if ($result->num_rows == 1){
                    $curr_user = $result->fetch_assoc();

                    if(password_verify($password, $curr_user['UserPassword'])) {
                        $loginMessage = "Login Successful!";

                        session_regenerate_id(true);
                        $_SESSION['user'] = $curr_user;
                        $_SESSION['role'] = $curr_user['UserRole'];
                        $_SESSION['is_login'] = true;
                        $_SESSION['login_message'] = $loginMessage;

                        if($_SESSION['user']['UserRole'] === "Admin") {
                            header('Location: ../views/medicine.php');
                        } else {
                            header('Location: ../views/home.php');
                        }

                        exit();

                    } else {
                        $loginMessage = "Password is wrong!";
                        $_SESSION['error_message'] = $loginMessage;

                        header('Location: ../views/login.php?error=1');
                    }                 

                } else {
                    $loginMessage = "User not found!";
                    $_SESSION['error_message'] = $loginMessage;

                    header('Location: ../views/login.php?error=1');
                }
    
                $stmt->close();
            }

        } else {
            $loginMessage = "Form fields are not set";
        }
    }
?>