<?php
// Inside update_appointment.php

// Assuming you have already established the database connection
include("../connection.php");

// Check if appointment_id and status are set
if(isset($_POST["appointment_id"]) && isset($_POST["status"])) {
    $appointmentId = $_POST["appointment_id"];
    $status = $_POST["status"];

    // Update the appointment status in the database
    $sql = "UPDATE appointment SET status = '$status' WHERE appointment_id = $appointmentId";
    if ($database->query($sql) === TRUE) {
        echo "Appointment marked as $status.";

        // If the appointment is marked as completed, record the sale
        if ($status === "Completed") {
            $fetchAppointmentSql = "SELECT services.service_price, shop_info.shop_info_id FROM appointment 
                                    JOIN services ON appointment.service_id = services.service_id 
                                    JOIN shop_info ON appointment.shop_info_id = shop_info.shop_info_id 
                                    WHERE appointment_id = $appointmentId";
            $fetchAppointmentResult = $database->query($fetchAppointmentSql);

            if ($fetchAppointmentResult->num_rows > 0) {
                $row = $fetchAppointmentResult->fetch_assoc();
                $servicePrice = $row['service_price'];
                $shopInfoId = $row['shop_info_id'];

                // Insert into the sales table
                $insertSalesSql = "INSERT INTO sales (appointment_id, shop_info_id, sales, dateSold) 
                                    VALUES ($appointmentId, $shopInfoId, $servicePrice, CURRENT_DATE)";
                if ($database->query($insertSalesSql) === TRUE) {
                    echo " Sale recorded successfully.";
                } else {
                    echo "Error recording sale: " . $database->error;
                }
            } else {
                echo "Error: Appointment details not found.";
            }
        }
    } else {
        echo "Error updating appointment: " . $database->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$database->close();
?>
