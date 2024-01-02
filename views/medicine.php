<?php
    session_start();
    require '../controllers/adminController.php';

    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }

    if($_SESSION['user']['UserRole'] !== "Admin") {
        header("Location: ./error/401.php");
    }

    if(!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = uniqid('token', TRUE);
    }

    $csrf_token = $_SESSION['csrf_token'];

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        if(isset($_SERVER["PATH_INFO"])){
            if($_SERVER["PATH_INFO"] === "/" || substr($_SERVER['PATH_INFO'], 1)){
                header("Location: ".$_SERVER["SCRIPT_NAME"]);
            }
        }
        
        $allMeds = Admin::GetAllMedicine();
    }
    else if($_SERVER["REQUEST_METHOD"] === "POST"){
        if ($_POST["action"] && $_POST["id"]) {
            if ($_POST["action"] == "Update") {
                header("Location: medicine/updateMedicine.php/".$_POST["id"]);
            }
            else if($_POST["action"] == "Delete"){
                Admin::DeleteMedicine($_POST["id"]);
                header("Location: ".$_SERVER["SCRIPT_NAME"]);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki-Medic</title>
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="nav-container">
                <a href="../views/medicine.php" class="nav-title">Wiki-Medic</a>

                <button class="nav-button">
                    <a href="../controllers/logoutController.php">
                        Logout
                    </a>
                </button>
            </div>
        </div>
    </header>

    <main>
        <div class="jumbotron-container-medicine">
            <div class="greetings">
                <br><br>
                <h2>Medicine Page</h2>
                <a href="./medicine/addMedicine.php" class="view-button">
                    Add Medicine Page
                </a>
            </div>

            <br><br>
            
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

            <table class="table-content">
                <tr class="table-header">
                    <th>Medicine Name</th>
                    <th>Medicine Description</th>
                    <th>Medicine Link</th>
                    <th colspan="2">Action</th>
                </tr>
                
                <?php for($i = 0; $i < $allMeds->num_rows; $i++) {
                    $med = $allMeds->fetch_assoc();
                    $medID = $med["MedicineID"];
                    $medName = $med["MedicineName"];
                    $medDesc = $med["MedicineDescription"];
                    $medLink = $med["MedicineLink"];
                ?>
                <tr>
                    <?php 
                        echo "<td>$medName</td>";
                        echo "<td>$medDesc</td>";
                        echo "<td>$medLink</td>";
                    ?>
                    <form method="post" action="">
                    <td>
                        <input type="submit" name="action" value="Update" class="update-button"/>
                    </td>
                    
                    <td>
                        <input type="submit" name="action" value="Delete" class="delete-button"/>
                    </td>

                    <input type="hidden" name="id" value="<?php echo hash("sha256",$medID); ?>"/>
                    </form>
                </tr>
                <?php }?>
            </table>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>
</html>