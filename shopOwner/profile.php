<?php
// Start the session at the very beginning of the file
session_start();

// Import database connection
include("../connection.php");

// Check if the user is logged in and has the correct type
if(isset($_SESSION["user"]) && $_SESSION['type'] == '1'){
    $useremail = $_SESSION["user"];
} else {
    // Redirect to login page if user is not logged in or has incorrect type
    header("location: ../index.php");
    exit(); // Terminate script execution after redirection
}


// Fetch past appointments for the logged-in user
$sql = "SELECT appointment.*, shop_info.shop_name, shop_info.location, services.serviceName, services.service_price
        FROM `appointment` 
        JOIN shop_info ON appointment.shop_info_id = shop_info.shop_info_id
        LEFT JOIN services ON appointment.service_id = services.service_id
        WHERE appointment.vehicle_owner_id = {$_SESSION['id']}
        AND appointment.status != 'Not Completed'
        ORDER BY appointment.appointment_date DESC";

$result = $database->query($sql);

// Check for SQL query errors
if ($result === false) {
    die("Error executing query: " . $database->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment History</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
          <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="../css/style.css" rel="stylesheet">
        <link href="../css/ui-dashboard.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Optional: Hide horizontal scrollbar */
            font-family: Arial, sans-serif; /* Optional: Choose a commonly used font */
        }

        body {
            background-color: #F2F2F2; /* Dominant Color */
        }

        .container {
            /* background-color: #B0C4DE; Secondary Color */
            border-radius: 10px; /* Optional: Add some rounded corners */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); Optional: Add a subtle shadow for depth */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #FFF; /* Text color for navbar links */
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #4682B4; /* Accent color on hover for navbar links */
        }

        .top-bar {
            background-color: #4682B4; /* Accent Color */
            color: #FFF; /* Text color for top bar */
        }

        .top-bar-item h3 {
            color: #FFF; /* Text color for top bar headings */
        }

        .top-bar-item p {
            color: #F2F2F2; /* Text color for top bar content */
        }

        .nav-bar {
            background-color: #4682B4; /* Accent Color */
        }
        /* Table Row Colors */
        tbody tr:nth-child(even) {
            background-color: #E6E6E6; /* Light Gray */
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF; /* White */
        }
        /* Style for action buttons */
        .action-btns .btn {
            margin-right: 5px;
        }
        .logo-link {
    text-decoration: none; /* Remove underline from logo link */
    color: #FFF; /* Set color for logo link */
}

.logo-link:hover {
    color: #B0C4DE; /* Hover color for logo link */
}
.logo span {
        color: #4682B4; /* Same color for the span */
    }
           
           
    </style>
</head>
<body>
<?php

      $shop_owner_id = isset($_SESSION['id']) ? trim($_SESSION['id']) : '';
      $resultName = $database->query("SELECT first_name, last_name FROM shop_owners WHERE shop_owner_id = '$shop_owner_id' ");
      if ($resultName->num_rows > 0) {
        $user = $resultName->fetch_assoc();
        $userFirstName = $user['first_name'];
        $userLastName = $user['last_name'];
      }
?> 
<nav class="nav-bar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="logo">
                <a href="index.php" class="logo-link">
                    <h1>Glide<span>Gleam</span></h1>
                </a>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointment.php">Appointments</a>
                </li>
                <div class="action">
                <div class="profile" onclick="menuToggle();">
                  <img src="../assets/avatar.jpg" />
                </div>
                <div class="menu">
                <h2></h2>
                  <h3><?php echo "$userFirstName $userLastName";   ?><br /><span>Vehicle Owner</span></h3>
                  <ul>
                    <li>
                      <img src="../assets/icons/user.png" /><a href="#">My profile</a>
                    </li>
                    <li>
                      <img src="../assets/icons/history.png" /><a href="history.php">History</a>
                    </li>
                    <li>
                      <img src="../assets/icons/log-out.png" /><a href="../signout.php">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>
            </ul>
        </div>
    </div>
</nav>

    <div class="container my-5">
        
    </div>

</body>
</html>
