<?php
session_start();
include("../connection.php");

if(isset($_GET['shop_info_id'])) {
    $shop_info_id = $_GET['shop_info_id'];

    // Delete shop
    $sql = "DELETE FROM shop_info WHERE shop_info_id = '$shop_info_id'";
    if ($database->query($sql) === TRUE) {
        echo "Shop deleted successfully!";
        // Redirect back to addShop.php
        header("Location: addShop.php");
        exit; // Make sure to exit after redirection
    } else {
        echo "Error deleting shop: " . $database->error;
    }
} else {
    echo "Invalid request!";
    exit;
}
?>
