<?php
    session_start();
    require("../../controllers/adminController.php");

    if(!isset($_SESSION['user'])){
        header("Location: ../login.php");
    }

    if($_SESSION["user"]["UserRole"] != "Admin") {
        header("Location: ../error/401.php");
    }

    if(!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = uniqid('token', TRUE);
    }

    $csrf_token = $_SESSION['csrf_token'];
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $medName = htmlspecialchars(trim($_POST["medicineName"]));
        $medDesc = htmlspecialchars(trim($_POST["medicineDesc"]));
        $medLink = htmlspecialchars(trim($_POST["medicineLink"]));

        if(!Util::isEmptyInput($medName) || !Util::isEmptyInput($medDesc) || !Util::isEmptyInput($medLink)){
            Admin::AddMedicine($medName, $medDesc, $medLink);
        }
        else{
            header("Location: ../medicine.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki-Medic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles/general.css">
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="../../styles/footer.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="nav-container">
                <a href="../medicine.php" class="nav-title">Wiki-Medic</a>

                <button class="nav-button">
                    <a href="../../controllers/logoutController.php">
                        Logout
                    </a>
                </button>
            </div>
        </div>
    </header>

    <main>
        <div class="jumbotron-container">
            <div class="greetings">
                <br><br>
                <h2><b>Add Medicine</b></h2>
                <br>
            </div>

            <form action="" method="post">
                <div class="form-div">
                    <label for="medicineName" class="form-label">
                        Medicine Name
                    </label>

                    <input type="text" placeholder="Medicine Name" name="medicineName" id="medicineName" class="form-input" autocomplete="off" required>
                </div>

                <div class="form-div">
                    <label for="medicineDesc" class="form-label">
                        Medicine Description
                    </label>

                    <textarea name="medicineDesc" placeholder="Medicine Description" id="medicineDesc" cols="10" rows="5" class="form-input" autocomplete="off" required></textarea>
                </div>

                <div class="form-div">
                    <label for="medicineLink" class="form-label">
                        Medicine Link
                    </label>

                    <input type="text" placeholder="Medicine Link" name="medicineLink" id="medicineLink" class="form-input" autocomplete="off" required>
                </div>

                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                <button class="button">Add Medicine</button>
            </form>

            <?php 
                if(isset($_GET['error']) && $_GET['error']) {
                    if(isset($_SESSION["error_message"])) {
                        $errorMessage = $_SESSION["error_message"];
                        echo '<br><div style="color:red;">' . $errorMessage . '</div>';
                    }
                }

                unset($_SESSION['error_message']);
            ?>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>
</html>