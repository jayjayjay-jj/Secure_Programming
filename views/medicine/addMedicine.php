<?php
    require("../../controllers/adminController.php");
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $medName = $_POST["medicineName"];
        $medDesc = $_POST["medicineDesc"];
        $medLink = $_POST["medicineLink"];
        Admin::AddMedicine($medName, $medDesc, $medLink);
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
                <a href="../homepage/hompage.html" class="nav-title">Wiki-Medic</a>

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
                <h2><b>Add Medicine</b></h2>
                <br>
            </div>

            <a href="./medicine.php">Medicine Page</a>

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

                <button class="button">Add Medicine</button>
            </form>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>
</html>