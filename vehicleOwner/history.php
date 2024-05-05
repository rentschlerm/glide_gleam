    <?php

    session_start();
    // var_dump($_POST['service_id']);
    if(isset($_SESSION["user"])){
        if($_SESSION["user"] == "" or $_SESSION['type'] != '2'){
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }

    // Import database connection
    include("../connection.php");

    // Fetch shop information from the database
    $sql = "SELECT * FROM shop_info";
    $result = $database->query($sql);
    $shops = ($result->num_rows > 0)? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>History</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
            <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
            <link href="lib/animate/animate.min.css" rel="stylesheet">
            <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

            <!-- Include Chart.js library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Stylesheet -->
            <link href="../css/style.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
            <style>
            .popup{
                animation: transitionIn-Y-bottom 0.5s;
            }
            .sub-table{
                animation: transitionIn-Y-bottom 0.5s;
            }
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
                overflow-x: hidden; /* Optional: Hide horizontal scrollbar */
            }

            body {
            background: linear-gradient(to bottom, #000000, #8A2BE2); /* Black to Violet gradient */
            
            }
            .section-title h2 {
            color: white;
        } 
        .paragraph-color p {
            color: white; 
        }

        /* Style for the table header */
        th {
            background-color: #343a40; /* Dark grey */
            color: #fff; /* White text */
        }
        /* Alternate row color for better readability */
        tbody tr {
            background-color: #fff; /* Violet */
            color: #000000; /* Black text */
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray */
            color: #000000; /* Black text */
        }
        /* Style for action buttons */
        .action-btns .btn {
            margin-right: 5px;
        }
        /* Adjusted table size */
        .table {
            max-width: 800px; /* Set the maximum width of the table */
            margin: 0 auto; /* Center the table horizontally */
        }
        /* The alert message box */
    .alert {
        padding: 20px;
        background-color: #f44336; /* Red */
        color: white;
        text-align: center;
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 400px; /* Adjust width as needed */
        margin-top: 20px;
        z-index: 9999; /* Ensure it appears above other content */
        margin-bottom: 15px;
        opacity: 1;
        transition: opacity 0.6s; /* 600ms to fade out */
    }
    .alert-success{
        padding: 20px;
        background-color: #7CFC00; /* Red */
        color: white;
        text-align: center;
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 400px; /* Adjust width as needed */
        margin-top: 20px;
        z-index: 9999; /* Ensure it appears above other content */
        margin-bottom: 15px;
        opacity: 1;
        transition: opacity 0.6s; /* 600ms to fade out */
    }

    /* The close button */
    .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
    }

    /* When moving the mouse over the close button */
    .closebtn:hover {
    color: black;
    }

        </style>
    </head>
    <body>
        <!-- Top Bar Start -->
        <div class="top-bar">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12">
                            <div class="logo">
                                <a href="index.php">
                                    <h1>Glide<span>Gleam</span></h1>
                                    <!-- <img src="img/logo.jpg" alt="Logo"> -->
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 d-none d-lg-block">
                            <div class="row">
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <div class="top-bar-item">
                                        <div class="top-bar-icon">
                                            <i class="fa fa-phone-alt"></i>
                                        </div>
                                        <div class="top-bar-text">
                                            <h3>Call Us</h3>
                                            <p>+012 345 6789</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="top-bar-item">
                                        <div class="top-bar-icon">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        <div class="top-bar-text">
                                            <h3>Email Us</h3>
                                            <p>info@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->

        <!-- Navbar -->
        <nav class="nav-bar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointment.php">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="booking.php">Car Wash</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="history.php" >History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../signout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal" id="ratingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rate Appointment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="ratingForm">
                    <input type="hidden" id="queueNumber" name="queue_number">
                    <label for="rating">Rating:</label>
                    <select id="rating" name="rating" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <label for="comments">Comments:</label>
                    <textarea id="comments" name="comments" class="form-control" placeholder="Enter your comments"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitRating">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle click on "Rate" button
        $('.rate-btn').click(function() {
            var queueNumber = $(this).data('queue');
            $('#queueNumber').val(queueNumber);
            $('#ratingModal').modal('show');
        });

        // Handle form submission
        $('#submitRating').click(function() {
            $.ajax({
                url: 'rate_comment.php',
                method: 'POST',
                data: $('#ratingForm').serialize(),
                success: function(response) {
                    // Handle success, e.g., display a success message
                    alert('Rating submitted successfully.');
                    $('#ratingModal').modal('hide');
                    // You may also update the UI to reflect the new rating
                },
                error: function(xhr, status, error) {
                    // Handle error, e.g., display an error message
                    alert('Error submitting rating.');
                }
            });
        });
    });
</script>



        <div class="container my-5">
        <h2>Appointment History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Queue Number</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch past appointments for the logged-in user using the stored user ID
                $historyQuery = "SELECT queue_number, appointment_date, status 
                                FROM appointment 
                                WHERE vehicle_owner_id = {$_SESSION['id']} 
                                AND status != 'Not Completed'";

                $historyResult = $database->query($historyQuery);

                // Check for SQL query errors
                if ($historyResult === false) {
                    die("Error executing query: " . $database->error);
                }

                // Output appointment history data
                while ($row = $historyResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['queue_number']}</td>";
                    echo "<td>{$row['appointment_date']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>";
                    
                    // Display star icons based on rating value if it exists
                    if (isset($row['rating'])) {
                        echo "<div class='rating'>";
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $row['rating']) {
                                echo "<i class='fas fa-star'></i>";
                            } else {
                                echo "<i class='far fa-star'></i>";
                            }
                        }
                        echo "</div>";
                    } else {
                        // Display "Rate" button if rating doesn't exist
                        echo "<button class='rate-btn' data-queue='{$row['queue_number']}'>Rate</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
