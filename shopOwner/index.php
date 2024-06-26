<?php
    session_start();
    include('../connection.php');
    
?>
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

        <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

          <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/ui-dashboard.css" rel="stylesheet">
    <style>
     html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Optional: Hide horizontal scrollbar */
            font-family: Arial, sans-serif; /* Optional: Choose a commonly used font */
        }

        body {
            background-color: #F2F2F2; /* Dominant Color */
        }

        .container {
            /* background-color: #B0C4DE; Secondary Color */
            border-radius: 10px; /* Optional: Add some rounded corners */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); Optional: Add a subtle shadow for depth */
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #FFF; /* Text color for navbar links */
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #4682B4; /* Accent color on hover for navbar links */
        }

        .nav-bar {
            background-color: #2C3E50 ; /* Accent Color */
        }
        /* Table Row Colors */
        tbody tr:nth-child(even) {
            background-color: #E6E6E6; /* Light Gray */
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF; /* White */
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
        .bg-gradient-custom {
            background-color: #4682B4; /* Matching color from your scheme */
            color: #FFF; /* Text color */
        }
        #system-time {
        font-size: 24px;
        font-weight: bold;}
        

</style>


</head>
<body>
<?php

      $shop_owner_id = isset($_SESSION['id']) ? trim($_SESSION['id']) : '';
      $resultName = $database->query("SELECT first_name, last_name FROM shop_owners WHERE shop_owner_id = '$shop_owner_id' ");
      if ($resultName->num_rows > 0) {
        $user = $resultName->fetch_assoc();
        $userFirstName = $user['first_name'];
        $userLastName = $user['last_name'];
      }
?> 
<nav class="nav-bar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="logo">
                <a href="index.php" class="logo-link">
                    <h1>Glide<span>Gleam</span></h1>
                </a>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointment.php">Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">History</a>
                </li>
                <div class="action">
                <div class="profile" onclick="menuToggle();">
                  <img src="../assets/avatar.jpg" />
                </div>
                <div class="menu">
                <h2></h2>
                  <h3><?php echo "$userFirstName $userLastName";   ?><br /><span>Shop Owner</span></h3>
                  <ul>
                    <li>
                      <img src="../assets/icons/user.png" /><a href="profile.php">My profile</a>
                    </li>
                    <li>
                      <img src="../assets/icons/edit.png" /><a href="services.php">Services</a>
                    </li>
                    <li>
                      <img src="../assets/icons/shop.png" /><a href="addShop.php">Add shop</a>
                    </li>
                    <li><img src="../assets/icons/reports.png" /><a href="generate_pdf.php">Report</a></li>
                    <li>
                      <img src="../assets/icons/log-out.png" /><a href="../signout.php">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>
            </ul>
        </div>
    </div>
