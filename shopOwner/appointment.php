<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/app.css">
        
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
    <style>
        .container {
            position: relative;
        }
        .back-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px 10px; /* Adjust padding as needed */
            border: none;
            background-color: #007bff; /* Your desired button color */
            color: #fff; /* Text color */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #0056b3; /* Hover color */
        }
        .appointments-heading {
            margin-top: 20px; /* Adjust the margin as needed */
        }
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a class="back-btn" href="index.php" role="button">Back</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Availability</a>
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
    <h2 class="appointments-heading">Appointments</h2>
    <?php
    // Start session at the very beginning of the script
    

    // Check if the user is logged in
    if(!isset($_SESSION["user"]) || $_SESSION['type'] != '1' || $_SESSION["user"] == "") {
        header("location: ../login.php");
        exit(); // Stop further execution
    } else {
        $useremail = $_SESSION["user"];
    }

    // Import database connection
    include("../connection.php");

    // Fetch shop information from the database
    $sql = "SELECT * FROM `appointment` 
            JOIN vehicle_owners ON appointment.vehicle_owner_id = vehicle_owners.vehicle_owner_id 
            JOIN shop_info ON shop_info.shop_info_id = appointment.shop_info_id 
            -- JOIN specialties ON specialties.shop_info_id = appointment.shop_info_id
            WHERE shop_info.shop_owner_id = {$_SESSION['id']} AND appointment.status = 'Not Completed'
            ORDER BY appointment.queue_number ASC;";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='card my-2'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Customer Name: " . $row["first_name"] . " " . $row["last_name"] . "</h5>";
            echo "<p class='card-text'>Shop Name: " . $row["shop_name"] . "</p>";
            echo "<p class='card-text'>Queue Number: " . $row["apponum"] . "</p>";
            // echo "<p class='card-text'>Service Name: " . $row["service_name"] . "</p>";
            // echo "<p class='card-text'>Price: ₱" . $row["price"] . "</p>";
            // echo "<p class='card-text'>Category: " . $row["category"] . "</p>";
            echo "<p class='card-text'>Appointment Date: " . date('F d, Y', strtotime($row["appodate"])) . "</p>";
            echo "<p class='card-text'>Appointment Time: " . date('h:i A', strtotime($row["appodate"])) . "</p>";

            // Button to handle completion of appointment
            echo "<button class='btn btn-primary' onclick='completeAppointment(" . $row["appoid"] . ", \"Completed\")'>Completed</button>";

            // Button to handle cancellation of appointment
            echo "<button class='btn btn-danger' onclick='completeAppointment(" . $row["appoid"] . ", \"Cancelled\")'>Cancel</button>";

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
                console.log(xhr.responseText);
            }
        };
        xhr.send("appointment_id=" + appointmentId);
    }
</script>

    
</body>
</html>
