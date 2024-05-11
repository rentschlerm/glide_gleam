<?php

 include("../connection.php");

    // Fetch past appointments for the logged-in user
    $sql = "SELECT * FROM review_table where appointment_id = ". $_GET['id'];

    $result = mysqli_fetch_assoc($database->query($sql));
    if($_GET['getFeedbackId']){
        echo json_encode($result);
    }