<?php
// Start the session at the very beginning of the file
session_start();

// Import database connection
include("../connection.php");

// Check if the selectedServices session variable is set
if(isset($_SESSION['selectedServices'])) {
    $selectedServices = $_SESSION['selectedServices'];
    // Now you can use $selectedServices array in this file
} else {
    // Handle the case where selectedServices is not set
    $selectedServices = array(); // Initialize as an empty array
}

// Check if the user is logged in and has the correct type
if(isset($_SESSION["user"]) && $_SESSION['type'] == '2'){
    $useremail = $_SESSION["user"];
} else {
    // Redirect to login page if user is not logged in or has incorrect type
    header("location: ../index.php");
    exit(); // Terminate script execution after redirection
}

// Fetch appointments for the logged-in user
$sql = "SELECT appointment.*, accounts.*, vehicle_owners.*, shop_info.*, services.serviceName, services.service_price
        FROM `appointment` 
        JOIN accounts ON appointment.vehicle_owner_id = accounts.account_id 
        JOIN vehicle_owners ON accounts.account_id = vehicle_owners.vehicle_owner_id
        JOIN shop_info ON appointment.shop_info_id = shop_info.shop_info_id
        LEFT JOIN services ON appointment.service_id = services.service_id
        WHERE accounts.account_id = {$_SESSION['id']}
        AND appointment.status = 'Not Completed'
        ORDER BY appointment.appointment_date ASC
        ";


$result = $database->query($sql);

// Check for SQL query errors
if ($result === false) {
    die("Error executing query: " . $database->error);
}

// Output HTML content
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
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
          <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
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

        /* Adjusted CSS */
        .appointment-card {
            max-width: 400px; /* Set the maximum width of the card */
            margin: -10 auto; /* Center the card horizontally */
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
            echo "<div class='card my-2 appointment-card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Shop Name: " . $row["shop_name"]. "</h5>";
            echo "<p class='card-text'>Location: " . $row["location"]. "</p>";
            echo "<p class='card-text'>Queue Number: " . $row["queue_number"] . "</p>";

            // Display selected services and their prices
            if(!empty($selectedServices)) {
                echo "<p class='card-text'>Selected Service(s): <br>";
                foreach($selectedServices as $service => $price) {
                    echo "- $service (₱$price)<br>";
                }
                echo "</p>";
            } else {
                echo "<p class='card-text'>No service selected</p>";
            }
            
            echo "<p class='card-text'>Appointment Date: " . date('F d, Y', strtotime($row["appointment_date"])). "</p>";
            echo "<p class='card-text'>Appointment Time: " . date('h:i A', strtotime($row["appointment_date"])). "</p>";
             // Button to handle cancellation of appointment
             echo "<button id='cancelBtn' class='btn btn-danger' onclick='completeAppointment(" . $row["appointment_id"] . ", \"Cancelled\")'>Cancel</button>";

            echo "</div>";
            echo "</div>";
        }
    } else {
        // Output a message if no appointments are found
        echo "<p>No appointments found</p>";
    }
    ?>
    </div>

    <script>
    // Function to hide the cancel button after 5 minutes
    setTimeout(function(){
        document.getElementById('cancelBtn').style.display = 'none';
    }, 300000); // 5 minutes in milliseconds

   
    function completeAppointment(appointmentId, status) {
        // Display a confirmation prompt
        var confirmAction = confirm("Are you sure you want to mark this appointment as " + status + "?");

        if (confirmAction) {
            // Send an AJAX request to mark the appointment as completed or cancelled
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_appointment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the PHP script
                    alert(xhr.responseText);
                    // Optionally, you can update the UI to reflect the completed/cancelled appointment
                    location.reload(); // Reload the page to reflect the changes
                    
                    // If the appointment is marked as completed, send notification
                    if (status === "Completed") {
                        sendNotification(appointmentId);
                    }
                }
            };
            xhr.send("appointment_id=" + appointmentId + "&status=" + status);
        }
    }
    
    </script>

</body>
</html>
