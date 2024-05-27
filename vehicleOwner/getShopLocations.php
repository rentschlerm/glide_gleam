<?php

// Include the file to establish database connection
include '../connection.php';

try {
    // Query to fetch shop locations
    $query = "SELECT latitude, longitude FROM shop_info";

    // Execute the query
    $result = $database->query($query);

    // Check if query executed successfully
    if ($result) {
        // Fetch all rows as associative array
        $shops = $result->fetch_all(MYSQLI_ASSOC);

        // Return the data as JSON response
        header('Content-Type: application/json');
        echo json_encode($shops);
    } else {
        // Query execution failed
        error_log($database->error); // Log MySQL error
        die("Error fetching shop locations: " . $database->error);
    }
} catch(Exception $e) {
    // Exception occurred
    error_log($e->getMessage()); // Log exception message
    die("Error fetching shop locations: " . $e->getMessage());
}
