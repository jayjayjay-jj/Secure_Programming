<?php
    session_start();
    require '../controllers/listMedicineController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki-Medic</title>
    <link rel="shortcut icon" href="../pics/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/general.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
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
                <h2><b>Wiki-Medic Dictionary</b></h2>
                <br>
            </div>

            <table class="table-content">
                <tr class="table-header">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Further Information</th>
                </tr>
                
                <?php 
                    $allMeds = getAllMedicine();
                    
                    for($i = 1; $i <= $allMeds->num_rows; $i++){
                        $med = $allMeds->fetch_assoc();
                        $medName = $med["MedicineName"];
                        $medDesc = $med["MedicineDescription"];
                        $medLink = $med["MedicineLink"];
                        echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>$medName</td>";
                        echo "<td>$medDesc</td>";
                        echo "<td><a target='.blank' href='$medLink'>Click for details</a></td>";
                        echo "</tr>";
                    }
                ?>
                
            </table>
        </div>
    </main>

    <footer>
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </footer>
</body>

</html>