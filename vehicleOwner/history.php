<?php
// Start the session at the very beginning of the file
session_start();

// Import database connection
include("../connection.php");

// Check if the user is logged in and has the correct type
if(isset($_SESSION["user"]) && $_SESSION['type'] == '2'){
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
    <style>
        .section-title h2 {
            color: white;
        } 

        /* Style for the table header */
        th {
            background-color: #343a40; /* Dark grey */
            color: #fff; /* White text */
        }
        /* Alternate row color for better readability */
        tbody tr {
            background-color: #fff; /* Violet */
            color: #000000; /* White text */
        }
        tbody tr:nth-child(even) {
            background-color: #fff; /* Violet */
            color: #000000; /* White text */
        }
        /* Style for action buttons */
        .action-btns .btn {
            margin-right: 5px;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Optional: Hide horizontal scrollbar */
        }

        body {
        background: linear-gradient(to bottom, #000000, #8A2BE2); /* Black to Violet gradient */
        
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
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 d-none d-lg-block">
                    <div class="row">
                        <div class="col-4"></div>
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
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../signout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <a class="btn btn-custom" href="index.php" role="button">Back</a>
        <?php
        // Check if the result is not empty
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // Output appointment details in a card
                echo "<div class='card my-2'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Shop Name: " . $row["shop_name"]. "</h5>";
                echo "<p class='card-text'>Location: " . $row["location"]. "</p>";
                echo "<p class='card-text'>Queue Number: " . $row["queue_number"] . "</p>";
                echo "<p class='card-text'>Appointment Date: " . date('F d, Y', strtotime($row["appointment_date"])). "</p>";
                echo "<p class='card-text'>Appointment Time: " . date('h:i A', strtotime($row["appointment_date"])). "</p>";
                echo "<p class='card-text'>Status: " . $row["status"]. "</p>";
                // If services are available, display them
                if (!empty($row["serviceName"])) {
                    echo "<p class='card-text'>Selected Service: " . $row["serviceName"] . " (₱" . $row["service_price"] . ")</p>";
                }
                // Rate button
// Rate button
                echo "<a href='rating.php?id=" . $row["appointment_id"] . "' class='btn btn-primary'>Rate</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            // Output a message if no appointments are found
            echo "<p>No past appointments found</p>";
        }
        ?>
    </div>

</body>
</html>
