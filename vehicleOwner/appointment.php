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

        /* Adjusted CSS */
        .appointment-card {
            max-width: 400px; /* Set the maximum width of the card */
            margin: -10 auto; /* Center the card horizontally */
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
    
    <div class="container my-5">
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
            echo"<span id='countdown'></span>";
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
        console.log('Hiding cancel button...');
        document.getElementById('cancelBtn').style.display = 'none';
    }, 900000); // 15 minutes in milliseconds

   
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
    <script>
        // Function to update the countdown
    function updateCountdown() {
        var startTime = localStorage.getItem('countdownStartTime');
        if (!startTime) {
            return; // Countdown hasn't started yet
        }

        var currentTime = new Date().getTime();
        var elapsedTime = currentTime - startTime;
        var remainingTime = 15 * 60 * 1000 - elapsedTime;

        // Convert remaining milliseconds to minutes and seconds
        var minutes = Math.floor(remainingTime / 60000);
        var seconds = ((remainingTime % 60000) / 1000).toFixed(0);

        // Display the remaining time in the format "MM:SS"
        document.getElementById('countdown').textContent = minutes + ":" + (seconds < 10 ? '0' : '') + seconds;

        // Check if the duration has elapsed
        if (remainingTime <= 0) {
            hideCancelButton(); // Hide the cancel button
            return;
        }

        // Continue updating the countdown
        setTimeout(updateCountdown, 1000);
    }

    // Function to hide the cancel button after the countdown
    function hideCancelButton() {
        document.getElementById('cancelBtn').style.display = 'none';
        document.getElementById('countdown').style.display = 'none'; // Hide the countdown
    }

    // Start the countdown
    if (!localStorage.getItem('countdownStartTime')) {
        // Start the countdown only if it hasn't started yet
        localStorage.setItem('countdownStartTime', new Date().getTime());
    }

    // Update the countdown
    updateCountdown();

    </script>

</body>
</html>