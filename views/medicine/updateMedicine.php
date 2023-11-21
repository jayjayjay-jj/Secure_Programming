<?php
    require("../../controllers/adminController.php");
    
    $hashID = substr($_SERVER['PATH_INFO'], 1);
    $medID = Admin::GetMedicineIDByHashID($hashID);
    if($medID == null){
        header("Location: ".$_SERVER["SCRIPT_NAME"]."/../../error.php");
    }
    $data = Admin::GetMedicineByID($medID);
    $medicine = $data->fetch_assoc();
    $medName = $medicine["MedicineName"];
    $medDesc = $medicine["MedicineDescription"];
    $medLink = $medicine["MedicineLink"];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        Admin::UpdateMedicine($medID,$_POST["medicineName"], $_POST["medicineDesc"], $_POST["medicineLink"]);
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
    <link rel="stylesheet" href="../../styles/general.css">
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="../../styles/footer.css">
</head>
<body>
    <h2>Update Medicine Page | Admin</h2>
    <a href="./medicine.php">Medicine Page</a>
    <form action="" method="post">
        <!-- <label for="medicineID">Medicine ID</label> -->
        <input type="hidden" name="medicineID" id="medicineID" value="<?php echo hash("sha256", $medID) ?>" disabled>
        <!-- <br> -->
        <label for="medicineName">Medicine Name</label>
        <input type="text" name="medicineName" id="medicineName" value="<?php echo $medName ?>">
        <br>
        <label for="medicineDesc">Medicine Description</label>
        <textarea name="medicineDesc" id="medicineDesc" cols="30" rows="10"><?php echo $medDesc?></textarea>
        <br>
        <label for="medicineLink">Medicine Link</label>
        <input type="text" name="medicineLink" id="medicineLink" value="<?php echo $medLink ?>">
        <br>
        <button class="button">Update Medicine</button>

    </form>
</body>
</html>