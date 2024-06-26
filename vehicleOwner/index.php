<?php

session_start();
// var_dump($_POST['service_id']);
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
 <!-- Include HERE Maps JavaScript API -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
          <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Stylesheet -->
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
        /* The alert message box */
    .alert {
        padding: 20px;
        background-color: #f44336; /* Red */
        color: white;
        text-align: center;
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 400px; /* Adjust width as needed */
        margin-top: 20px;
        z-index: 9999; /* Ensure it appears above other content */
        margin-bottom: 15px;
        opacity: 1;
        transition: opacity 0.6s; /* 600ms to fade out */
    }
    .alert-success{
        padding: 20px;
        background-color: #7CFC00; /* Red */
        color: white;
        text-align: center;
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 400px; /* Adjust width as needed */
        margin-top: 20px;
        z-index: 9999; /* Ensure it appears above other content */
        margin-bottom: 15px;
        opacity: 1;
        transition: opacity 0.6s; /* 600ms to fade out */
    }

    /* The close button */
    .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
    }

    /* When moving the mouse over the close button */
    .closebtn:hover {
    color: black;
    }
    #shopMapContainer {
            width: 100%;
            height: 500px;
            margin-top: 20px;
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
                <div class="action">
                <div class="profile" onclick="menuToggle();">
                  <img src="../assets/avatar.jpg" />
                </div>
                <div class="menu">
                <h2></h2>
                <?php

                    $shop_owner_id = isset($_SESSION['id']) ? trim($_SESSION['id']) : '';
                    $resultName = $database->query("SELECT first_name, last_name FROM vehicle_owners WHERE vehicle_owner_id = '$shop_owner_id' ");
                    if ($resultName->num_rows > 0) {
                        $user = $resultName->fetch_assoc();
                        $userFirstName = $user['first_name'];
                        $userLastName = $user['last_name'];
                    }
                ?> 
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

 <!-- Left side card -->
 <div class="container mt-4">
        <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="card custom-card">
                    <div class="card-body text-center">
                    <?php

                        $vehicle_owner_id = isset($_SESSION['id']) ? $_SESSION['id'] : ""; 

                        // Fetch appointment with the smallest queue number
                        $sql = "SELECT appointment.*, services.service_price 
                                FROM appointment 
                                INNER JOIN services ON appointment.service_id = services.service_id 
                                WHERE appointment.status = 'Not Completed' 
                                AND vehicle_owner_id = '$vehicle_owner_id'
                                ORDER BY appointment.queue_number ASC
                                LIMIT 1";
                        $result = $database->query($sql);

                        // Check if there are appointments
                        if ($result->num_rows > 0) {
                            // Extract appointment details
                            $row = $result->fetch_assoc();
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
                        } else {
                            echo "No appointments found.";
                        }
                    ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid mt-4">
 <!-- Search Bar -->
    <div class="row mb-4 mt-5">
        <div class="col">
            <form action="#" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for a shop..." name="search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container my-5">
        <div id="shopMapContainer"></div>
    </div>
    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Book Now!
    </button>
</div>
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
        echo "
        <div class='alert'>
            <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
            Time conflict! This time slot is already booked.
        </div>";
        echo "Time conflict! This time slot is already booked.";
    } else {
        // Check if a service was selected
        if (isset($_POST['service_id']) && !empty($_POST['service_id'])) {
            // Get the selected service ID
            $selectedServiceId = $_POST['service_id'];
        
            // Insert the appointment into the database
            $insertQuery = "INSERT INTO `appointment`(`vehicle_owner_id`, `shop_info_id`, `queue_number`, `appointment_date`,`status`, `service_id`) VALUES ('{$_SESSION['id']}','{$_POST['shop_id']}','{$getCurrentAppID}','{$appDate}','Not Completed', '{$selectedServiceId}')";
        
            // Execute the query
            if ($database->query($insertQuery) === TRUE) {
                echo "
                <div class='alert-success'>
                    <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                    Appointment Recorded.
                </div>";
                echo "Appointment Recorded";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $database->error;
            }
        } else {
            echo "No service selected.";
        }
        
    }
}

    }
    ?>

