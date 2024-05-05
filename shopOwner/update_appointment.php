<?php
session_start();

if(isset($_POST['appointment_id'], $_POST['status'])) {
    // Import database connection
    include("../connection.php");

    // Update appointment status
    $appointmentId = $_POST['appointment_id'];
    $status = $_POST['status'];
    
    $updateQuery = "UPDATE appointment SET status = '$status' WHERE appointment_id = $appointmentId";
    $updateResult = $database->query($updateQuery);

    if ($updateResult === true) {
        // Insert appointment details into history table
        $insertQuery = "INSERT INTO appointment_history (appointment_id, queue_number, appointment_date, status)
                        SELECT appointment_id, queue_number, appointment_date, status 
                        FROM appointment 
                        WHERE appointment_id = $appointmentId";

        $insertResult = $database->query($insertQuery);

        if ($insertResult === false) {
            // Handle insertion error
            echo "Error inserting appointment into history: " . $database->error;
        } else {
            // Appointment updated and saved in history successfully
            echo "Appointment updated and saved in history successfully!";
        }
    } else {
        // Handle update error
        echo "Error updating appointment: " . $database->error;
    }

    // Close the database connection
    $database->close();
} else {
    echo "Invalid request!";
}
?>
