<?php
// save_location.php

// Include the database connection file
include 'connection.php';

// Get POST data
$shopName = $_POST['shop_name'];
$location = $_POST['location'];
$operatingFrom = $_POST['operating_from'];
$operatingTo = $_POST['operating_to'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// SQL to insert data into the database
$sql = "INSERT INTO shop_info (shop_name, location, operating_from, operating_to, longitude, latitude) VALUES ('$shopName', '$location', '$operatingFrom', '$operatingTo', '$longitude', '$latitude')";

if ($database->query($sql) === TRUE) {
    echo "Location saved successfully2";
} else {
    echo "Error: " . $sql . "<br>" . $database->error;
}

// Close the database connection
$database->close();
?>
