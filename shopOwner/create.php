<?php
include("../connection.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you are getting the shop_owner_id from a session variable
    session_start();
    if(isset($_SESSION['id'])) {
        $shop_owner_id = $_SESSION['id'];
    } else {
        // If not available in session, handle accordingly (e.g., redirect to login)
        die("Error: Shop owner ID not available.");
    }

    $shop_name = $_POST["shop_name"];
    $location = $_POST["location"];
    $operating_from = $_POST["operating_from"];
    $operating_to = $_POST["operating_to"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
   
    // Inserting data directly into the database
    $insertQuery = "INSERT INTO shop_info (shop_owner_id, shop_name, location, operating_from, operating_to,longitude, latitude)
                    VALUES ('$shop_owner_id', '$shop_name', '$location', '$operating_from', '$operating_to', '$longitude','$latitude')";

    if ($database->query($insertQuery) === TRUE) {
        echo"
        <div class='alert-success'><span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        Shop added successfully!
        </div
        
        
        ";
        // $alertMessage = "Shop added successfully!2";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $database->error;
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
          
            <!-- Include Chart.js library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <!-- Include HERE Maps JavaScript API -->
 <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

    <link rel="stylesheet" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
            <!-- Stylesheet -->
            <link href="../css/style.css" rel="stylesheet">
        <link href="../css/ui-dashboard.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
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
        #mapContainer {
            height: 400px;
            width: 100%;
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
<?php

$shop_owner_id = isset($_SESSION['id']) ? trim($_SESSION['id']) : '';
$resultName = $database->query("SELECT first_name, last_name FROM shop_owners WHERE shop_owner_id = '$shop_owner_id' ");
if ($resultName->num_rows > 0) {
  $user = $resultName->fetch_assoc();
  $userFirstName = $user['first_name'];
  $userLastName = $user['last_name'];
}$database->close();
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
                <h3><?php echo "$userFirstName $userLastName";   ?><br /><span>Shop Owner</span></h3>
                  <ul>
                    <li>
                      <img src="../assets/icons/user.png" /><a href="#">My profile</a>
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
    <div class="container my-5">
    <a class="btn btn-custom" href="addShop.php" role="button">Back</a>
    <div class="section-title">
        <h2>Add Carwash Shop</h2>
    </div>    
    
    <form action="" method="post">
        <div class="mb-3">
            <label for="shop_name" class="form-label">Shop Name</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="operating_from" class="form-label">Operating From</label>
            <input type="time" class="form-control" id="operating_from" name="operating_from" required>
        </div>
        <div class="mb-3">
            <label for="operating_to" class="form-label">Operating To</label>
            <input type="time" class="form-control" id="operating_to" name="operating_to" required>
        </div>
        <h1>Add to map</h1>
        <div id="mapContainer"></div>
        <button id="saveLocationBtn" type="button" class="btn btn-custom">Add Shop</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var map;
    var defaultLayers;
    var platform;
    var behavior;
    var longTapTimer;

    function initMap() {
        // initialize platform
        platform = new H.service.Platform({
            'apikey': 'xzrMvhwIvXQkL4ODYBNn02k3U2AL1aC974XXIb6M9Eo' 
        });

        // obtain the default map types from the platform object
        defaultLayers = platform.createDefaultLayers();

        // initialize map object
        map = new H.Map(
            document.getElementById('mapContainer'),
            defaultLayers.vector.normal.map,
            {
                center: { lat: 12.8797, lng: 121.774 },
                zoom: 6, 
                pixelRatio: window.devicePixelRatio || 1
            }
        );

        // map interaction
        var mapEvents = new H.mapevents.MapEvents(map);
        behavior = new H.mapevents.Behavior(mapEvents);
        var ui = H.ui.UI.createDefault(map, defaultLayers);

        // event listener to the map for long tap to drop a pin
        map.addEventListener('pointerdown', function (evt) {
            longTapTimer = setTimeout(function() {
                var coord = map.screenToGeo(evt.currentPointer.viewportX, evt.currentPointer.viewportY);
                addMarker(coord.lat, coord.lng);
            }, 500); // Set the duration for long tap in milliseconds
        });

        map.addEventListener('pointerup', function () {
            clearTimeout(longTapTimer);
        });
    }

    // add a marker at a specified location
    function addMarker(latitude, longitude) {
        // remove existing marker if any
        map.removeObjects(map.getObjects());

        // add a marker to the map
        var marker = new H.map.Marker({ lat: latitude, lng: longitude });
        map.addObject(marker);

        // update map center
        map.setCenter({ lat: latitude, lng: longitude });
    }

    // handle saving the location
    function saveLocation() {
        var coord = map.getCenter();
        var latitude = coord.lat;
        var longitude = coord.lng;
        var shopName = document.getElementById('shop_name').value;
        var location = document.getElementById('location').value;
        var operating_from = document.getElementById('operating_from').value;
        var operating_to = document.getElementById('operating_to').value;

        // Inserting latitude, longitude, and shop name directly into the database
        $.ajax({
            url: '', // Leave empty as it points to the same script
            type: 'POST',
            data: {
                latitude: latitude,
                longitude: longitude,
                shop_name: shopName,
                location: location,
                operating_from: operating_from,
                operating_to: operating_to
            },
            success: function(response) {
                alert('Shop added successfully!');
                console.log(latitude);
                console.log(longitude);
                console.log(shopName);
                console.log(location);
                console.log(operating_from);
                console.log(operating_to);
            },
            error: function(xhr, status, error) {
                alert('Error adding shop: ' + error);
            }
        });
    }

    // load the HERE Map after page is fully loaded
    window.addEventListener('load', initMap);

    // event listener to the Save Location button
    document.getElementById('saveLocationBtn').addEventListener('click', saveLocation);
</script>
    <script>
        // Get all elements with class="closebtn"
        var close = document.getElementsByClassName("closebtn");
        var i;

        // Loop through all close buttons
        for (i = 0; i < close.length; i++) {
        // When someone clicks on a close button
        close[i].onclick = function(){

            // Get the parent of <span class="closebtn"> (<div class="alert">)
            var div = this.parentElement;

            // Set the opacity of div to 0 (transparent)
            div.style.opacity = "0";

            // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
        }
    </script>
</body>
</html>
