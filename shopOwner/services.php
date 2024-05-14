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
                        <a class="nav-link" href="generate_pdf.php">Reports</a>
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

    
    <div class="container mt-4">
        <a class="btn btn-custom" href="index.php" role="button">Back</a>
        <a class="btn btn-custom" href="addServices.php" role="button">Add a Service</a>
    </div>

    <!-- Services Table -->
    <div id="servicesTable" class="container mt-4">
        <div class="section-title">
            <h2>Services</h2>
        </div>
        <div class="table-responsive">
            <div class="text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Vehicle Size</th>
                            <th>Price</th>
                            <th>Vehicle Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($database->connect_error) {
                            die("Connection Failed:" . database->connect_error);
                        }
                    
                        // Display Services table
                        $shop_owner_id = $_SESSION['id'];
                        $query_shop_info_id = "SELECT shop_info_id FROM shop_info WHERE shop_owner_id = '$shop_owner_id'";
                        $result_shop_info_id = $database->query($query_shop_info_id);
                        $row_shop_info_id = $result_shop_info_id->fetch_assoc();
                        $shop_info_id = $row_shop_info_id['shop_info_id'];

                        $sql2 = "SELECT * FROM services WHERE shop_info_id = '$shop_info_id'";
                        $result2 = $database->query($sql2);

                        if (!$result2) {
                            die("Invalid query: " . $database->error);
                        }

                        while ($row = $result2->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>{$row['serviceName']}</td>
                                <td>{$row['vehicle_size']}</td>
                                <td>{$row['service_price']}</td>
                                <td>{$row['vehicle_type']}</td>
                                
                                <td class='action-btns'>
                                    <a class='btn btn-custom btn-sm' href='/glide_gleam/shopOwner/editServices.php?service_id={$row['service_id']}'>
                                        <i class='fas fa-edit fa-sm'></i> <!-- Edit icon -->
                                    </a>
                                    <a class='btn btn-custom btn-sm' href='/glide_gleam/shopOwner/deleteServices.php?service_id={$row['service_id']}'>
                                        <i class='fas fa-trash-alt fa-sm'></i> <!-- Delete icon -->
                                    </a>
                                </td>

                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <!-- Bootstrap and other JS libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Function to reload services table
        function reloadServicesTable() {
            // Fetch the updated data
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>') // Replace 'get_services.php' with the URL of the script that fetches updated data
                .then(response => response.text())
                .then(data => {
                    // Replace the content of the services table
                    document.getElementById('servicesTable').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Call the function after successful form submission
        // Assuming the form submission is handled using AJAX and you have a success callback
        // Replace the following with your actual success callback
        function handleFormSubmission() {
            // Assuming the form submission is successful
            reloadServicesTable(); // Call the function to reload the services table
        }
    </script>
</body>
</html>
