<?php
// Inside remove_appointment.php

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
    } else {
        echo "Error updating appointment: " . $database->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$database->close();
