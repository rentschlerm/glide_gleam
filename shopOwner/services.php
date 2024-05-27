<?php
session_start();
include("../connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Your additional CSS styles -->
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

        .top-bar {
            background-color: #4682B4; /* Accent Color */
            color: #FFF; /* Text color for top bar */
        }

        .top-bar-item h3 {
            color: #FFF; /* Text color for top bar headings */
        }

        .top-bar-item p {
            color: #F2F2F2; /* Text color for top bar content */
        }

        .nav-bar {
            background-color: #4682B4; /* Accent Color */
        }
        /* Table Row Colors */
        tbody tr:nth-child(even) {
            background-color: #E6E6E6; /* Light Gray */
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF; /* White */
        }
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

    
    <div class="container mt-4">
        <a class="btn btn-custom" href="index.php" role="button">Back</a>
        <a class="btn btn-custom" href="addServices.php" role="button">Add a Service</a>
    </div>

    <!-- Services Table -->
    <div id="servicesTable" class="container mt-4">
        <div class="section-title">
            <h2>Services</h2>
        </div>
        <div class="table-responsive">
            <div class="text-center">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="sortable" data-column="service_name">Service Name <span class="arrow-up">&#9650;</span><span class="arrow-down">&#9660;</span></th>
                        <th class="sortable" data-column="vehicle_size">Vehicle Size <span class="arrow-up">&#9650;</span><span class="arrow-down">&#9660;</span></th>
                        <th class="sortable" data-column="service_price">Price <span class="arrow-up">&#9650;</span><span class="arrow-down">&#9660;</span></th>
                        <th class="sortable" data-column="vehicle_type">Vehicle Type <span class="arrow-up">&#9650;</span><span class="arrow-down">&#9660;</span></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php
                        if($database->connect_error) {
                            die("Connection Failed:" . database->connect_error);
                        }
                    
                        // Display Services table
                        $shop_owner_id = $_SESSION['id'];
                        $query_shop_info_id = "SELECT shop_info_id FROM shop_info WHERE shop_owner_id = '$shop_owner_id'";
                        $result_shop_info_id = $database->query($query_shop_info_id);
                        $row_shop_info_id = $result_shop_info_id->fetch_assoc();
                        $shop_info_id = $row_shop_info_id['shop_info_id'];

                        $sql2 = "SELECT * FROM services WHERE shop_info_id = '$shop_info_id'";
                        $result2 = $database->query($sql2);

                        if (!$result2) {
                            die("Invalid query: " . $database->error);
                        }

                     while ($row = $result2->fetch_assoc()) {
                            echo "
                            <tr>
                                <td data-column='service_name'>{$row['serviceName']}</td>
                                <td data-column='vehicle_size'>{$row['vehicle_size']}</td>
                                <td data-column='service_price'>{$row['service_price']}</td>
                                <td data-column='vehicle_type'>{$row['vehicle_type']}</td>
                                
                                <td class='action-btns'>
                                    <a class='btn btn-custom' href='/glide_gleam/shopOwner/editServices.php?service_id={$row['service_id']}'>
                                        <i class='fas fa-edit fa-sm'></i> <!-- Edit icon -->
                                    </a>
                                    <a class='btn btn-custom' href='/glide_gleam/shopOwner/deleteServices.php?service_id={$row['service_id']}'>
                                        <i class='fas fa-trash-alt fa-sm'></i> <!-- Delete icon -->
                                    </a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <!-- Bootstrap and other JS libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Function to reload services table
        function reloadServicesTable() {
            // Fetch the updated data
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>') // Replace 'get_services.php' with the URL of the script that fetches updated data
                .then(response => response.text())
                .then(data => {
                    // Replace the content of the services table
                    document.getElementById('servicesTable').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Call the function after successful form submission
        // Assuming the form submission is handled using AJAX and you have a success callback
        function handleFormSubmission() {
            // Assuming the form submission is successful
            reloadServicesTable(); // Call the function to reload the services table
        }
    </script>
    <!-- Script to sort the tables -->
   <script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Script loaded successfully.");

        let table = document.querySelector("table");
        if (!table) {
            console.error("Table element not found.");
            return;
        }

        let tbody = table.querySelector("tbody");
        if (!tbody) {
            console.error("Tbody element not found.");
            return;
        }

        let headers = table.querySelectorAll("th.sortable");
        if (!headers || headers.length === 0) {
            console.error("Sortable headers not found.");
            return;
        }

        headers.forEach(header => {
            header.addEventListener("click", () => {
                let column = header.dataset.column;
                let sortOrder = header.dataset.order || "asc";

                sortOrder = sortOrder === "asc" ? "desc" : "asc";
                header.dataset.order = sortOrder;

                // Reset arrow icons in all other column headers
                headers.forEach(otherHeader => {
                    if (otherHeader !== header) {
                        otherHeader.querySelector(".arrow-up").style.display = "none";
                        otherHeader.querySelector(".arrow-down").style.display = "none";
                    }
                });

                let arrows = header.querySelectorAll("span");
                arrows.forEach(arrow => arrow.style.display = "none");
                header.querySelector(sortOrder === "asc" ? ".arrow-up" : ".arrow-down").style.display = "inline";

                sortTable(column, sortOrder);
            });
        });
    });

    function sortTable(column, order) {
        let rows = Array.from(document.querySelectorAll("tbody tr"));

        rows.sort((a, b) => {
            let aValueElement = a.querySelector(`td[data-column='${column}']`);
            let bValueElement = b.querySelector(`td[data-column='${column}']`);

            // Check if the queried elements exist
            if (!aValueElement || !bValueElement) {
                return 0; // Return 0 to indicate equal values
            }

            let aValue = aValueElement.textContent.trim();
            let bValue = bValueElement.textContent.trim();

            // Sort alphabetically for Service Name and Vehicle Type
            if (column === "service_name" || column === "vehicle_type") {
                return order === "asc" ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            }
            
            // Sort numerically for Price
            if (column === "service_price") {
                let aPrice = parseFloat(aValue.replace("$", ""));
                let bPrice = parseFloat(bValue.replace("$", ""));
                return order === "asc" ? aPrice - bPrice : bPrice - aPrice;
            }
            
            // Custom sorting for Vehicle Size
            if (column === "vehicle_size") {
                const sizeOrder = { "Small": 1, "Medium": 2, "Large": 3 };
                return order === "asc" ? sizeOrder[aValue] - sizeOrder[bValue] : sizeOrder[bValue] - sizeOrder[aValue];
            }
        });

        let tbody = document.querySelector("tbody");
        tbody.innerHTML = "";
        rows.forEach(row => {
            tbody.appendChild(row);
        });
    }
</script>
</body>
</html>
