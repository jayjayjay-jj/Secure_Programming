<?php
require "connection.php";

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

    static function AddMedicine($medName, $medDesc, $medLink){
        global $conn;
        $id = "MD". uniqid();
        $stmt = $conn->prepare("insert into msmedicine (MedicineID, MedicineName, MedicineDescription, MedicineLink) values (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id, $medName, $medDesc, $medLink);
        if($stmt->execute() === true){
            echo "success insert";
        }
        else{
            echo "fail";
        }
        $stmt->close();
        $conn->close();
    }

    static function UpdateMedicine($medID, $medName, $medDesc, $medLink){
        global $conn;
        $stmt = $conn->prepare("update msmedicine set MedicineName = ?, MedicineDescription = ?, MedicineLink = ? where MedicineID = ?");
        $stmt->bind_param("ssss", $medName, $medDesc, $medLink, $medID);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    static function DeleteMedicine($medID){
        global $conn;
        $stmt = $conn->prepare("delete from msmedicine where MedicineID = ?");
        $stmt->bind_param("s", $medID);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}

?>