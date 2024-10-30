<?php

//receive_data.php: Handles real-time sensor data received from hardware

//include database connection file
include('../includes/db.php');

//Enable error reporting for debugging
error_get_last(E_ALL);
ini_set('display_errors',1);

//Check if the request method is POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //retrieve sensor data from POST request
    $patient_id = $_POST['patient_id'];
    $moisture = $_POST['moisture'];
    $temperature = $_POST['temperature'];
    $tissue_health = $_POST['tissue_health'];
    $timestamp = date('Y-m-d H:i:s');

    

    //validate that required data is present
    if(!empty($moisture) && !empty($temperature) && !empty($tissue_health) && !empty($patient_id)){

        //insert into the sensor_data table
        $sql = "INSERT INTO sensor_data(patient_id, moisture, temperature, tissue_health, recorded_at)
                VALUES('$patient_id','$moisture', '$temperature', '$tissue_health','$timestamp')";

        if($conn->query($sql) === TRUE){
            echo "Sensor data recorded successfully!";
        }
        else{
            echo "Error:" .$conn->error;
          }
        }
    else{
        echo "Invalid sensor data received!";
      }
    
  }
  else{
    echo "Invalid request method!";
  }

?>