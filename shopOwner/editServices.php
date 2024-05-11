<?php
session_start();
include("../connection.php");

$alertMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_changes"])) {
    if(isset($_SESSION['id'])) {
        $shop_owner_id = $_SESSION['id'];
        $size = $_POST["vehicle_size"];
        $price = $_POST["price"];
        $vehicle_type = $_POST["vehicle_type"];
        $service_name = $_POST["sname"];

        $sql = "SELECT shop_info_id FROM shop_info WHERE shop_owner_id = '$shop_owner_id'";
        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            $shop_info_row = $result->fetch_assoc();
            $shop_info_id = $shop_info_row['shop_info_id'];
        } else {
            die("Error: Shop info not found.");
        }

        // Assuming you have a service ID to identify which service to edit
        $service_id = $_POST["service_id"];

        // Update the service details in the database
        $updateQuery = "UPDATE services SET serviceName='$service_name', vehicle_size='$size', service_price='$price', vehicle_type='$vehicle_type' WHERE service_id='$service_id' AND shop_info_id='$shop_info_id'";

        if($database->query($updateQuery) === TRUE) {
            $alertMessage = "Service updated successfully!";
        } else {
            $alertMessage = "Error updating service: " . $database->error;
        }
    } else {
        die("Error: Shop owner ID not available.");
    }
}

// Fetch the service details based on service_id
if(isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    $query = "SELECT * FROM services WHERE service_id='$service_id'";
    $result = $database->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Error: Service not found.");
    }
} else {
    die("Error: Service ID not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your additional CSS styles -->
    
    <style>
        /* Add your custom CSS styles here */
    </style>
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
    <!-- Your HTML content here -->
    <div class="container mt-4">
        <div class="section-title">
            <h2>Edit Service</h2>
        </div>
        <a href="services.php" class="btn btn-secondary">Back to Services</a>

        <form action="" method="POST">
            <div class="form-group">
                <label for="sname">Service Name</label>
                <input type="text" class="form-control" id="sname" name="sname" value="<?php echo $row['serviceName']; ?>" required>
            </div>
    <div class="form-group">
            <label for="vehicle_size">Vehicle Size</label>
        <select class="form-select" id="vehicle_size" name="vehicle_size" required>
                <option value="Small" <?php if($row['vehicle_size'] == "Small") echo "selected"; ?>>Small</option>
                <option value="Medium" <?php if($row['vehicle_size'] == "Medium") echo "selected"; ?>>Medium</option>
            <option value="Large" <?php if($row['vehicle_size'] == "Large") echo "selected"; ?>>Large</option>
        </select>
    </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $row['service_price']; ?>">
            </div>
            <div class="form-group">
                <label for="vehicle_type">Vehicle Type</label>
                <select class="form-select" name="vehicle_type" required>
                    <option value="Automobile" <?php if($row['vehicle_type'] == "Automobile") echo "selected"; ?>>Automobile</option>
                    <option value="Motorcycle" <?php if($row['vehicle_type'] == "Motorcycle") echo "selected"; ?>>Motorcycle</option>
                    <option value="Van" <?php if($row['vehicle_type'] == "Van") echo "selected"; ?>>Van</option>
                    <option value="Auto Detailing Services" <?php if($row['vehicle_type'] == "Auto Detailing Services") echo "selected"; ?>>Auto Detailing Services</option>
                </select>
            </div>
            <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
            <button type="submit" class="btn btn-primary" name="save_changes" href="services.php">Save Changes</button>
            <a href="services.php" class="btn btn-secondary">Cancel</a>
        </form>
        <?php if (!empty($alertMessage)): ?>
        <div class="alert alert-success mt-3" role="alert">
            <?php echo $alertMessage; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    
</body>
</html>
