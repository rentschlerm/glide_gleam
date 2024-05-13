<?php
    session_start();
    include('../connection.php');
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Your additional CSS styles -->
    <!-- Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
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
                    <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addShop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.php">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="generate_pdf.php">REPORTS</a>
                    </li>
                  
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="../signout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>  

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    </nav>

    <?php
    // Start PHP session

    // Check if the user is logged in
    if(!isset($_SESSION["user"]) || $_SESSION['type'] != '1' || $_SESSION["user"] == "") {
        header("location: ../signin.php");
        exit(); // Stop further execution
    }

    // Import database connection
    include("../connection.php");

    // Fetch past appointments for the logged-in user
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
            AND appointment.status != 'Not Completed'
            ORDER BY appointment.appointment_date DESC;
            ";

    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='card my-2 m-4 d-inline-block' style='width: 45%'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Customer Name: " . $row["first_name"] . " " . $row["last_name"] . "</h5>";
            echo "<p class='card-text'>Shop Name: " . $row["shop_name"] . "</p>";
            echo "<p class='card-text'>Queue Number: " . $row["queue_number"] . "</p>";
            echo "<p class='card-text'>Service Name: " . $row["serviceName"] . "</p>";
            echo "<p class='card-text'>Price: ₱" . $row["service_price"] . "</p>";
            echo "<p class='card-text'>Category: " . $row["vehicle_type"] . "</p>";
            echo "<p class='card-text'>Appointment Date: " . date('F d, Y', strtotime($row["appointment_date"])) . "</p>";
            echo "<p class='card-text'>Appointment Time: " . date('h:i A', strtotime($row["appointment_date"])) . "</p>";
            echo "<button class='btn-view-feedback btn btn-custom' data-id='". $row['appointment_id'] ."'> View Feedback </button>";
            // Button to handle cancellation of appointment

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No past appointments found</p>";
    }

    // Close the database connection
    $database->close();
    ?>
<div class="modal fade" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedback-user-name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="feedback-content"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        $('.btn-view-feedback').on('click',function(){
            const feedbackId = $(this).data('id');

            $.ajax({
                url: 'viewHistory.php?getFeedbackId=true&id=' + feedbackId,
                method: 'GET',
                success:function(response){
                    const review = JSON.parse(response);
                    $('#feedback-modal').modal('show')
                    $('#feedback-user-name').html(review.user_name)
                    $('#feedback-content').html(review.user_review)
                }
            })
        });
    </script>
</body>
</html>
