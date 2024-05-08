<?php

    // learn from w3schools.com
    // Unset all the server-side variables
    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    if ($_POST) {
        $_SESSION["personal"] = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'phone' => $_POST['phone'] // Added phone number
        );

        print_r($_SESSION["personal"]);
        
        header("location: create-account.php");
    }

    ?>