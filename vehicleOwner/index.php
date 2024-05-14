<?php

session_start();
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
     <!-- CSS Libraries -->
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
          <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">
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
        /*  background-color: #B0C4DE; /* Secondary Color */
            border-radius: 10px; /* Optional: Add some rounded corners */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow for depth */
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
        .bg-gradient-custom {
                background-color: #4682B4; /* Matching color from your scheme */
                color: #FFF; /* Text color */
            }

    </style>
</head>
<body>
     <!-- Top Bar Start -->
     <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="index.php">
                                <h1>Glide<span>Gleam</span></h1>
                                <!-- <img src="img/logo.jpg" alt="Logo"> -->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Call Us</h3>
                                        <p>+012 345 6789</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Email Us</h3>
                                        <p>info@example.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

    <!-- Navbar -->
    <nav class="nav-bar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking.php">Car Wash</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.php">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../signout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Left side card -->
    <div class="container mt-4">
        <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="card custom-card">
                    <div class="card-body text-center">
                    <?php
// Include your database connection file

$vehicle_owner_id = isset($_SESSION['id']) ? $_SESSION['id'] : ""; 

// Fetch appointments data from the database with service details
$sql = "SELECT appointment.*, services.service_price 
        FROM appointment 
        INNER JOIN services ON appointment.service_id = services.service_id 
        WHERE appointment.status = 'Not Completed' 
        AND vehicle_owner_id = '$vehicle_owner_id'"
        ;
$result = $database->query($sql);

// Check if there are appointments
if ($result->num_rows > 0) {
    // Loop through each appointment
    while($row = $result->fetch_assoc()) {
        // Extract appointment details
        $queue_number = $row["queue_number"];
        $shop_info_id = $row["shop_info_id"];
        $service_price = $row["service_price"];
        // Fetch shop name based on shop_info_id
        $shop_sql = "SELECT shop_name FROM shop_info WHERE shop_info_id = $shop_info_id";
        $shop_result = $database->query($shop_sql);
        $shop_name = "";
        if ($shop_result->num_rows > 0) {
            $shop_row = $shop_result->fetch_assoc();
            $shop_name = $shop_row["shop_name"];
        }

        // Output the card with fetched data
        echo '<div class="card custom-card">';
        echo '<div class="card-body text-center">';
        echo '<p class="queue-number">'.$queue_number.'</p>';
        echo '<p class="card-text">Your Queue</p>';
        echo '<p class="card-text">Shop: '.$shop_name.'</p>';
        echo '<p class="card-text">Price: &#x20B1;'.$service_price.'</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No appointments found.";
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
