<?php
session_start();
include("../connection.php");

// Check if service ID is provided and valid
if(isset($_GET['service_id'])) {
    // Get service ID from the URL
    $service_id = $_GET['service_id'];

    // Retrieve shop owner ID from session
    if(isset($_SESSION['id'])) {
        $shop_owner_id = $_SESSION['id'];
        
        // Get shop info ID for authorization
        $sql_shop_info = "SELECT shop_info_id FROM shop_info WHERE shop_owner_id = '$shop_owner_id'";
        $result_shop_info = $database->query($sql_shop_info);
        
        if($result_shop_info->num_rows > 0) {
            $row_shop_info = $result_shop_info->fetch_assoc();
            $shop_info_id = $row_shop_info['shop_info_id'];

            // Delete the service from the database
            $deleteQuery = "DELETE FROM services WHERE service_id = '$service_id' AND shop_info_id = '$shop_info_id'";
            if($database->query($deleteQuery) === TRUE) {
                // Redirect back to services.php after deletion
                header("Location: services.php");
                exit();
            } else {
                echo "Error deleting service: " . $database->error;
            }
        } else {
            echo "Error: Shop info not found.";
        }
    } else {
        echo "Error: Shop owner ID not available.";
    }
} else {
    echo "Error: Service ID not provided.";
}
?>
