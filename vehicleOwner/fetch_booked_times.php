<?php
include("../connection.php");

if ($_POST['appointmentDate'] && $_POST['shop_id']) {
    $date = $_POST['date'];
    $shopId = $_POST['shop_id'];

    $sql = "SELECT appointment_time, status FROM appointment WHERE appointment_date = '$date' AND shop_info_id = '$shopId'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        $bookedTimesAndStatus = [];
        while ($row = $result->fetch_assoc()) {
            $bookedTimesAndStatus[$row['appointment_time']] = $row['status'];
        }
        echo json_encode($bookedTimesAndStatus);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

$database->close();
?>