</nav>

    
    <?php

      // Fetch total sales for the shop owner
      $shop_owner_id = isset($_SESSION['id']) ? $_SESSION['id'] : ""; // Retrieve the shop owner's ID from session
      $totalSalesQuery = "SELECT SUM(sales) AS total_sales 
      FROM sales 
      JOIN shop_info ON sales.shop_info_id = shop_info.shop_info_id
      JOIN shop_ownerS ON shop_info.shop_owner_id = shop_ownerS.shop_owner_id
      WHERE shop_ownerS.shop_owner_id = '$shop_owner_id'
      ";
      $totalSalesResult = $database->query($totalSalesQuery);
      $totalSales = 0; // Initialize total sales variable

      if ($totalSalesResult->num_rows > 0) {
          $totalSalesRow = $totalSalesResult->fetch_assoc();
          $totalSales = $totalSalesRow['total_sales'];
      }
      // Fetch today's sales for the shop owner
      $currentDate = date("Y-m-d"); // Get current date
      // echo"$currentDate";
      $todaySalesQuery = "SELECT SUM(sales) AS today_sales 
                          FROM sales 
                          JOIN shop_info ON sales.shop_info_id = shop_info.shop_info_id
                          JOIN shop_owners ON shop_info.shop_owner_id = shop_owners.shop_owner_id
                          WHERE shop_owners.shop_owner_id = '$shop_owner_id'
                          AND DATE(dateSold) = '$currentDate'";
      $todaySalesResult = $database->query($todaySalesQuery);
      $todaySales = 0; // Initialize today's sales variable

      if ($todaySalesResult) {
          // Check if any rows are returned
          if ($todaySalesResult->num_rows > 0) {
              // Fetch today's sales data
              $todaySalesRow = $todaySalesResult->fetch_assoc();
              $todaySales = $todaySalesRow['today_sales'];
          } else {
              echo "No sales recorded for today.";
          }
      } else {
          // Display error message if query execution fails
          echo "Error executing today's sales query: " . $database->error;
      }

      // Output today's sales for debugging
      echo "<div id='system-time'></div>";

          // Fetch number of customers who booked for the day
          $customersBookedQuery = "SELECT COUNT(*) AS booked_customers 
          FROM appointment 
          JOIN shop_info on appointment.shop_info_id = shop_info.shop_info_id
          WHERE shop_owner_id = '$shop_owner_id' 
          AND DATE(appointment_date) = '$currentDate'
          AND status = 'Completed'";
          $customersBookedResult = $database->query($customersBookedQuery);
          $customersBooked = 0; // Initialize number of customers booked variable

          if ($customersBookedResult->num_rows > 0) {
          $customersBookedRow = $customersBookedResult->fetch_assoc();
          $customersBooked = $customersBookedRow['booked_customers'];
        }

      
    ?>
   
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                    <h5 class="font-weight-bolder mb-0">
                    &#x20B1; <?php echo number_format($todaySales, 2); ?> <!-- Display today's sales -->
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">
                  <i class="fas fa-coins text-lg opacity-10"></i> <!-- Money icon -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Customers</p>
                    <h5 class="font-weight-bolder mb-0">
                    <?php echo $customersBooked; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">
                  <i class="fas fa-users text-lg opacity-10"></i> <!-- People icon -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                    <h5 class="font-weight-bolder mb-0">
                      +5
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">
                  <i class="fas fa-user text-lg opacity-10"></i> <!-- Single person icon -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
              <div class="card-body p-3">
                  <div class="row">
                      <div class="col-8">
                          <div class="numbers">
                              <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                              <h5 class="font-weight-bolder mb-0">
                                  &#x20B1; <?php echo number_format($totalSales, 2); ?> <!-- Display total sales -->
                              </h5>
                          </div>
                      </div>
                      <div class="col-4 text-end">
                          <div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">
                          <i class="fas fa-shopping-cart text-lg opacity-10"></i> <!-- Shopping cart icon -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Services Chart -->
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column h-100">
                        <h5 class="font-weight-bolder">Services overview</h5>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Services Chart -->
        <!-- Sales Chart -->
        <div class="col-lg-5">
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
              <!-- <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3"> -->
                <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
                <h5 class="font-weight-bolder">Sales overview</h5>
                
      </div>  
     </div>
    </div>
        <!-- End of Sales Chart -->
        <!-- Start of Queue Display -->
        <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card w-auto"> <!-- Add w-auto class here -->
            <div class="card-body p-3">
                <h5 class="font-weight-bolder">Shop Owner Dashboard</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">Upcoming Appointments</h5>
                <?php
                // Fetch upcoming appointments for the shop owner's shop
                $shop_owner_id = isset($_SESSION['id']) ? $_SESSION['id'] : ""; // Retrieve the shop owner's ID from session
                $shop_appointments_query = "SELECT appointment.*, services.service_price 
                FROM appointment 
                INNER JOIN services ON appointment.service_id = services.service_id 
                INNER JOIN shop_info ON appointment.shop_info_id = shop_info.shop_info_id
                WHERE appointment.status = 'Not Completed' AND shop_info.shop_owner_id = '$shop_owner_id'
                ORDER BY appointment.queue_number DESC";
                $shop_appointments_result = $database->query($shop_appointments_query);

                if ($shop_appointments_result->num_rows > 0) {
                    while ($row = $shop_appointments_result->fetch_assoc()) {
                        echo '<div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">';
                        echo '<div class="col-4 text-end">';
                        echo '<div class="icon icon-shape bg-gradient-custom shadow text-center border-radius-md">';
                        echo "<i>" . $row['queue_number'] . "</i>";
                        echo '<i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>';
                        echo '</div>';
                        echo '</div>';
                        echo '</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No upcoming appointments found.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- End of Queue Display -->


        <?php
            $shop_owner_id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
            // query to fetch sales data
            $dateQuery = "SELECT DATE_FORMAT(appointment.appointment_date, '%Y-%m') AS month,
            COUNT(*) AS total_appointments 
            FROM appointment 
            INNER JOIN shop_info ON appointment.shop_info_id = shop_info.shop_info_id
            WHERE appointment.status = 'Completed' 
            AND shop_info.shop_owner_id = '$shop_owner_id'
            GROUP BY MONTH(appointment.appointment_date)
            ";

            $serviceQuery = "SELECT appointment.service_id, COUNT(*) AS service_count 
            FROM appointment 
            INNER JOIN shop_info ON appointment.shop_info_id = shop_info.shop_info_id
            WHERE shop_info.shop_owner_id = '$shop_owner_id'
            GROUP BY appointment.service_id
            ";

            // database connection
            $dateResult = $database->query($dateQuery);
            $serviceResult = $database->query($serviceQuery);
            

            // Initialize an empty array to store sales data
            $salesData = array();
            $serviceData = array();

            // Loop through the query result and populate the service usage data array
            while ($row = $serviceResult->fetch_assoc()) {
                // table named 'services' to map service_id to service names
                $service_name_query = "SELECT serviceName FROM services WHERE service_id = ".$row['service_id'];
                $service_name_result = $database->query($service_name_query);
                $service_name_row = $service_name_result->fetch_assoc();
                $service_name = $service_name_row['serviceName'];

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
                  backgroundColor: 'rgba(70, 130, 180, 0.2)', // Adjust colors to match your scheme
                  borderColor: '#4682B4', // Adjust colors to match your scheme
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
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

new Chart(ctx, {
  type: "bar",
  data: {
    labels:<?php echo json_encode($months); ?>,
    datasets: [{
      label: "Sales",
      tension: 0.4,
      borderWidth: 0,
      borderRadius: 4,
      borderSkipped: false,
      backgroundColor: "#fff",
      data: <?php echo json_encode($sales); ?>,
      maxBarThickness: 6
    }, ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      }
    },
    interaction: {
      intersect: false,
      mode: 'index',
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
        },
        ticks: {
          suggestedMin: 0,
          suggestedMax: 500,
          beginAtZero: true,
          padding: 15,
          font: {
            size: 14,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
          color: "#fff"
        },
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false
        },
        ticks: {
          display: false
        },
      },
    },
  },
});
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(70, 130, 180, 0.2)'); // Adjust colors to match your scheme
    gradientStroke1.addColorStop(0.2, 'rgba(72, 72, 176, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(70, 130, 180, 0)'); // Adjust colors to match your scheme

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(20, 23, 39, 0.2)'); // Adjust colors to match your scheme
    gradientStroke2.addColorStop(0.2, 'rgba(72, 72, 176, 0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20, 23, 39, 0)'); // Adjust colors to match your scheme

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: <?php echo json_encode($services); ?>,
        datasets: [{
            label: "Automobile",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#4682B4",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: <?php echo json_encode($usageCounts); ?>,
            maxBarThickness: 6

          },
        //   {
        //     label: "Motorcycle",
        //     tension: 0.4,
        //     borderWidth: 0,
        //     pointRadius: 0,
        //     borderColor: "#3A416F",
        //     borderWidth: 3,
        //     backgroundColor: gradientStroke2,
        //     fill: true,
        //     data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
        //     maxBarThickness: 6
        //   },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    </script>
     <script>
        function updateTime() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            var timeString = hours + ':' + minutes + ':' + seconds;
            document.getElementById('system-time').textContent = timeString;
        }

        // Update time every second
        setInterval(updateTime, 1000);

        // Call updateTime once to initialize the time
        updateTime();
    </script>
    <script>
      function menuToggle() {
        const toggleMenu = document.querySelector(".menu");
        toggleMenu.classList.toggle("active");
      }
    </script>
</body>
</html>
