<?php
session_start();
include("../connection.php");

if(isset($_GET['shop_info_id'])) {
    $shop_info_id = $_GET['shop_info_id'];

    // Fetch shop information
    $sql = "SELECT * FROM shop_info WHERE shop_info_id = '$shop_info_id'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $shop_name = $row['shop_name'];
        $location = $row['location'];
        $operating_from = $row['operating_from'];
        $operating_to = $row['operating_to'];
    } else {
        echo "Shop not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}

// Update shop information
if(isset($_POST['submit'])) {
    $new_shop_name = $_POST['shop_name'];
    $new_location = $_POST['location'];
    $new_operating_from = $_POST['operating_from'];
    $new_operating_to = $_POST['operating_to'];

    $sql_update = "UPDATE shop_info SET shop_name = '$new_shop_name', location = '$new_location', operating_from = '$new_operating_from', operating_to = '$new_operating_to' WHERE shop_info_id = '$shop_info_id'";
    if ($database->query($sql_update) === TRUE) {
        echo "
        <div class='alert-success'>
                    <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                    Edit Successful.
        </div>";

        // Redirect to the shop list page or any other page you want
        header("Location: addShop.php");

        
    } else {
        echo "Error updating shop information: " . $database->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
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
        .section-title h2 {
            color: white;
        } 
        .table{
            color: white;
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
<body>
    <div class="container">
        <h2>Edit Shop</h2>
        <a href="services.php" class="btn btn-secondary">Back to Shop</a>

        <form method="POST">
            <div class="form-group">
                <label for="shop_name">Shop Name:</label>
                <input type="text" class="form-control" id="shop_name" name="shop_name" value="<?php echo $shop_name; ?>">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $location; ?>">
            </div>
            <div class="form-group">
                <label for="operating_from">Operating From:</label>
                <input type="time" class="form-control" id="operating_from" name="operating_from" value="<?php echo $operating_from; ?>">
            </div>
            <div class="form-group">
                <label for="operating_to">Operating To:</label>
                <input type="time" class="form-control" id="operating_to" name="operating_to" value="<?php echo $operating_to; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
            <a href="services.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
