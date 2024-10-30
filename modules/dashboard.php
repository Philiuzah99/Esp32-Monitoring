<?php


//dashboard.php: Display sensor data and control devices

include('../includes/db.php');

//Fetch all sensor data
//$sql = "SELECT id,moisture,temperature,tissue_health, recorded_at";
//$result = $conn->query($sql);
$result = $conn->query("SELECT * FROM sensor_data ORDER by recorded_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Wound Monitoring Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1  align="center" style="color:blue";>............<b>View Wound Status</b>............. </h1>

    <!-- Search patient by number -->
    <!-- <form action="" method="GET">
        <input type="text" name="patient_number" placeholder="Search patient by bunber">
        <button type="submit">Search</button>
     </form> -->

     <!-- Dispaly sensor data -->
      <table border="1" align="center">
        <tr>
            
            <th>Patient ID</th>
            <th>Moisture</th>
            <th>Temperature</th>
            <th>Tissue Health</th>
            <th>Timestamp</th>
            
        </tr>
        <?php while($row = $result->fetch_assoc()){
            //$patient_id = $row['id'];

            //query to get the patient number from the patients table
           /* $patient_sql = "SELECT patient_number FROM patients WHERE id ='$id'";
            $patient_result = $conn->query($patient_sql);

            if($patient_result->num_rows>0){
              $patient_row = $patient_result->fetch_assoc();
              $patient_number = $patient_row['patient_number'];
            }
            else{
              $patient_number = "Unknown";
            }*/
          
          ?>
        <tr>
          
            <td><?php echo $row['patient_id']; ?></td>
            <td><?php echo $row['moisture']; ?></td>
            <td><?php echo $row['temperature']; ?></td>
            <td><?php echo $row['tissue_health'];?></td>
            <td><?php echo $row['recorded_at'];?></td>
            
            
            
        </tr>
        <?php } ?>
      </table>

      <!-- Control Devices -->
       <h2 align="center" style="color:blue">...............<b>Intervene...Control devcies</b>.............</h2>
      <table border=1 align="center">
          <tr>
            <th>Device Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
    
        <?php
        $devices = $conn->query("SELECT * FROM devices");
        while($device = $devices->fetch_assoc()){
         $device_id = $device['id'];
         $status = $device['status'];

        ?>
           <tr>
            <td><?php echo htmlspecialchars($device['device_name']); ?></td>
            <td><?php echo htmlspecialchars($status); ?></td>
            <td>
                <form action="../devices/control_device.php" method="POST" class="device-control">
                    <input type="hidden" name="device_id" value="<?php echo $device_id; ?>">
                    <button type="submit" name="toggle_status"><?php echo ($status == 'ON') ? 'Turn OFF':'Turn ON';?></button>
                </form>
            </td>
           </tr>
        <?php } ?>
     </table>
        
        

       <script scr="../js/app.js"></script>
       <?php include '../includes/footer.php';?>
</body>
</html>