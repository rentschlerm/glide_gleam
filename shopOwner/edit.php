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
<body>
    <div class="container">
        <h2>Edit Shop</h2>
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
