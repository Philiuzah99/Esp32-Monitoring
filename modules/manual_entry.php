<?php
// Database connection
$host = "localhost";
$user = "root"; // Update with your database username
$pass = ""; // Update with your database password
$db = "wound_monitoring_system";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store messages
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $patient_id = $conn->real_escape_string($_POST['patient_id']);
    $moisture = $conn->real_escape_string($_POST['moisture']);
    $temperature = $conn->real_escape_string($_POST['temperature']);
    $tissue_health = $conn->real_escape_string($_POST['tissue_health']);

    // Check if the patient_id exists
    $patient_check = $conn->query("SELECT * FROM patients WHERE id = '$patient_id'");

    if ($patient_check->num_rows > 0) {
        // Patient exists, proceed to insert sensor data
        $sql = "INSERT INTO sensor_data (patient_id, moisture, temperature, tissue_health) 
                VALUES ('$patient_id', '$moisture', '$temperature', '$tissue_health')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Sensor data recorded successfully!";
        } else {
            $message = "Error: " . $conn->error; // Show the error message
        }
    } else {
        $message = "Error: The specified patient ID does not exist.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Sensor Data Entry</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"> <!-- Link your CSS file here -->
</head>
<body>
    <div class="container">
        <h2>Manual Sensor Data Entry</h2>
        <form action="" method="POST">
            <label for="patient_id">Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" required><br>

            <label for="moisture">Moisture Level:</label>
            <input type="text" id="moisture" name="moisture" required><br>

            <label for="temperature">Temperature:</label>
            <input type="text" id="temperature" name="temperature" required><br>

            <label for="tissue_health">Tissue Health:</label>
            <input type="text" id="tissue_health" name="tissue_health" required><br>

            <input type="submit" value="Submit Data">
        </form>

        <?php if (!empty($message)) : ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>