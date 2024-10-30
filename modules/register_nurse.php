<?php


// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include('../includes/db.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input values
    $nurse_name = $_POST['nurse_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Prepare and execute the SQL insert query
    $sql = "INSERT INTO nurses (nurse_name, email, password) VALUES ('$nurse_name', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nurse registered successfully!";
    } else {
        // Output any SQL errors for debugging
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"> <!-- Link to your CSS -->
</head>
<body>

<!-- HTML Form for nurse registration -->
<form action="" method="POST">
    <h2 style="color: blue";>Register a Nurse</h2>
    <label for="nurse_name">Full Name:</label>
    <input type="text" id="nurse_name" name="nurse_name" placeholder="Full Name" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Password" required><br>

    <button type="submit">Register</button>
</form>

<?php include '../includes/footer.php';?>

</body>
</html>