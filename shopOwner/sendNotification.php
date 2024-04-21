<?php
// sendNotification.php

// Include SMSNotification class
require_once '../functions/twillio.php'; // Assuming the SMSNotification class is defined in SMSNotification.php file

// Check if the appointment_id parameter is set
if(isset($_POST['appointment_id'])) {
    // Get the appointment ID from the POST request
    $appointmentId = $_POST['appointment_id'];

    // Fetch the recipient's phone number associated with the appointment from the database
    // Replace this with your own database retrieval logic
    include("../connection.php"); // Include database connection
    $sql = "SELECT phone 
            FROM vehicle_owners 
            JOIN (
                SELECT vehicle_owner_id, queue_number 
                FROM appointment 
                WHERE status = 'Not Completed'  -- Added WHERE clause
                ORDER BY queue_number 
                LIMIT 1 OFFSET 1
            ) AS second_appointment ON vehicle_owners.account_id = second_appointment.vehicle_owner_id;";

    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        // Phone number found
        $row = $result->fetch_assoc();
        $phoneNumber = $row['phone'];

        // Define the notification message
        $message = "Thank you for waiting! We have already finished washing the car before you. Please be at the carwash in 15 mins otherwise we will cancel your appointment";

        // Instantiate SMSNotification class
        $smsNotification = new SMSNotification();
        var_dump($smsNotification);
        // Send the SMS notification
        $result = $smsNotification->send($message, $phoneNumber);

        if($result === true) {
            echo "SMS notification sent successfully.";
        } else {
            echo "Error sending SMS notification: " . $result;
        }
    } else {
        echo "Phone number not found for the second appointment.";
    }

    $database->close(); // Close database connection
} else {
    echo "Error: appointment_id parameter not set.";
}
?>
