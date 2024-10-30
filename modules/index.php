<?php
session_start();
include '../includes/db.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: main.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($action == 'login') {
        $query = "SELECT * FROM nurses WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            $nurse = $result->fetch_assoc();
            if (password_verify($password, $nurse['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['nurse_name'] = $nurse['nurse_name'];
                header("Location: main.php");
                exit();
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "Email not found!";
        }
    } elseif ($action == 'register') {
        $nurse_name = $_POST['nurse_name'];

        $check_query = "SELECT * FROM nurses WHERE email = '$email'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows == 0) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $insert_query = "INSERT INTO nurses (nurse_name, email, password) VALUES ('$nurse_name', '$email', '$hashed_password')";
            $conn->query($insert_query);
            $_SESSION['logged_in'] = true;
            $_SESSION['nurse_name'] = $nurse_name;
            header("Location: index.php");
            exit();
        } else {
            $error = "Email already exists!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nurse Login/Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <!--<div class="logo">
            Phil-<span class="red">TE</span>ch <span class="blue">En</span>gineering
        <div class="menu">
            <button onclick="showLogin()">Login</button>
            <button onclick="showRegister()">Register</button>
        </div> -->


      <div class="navbar">
        <div class="logo">
            Phil-<span class="red">TE</span>ch <span class="blue">En</span>gineering
        </div>
        <i class="fas fa-bars menu-icon" id="menu-toggle"></i>
        <div class="menu" id="menu">

            <button onclick="showLogin()">Login</button>
            <button onclick="showRegister()">Register</button>

          <!-- <a href="dashboard.php">Dashboard</a> 
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="#" id="profiles">Profiles</a> 
            <div class="dropdown" id="profiles-dropdown" style="display: none;">
                <a href="register_nurse.php">Register Nurse</a> 
                <a href="register_patient.php">Register Patient</a> 
                <a href="patients.php">View Patients</a>
                <a href="view_nurses.php">View Nurses</a>
                <a href="logout.php">Logout</a>
            </div> -->

        </div>
      </div>

    </header>

    <div class="form-container">
        <div id="login-form">
            <h2>Login</h2>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form align="center" method="POST">
                <input type="hidden" name="action" value="login">
                <label>Email:</label>
                <input type="email" name="email" required><br><br>
                <label>Password:</label>
                <input type="password" name="password" required><br><br>
                <button type="submit">Login</button>
            </form>
        </div>

        <div id="register-form" style="display:none;">
            <h2>Register</h2>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form align="center" method="POST">
                <input type="hidden" name="action" value="register">
                <label>Name:</label>
                <input type="text" name="nurse_name" required><br>
                <label>Email:</label>
                <input type="email" name="email" required><br>
                <label>Password:</label>
                <input type="password" name="password" required><br><br>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
        }

        function showRegister() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        }
    </script>
    <?php include '../includes/footer.php';?>
</body>
</html>