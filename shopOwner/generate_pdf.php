<?php
// Start the session
session_start();


// Check if 'id' is set in the session
if (!isset($_SESSION['id'])) {
    // Handle the case when 'id' is not set, redirect or show an error message
    die("Error: Session ID not found.");
}

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

// Function to generate PDF report
function generatePDFReport($conn)
{
    // Function to generate table rows based on filtered data
    function generateRows($conn)
    {
        $rows = '';
        // Get the shop owner ID from the session
        $shopOwnerId = $_SESSION['id']; // Store the session ID in a variable

        // SQL query with prepared statement to prevent SQL injection
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
                WHERE shop_info.shop_owner_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $shopOwnerId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $rows .= "<tr>";
            // Add table data here according to your requirements
            // Example:
            
            $rows .= "<td>{$row['first_name']}</td>" ;
            $rows .= "<td>{$row['shop_name']}</td>";
            $rows .= "<td>{$row['brand']}</td>";
            $rows .= "<td>{$row['model']}</td>";
            $rows .= "<td>{$row['vehicle_year']}</td>";
            $rows .= "<td>{$row['license_plate']}</td>";
            $rows .= "<td>{$row['color']}</td>";
            $rows .= "<td>{$row['vehicle_type']}</td>";
            $rows .= "<td>{$row['serviceName']}</td>";
            $rows .= "<td>{$row['service_price']}</td>";
            $rows .= "<td>{$row['appointment_date']}</td>";
            $rows .= "<td>{$row['status']}</td>";

            

            // Add other columns similarly
            $rows .= "</tr>";
        }
        return $rows;
    }

    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle("Carwash Shop Reports");
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('times');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '3', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('times', '', 10);
    $pdf->AddPage();
    
    // Set the default timezone to Philippines
    date_default_timezone_set('Asia/Manila');
    // Get the current date and format it
    $current_date = date('F d, Y');
    // Construct the PDF content
    $content = '';
    $content .= '
        <h2 style="margin: 20; text-align: center;">Glide_Gleam</h2>
        <p style="margin: 0; text-align: center;">CARWASH SHOP</p>
        <p style="margin-top: 0px; text-align: center;">Reports</p>
        <p style="margin: 0; text-align: center;">' . $current_date . '</p>
        
        <table border="1" cellspacing="0" cellpadding="3">
            <tr align="center">
                
                <th>Customer Name</th>      
                <th>Shop Name</th>
                <th>Vehicle Brand</th>
                <th>Vehicle Model</th>
                <th>Vehicle Year</th>
                <th>License Plate</th>
                <th>Vehicle Color</th>
                <th>Vehicle Type</th>
                <th>Selected Service</th>
                <th>Service Price</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
    ';

    $content .= generateRows($conn);
    $content .= '</table>';

    // Calculate total sales for completed appointments only
    $totalSales = 0;
    $sqlTotal = "SELECT SUM(services.service_price) AS total_sales
                 FROM appointment 
                 JOIN services ON services.service_id = appointment.service_id
                 WHERE appointment.status = 'Completed'
                 AND appointment.shop_info_id IN (SELECT shop_info_id FROM shop_info WHERE shop_owner_id = ?)";
    $stmtTotal = $conn->prepare($sqlTotal);
    $stmtTotal->bind_param("i", $_SESSION['id']);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $totalRow = $resultTotal->fetch_assoc();
    $totalSales = $totalRow['total_sales'];

    // Add total sales section
    $content .= '<p>Total Sales of Completed Appointments: ' . $totalSales . '</p>';

    // Write the HTML content to the PDF and output it
    $pdf->writeHTML($content);
    $pdf->Output('Reports.pdf', 'I');
}

// Generate PDF report
generatePDFReport($conn);
?>
