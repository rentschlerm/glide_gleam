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
            $checker = $database->query("SELECT * FROM accounts WHERE email='$email' AND type='1'");
            if ($checker->num_rows == 1) {
                $user = $checker->fetch_assoc();
                $userPassword = $user['password'];
                if(password_verify($password, $userPassword)) {
                    // Car wash owner dashboard
                    $_SESSION['user'] = $email;
                    $_SESSION['type'] = '1';
                    $_SESSION['id'] = $user['account_id']; // Get shop_owner_id here
                    $_SESSION['login_message'] = 'success';
                    header("location: shopOwner/index.php");
                }else{
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Incorrect password</label>';
                    $_SESSION['login_message'] = $error;
                    header("location: index.php");
                }
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                $_SESSION['login_message'] = $error;
                header("location: index.php");
            }
        } elseif ($utype == '2') {
            // Car owner login
            $checker = $database->query("SELECT * FROM accounts WHERE email='$email' AND type='2'");
            $userPassword = $user['password'];
            if ($checker->num_rows == 1) {
                if(password_verify($password, $userPassword)) {
                    // Car owner dashboard
                    $carOwnerData = $checker->fetch_assoc();
                    $_SESSION['id'] = $carOwnerData['account_id'];
                    $_SESSION['user'] = $email;
                    $_SESSION['type'] = '2';
                    header("location: vehicleOwner/index.php");
                }else{
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Incorrect password</label>';
                    $_SESSION['login_message'] = $error;
                    header("location: index.php");
                }
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                $_SESSION['login_message'] = $error;
                header("location: index.php");
            }
        }
        elseif ($utype == 0) {
            // Admin login
            $admin = $resultAdmin->fetch_assoc();
            $checker = $database->query("SELECT * FROM admin WHERE email='$email' AND password='$password' AND type='admin'");
            if ($checker->num_rows == 1) {
                if(password_verify($password, $userPassword)) {
                    // Admin dashboard
                    $_SESSION['user'] = $email;
                    $_SESSION['type'] = 'admin';
                    $_SESSION['login_message'] = 'success';
                    header('location: admin/index.php');
                }else{
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Incorrect password</label>';
                    $_SESSION['login_message'] = $error;
                    header("location: index.php");
                }
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                $_SESSION['login_message'] = $error;
                header("location: index.php");
            }
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
            $_SESSION['login_message'] = $error;
            header("location: index.php");
        }
    }else{
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
        $_SESSION['login_message'] = $error;
        header("location: index.php");
    }
} else {
    $error = '<label for="promter" class="form-label">&nbsp;</label>';
    $_SESSION['login_message'] = $error;
    header("location: index.php");
}
?>