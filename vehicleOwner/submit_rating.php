<?php
// Start the session at the very beginning of the file
session_start();

// Import database connection
include("../connection.php");

// Check if the user is logged in and has the correct type
if(isset($_SESSION["user"]) && $_SESSION['type'] == '2'){
    $useremail = $_SESSION["user"];
} else {
    // Redirect to login page if user is not logged in or has incorrect type
    header("location: ../index.php");
    exit(); // Terminate script execution after redirection
}

// Check if rating data is submitted along with appointment_id
if(isset($_POST["rating_data"], $_POST["appointment_id"], $_POST["user_name"], $_POST["user_review"]))
{
    // Sanitize data
    $appointment_id = $database->real_escape_string($_POST["appointment_id"]);
    $user_name = $database->real_escape_string($_POST["user_name"]);
    $user_rating = $database->real_escape_string($_POST["rating_data"]);
    $user_review = $database->real_escape_string($_POST["user_review"]);

    // Insert rating and review into the database
    $sql = "INSERT INTO review_table (appointment_id, user_name, user_rating, user_review, datetime) 
            VALUES ('$appointment_id', '$user_name', '$user_rating', '$user_review', NOW())";

    // Execute SQL query
    $result = $database->query($sql);

    // Check for errors
    if ($result === false) {
        die("Error executing query: " . $database->error);
    }

    echo "Your Review & Rating Successfully Submitted";
}

// Check if action is requested
if(isset($_POST["action"]))
{
    // Initialize variables
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    // Prepare SQL query to fetch reviews
    $query = "
    SELECT * FROM review_table 
    ORDER BY review_id DESC
    ";

    // Execute query and fetch results
    $result = $database->query($query);

    // Loop through fetched results
    foreach($result as $row)
    {
        // Add review details to content array
        $review_content[] = array(
            'user_name'     =>  $row["user_name"],
            'user_review'   =>  $row["user_review"],
            'rating'        =>  $row["user_rating"],
            'datetime'      =>  date('l jS, F Y h:i:s A', strtotime($row["datetime"])) // Convert datetime to readable format
        );

        // Increment count for each star rating
        switch ($row["user_rating"]) {
            case '5':
                $five_star_review++;
                break;
            case '4':
                $four_star_review++;
                break;
            case '3':
                $three_star_review++;
                break;
            case '2':
                $two_star_review++;
                break;
            case '1':
                $one_star_review++;
                break;
        }

        // Increment total review count and total user rating
        $total_review++;
        $total_user_rating += $row["user_rating"];
    }

    // Calculate average rating
    if($total_review > 0) {
        $average_rating = $total_user_rating / $total_review;
    }

    // Prepare output array
    $output = array(
        'average_rating'    =>  number_format($average_rating, 1),
        'total_review'      =>  $total_review,
        'five_star_review'  =>  $five_star_review,
        'four_star_review'  =>  $four_star_review,
        'three_star_review' =>  $three_star_review,
        'two_star_review'   =>  $two_star_review,
        'one_star_review'   =>  $one_star_review,
        'review_data'       =>  $review_content
    );

    // Output JSON encoded data
    header('Content-Type: application/json');
    echo json_encode($output);
}
?>
