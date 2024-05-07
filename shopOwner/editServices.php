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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your additional CSS styles -->
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>
    <!-- Your HTML content here -->
    <div class="container mt-4">
        <div class="section-title">
            <h2>Edit Service</h2>
        </div>
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
