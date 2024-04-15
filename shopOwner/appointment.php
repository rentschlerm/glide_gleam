<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/app.css">
        
    <title>Appointments</title>
    <style>
        .container {
            position: relative;
        }
        .back-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px 10px; /* Adjust padding as needed */
            border: none;
            background-color: #007bff; /* Your desired button color */
            color: #fff; /* Text color */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #0056b3; /* Hover color */
        }
        .appointments-heading {
            margin-top: 20px; /* Adjust the margin as needed */
        }
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<a class="back-btn" href="../carwashowner/index.php" role="button">Back</a>
    <div class="container my-5">
        
        
        
    <h2 class="appointments-heading">Appointments</h2>
        
        <?php
        session_start();

        if(isset($_SESSION["user"])){
            if($_SESSION["user"] == "" or $_SESSION['type'] != '1'){
                header("location: ../login.php");
            } else {
                $useremail = $_SESSION["user"];
            }
        } else {
            header("location: ../index.html");
        }

        // Import database connection
        include("../connection.php");

        // Fetch shop information from the database
        $sql = "SELECT * FROM `appointment` 
        JOIN vehicle_owners ON appointment.vehicle_owner_id = vehicle_owners.account_id 
        JOIN shop_info ON shop_info.shop_info_id = appointment.shop_info_id 
        -- JOIN specialties ON specialties.shop_info_id = appointment.shop_info_id
        WHERE shop_info.shop_owner_id = {$_SESSION['id']} AND appointment.status = 'Not Completed'
        ORDER BY appointment.apponum ASC;";
        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='card my-2'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>Customer Name: " . $row["first_name"] . " " . $row["last_name"] . "</h5>";
                echo "<p class='card-text'>Shop Name: " . $row["shop_name"] . "</p>";
                echo "<p class='card-text'>Queue Number: " . $row["apponum"] . "</p>";
                // echo "<p class='card-text'>Service Name: " . $row["service_name"] . "</p>";
                // echo "<p class='card-text'>Price: ₱" . $row["price"] . "</p>";
                // echo "<p class='card-text'>Category: " . $row["category"] . "</p>";
                echo "<p class='card-text'>Appointment Date: " . date('F d, Y', strtotime($row["appodate"])) . "</p>";
                echo "<p class='card-text'>Appointment Time: " . date('h:i A', strtotime($row["appodate"])) . "</p>";
                
                // Button to handle completion of appointment
                echo "<button class='btn btn-primary' onclick='completeAppointment(" . $row["appoid"] . ", \"Completed\")'>Completed</button>";
                
                // Button to handle cancellation of appointment
                echo "<button class='btn btn-danger' onclick='completeAppointment(" . $row["appoid"] . ", \"Cancelled\")'>Cancel</button>";
                
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No appointment found</p>";
        }

        $database->close();
        ?>
    </div>

    <script>
    function completeAppointment(appointmentId, status) {
        // Display a confirmation prompt
        var confirmAction = confirm("Are you sure you want to mark this appointment as " + status + "?");

        if (confirmAction) {
            // Send an AJAX request to mark the appointment as completed or cancelled
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_appointment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the PHP script
                    alert(xhr.responseText);
                    // Optionally, you can update the UI to reflect the completed/cancelled appointment
                    location.reload(); // Reload the page to reflect the changes
                    
                    // If the appointment is marked as completed, send notification
                    if (status === "Completed") {
                        sendNotification(appointmentId);
                    }
                }
            };
            xhr.send("appointment_id=" + appointmentId + "&status=" + status);
        }
    }
    
    // Function to send notification
    function sendNotification(appointmentId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "sendNotification.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the PHP script (optional)
                console.log(xhr.responseText);
            }
        };
        xhr.send("appointment_id=" + appointmentId);
    }
</script>

    
</body>
</html>
