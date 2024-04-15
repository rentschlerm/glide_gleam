<?php
session_start();

include('connection.php');

// Unset all the server-side variables
session_unset();


// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;
// Import database


if ($_POST) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $error = '<label for="promter" class="form-label"></label>';

    $result = $database->query("SELECT * FROM accounts WHERE email='$email'");
    // $resultAdmin = $database->query("SELECT * FROM admin WHERE email='$email'");

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $utype = $user['type'];
    
        // Check user type
        if ($utype == '1') {
            // Car wash owner login
            $checker = $database->query("SELECT * FROM accounts WHERE email='$email' AND password='$password' AND type='1'");
            if ($checker->num_rows == 1) {
                $user = $checker->fetch_assoc();
                // Car wash owner dashboard
                $_SESSION['user'] = $email;
                $_SESSION['type'] = '1';
                $_SESSION['id'] = $user['account_id']; // Get shop_owner_id here
                header("location: shopOwner/index.php");
    
                
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        } elseif ($utype == '2') {
            // Car owner login
            $checker = $database->query("SELECT * FROM accounts WHERE email='$email' AND password='$password' AND type='2'");
            if ($checker->num_rows == 1) {
                // Car owner dashboard
                $carOwnerData = $checker->fetch_assoc();
                $_SESSION['id'] = $carOwnerData['account_id'];
                $_SESSION['user'] = $email;
                $_SESSION['type'] = '2';
                header("location: vehicleOwner/index.php");
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Invalid user type</label>';
        }
    } elseif ($resultAdmin->num_rows == 1) {
        // Admin login
        $admin = $resultAdmin->fetch_assoc();
        $checker = $database->query("SELECT * FROM admin WHERE email='$email' AND password='$password' AND type='admin'");
        if ($checker->num_rows == 1) {
            // Admin dashboard
            $_SESSION['user'] = $email;
            $_SESSION['type'] = 'admin';
            header('location: admin/index.php');
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
        }
    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
    }
} else {
    $error = '<label for="promter" class="form-label">&nbsp;</label>';
}
?>