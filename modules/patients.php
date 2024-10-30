<?php

include('../includes/db.php');
//include('../includes/header.php')

//Query to fetch patients details
$sql = "SELECT id, patient_name, patient_number, registered_at FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> patients/list</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1 style="color: blue" align="center";>Patient List</h2>

    <table border=1 align="center">
        <tr>
            <th>Patient ID</th>
            <th>Patient Name</th>
            <th>Patient Number</th>
            <th>Date Registered</th>
        </tr>

        <?php while($row = $result->fetch_assoc()){
            ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['patient_name']; ?></td>
                <td><?php echo $row['patient_number']; ?></td>
                <td><?php echo $row['registered_at']; ?></td>
              </tr>
            <?php
        } ?>
    </table>
    <?php include '../includes/footer.php';?>
</body>
</html>