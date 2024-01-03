<?php
    session_start();
    header_remove("X-Powered-By");
    header('X-Frame-Options: DENY, SAMEORIGIN');
    require("../../controllers/adminController.php");

    if(!isset($_SESSION['user'])){
        header("Location: ../login.php");
    }

    if($_SESSION["user"]["UserRole"] != "Admin") {
        header("Location: ../../error/401.php");
    }

    if(!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = uniqid('token', TRUE);
    }
    
    $hashID = substr($_SERVER['PATH_INFO'], 1);
    $medID = Admin::GetMedicineIDByHashID($hashID);

    if($medID == null){
        header("Location: ".$_SERVER["SCRIPT_NAME"]."/../../error/404.php");
    }

    $data = Admin::GetMedicineByID($medID);
    $medicine = $data->fetch_assoc();
    $medName = $medicine["MedicineName"];
    $medDesc = $medicine["MedicineDescription"];
    $medLink = $medicine["MedicineLink"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $updatedName = htmlspecialchars(trim($_POST["medicineName"]));
        $updatedDesc = htmlspecialchars(trim($_POST["medicineDesc"]));
        $updatedLink = htmlspecialchars(trim($_POST["medicineLink"]));

        Admin::UpdateMedicine($medID, $updatedName, $updatedDesc, $updatedLink);
        header("Location: ".$_SERVER["SCRIPT_NAME"]."/../../medicine.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki-Medic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../styles/general.css">
    <link rel="stylesheet" href="../../../styles/header.css">
    <link rel="stylesheet" href="../../../styles/footer.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="nav-container">
                <a href="../../medicine.php" class="nav-title">Wiki-Medic</a>

                <button class="nav-button">
                    <a href="../controllers/logoutController.php">
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
                <h2><b>Update Medicine</b></h2>
                <br>
            </div>

            <form action="" method="post">
                <!-- <label for="medicineID">Medicine ID</label> -->
                <input type="hidden" name="medicineID" id="medicineID" value="<?php echo hash("sha256", $medID) ?>" disabled>

                <div class="form-div">
                    <label for="medicineName" class="form-label">
                        Medicine Name
                    </label>
                    
                    <input type="text" class="form-input" name="medicineName" id="medicineName" value="<?php echo $medName ?>">
                </div>

                <div class="form-div">
                    <label for="medicineDesc" class="form-label">
                        Medicine Description
                    </label>

                    <textarea name="medicineDesc" class="form-input" id="medicineDesc" cols="10" rows="5"><?php echo $medDesc?></textarea>
                </div>

                <div class="form-div">
                    <label for="medicineLink" class="form-label">
                        Medicine Link
                    </label>

                    <input type="text" class="form-input" name="medicineLink" id="medicineLink" value="<?php echo $medLink ?>">
                </div>
                
                <button class="button">Update Medicine</button>
            </form>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>
</html>