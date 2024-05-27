<?php
session_start();
include("../connection.php");
// Check if the user is logged in
if(!isset($_SESSION["user"]) || $_SESSION['type'] != '1' || $_SESSION["user"] == "") {
    header("location: ../index.php");
    exit(); // Stop further execution
} else {
    $useremail = $_SESSION["user"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
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
        <link href="../css/ui-dashboard.css" rel="stylesheet">
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

        .nav-bar {
            background-color: #2C3E50 ; /* Accent Color */
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
        /* Adjusted table size */
        .table {
            max-width: 800px; /* Set the maximum width of the table */
            margin: 0 auto; /* Center the table horizontally */
        }
    .backButton {
    margin-left: 10%; /* Move the div 20% to the right */
    margin-top: 2%;
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
                <li class="nav-item">
                    <a class="nav-link" href="history.php">History</a>
                </li>
                <div class="action">
                <div class="profile" onclick="menuToggle();">
                  <img src="../assets/avatar.jpg" />
                </div>
                <div class="menu">
                <h3><?php echo "$userFirstName $userLastName";   ?><br /><span>Shop Owner</span></h3>
                  <ul>
                    <li>
                      <img src="../assets/icons/user.png" /><a href="#">My profile</a>
                    </li>
                    <li>
                      <img src="../assets/icons/edit.png" /><a href="services.php">Services</a>
                    </li>
                    <li>
                      <img src="../assets/icons/shop.png" /><a href="addShop.php">Add shop</a>
                    </li>
                    <li><img src="../assets/icons/reports.png" /><a href="generate_pdf.php">Report</a></li>
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

    <!-- <div class="backButton">
    <a class="btn btn-custom" href="index.php" role="button">Back</a>
    </div> -->
    
    <div class="container my-5">
    <div class="section-title">
    <h2 class="appointments-heading">Appointments</h2>
    </div>
    <?php
    // Fetch shop information from the database
    $sql = "SELECT appointment.*, 
                vehicle_owners.*, 
                shop_info.*, 
                services.serviceName, 
                services.service_price, 
                services.vehicle_type
            FROM appointment 
            JOIN vehicle_owners ON appointment.vehicle_owner_id = vehicle_owners.vehicle_owner_id 
            JOIN shop_info ON shop_info.shop_info_id = appointment.shop_info_id 
            JOIN services ON services.service_id = appointment.service_id
            WHERE shop_info.shop_owner_id = {$_SESSION['id']} 
            AND appointment.status = 'Not Completed'
            ORDER BY appointment.queue_number ASC;
            ";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='card my-2'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Customer Name: " . $row["first_name"] . " " . $row["last_name"] . "</h5>";
            echo "<p class='card-text'>Shop Name: " . $row["shop_name"] . "</p>";
            echo "<p class='card-text'>Queue Number: " . $row["queue_number"] . "</p>";
            echo "<p class='card-text'>Service Name: " . $row["serviceName"] . "</p>";
            echo "<p class='card-text'>Price: ₱" . $row["service_price"] . "</p>";
            echo "<p class='card-text'>Category: " . $row["vehicle_type"] . "</p>";
            echo "<p class='card-text'>Appointment Date: " . date('F d, Y', strtotime($row["appointment_date"])) . "</p>";
            echo "<p class='card-text'>Appointment Time: " . date('h:i A', strtotime($row["appointment_date"])) . "</p>";

            // Button to handle completion of appointment
            echo "<button class='btn btn-custom' onclick='completeAppointment(" . $row["appointment_id"] . ", \"Completed\")'>Mark as Completed</button>";
            echo "&nbsp; &nbsp;";
            // Button to handle cancellation of appointment
            echo "<button class='btn btn-danger' onclick='completeAppointment(" . $row["appointment_id"] . ", \"Cancelled\")'>Cancel</button>";

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No appointment found</p>";
    }

    // Close the database connection
    $database->close();
?>

    </div>

    <script>
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
    
    // Function to send notification
    function sendNotification(appointmentId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "sendNotification.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the PHP script (optional)
                // console.log(xhr.responseText);
                alert(xhr.responseText);
            }
        };
        xhr.send("appointment_id=" + appointmentId);
    }
</script>

    
</body>
</html>
