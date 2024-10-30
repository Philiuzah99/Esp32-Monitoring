<?php
//Register_patient.php: handles patient registration
include('../includes/db.php');
include('../includes/header.php');

if($_SERVER['REQUEST_METHOD'] =='POST'){
    $patient_name = $_POST['patient_name'];
    $patient_number = rand(1000, 9999);

    $sql = "INSERT INTO patients(patient_name, patient_number) VALUES('$patient_name','$patient_number')";

    if($conn->query($sql) === TRUE){
        echo "Patient registerd successfully! Assigned number: $patient_number";
    }
    else{
        echo "Error:" ,$conn->error;
    }
}
?>

<!-- HTML Form for patient registration -->
 <form action="" method="POST" align="center">
     <h2 style="color:blue" align="center"> Register a New Patient</h2>
    <input type="text" name="patient_name" placeholder="Patient Name" required><br>
    <button type="submit"> Register Patient</button>
 </form>

 <?php include '../includes/footer.php';?>