
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Wound Monitoring System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for hamburger icon -->
    <link rel="stylesheet" href="styles.css"> <!-- Your custom CSS file -->
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            background-color: grey;
        }

        /* Slideshow Container */
        .slideshow-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Behind everything else */
        }

        /* Slideshow images */
        .slideshow-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            opacity: 0;
            animation: slideAnimation 15s infinite;
        }

        /* Slide Animation */
        @keyframes slideAnimation {
            0%, 20% {
                opacity: 1;
            }
            25%, 95% {
                opacity: 0;
            }
        }

        /* Sequentially time each slide */
        .slideshow-container img:nth-child(1) {
            animation-delay: 0s;
        }

        .slideshow-container img:nth-child(2) {
            animation-delay: 5s;
        }

        .slideshow-container img:nth-child(3) {
            animation-delay: 10s;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo .red {
            color: red;
        }

        .logo .blue {
            color: blue;
        }

        .menu-icon {
            font-size: 30px;
            cursor: pointer;
        }

        .menu {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 60px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.9);
            width: 200px;
            text-align: right;
        }

        .menu a {
            padding: 10px;
            color: white;
            text-decoration: none;
            display: block;
        }

        .menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu.active {
            display: flex;
        }

        /* For larger screens */
        @media (min-width: 768px) {
            .menu {
                display: flex;
                position: relative;
                flex-direction: row;
                width: auto;
                background: none;
                top: auto;
                right: auto;
            }

            .menu a {
                margin-left: 20px;
            }

            .menu-icon {
                display: none;
            }
        }

        /* Main content */
        .content {
            position: relative;
            color: white;
            text-align: center;
            top: 40%;
            z-index: 1;
        }

        h1 {
            font-size: 40px;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>
<body>

    <!-- Slideshow Container -->
    <div class="slideshow-container">
        <img src="../images/esp32.jpg" alt="Slide 1">
        <img src="../images/moist.jpg" alt="Slide 2">
        <img src="../images/optical.jpg" alt="Slide 3">
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            Phil-<span class="red">TE</span>ch <span class="blue">En</span>gineering
        </div>
        <i class="fas fa-bars menu-icon" id="menu-toggle"></i>
        <div class="menu" id="menu">
            <a href="dashboard.php">Dashboard</a> <!-- Link to Dashboard -->
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="#" id="profiles">Profiles</a> <!-- Dropdown Profiles Menu -->
            <div class="dropdown" id="profiles-dropdown" style="display: none;">
                <a href="register_nurse.php">Register Nurse</a> <!-- Link to nurse registration -->
                <a href="register_patient.php">Register Patient</a> <!-- Link to patient registration -->
                <a href="patients.php">View Patients</a>
                <a href="view_nurses.php">View Nurses</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>Welcome to the Wound Monitoring System</h1>
        <p>Explore our interactive dashboard, manage profiles, and control devices remotely.</p>
    </div>

    <script>
        // Toggle menu on mobile
        const menuIcon = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        const profilesLink = document.getElementById('profiles');
        const profilesDropdown = document.getElementById('profiles-dropdown');

        menuIcon.addEventListener('click', () => {
            menu.classList.toggle('active');
        });

        // Toggle Profiles Dropdown
        profilesLink.addEventListener('click', (e) => {
            e.preventDefault();  // Prevent default link action
            profilesDropdown.style.display = profilesDropdown.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>