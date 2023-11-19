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
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../header.css">
</head>

<body>
    <header>
        <div class="name">
            <a href="../homepage/hompage.html"><img src="../pics/logo1.png" alt=""></a>
        </div>
        <div class="navbar">
            <a href="register.php">Register</a>
        </div>
    </header>
    <div class="greetings">
        <h2><b>Wiki-Medic Dictionary</b></h2>
    </div>
    <main>
        <div id="greetings1">
            <h1>View Only</h1>
        </div>
        <div class="medicine-board"></div>
        <table class="center">
            <tr class="col1">
                <th>No.</th>
                <th>Name</th>
                <th>Description</th>
                <th>More info</th>
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
                    echo "<td><a href='$medLink'>Click for details</a></td>";
                    echo "</tr>";
                }
            ?>
            
        </table>
        <br>
        <br>
        <div class="out">
            <a href="../register.php">Exit</a>
        </div>
        </div>
    </main>
    <Footer class="foot">
        <p>Copyright @ 2023 [Wiki-Medic]. All Rights Reserved</p>
    </Footer>
</body>

</html>