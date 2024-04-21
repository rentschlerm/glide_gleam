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

        $insertQuery2 = "INSERT INTO services (serviceName, shop_info_id, vehicle_size, service_price, vehicle_type)
        VALUES ('$service_name','$shop_info_id', '$size', '$price', '$vehicle_type')";

        if($database->query($insertQuery2) === TRUE) {
            $alertMessage = "Service added successfully!";
        } else {
            $alertMessage = "Error: " . $insertQuery2 . "<br>" . $database->error;
        }
    } else {
        die("Error: Shop owner ID not available.");
    }
}
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
                        <a class="nav-link" href="appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
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
    <a class="btn btn-custom" href="services.php" role="button">Back</a>
    <form action="" method="POST" class="container mt-4">
    <div class="section-title">
        <h2>Add a Service</h2>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Vehicle Size</th>
                <th>Price</th>
                <th>Vehicle Type</th>
            </tr>
        </thead>
        <tbody id="services">
            <tr>
                <td><input type="text" class="form-control" name="sname" required></td>
                <td>
                    <select class="form-select" name="vehicle_size" required>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select>
                </td>
                <td><input type="number" class="form-control" name="price"></td>
                <td>
                    <select class="form-select" name="vehicle_type" required>
                        <option value="Automobile">Automobile</option>
                        <option value="Motorcycle">Motorcycle</option>
                        <option value="Van">Van</option>
                        <option value="Auto Detailing Services">Auto Detailing Services</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <button type="submit" class="btn btn-success" name="save_changes">Save changes</button>
    </div>
</form>
<?php if (!empty($alertMessage)): ?>
<div id="alertDiv" class="alert alert-success alert-dismissible text-center" style="position: fixed; top: 50px; left: 50%; transform: translateX(-50%);" role="alert">
    <?php echo $alertMessage; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<script>
    // Automatically close the alert after 5 seconds
    setTimeout(function() {
        document.getElementById('alertDiv').style.display = 'none';
    }, 5000);
</script>
<?php endif; ?>



    </body>
    </html>