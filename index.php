<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Wash Booking System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Your Instant Car Wash</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#">Sign In</a> -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#signIn">Sign in</button>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#">Sign Up</a> -->&nbsp
                        
                    </li><button type="button" class="btn btn-custom" data-toggle="modal" data-target="#signUp">Sign up</button>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal for Sign in -->
<div id="signIn" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Sign In </h4>
            </div>
            <div class="modal-body">
                <center>
                <div class="container">
                    <table border="0" style="margin: 0;padding: 0;width: 60%;">
                        <tr>
                            <td>
                            <p class="header-text" style="text-align: center; font-size: 25px; font-weight: bold;">Welcome Back!</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: justify; font-size: 15px;">
                                <p class="sub-text">Login with your details to continue</p>
                            </td>
                        </tr>
                        <tr>
                            
                            <form action="signin.php" method="post"> <!-- Corrected form action -->
                                <td class="label-td">
                                    <label for="email" class="form-label">Email: </label>
                                </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <input type="email" name="email" class="input-text" placeholder="Email Address" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <label for="password" class="form-label">Password: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <input type="password" name="password" class="input-text" placeholder="Password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Login" class="login-btn btn-primary btn">
                            </td>
                        </tr>
                        </form>
                        
                        <tr>
                            <td>
                                <br>
                                <label for="" class="sub-text" style="font-weight: 280;">Don't have an account? </label>
                                <a href="choose_account_type.php" class="hover-link1 non-style-link" data-toggle="modal" data-target="#signUp">Sign Up</a>
                                <br><br><br>
                            </td>
                        </tr>
                    </table>
                </div>
            </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal for Sign up -->
<div id="signUp" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sign up</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="./createAccount/save_user_type.php" method="POST" id="signups-form">
                        <div class="col-sm-4">
                            <select class="form-control" name="userType" id="userType"  onchange="handleUserType(this.value)" required>
                                <option value="">Select User Type</option>
                                <option value="shop_owner">Shop Owner</option>
                                <option value="vehicle_owner">Vehicle Owner</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-custom">Next</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <p class="sub-text" style="font-weight: 280;">Already have an account? <a href="login.php" class="hover-link1 non-style-link">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-custom" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
   <!-- Shop Owner Modal -->
<div id="shopOwnerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Shop Owner Details</h4>
            </div>
            <form action="./createAccount/save_user_type.php" method="POST" id="signup-form"> <!-- Add form tag here -->
                <div class="modal-body">
                    <!-- Form fields for shop owner -->
                    <div class="col-sm-4">
                    </div>

                    <select class="form-control" name="userType" id="userType"  onload="handleUserType(this.value)" required>

                            <option value="shop_owner">Shop Owner</option>
                        </select>
                            
                    <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label">First Name:</label>
                        <div class="col-sm-4">
                            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <label for="lname" class="col-sm-2 col-form-label">Last Name:</label>
                        <div class="col-sm-4">
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number:</label>
                        <div class="col-sm-10">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-sm-10" style="position: relative;">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <img id="toggle-icon" class="password-toggle-icon" src="https://img.icons8.com/material-outlined/24/000000/invisible--v1.png" onclick="togglePasswordVisibility()" alt="Toggle Password Visibility" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-custom">Next</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    <!-- Other fields for shop owner -->
                </div>
            </form> <!-- Close form tag here -->
            <div class="modal-footer">
                <!-- Shop owner modal footer -->
                <button class="btn btn-custom" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Vehicle Owner Modal -->
