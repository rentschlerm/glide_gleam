<?php
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you are getting the shop_owner_id from a session variable
    session_start();
    if(isset($_SESSION['id'])) {
        $shop_owner_id = $_SESSION['id'];
    } else {
        // If not available in session, handle accordingly (e.g., redirect to login)
        die("Error: Shop owner ID not available.");
    }

    $shop_name = $_POST["shop_name"];
    $location = $_POST["location"];
    $operating_from = $_POST["operating_from"];
    $operating_to = $_POST["operating_to"];
   
    
    $insertQuery = "INSERT INTO shop_info (shop_owner_id, shop_name, location, operating_from, operating_to)
                    VALUES ('$shop_owner_id', '$shop_name', '$location', '$operating_from', '$operating_to')";

    if ($database->query($insertQuery) === TRUE) {
        
        echo " <script>alert('New shop added successfully!');</script>";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $database->error;
    }
}


$database->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

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
                        <a class="nav-link" href="./appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addShop.php">Shop</a>
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
    <a class="btn btn-primary" href="addShop.php" role="button">Back</a>
        <h2>Add Carwash Shop</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="shop_name" class="form-label">Shop Name</label>
                <input type="text" class="form-control" id="shop_name" name="shop_name" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="operating_from" class="form-label">Operating From</label>
                <input type="time" class="form-control" id="operating_from" name="operating_from" required>
            </div>
            <div class="mb-3">
                <label for="operating_to" class="form-label">Operating To</label>
                <input type="time" class="form-control" id="operating_to" name="operating_to" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Shop</button>
        </form>
    </div>
   
</body>
</html>
