<?php

//control_device.php: handles turning devcies ON and OFF
include('../includes/db.php');
if($_SERVER['REQUEST_METHOD'] =='POST'){
    $device_id = $_POST['device_id'];

    //Fetch current status of the device
    $result = $conn->query("SELECT status FROM devices WHERE id = $device_id");
    $device = $result->fetch_assoc();
    $new_status =($device['status'] =='ON') ? 'OFF': 'ON';

    //Update device status
    $conn->query("UPDATE devices SET status = '$new_status' WHERE id = $device_id");

    header("Location: ../modules/dashboard.php");
}
?>