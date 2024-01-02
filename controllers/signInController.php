<?php
    require(__DIR__.'/connection.php');
    require(__DIR__.'/util.php');
    require(__DIR__.'/config.php');

    session_start();
    $is_login = false;

    function rateLimit($attemptLimit, $attemptInterval) {
        $userKey = md5($_SERVER['REMOTE_ADDR']);
    
        if (!isset($_SESSION['attempt'][$userKey])) {
            $_SESSION['attempt'][$userKey] = [
                'count' => 0,
                'loginTime' => time(),
                'lastAttemptTime' => 0,
                'fifthAttemptTime' => 0,
            ];
        }
    
        $attemptTime = time() - $_SESSION['attempt'][$userKey]['loginTime'];
    
        if ($attemptTime > $attemptInterval) {
            $_SESSION['attempt'][$userKey]['count'] = 0;
            $_SESSION['attempt'][$userKey]['loginTime'] = time();
            $_SESSION['attempt'][$userKey]['lastAttemptTime'] = 0;
        }
    
        // Too many attempts (attempts > 5)
        if ($_SESSION['attempt'][$userKey]['count'] >= $attemptLimit) {
            $_SESSION['attempt'][$userKey]['lastAttemptTime'] = time();

            if ($_SESSION['attempt'][$userKey]['count'] == $attemptLimit) {
                $_SESSION['attempt'][$userKey]['fifthAttemptTime'] = time();
            }

            return false;
        }
    
        $_SESSION['attempt'][$userKey]['count']++;
        $_SESSION['attempt'][$userKey]['loginTime'] = time();
    
        return true;
    }  
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $userKey = md5($_SERVER['REMOTE_ADDR']);
        
        if(Util::isInvalidCSRFToken($_POST['csrf_token'], $_SESSION['csrf_token'])) {
            $loginMessage = "Anti-CSRF token invalid";
            $_SESSION['error_message'] = $loginMessage;

            header('Location: ../views/login.php?error=1');

        } else if (isset($_POST['username'], $_POST['password'])) {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
            
            // rate Limit (5 attempts, 15 minutes)
            if (rateLimit(5, 15)) {
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
                            $loginMessage = "Account not found!";
                            $_SESSION['error_message'] = $loginMessage;
    
                            header('Location: ../views/login.php?error=1');
                        }                 
    
                    } else {
                        $loginMessage = "Account not found!";
                        $_SESSION['error_message'] = $loginMessage;
    
                        header('Location: ../views/login.php?error=1');
                    }
        
                    $stmt->close();
                }
            } else {

                if ($_SESSION['attempt'][$userKey]['count'] == 5) {
                    $fifthAttemptTime = $_SESSION['attempt'][$userKey]['fifthAttemptTime'];
                    $remainingTime = ($fifthAttemptTime + 900 - time())/60;

                    $loginMessage = "Too many login attempts. Please try again after {$remainingTime} minutes.";
                    
                    $_SESSION['error_message'] = $loginMessage;
        
                    header('Location: ../views/login.php?error=1');
                }

            }
    
            

        } else {
            $loginMessage = "Form fields are not set";
        }
    }
?>