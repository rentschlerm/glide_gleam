<?php

session_start();

if(isset($_SESSION["user"])){
    if($_SESSION["user"] == "" or $_SESSION['type'] != '2'){
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

// Import database connection
include("../connection.php");

// Fetch shop information from the database
$sql = "SELECT * FROM shop_info";
$result = $database->query($sql);
$shops = ($result->num_rows > 0)? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
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
                        <a class="nav-link" href="appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Car Wash</a>
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


    <a class="btn btn-primary" href="index.php" role="button">Back</a>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Create Appointment
</button>
    <?php
    
    if ($_POST){
        $getAppointmentNum = "SELECT * FROM appointment WHERE shop_info_id = {$_POST['shop_id']} Order by appointment.queue_number DESC LIMIT 1";
        $result = $database->query($getAppointmentNum);
        $getResult = $result->fetch_array(MYSQLI_NUM);
        $getCurrentAppID = $getResult? intval($getResult[3]) : 0;
        $getCurrentAppID++;

        $s = $_POST['appointment_date'] ." ". $_POST['appointment_time'].':00';
        $date = strtotime($s);
        $appDate = date('Y/m/d H:i:s', $date);
        
        
        // Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for time conflict
    $sql = "SELECT * FROM appointment WHERE appointment_date = '$appDate' AND status = 'Not Completed'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        // Conflict found
        echo "Time conflict! This time slot is already booked.";
    } else {
        // Check if a service was selected
        if (isset($_POST['service_sizes']) && is_array($_POST['service_sizes'])) {
            // Get the selected service ID
            $selectedServiceId = null;
            foreach ($_POST['service_sizes'] as $serviceId => $size) {
                if (!empty($size)) {
                    $selectedServiceId = $serviceId;
                    break; // Stop the loop since a service is already selected
                }
            }

            // Check if a service was actually selected
            if (!is_null($selectedServiceId)) {
                // Insert the appointment into the database
                $insertQuery = "INSERT INTO `appointment`(`vehicle_owner_id`, `shop_info_id`, `queue_number`, `appointment_date`, `service_id`) VALUES ('{$_SESSION['id']}','{$_POST['shop_id']}','{$getCurrentAppID}','{$appDate}', '{$selectedServiceId}')";

                // Execute the query
                if ($database->query($insertQuery) === TRUE) {
                    echo "Appointment Recorded";
                } else {
                    echo "Error: " . $insertQuery . "<br>" . $database->error;
                }
            } else {
                echo "No service selected.";
            }
        } else {
            echo "No service selected.";
        }
    }
}

    }

    // Fetch shop information from the database
    $sql = "SELECT * FROM shop_info";
$result = $database->query($sql);
$shops = ($result->num_rows > 0)? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
if (count($shops)) {
    // Output data of each row
    foreach ($shops as $shopKey => $value) {
        // Display shop information
        echo "<div>";
        echo "<h2>Shop Name: " . $value["shop_name"]. "</h2>";
        echo "<p>Location: " . $value["location"] . "</p>";
        echo "<p>Operating Hours: " . date('h:i A', strtotime($value["operating_from"])) . " to " . date('h:i A', strtotime($value["operating_to"])) . "</p>";
        
        // Fetch services for this shop
        $serviceSql = "SELECT * FROM services WHERE shop_info_id = {$value['shop_info_id']}";
        $serviceResult = $database->query($serviceSql);
        if ($serviceResult->num_rows > 0) {
            // Display available services in a table
            echo "<p>Available Services:</p>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Service</th><th>Vehicle Size</th><th>Price</th><th>Vehicle Type</th></tr></thead>";
            echo "<tbody>";
            while ($service = $serviceResult->fetch_assoc()) {
                // Display each service in a row
                echo "<tr>";
                echo "<td>{$service['serviceName']}</td>";
                echo "<td>{$service['vehicle_size']}</td>";
                echo "<td>&#x20B1;{$service['service_price']}</td>";
                echo "<td>{$service['vehicle_type']}</td>";
            
                echo "</tr>";
            }
            echo "</tbody></table>";
            
        } else {
            echo "<p>No services available for this shop.</p>";
        }
        echo "</div>";
        echo "<hr>";
    }
} else {
    echo "No shops found";
}

$database->close();
?>



   
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="shopSelect" class="form-label">Select a Shop</label>
                        <select class="form-select" id="shopSelect" name="shop_id" required>
                            <option selected disabled>Select Shop</option>
                            <?php foreach ($shops as $shop): ?>
                                <option value="<?= $shop['shop_info_id'] ?>"><?= $shop['shop_name'] ?> | Location: <?= $shop['location'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vehicleTypeSelect" class="form-label">Select Vehicle Type</label>
                        <select class="form-select" id="vehicleTypeSelect" name="vehicle_type" required>
                            <option selected disabled>Select Vehicle Type</option>
                            <option value="Automobile">Automobile</option>
                            <option value="Motorcycle">Motorcycle</option>
                        </select>
                    </div>
                    <div class="mb-3" id="registeredVehicleContainer" style="display: none;">
                        <label for="registeredVehicleSelect" class="form-label">Select Registered Vehicle</label>
                        <!-- Registered Vehicle Select Dropdown -->
                        <select class="form-select" id="registeredVehicleSelect" name="vehicle_id" required>
                            <option selected disabled>Select Registered Vehicle</option>
                            <!-- Options will be populated dynamically based on selected vehicle type -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="appointmentDate" class="form-label">Appointment Date</label>
                        <input type="date" class="form-control" id="appointmentDate" name="appointment_date" required>
                    </div>
                    <div class="mb-3">
                    <label for="appointmentTime" class="form-label">Appointment Time</label>
                    <select class="form-control" id="appointmentTime" name="appointment_time" required>
                        <option value="">Select Time</option>
                        <?php   
                        // Generate hourly options for appointment time
                        $startHour = strtotime("08:00"); // Start at 8:00 AM
                        $endHour = strtotime("18:00"); // End at 6:00 PM
                        while ($startHour <= $endHour) {
                            echo "<option value='" . date('H:i', $startHour) . "'>" . date('h:i A', $startHour) . "</option>";
                            $startHour = strtotime('+1 hour', $startHour);
                        }
                        ?>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="servicesSelect" class="form-label">Services available for you:</label>
                        <div id="servicesSelect">
                            <!-- Services will be populated here based on the selected vehicle type -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

    
<!-- Modal -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Function to fetch and populate services based on the selected vehicle type
    $(document).ready(function(){
        $('#vehicleTypeSelect').change(function(){
            var vehicleType = $(this).val();
            $.ajax({
                url: 'fetch_services.php',
                type: 'POST',
                data: {vehicle_type: vehicleType},
                success: function(response){
                    $('#servicesSelect').html(response);
                }
            });
        });
    });
</script>
<script>
$(document).ready(function(){
    $('#vehicleTypeSelect').change(function(){
        var vehicleType = $(this).val();
        if (vehicleType) {
            $.ajax({
                url: 'fetch_registered_vehicles.php',
                type: 'POST',
                data: {vehicle_type: vehicleType},
                success: function(response){
                    $('#registeredVehicleSelect').html(response);
                    $('#registeredVehicleContainer').show(); // Show the container
                }
            });
        } else {
            $('#registeredVehicleContainer').hide(); // Hide the container if no vehicle type selected
        }
    });
});
</script>
</body>
</html>