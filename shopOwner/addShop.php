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
        .section-title h2 {
            color: white;
        } 
        .heading-title{
            color:white;
        }

        /* Style for the table header */
        th {
            background-color: #343a40; /* Dark grey */
            color: #fff; /* White text */
        }
        /* Alternate row color for better readability */
        tbody tr {
            background-color: #fff; /* Violet */
            color: #000000; /* White text */
        }
        tbody tr:nth-child(even) {
            background-color: #fff; /* Violet */
            color: #000000; /* White text */
        }
        /* Style for action buttons */
        .action-btns .btn {
            margin-right: 5px;
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
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addShop.php">Shop</a>
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
        <h2>My Carwash Shop</h2>
    </div>
        <a class="btn btn-primary" href="index.php" role="button">Back</a>
        <a class="btn btn-primary" href="create.php" role="button">Add Carwash Shop</a>

        <br>
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
                        <td>
                            <a class='btn btn-primary btn-sm' href='/cws/carwashowner/edit.php?shop_info_id={$row['shop_info_id']}'>EDIT</a>
                            <a class='btn btn-primary btn-sm' href='/cws/carwashowner/delete.php?shop_info_id={$row['shop_info_id']}'>DELETE</a>
                        </td>
                    </tr>";
                }
                ?>
                
            
    </div>

    </body>
</html>