<?php


// Include database connection
include('../includes/db.php');

// Fetch all nurses from the database
$sql = "SELECT nurse_name, email FROM nurses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nurses List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"> <!-- Link to CSS -->
</head>
<body>
    <h1 style="color:blue" align="center">Registered Nurses</h1>

    <!-- Table to display nurses -->
    <table border="1" align="center">
        <tr>
            <th>Nurse Name</th>
            <th>Email</th>
        </tr>
        <?php if ($result->num_rows > 0) {
            // Loop through the result and display nurses
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['nurse_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='2'>No nurses registered.</td></tr>";
        } ?>
    </table>
    <?php include '../includes/footer.php';?>
</body>
</html>