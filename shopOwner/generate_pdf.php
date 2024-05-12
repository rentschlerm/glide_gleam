<?php
// Start the session
session_start();

// Check if 'id' is set in the session
if (!isset($_SESSION['id'])) {
    // Handle the case when 'id' is not set, redirect or show an error message
    die("Error: Session ID not found.");
}

// Backend logic to generate PDF report

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carwash";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the shop owner ID from the session
$shopOwnerId = $_SESSION['id']; // Store the session ID in a variable

// SQL query
$sql = "SELECT appointment.*, 
                vehicle_owners.*, 
                shop_info.*, 
                services.serviceName, 
                services.service_price, 
                services.vehicle_type
            FROM appointment 
            JOIN vehicle_owners ON appointment.vehicle_owner_id = vehicle_owners.vehicle_owner_id 
            JOIN shop_info ON shop_info.shop_info_id = appointment.shop_info_id 
            JOIN services ON services.service_id = appointment.service_id
            WHERE shop_info.shop_owner_id = $shopOwnerId
            AND appointment.status = 'Not Completed'";
$result = $conn->query($sql);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Carwash Shop Reports');
$pdf->SetSubject('Report Subject');
$pdf->SetKeywords('Report, PDF, Example, PHP');

// Add a page
$pdf->AddPage();

// Set current date
$currentDate = date('Y-m-d');

// Set some content to display
$html = '<h1>GLIDE_GLEAM</h1>';
$html .= '<p>Report Date: ' . $currentDate . '</p>'; // Add current date

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    $html .= '<table border="1">
                    <tr>
                        <th>Appointment ID</th>
                        <th>Owner Name</th>
                        <th>Vehicle Model</th>
                        <th>Service Name</th>
                        <th>Service Price</th>
                        <th>Vehicle Type</th>
                    </tr>';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                        <td>' . $row["appointment_id"] . '</td>
                        <td>' . $row["owner_name"] . '</td>
                        <td>' . $row["vehicle_model"] . '</td>
                        <td>' . $row["serviceName"] . '</td>
                        <td>' . $row["service_price"] . '</td>
                        <td>' . $row["vehicle_type"] . '</td>
                    </tr>';
    }
    $html .= '</table>';
} else {
    $html .= '<p>No Reports as of Today.</p>';
}

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('report.pdf', 'I');

// Close connection
$conn->close();
?>
