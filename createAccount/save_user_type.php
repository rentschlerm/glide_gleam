<?php
// Retrieve the POST data sent from the client-side JavaScript
$data = json_decode(file_get_contents("php://input"), true);

var_dump($data);

// Check if the user type is valid
$userType = isset($data['userType']) ? $data['userType'] : null;

// Debugging: Print out the user type
echo "User type received: " . $userType;

// Check if the user type is valid
$userType = $data['userType'] ?? null;
if ($userType !== 'shop_owner' && $userType !== 'vehicle_owner') {
    // Invalid user type
    http_response_code(400);
    echo "Invalid user type";
    exit;
}

include('../connection.php');

$email = $_POST['email'];
$password = $_POST['password'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$phone = $_POST['phone'];

// Prepare and execute SQL statement to save the user type to the appropriate table
if ($userType === 'shop_owner') {
    $database->query("INSERT INTO shop_owners (first_name, last_name, phone) VALUES ('$firstName', '$lastName', '$phone')");
    $shopOwnerId = $database->insert_id;

    // Insert account details
    $database->query("INSERT INTO accounts (email, password, type, status) VALUES ('$email', '$password', '1', 'Accept registration')");
    $accountId = $database->insert_id;

    // Update shop owner with account ID
    $database->query("UPDATE shop_owners SET account_id = '$accountId' WHERE shop_owner_id = '$shopOwnerId'");

    // Set shop_owner_id in session
    $_SESSION['shop_owner_id'] = $shopOwnerId;
} else {
    $database->query("INSERT INTO vehicle_owners (first_name, last_name, phone) VALUES ('$firstName', '$lastName', '$phone')");
    $vehicleOwnerId = $database->insert_id;
    $database->query("INSERT INTO accounts (email, password, type, status) VALUES ('$email', '$password', '2', 'Accept registration')");
    $accountId = $database->insert_id;
    $database->query("UPDATE vehicle_owners SET account_id = '$accountId' WHERE vehicle_owner_id = '$vehicleOwnerId'");

}

if ($databse->query($sql) === TRUE) {
    // User type saved successfully, redirect to login page
    header("Location: index.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $databse->error;
}

echo "User type saved successfully";
// Close the database connection
$databse->close();
?>
