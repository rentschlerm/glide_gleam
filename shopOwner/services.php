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
                        <a class="nav-link" href="appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Availability</a>
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
    <!-- Button for modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add a Service
</button>
    <div id="servicesTable"> <!-- Wrap the table in a div with an id -->
    <table class="table">
        <thead>
            <br><br><br>
            <h2> Services </h2>
            
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
                    <td>
                        <a class='btn btn-primary btn-sm' href='/cws/carwashowner/edit.php?shop_info_id={$row['shop_info_id']}'>EDIT</a>
                        <a class='btn btn-primary btn-sm' href='/cws/carwashowner/delete.php?shop_info_id={$row['shop_info_id']}'>DELETE</a>
                    </td>
                </tr>";
            }
            ?>
            
        </tbody>
    </table>
</div> <!-- Close the div -->



    <!-- Modal -->
<div class="modal fade modal-lg" id="exampleModal" role="dialog">
    <div class="modal-dialog">
        <form action="" method="POST" > <!-- Ensure correct form action -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-block">
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
                                    <td><input type "number" class="form-control" name="price"></td>
                                    <!-- <td><input type="number" class="form-control" name="small" required></td>
                                    <td><input type="number" class="form-control" name="medium" required></td>
                                    <td><input type="number" class="form-control" name="large" required></td> -->
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="save_changes" >Save changes</button> <!-- Ensure correct button name -->
                </div>
                <?php
include("../connection.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_changes"])) {
    // Form submission has occurred, proceed with adding the service
    
    if(isset($_SESSION['id'])) {
        $shop_owner_id = $_SESSION['id'];
    } else {
        // If not available in session, handle accordingly (e.g., redirect to login)
        die("Error: Shop owner ID not available.");
    }

    // Retrieve form data
    $size = $_POST["vehicle_size"];
    $price = $_POST["price"];
    $vehicle_type = $_POST["vehicle_type"];
    $service_name = $_POST["sname"];

    // Retrieve shop info ID
    $sql = "SELECT shop_info_id FROM shop_info WHERE shop_owner_id = '$shop_owner_id'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        $shop_info_row = $result->fetch_assoc();
        $shop_info_id = $shop_info_row['shop_info_id'];
    } else {
        die("Error: Shop info not found.");
    }

    // Insert the service into the database
    $insertQuery2 = "INSERT INTO services (serviceName, shop_info_id, vehicle_size, service_price, vehicle_type)
    VALUES ('$service_name','$shop_info_id', '$size', '$price', '$vehicle_type')";

if($database->query($insertQuery2) === TRUE) {
    // Redirect to the same page to prevent form resubmission
    header("Location: services.php");
    // return; // Prevent further execution of the page
} else {
    echo "Error: " . $insertQuery2 . "<br>" . $database->error;
}
}


?>

            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

          <!-- Include Chart.js library -->
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          
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
