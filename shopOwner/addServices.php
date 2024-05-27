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

            $insertQuery2 = "INSERT INTO services (serviceName, shop_info_id, vehicle_size, service_price, vehicle_type)
            VALUES ('$service_name','$shop_info_id', '$size', '$price', '$vehicle_type')";

            if($database->query($insertQuery2) === TRUE) {
                $alertMessage = "Service added successfully!";
            } else {
                $alertMessage = "Error: " . $insertQuery2 . "<br>" . $database->error;
        }
        } else {
            $alertMessage = "Please Add a Shop first!";
            // die("Please Add a Shop first!");
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
        <link href="../css/ui-dashboard.css" rel="stylesheet">
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

        .nav-bar {
            background-color: #2C3E50 ; /* Accent Color */
        }
        /* Table Row Colors */
        tbody tr:nth-child(even) {
            background-color: #E6E6E6; /* Light Gray */
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF; /* White */
        }
        /* Style for action buttons */
        .action-btns .btn {
            margin-right: 5px;
        }
        /* Adjusted table size */
        .table {
            max-width: 800px; /* Set the maximum width of the table */
            margin: 0 auto; /* Center the table horizontally */
        }
    .bg-gradient-custom {
            background-color: #4682B4; /* Matching color from your scheme */
            color: #FFF; /* Text color */
        }
        .logo-link {
        text-decoration: none; /* Remove underline from logo link */
        color: #FFF; /* Set color for logo link */
      }

      .logo-link:hover {
          color: #B0C4DE; /* Hover color for logo link */
      }
      .logo span {
              color: #4682B4; /* Same color for the span */
          }
</style>
</head>
<body>
<?php

$shop_owner_id = isset($_SESSION['id']) ? trim($_SESSION['id']) : '';
$resultName = $database->query("SELECT first_name, last_name FROM shop_owners WHERE shop_owner_id = '$shop_owner_id' ");
if ($resultName->num_rows > 0) {
  $user = $resultName->fetch_assoc();
  $userFirstName = $user['first_name'];
  $userLastName = $user['last_name'];
}
?>
<nav class="nav-bar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="logo">
                <a href="index.php" class="logo-link">
                    <h1>Glide<span>Gleam</span></h1>
                </a>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointment.php">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">History</a>
                </li>
                <div class="action">
                <div class="profile" onclick="menuToggle();">
                  <img src="../assets/avatar.jpg" />
                </div>
                <div class="menu">
                <h3><?php echo "$userFirstName $userLastName";   ?><br /><span>Shop Owner</span></h3>
                  <ul>
                    <li>
                      <img src="../assets/icons/user.png" /><a href="#">My profile</a>
                    </li>
                    <li>
                      <img src="../assets/icons/edit.png" /><a href="services.php">Services</a>
                    </li>
                    <li>
                      <img src="../assets/icons/shop.png" /><a href="addShop.php">Add shop</a>
                    </li>
                    <li><img src="../assets/icons/reports.png" /><a href="generate_pdf.php">Report</a></li>
                    <li>
                      <img src="../assets/icons/log-out.png" /><a href="../signout.php">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>
            </ul>
        </div>
    </div>
</nav>

<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
<div id="alertDiv" class="alert alert-success alert-dismissible text-center" style="position: fixed; top: 80px; left: 50%; transform: translateX(-50%);" role="alert">
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