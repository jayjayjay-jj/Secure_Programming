<?php
    require '../controllers/adminController.php';

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        if(isset($_SERVER["PATH_INFO"])){
            if($_SERVER["PATH_INFO"] === "/"){
                header("Location: ".$_SERVER["SCRIPT_NAME"]);
            }
        }
        else{
            $allMeds = Admin::GetAllMedicine();
        }
    }
    else if($_SERVER["REQUEST_METHOD"] === "POST"){
        if ($_POST["action"] && $_POST["id"]) {
            if ($_POST["action"] == "Update") {
              // Update with $_POST["id"]
            }
            else if($_POST["action"] == "Delete"){
                Admin::DeleteMedicine($_POST["id"]);
            }
        }
        header("Location: ".$_SERVER["SCRIPT_NAME"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Page</title>
</head>
<body>
    <h2>Medicine Page | Admin</h2>
    <a href="./addMedicine.php">Add Medicine Page</a>
    <table>
        <thead>
            <th>Medicine ID</th>
            <th>Medicine Name</th>
            <th>Medicine Description</th>
            <th>Medicine Link</th>
            <th colspan="2">Action</th>
        </thead>
        <tbody>
            <?php for($i = 0; $i < $allMeds->num_rows; $i++) {
                $med = $allMeds->fetch_assoc();
                $medID = $med["MedicineID"];
            ?>
            <tr>
                <?php foreach($med as $k => $v){
                    echo "<td>$v</td>";
                } ?>
                <form method="post" action="">
                <td><input type="submit" name="action" value="Update"/></td>
                <td><input type="submit" name="action" value="Delete"/></td>
                <td><input type="hidden" name="id" value="<?php echo $medID; ?>"/></td>
                </form>
            </tr>
            <?php }?>
        </tbody>
    </table>
</body>
</html>

<script>
    function deleteMedicine(str){
        console.log(window.location.href+'/remove/'+str);
        // window.location.href = str;  
    }
</script>