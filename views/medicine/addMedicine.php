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
    <h2>Add Medicine Page | Admin</h2>
    <a href="../medicine.php">Medicine Page</a>
    <form action="" method="post">
        <label for="medicineName">Medicine Name</label>
        <input type="text" name="medicineName" id="medicineName">
        <br>
        <label for="medicineDesc">Medicine Description</label>
        <textarea name="medicineDesc" id="medicineDesc" cols="30" rows="10"></textarea>
        <br>
        <label for="medicineLink">Medicine Link</label>
        <input type="text" name="medicineLink" id="medicineLink">
        <br>
        <button class="button">Add Medicine</button>

    </form>
</body>
</html>