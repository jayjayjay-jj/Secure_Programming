<?php
    require '../controllers/adminController.php';

    $medID = substr($_SERVER['PATH_INFO'], 1);
    $data = Admin::GetMedicineByID($medID);
    $medicine = $data->fetch_assoc();
    var_dump($medicine);
    $medName = $medicine["MedicineName"];
    $medDesc = $medicine["MedicineDescription"];
    $medLink = $medicine["MedicineLink"];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        Admin::UpdateMedicine($medID,$_POST["medicineName"], $_POST["medicineDesc"], $_POST["medicineLink"]);
        header("Location: ../medicine.php");
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
    <h2>Update Medicine Page | Admin</h2>
    <a href="./medicine.php">Medicine Page</a>
    <form action="" method="post">
        <label for="medicineID">Medicine Name</label>
        <input type="text" name="medicineID" id="medicineID" value="<?php echo $medID ?>" disabled>
        <br>
        <label for="medicineName">Medicine Name</label>
        <input type="text" name="medicineName" id="medicineName" value="<?php echo $medName ?>">
        <br>
        <label for="medicineDesc">Medicine Description</label>
        <textarea name="medicineDesc" id="medicineDesc" cols="30" rows="10"><?php echo $medDesc?></textarea>
        <br>
        <label for="medicineLink">Medicine Link</label>
        <input type="text" name="medicineLink" id="medicineLink" value="<?php echo $medLink ?>">
        <br>
        <button>Update Medicine</button>

    </form>
</body>
</html>