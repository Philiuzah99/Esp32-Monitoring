<!-- submit_data.php -->
<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'wound_monitoring_system'); // Replace with your database name

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
$patient_id = $conn->real_escape_string($_POST['patient_id']);
$moisture =$conn->real_escape_string( $_POST['moisture']);
$temperature =$conn->real_escape_string( $_POST['temperature']);
$tissue_health = $conn->real_escape_string($_POST['tissue_health']);
$timestamp = date('Y-m-d H:i:s');

// Insert data into the database
$sql = "INSERT INTO sensor_data (ID,moisture, temperature, tissue_health, recorded_at)
        VALUES ('$patient_id','$moisture', '$temperature', '$tissue_health', '$timestamp')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. <a href='manual_entry.php'>Add more data</a>";
  } 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>