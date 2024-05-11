<?php
include("../connection.php");

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
    $insertQuery = "INSERT INTO shop_info (shop_owner_id, shop_name, location, operating_from, operating_to, longitude, latitude)
                    VALUES ('$shop_owner_id', '$shop_name', '$location', '$operating_from', '$operating_to', '$longitude', '$latitude')";

    if ($database->query($insertQuery) === TRUE) {
        $alertMessage = "Shop added successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $database->error;
    }
}


$database->close();
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
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
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
        .mb-3{
            color:white;
        }
        #mapContainer {
            height: 400px;
            width: 100%;
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
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addShop.php">Shop</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="../signout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">
    <a class="btn btn-primary" href="addShop.php" role="button">Back</a>
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
        <button id="saveLocationBtn" type="button" class="btn btn-primary">Save Location</button>

        <button type="submit" class="btn btn-primary">Add Shop</button>
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

</body>
</html>
