<?php
session_start();
include('../connection.php');
$_SESSION['login_message'] = '';
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $userType = $_POST['userType'] ?? ''; // This will contain either 'shop_owner' or 'vehicle_owner'
    $model = $_POST ['model'];
    $licensePlate = $_POST ['license_plate'];
    $vehicleSize = $_POST ['vehicle_size'];
    $vehicleBrand = $_POST ['brand'];
    $vehicleYear = $_POST ['vehicle_year'];
    $vehicleColor = $_POST ['color'];
    $vehicleType = $_POST ['vehicle_type'];
    $msg = 'success';
    try{
        // Prepare and execute SQL statement to save the user type to the appropriate table
        if ($userType === 'shop_owner') {
            $database->query("INSERT INTO shop_owners (first_name, last_name, phone) VALUES ('$firstName', '$lastName', '$phone')");
            $shopOwnerId = $database->insert_id;

            // Insert account details
            $database->query("INSERT INTO accounts (email, password, type, status) VALUES ('$email', '$password', '1', 'Accept registration')");
            $accountId = $database->insert_id;

            // Update shop owner with account ID
            $database->query("UPDATE shop_owners SET shop_owner_id = '$accountId' WHERE shop_owner_id = '$shopOwnerId'");

            // Set shop_owner_id in session
            $_SESSION['shop_owner_id'] = $shopOwnerId;
        } else {
            $database->query("INSERT INTO vehicle_owners (first_name, last_name, phone,brand,model,vehicle_year,license_plate,vehicle_size,color,vehicle_type) VALUES ('$firstName', '$lastName', '$phone', '$vehicleBrand', '$model', '$vehicleYear', '$licensePlate', '$vehicleSize', '$vehicleColor', '$vehicleType')");
            $vehicleOwnerId = $database->insert_id;
            $database->query("INSERT INTO accounts (email, password, type, status) VALUES ('$email', '$password', '2', 'Accept registration')");
            $accountId = $database->insert_id;
            $database->query("UPDATE vehicle_owners SET vehicle_owner_id = '$accountId' WHERE vehicle_owner_id = '$vehicleOwnerId'");
        }
        // Redirect to login page after successfully saving user type
        
    } catch (Exception $e) {
        $error = $e->getMessage();
        $msg = $error;
    }

    header("Location: ../index.php?signup={$msg}");
} else {
    echo "Error: Form not submitted.";
}

// Close the database connection
$database->close();
?>

