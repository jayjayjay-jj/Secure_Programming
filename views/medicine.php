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
        <div class="jumbotron-container-medicine">
            <div class="greetings">
                <br><br>
            <h2>Medicine Page | Admin</h2>
                <br>
            </div>
            
            <a href="./medicine/addMedicine.php">Add Medicine Page</a>
            
            <table class="table-content">
                <tr class="table-header">
                    <th>Medicine ID</th>
                    <th>Medicine Name</th>
                    <th>Medicine Description</th>
                    <th>Medicine Link</th>
                    <th colspan="2">Action</th>
                </tr>
                
                <?php for($i = 0; $i < $allMeds->num_rows; $i++) {
                    $med = $allMeds->fetch_assoc();
                    $medID = $med["MedicineID"];
                ?>
                <tr>
                    <?php foreach($med as $k => $v){
                        echo "<td>$v</td>";
                    } ?>
                    <form method="post" action="">
                    <td>
                        <input type="submit" name="action" value="Update" class="update-button"/>
                    </td>
                    
                    <td>
                        <input type="submit" name="action" value="Delete" class="delete-button"/>
                    </td>

                    <td><input type="hidden" name="id" value="<?php echo $medID; ?>"/></td>
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

<script>
    function deleteMedicine(str){
        console.log(window.location.href+'/remove/'+str);
        // window.location.href = str;  
    }
</script>