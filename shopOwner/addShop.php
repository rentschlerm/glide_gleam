<?php
    session_start();
    include("../connection.php");
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
        /* Table Row Colors */
        tbody tr:nth-child(even) {
            background-color: #E6E6E6; /* Light Gray */
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF; /* White */
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
    </nav>
    <div class="container my-5">
    <div class="section-title">
    </div>
        <a class="btn btn-custom" href="index.php" role="button">Back</a>
        <a class="btn btn-custom" href="create.php" role="button">Add Carwash Shop</a>

        <table class="table">
            <thead>
                <br><br><br>
                <div class="section-title">
            <h2> Shops </h2>
                </div>
                <tr >
                    <th>Shop Name</th>
                    <th>Location</th>
                    <th>Open</th>
                    <th>Close</th>
                    <!-- <th>Services</th>
                    <th>Price</th>
                    <th>Category</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                

                if($database->connect_error) {
                    die("Connection Failed:" . database->connect_error);
                }
               

                // Check if the user ID is set in the session
                // if(isset($_SESSION['id'])) {
                    // Output the user ID for verification
                //     echo "User ID: " . $_SESSION['id'];
                // } else {
                //     echo "User ID is not set in the session.";
                // }
                
                // Assuming your connection.php file defines $connection
                $shop_owner_id = $_SESSION['id'];
                $sql = "SELECT * FROM shop_info WHERE shop_owner_id = '$shop_owner_id'";
                $result = $database->query($sql);

                if (!$result) {
                    die("Invalid query: " . $database->error);
                }

                // <td>{$row['service_name']}</td>
                // <td>{$row['price']}</td>
                // <td>{$row['category']}</td>
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['shop_name']}</td>
                        <td>{$row['location']}</td>
                        <td>{$row['operating_from']}</td>
                        <td>{$row['operating_to']}</td>
                        <td class='action-btns'>
                            <a class='btn btn-custom btn-sm' href='/glide_gleam/shopOwner/edit.php?shop_info_id={$row['shop_info_id']}'>
                                <i class='fas fa-edit fa-sm'></i> <!-- Edit icon -->
                            </a>
                            <a class='btn btn-custom btn-sm' href='/glide_gleam/shopOwner/deleteShop.php?shop_info_id={$row['shop_info_id']}'>
                                <i class='fas fa-trash-alt fa-sm'></i> <!-- Delete icon -->
                            </a>
                        </td>
                        
                    </tr>";
                }
                ?>
                
            
    </div>

    </body>
</html>