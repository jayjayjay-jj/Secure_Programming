<?php
require "connection.php";
require "util.php";

class Admin{
        
    static function GetAllMedicine(){
        global $conn;
        $q = "select * from msmedicine;";
        $d = $conn->query($q);
        return $d;
    }
    
    static function GetMedicineByID($medID){
        global $conn;
        $stmt = $conn->prepare("select * from msmedicine where MedicineID = ?");
        $stmt->bind_param("s", $medID);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        return $res;
    }

    static function GetMedicineIDByHashID($hashID){
        $meds = Admin::GetAllMedicine();
        for($i = 0; $i < $meds->num_rows; $i++){
            $medID = $meds->fetch_assoc()["MedicineID"];
            if($hashID === hash("sha256", $medID)){
                return $medID;
            }
        }
        return null;
    }

    static function AddMedicine($medName, $medDesc, $medLink){
        global $conn;

        if(Util::isInvalidCSRFToken($_POST['csrf_token'], $_SESSION['csrf_token'])) {
            $errorMessage = "Anti-CSRF token invalid";
            $_SESSION['error_message'] = $errorMessage;

            header('Location: ../views/medicine/addMedicine?error=1');
        }

        $id = "MD". uniqid();
        $stmt = $conn->prepare("insert into msmedicine (MedicineID, MedicineName, MedicineDescription, MedicineLink) values (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id, $medName, $medDesc, $medLink);
        if($stmt->execute() === true){
            // echo "success insert";
            header("Location: ../../views/medicine.php");
        }
        else{
            echo "fail";
        }
        $stmt->close();
        $conn->close();
    }

    static function UpdateMedicine($medID, $medName, $medDesc, $medLink){
        global $conn;

        if(Util::isInvalidCSRFToken($_POST['csrf_token'], $_SESSION['csrf_token'])) {
            $errorMessage = "Anti-CSRF token invalid";
            $_SESSION['error_message'] = $errorMessage;

            header('Location: ../views/medicine/updateMedicine?error=1');
        }

        $stmt = $conn->prepare("update msmedicine set MedicineName = ?, MedicineDescription = ?, MedicineLink = ? where MedicineID = ?");
        $stmt->bind_param("ssss", $medName, $medDesc, $medLink, $medID);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    static function DeleteMedicine($hashID){
        $medID = Admin::GetMedicineIDByHashID($hashID);
        
        global $conn;

        $stmt = $conn->prepare("delete from msmedicine where MedicineID = ?");
        $stmt->bind_param("s", $medID);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}

?>