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
        .custom-card {
            max-width: 300px; /* Set the maximum width of the card */
            margin-bottom: 5px; /* Add some space below the card */
        }
        .queue-number {
            font-size: 72px; /* Increase the font size of the queue number */
            font-weight: bold; /* Make the queue number bold */
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
                        <a class="nav-link" href="#">Settings</a>
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
include("../connection.php");

// Fetch appointments data from the database with service details
$sql = "SELECT appointment.*, services.service_price 
        FROM appointment 
        INNER JOIN services ON appointment.service_id = services.service_id 
        WHERE appointment.status = 'Not Completed'";
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