<div id="vehicleOwnerModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Vehicle Owner Details</h4>
            </div>
            <form action="./createAccount/save_user_type.php" method="POST" id="signup-form"> <!-- Add form tag here -->
            <div class="modal-body">
                <!-- Form fields for vehicle owner -->
                <div>
                    <!-- Additional fields for vehicle owner -->
                    <!-- Add your vehicle information fields here -->
                    <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label">First Name:</label>
                        <div class="col-sm-4">
                            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <label for="lname" class="col-sm-2 col-form-label">Last Name:</label>
                        <div class="col-sm-4">
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number:</label>
                        <div class="col-sm-10">
                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-sm-10" style="position: relative;">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <img id="toggle-icon" class="password-toggle-icon" src="https://img.icons8.com/material-outlined/24/000000/invisible--v1.png" onclick="togglePasswordVisibility()" alt="Toggle Password Visibility" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Vehicle Information:</label>
                        <div class="col-sm-10">
                            <select name="vehicle_type" class="form-control" required>
                                <option value="">Select Vehicle Type</option>
                                <option value="Automobile">Automobile</option>
                                <option value="Motorcycle">Motorcycle</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label">Brand:</label>
                        <div class="col-sm-10">
                            <select name="brand" class="form-control" required>
                                <option value="">Select Brand</option>
                                <option value="Nissan">Nissan</option>
                                <option value="Kia">Kia</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Mazda">Mazda</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Ford">Ford</option>
                                <option value="Hyundai">Hyundai</option>
                                <option value="Isuzu">Isuzu</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Honda">Honda</option>
                                <option value="Geely">Geely</option>
                                <option value="MG">MG</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="model" class="col-sm-2 col-form-label">Vehicle Model:</label>
                        <div class="col-sm-4">
                            <input type="text" name="model" class="form-control" placeholder="Vehicle Model" required>
                        </div>
                        <label for="vehicle_year" class="col-sm-2 col-form-label">Year:</label>
                        <div class="col-sm-4">
                            <input type="text" name="vehicle_year" class="form-control" placeholder="Year" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="license_plate" class="col-sm-2 col-form-label">License Plate:</label>
                        <div class="col-sm-4">
                            <input type="text" name="license_plate" class="form-control" placeholder="License Plate" required>
                        </div>
                        <label for="vehicle_size" class="col-sm-2 col-form-label">Size:</label>
                        <div class="col-sm-4">
                            <select name="vehicle_size" class="form-control" required>
                                <option value="">Select Size</option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="color" class="col-sm-2 col-form-label">Color:</label>
                        <div class="col-sm-4">
                            <select name="color" class="form-control" required>
                                <option value="">Select Color</option>
                                <option value="Black">Black</option>
                                <option value="White">White</option>
                                <option value="Silver">Silver</option>
                                <option value="Grey">Grey</option>
                                <option value="Blue">Blue</option>
                                <option value="Red">Red</option>
                                <option value="Yellow">Yellow</option>
                            </select>
                        </div>
                       
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-custom">Next</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <p class="sub-text" style="font-weight: 280;">Already have an account? <a href="login.php" class="hover-link1 non-style-link">Login</a></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-custom" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
                <!-- Other fields for vehicle owner -->
            </div>
            
        </div>
    </div>

    <!--MODAL COPY AND PASTE-->
    <div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="message-modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="mesasge-modal-body">
              <!--MESSAGE-->
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>


      <?php 
        if(!empty($_SESSION['login_message']) && $_SESSION['login_message'] !== 'success')
        {
      ?>
            <div class="modal fade" id="signin-message-modal" >
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="sign-in-message-modal-title">SIGN IN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="sign-in-mesasge-modal-body text-center p-5">
                        <?= $_SESSION['login_message'] ?>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
                </div>
            </div>
            <script>
                $('#signin-message-modal').modal('show');
            </script>
      <?php
        }
      ?>
</div>

    <header class="jumbotron text-center">
        <div class="container">
            <h1 class="display-1">Book Your Car Wash Appointment</h1>
            <p class="lead">Convenient, Fast, and Reliable</p>
            <!-- <a href="#" class="btn btn-primary btn-lg">Book Appointment</a> -->
            <div class="ml-auto">
                <a class="btn btn-custom" data-toggle="modal" data-target="#signIn">Get Appointment</a>
            </div>
        </div>
    </header>
    
    <footer class="bg-dark text-white py-4" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: red; color: white; text-align: center;">
        <div class="container text-center">
            <p>&copy; 2024 Car Wash Booking System</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var icon = document.getElementById("toggle-icon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.setAttribute("src", "https://img.icons8.com/material-outlined/24/000000/visible--v1.png");
            } else {
                passwordInput.type = "password";
                icon.setAttribute("src", "https://img.icons8.com/material-outlined/24/000000/invisible--v1.png");
            }
        }
    </script>
     <script>
        function handleUserType(userType) {
    // Send an HTTP request to the server-side script with the selected user type
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_user_type.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle response from the server if needed
            console.log(xhr.responseText);
        }
    };

    // Get form data
    var form = document.getElementById("signup-form");
    var formData = new FormData(form);

    // Append user type to form data
    formData.append("userType", userType);

    // Send form data as JSON
    xhr.send(JSON.stringify(Object.fromEntries(formData.entries())));
}

    </script>
<script>
    // Check if the URL contains the query parameter "signup=success"
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.has('signup') && urlParams.get('signup') === 'success' ? "Successful! Please Log in to continue" : urlParams.get('signup');
    if(urlParams.has('signup')){
        // modal changes
        $('.message-modal-title').text('Sign Up');
        $('.mesasge-modal-body').html(`<div class="text-center py-5"> ${message} </div>`)
        $('#message-modal').modal('show');
    }
</script>

<script>
    function handleUserType(userType) {
    if (userType === 'shop_owner') {
        $('#modal-placeholder').html($('#shopOwnerModal').html());
        $('#shopOwnerModal').modal('show');
        
        // Close the main modal
        $('#signUp').modal('hide');
    } else if (userType === 'vehicle_owner') {
        $('#modal-placeholder').html($('#vehicleOwnerModal').html());
        $('#vehicleOwnerModal').modal('show');
        
        // Close the main modal
        $('#signUp').modal('hide');
    } else {
        $('#modal-placeholder').html('');
    }
}

</script>
<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>
</html>
