<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glide Gleam Car Wash Owner Dashboard</title>
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
          <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">
</head>
<body>
     <!-- Top Bar Start -->
     <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="index.html">
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
                        <a class="nav-link" href="./appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Availability</a>
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

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Dashboard Homepage -->
        <h2 class="mb-4">Shop Owner Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <!-- Display overview of upcoming appointments -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Appointments</h5>
                        <!-- Display upcoming appointments here -->
                    </div>
                </div>
            </div>
            
            <div style="width: 50%; margin: auto;">
                <!-- Chart.js Canvas -->
                <canvas id="salesChart"></canvas>
                <canvas id="serviceUsageChart"></canvas>
            </div>
        <?php
            // database connection established
            include('../connection.php');

            // query to fetch sales data
            $dateQuery = "SELECT DATE_FORMAT(appointment_date, '%Y-%m') AS month, COUNT(*) AS total_appointments 
            FROM appointment 
            GROUP BY MONTH(appointment_date)";

            $serviceQuery = "SELECT service_id, COUNT(*) AS service_count 
            FROM appointment 
            GROUP BY service_id";

            // database connection
            $dateResult = $database->query($dateQuery);
            $serviceResult = $database->query($serviceQuery);
            

            // Initialize an empty array to store sales data
            $salesData = array();
            $serviceData = array();

            // Loop through the query result and populate the service usage data array
            while ($row = $serviceResult->fetch_assoc()) {
                // table named 'services' to map service_id to service names
                $service_name_query = "SELECT service_name FROM services WHERE service_id = ".$row['service_id'];
                $service_name_result = $db->query($service_name_query);
                $service_name_row = $service_name_result->fetch_assoc();
                $service_name = $service_name_row['service_name'];

                // Store service usage data in the format 'Service Name' => Service Count
                $serviceData[$service_name] = (int)$row['service_count'];
            }


            // Loop through the query result and populate the sales data array
            while ($row = $dateResult->fetch_assoc()) {
            // Format the month as 'Month Year' (e.g., 'January 2024')
            $formattedMonth = date('F Y', strtotime($row['month']));

            // Store sales data in the format 'Month Year' => Total Appointments
            $salesData[$formattedMonth] = (int)$row['total_appointments'];
            }

            // Convert sales data into arrays for Chart.js
            $months = array_keys($salesData);
            $sales = array_values($salesData);
            $services = array_keys($serviceData);
            $usageCounts = array_values($serviceData);
        ?>
            <!-- Other sections and features can be added here -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript to render line chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Sales',
                    data: <?php echo json_encode($sales); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
     <script>
        // JavaScript to render radar chart
        var ctx = document.getElementById('serviceUsageChart').getContext('2d');
        var serviceUsageChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: <?php echo json_encode($services); ?>,
                datasets: [{
                    label: 'Service Usage',
                    data: <?php echo json_encode($usageCounts); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust colors as needed
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scale: {
                    angleLines: {
                        display: false
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
