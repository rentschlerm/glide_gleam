<?php

include("../connection.php");

// Check if the user is authenticated and their vehicle type is set
session_start();
if(isset($_SESSION['id'])) {
    // Retrieve user's vehicle type from the database
    $userId = $_SESSION['id']; // user ID stored in the session
    
    // Query to retrieve the user's vehicle type from the database
    $sql = "SELECT vehicle_type FROM vehicle_owners WHERE vehicle_owner_id = '$userId'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vehicleType = $row['vehicle_type'];

        // Fetch registered vehicles of the user's vehicle type from the database
        $sql = "SELECT * FROM vehicle_owners WHERE vehicle_owner_id = '$userId' AND vehicle_type = '$vehicleType'";
        $result = $database->query($sql);

        // Check if registered vehicles are found
        if ($result->num_rows > 0) {
            // Start creating HTML options for the select dropdown
            while ($row = $result->fetch_assoc()) {
                $html .= "<option value='" . $row['vehicle_owner_id'] . "'>" . $row['model'] . "</option>";
            }

            // Return the HTML response
            echo $html;
        } else {
            echo "<option selected disabled>No registered vehicles found</option>";
        }
    } else {
        echo "<option selected disabled>No vehicle type found for the user</option>";
    }
} else {
    echo "<option selected disabled>User is not authenticated</option>";
}

// Close the database connection
$database->close();
?>
