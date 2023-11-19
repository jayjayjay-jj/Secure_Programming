<?php
    require "../controllers/adminController.php";
    
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
    <title>Add Medicine Page</title>
</head>
<body>
    <h2>Add Medicine Page | Admin</h2>
    <a href="./medicine.php">Medicine Page</a>
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
        <button>Add Medicine</button>

    </form>
</body>
</html>