<div class="container-fluid mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        // Fetch shop information from the database based on the search query
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $searchSql = "SELECT * FROM shop_info WHERE shop_name LIKE '%$searchTerm%'";
        $searchResult = $database->query($searchSql);
        $shops = ($searchResult->num_rows > 0) ? mysqli_fetch_all($searchResult, MYSQLI_ASSOC) : [];

        if (count($shops)) {
            // Output data of each shop
            foreach ($shops as $shopKey => $shop) {
                ?>
                <div class="col mb-4">
                    <!-- Shop Card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Shop Name: <?php echo $shop["shop_name"]; ?></h5>
                            <p class="card-text">Location: <?php echo $shop["location"]; ?></p>
                            <p class="card-text">Operating Hours: <?php echo date('h:i A', strtotime($shop["operating_from"])) . " to " . date('h:i A', strtotime($shop["operating_to"])); ?></p>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#servicesModal_<?php echo $shop['shop_info_id']; ?>">
                                View Services
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="servicesModal_<?php echo $shop['shop_info_id']; ?>" tabindex="-1" aria-labelledby="servicesModalLabel_<?php echo $shop['shop_info_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="servicesModalLabel_<?php echo $shop['shop_info_id']; ?>">Services Offered by <?php echo $shop["shop_name"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                // Fetch services for this shop
                                $serviceSql = "SELECT * FROM services WHERE shop_info_id = {$shop['shop_info_id']}";
                                $serviceResult = $database->query($serviceSql);
                                if ($serviceResult->num_rows > 0) {
                                    // Display available services in a table
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
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='col'>No shops found</p>";
        }
        ?>
    </div>
</div>




   
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
                            
                            <!-- Options will be populated dynamically based on selected vehicle type -->
                        </select>
                    </div>
                    <!-- Hidden input fields for vehicle size and license plate -->
                        <input type="hidden" id="vehicleSizeInput" name="vehicle_size">
                        <input type="hidden" id="licensePlateInput" name="license_plate">
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
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-custom">Save changes</button>
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
$(document).ready(function(){
    // Function to fetch services based on selected vehicle type and shop
    function fetchServices() {
        var vehicleType = $('#vehicleTypeSelect').val();
        var shopId = $('#shopSelect').val(); // Get the selected shop ID
        
        // Log to console for debugging
        console.log('Vehicle Type:', vehicleType);
        console.log('Shop ID:', shopId);
        
        $.ajax({
            type: 'POST',
            url: 'fetch_services.php',
            data: {vehicle_type: vehicleType, shop_id: shopId},
            success: function(response) {
                $('#servicesSelect').html(response);
            }
        });
    }

    // Event listener for vehicle type change
    $('#vehicleTypeSelect').change(function(){
        fetchServices();
    });

    // Event listener for shop change
    $('#shopSelect').change(function(){
        fetchServices();
    });

    // Call fetchServices() initially to populate services based on default vehicle type and shop
    fetchServices();
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
<script>
$(document).ready(function(){
    $('#registeredVehicleSelect').change(function(){
        var selectedOption = $(this).find(':selected');
        var vehicleSize = selectedOption.data('size');
        var licensePlate = selectedOption.data('plate');
        // Set the vehicle size and license plate in hidden input fields
        $('#vehicleSizeInput').val(vehicleSize);
        $('#licensePlateInput').val(licensePlate);
    });
});
</script>
<script>
// Get all elements with class="closebtn"
var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
  // When someone clicks on a close button
  close[i].onclick = function(){

    // Get the parent of <span class="closebtn"> (<div class="alert">)
    var div = this.parentElement;

    // Set the opacity of div to 0 (transparent)
    div.style.opacity = "0";

    // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>
<!--<script>
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    let month = currentDate.getMonth() + 1;
    let day = currentDate.getDate();

    month = month < 10 ? "0" + month : month;
    day = day < 10 ? "0" + day : day;

    document.querySelector(#appointmentDate).min = `${year}-${month}-${day}`;
</script>

<script>
$ ( function() {
    $( "appointment_date").datepicker({ min.Date: -20, maxDate: "+M + 10D" });
} );
</script> -->
<!-- PAST DATE DISABLE --> 
<script>
$(document).ready(function() {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;

    $('#appointmentDate').attr('min', maxDate);
})
</script>
<!-- DISABLE PAST TIME
<script>
     // Function to disable past times in appointment time selector
     $('#appointmentTime').on('change', function() {
        var selectedTime = $(this).val();
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var currentFormattedTime = hours + ":" + minutes;

        if (selectedTime < currentFormattedTime) {
            alert('Please select a future time.');
            $(this).val('');
        }
    }); 
</script> -->

<script>
    $(document).ready(function() {
    // Get the current date and time
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var currentMonth = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Add leading zero if needed
    var currentDay = ('0' + currentDate.getDate()).slice(-2); // Add leading zero if needed
    var currentHours = ('0' + currentDate.getHours()).slice(-2); // Add leading zero if needed
    var currentMinutes = ('0' + currentDate.getMinutes()).slice(-2); // Add leading zero if needed

    // Set the minimum date for the appointment date selector to the current date
    var minDate = currentYear + '-' + currentMonth + '-' + currentDay;
    $('#appointmentDate').attr('min', minDate);

    // Function to disable past times in appointment time selector
    $('#appointmentTime').on('change', function() {
        var selectedTime = $(this).val();
        var selectedDate = $('#appointmentDate').val();

        if (selectedDate === minDate) {
            // Compare selected time with current time if the date is today
            if (selectedTime < currentHours + ':' + currentMinutes) {
                alert('Please select a future time.');
                $(this).val('');
            }
        }   
    });
});
</script>

<script>
    $(document).ready(function() {
    // Function to fetch booked times and their status for the selected date and shop ID
    function fetchBookedTimesAndStatus(date, shopId) {
        $.ajax({
            url: 'fetch_booked_times.php',
            type: 'POST',
            data: { date: date, shop_id: shopId },
            dataType: 'json',
            success: function(response) {
                disableBookedTimesAndStatus(response);
            }
        });
    }

    // Function to disable booked times and their status in appointment time selector
    function disableBookedTimesAndStatus(bookedSlots) {
        $('#appointmentTime option').each(function() {
            var slotValue = $(this).val();
            var slotStatus = bookedSlots[slotValue];
            if (slotStatus && slotStatus === 'Not Completed') {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
            }
        });
    }

    // Event listener for date and shop selection changes
    $('#appointmentDate, #shopSelect').on('change', function() {
        var selectedDate = $('#appointmentDate').val();
        var selectedShopId = $('#shopSelect').val();
        if (selectedDate && selectedShopId) {
            fetchBookedTimesAndStatus(selectedDate, selectedShopId);
        }
    });

    // Initial fetch and disable booked times and their status based on default date and shop selection
    var defaultDate = $('#appointmentDate').val();
    var defaultShopId = $('#shopSelect').val();
    if (defaultDate && defaultShopId) {
        fetchBookedTimesAndStatus(defaultDate, defaultShopId);
    }
});

</script>
<!--
<script>
    $(document).ready(function() {
    // Function to disable booked time slots
    function disableBookedTimeSlots(bookedTimes) {
        // Loop through each option in the appointment time selector
        $('#appointmentTime option').each(function() {
            var slotValue = $(this).val();
            // Check if the slotValue is in the bookedTimes array
            if (bookedTimes.includes(slotValue)) {
                // Disable the option if it's booked
                $(this).prop('disabled', true);
            } else {
                // Enable the option if it's not booked
                $(this).prop('disabled', false);
            }
        });
    }

    // Example usage
    var bookedTimes = ['09:00', '10:00', '11:00']; // Assume these are booked times fetched from the server
    disableBookedTimeSlots(bookedTimes);
});

</script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var shopMap;
        var shopDefaultLayers;
        var shopPlatform;

        function initShopMap() {
            // Initialize platform
            shopPlatform = new H.service.Platform({
                'apikey': 'xzrMvhwIvXQkL4ODYBNn02k3U2AL1aC974XXIb6M9Eo' // Load HERE API key from PHP
            });

            // Obtain the default map types from the platform object
            shopDefaultLayers = shopPlatform.createDefaultLayers();

            // Initialize map object
            shopMap = new H.Map(
                document.getElementById('shopMapContainer'),
                shopDefaultLayers.vector.normal.map,
                {
                    center: { lat: 12.8797, lng: 121.774 }, // Default center
                    zoom: 6, // Default zoom level
                    pixelRatio: window.devicePixelRatio || 1
                }
            );

            // Load car wash shop locations
            loadShopLocations();
        }

        // Load car wash shop locations
        function loadShopLocations() {
            $.ajax({
                url: 'getShopLocations.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); // Log the response to inspect its structure
                    response.forEach(function(location) {
                        var marker = new H.map.Marker({ lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) });
                        shopMap.addObject(marker);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading shop locations: ' + error);
                }
            });
        }

        // Load the map after the page is fully loaded
        window.addEventListener('load', initShopMap);
    </script>
</body>
</html>