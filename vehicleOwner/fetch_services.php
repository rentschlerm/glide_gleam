<?php
session_start();
// Include database connection
include("../connection.php");

// Initialize total variable
$total = 0;
$selectedServices = array();
$userId = $_SESSION['id'];
// Check if the vehicle type is set and not empty
if(isset($_POST['vehicle_type']) && !empty($_POST['vehicle_type'])) {
    // Sanitize the input to prevent SQL injection
    $vehicleType = mysqli_real_escape_string($database, $_POST['vehicle_type']);
    
    // Fetch services based on the selected vehicle type
    $sql = "SELECT * FROM services WHERE vehicle_type = '$vehicleType'";
    $result = $database->query($sql);
    
    // Check if services are found
    if ($result->num_rows > 0) {
        // Start table
        echo "<table class='table'>";
        echo "<thead><tr><th>Service Name</th><th>Price</th></thead>";
        echo "<tbody>";
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['serviceName'] . "</td>"; // Display service name
            
            // Fetch the vehicle size of the registered vehicle
            $sqlVehicleSize = "SELECT * FROM vehicle_owners WHERE vehicle_owner_id = '$userId'";
            $resultVehicleSize = $database->query($sqlVehicleSize);
            $rowVehicleSize = $resultVehicleSize->fetch_assoc();
            $vehicleSize = $rowVehicleSize['vehicle_size'];
            
            // Fetch the price for the current service and vehicle size
            $sqlPrice = "SELECT service_price FROM services WHERE service_id = {$row['service_id']} AND vehicle_size = '$vehicleSize'";
            $resultPrice = $database->query($sqlPrice);
            $priceRow = $resultPrice->fetch_assoc();
            $price = $priceRow['service_price'];
            
            // Display the price
            echo "<td>$price</td>";
            
            // Display radio buttons for service selection
            echo "<td><input type='radio' name='service_id' value='{$row['service_id']}' data-price='$price'></td>";
            
            // Hidden input field to store specialties id
            echo "<input type='hidden' name='specialties_id[" . $row['service_id'] . "]' id='specialty_" . $row['service_id'] . "' value=''>";
            
            echo "</tr>";
        }
        
        // End table
        echo "</tbody></table>";
        
        // Reset button
        echo "<button type='button' onclick='resetRadioButtons()'>Clear Selection</button>";
        echo "<br><br><br>";
        
        // Display Total
        echo "<h2>Total:</h2>";
        echo "<p>Selected Service(s): <span id='selectedService'></span></p>";
        echo "<p>Total Amount: Php <span id='totalAmount'>0.00</span></p>";
        
        // JavaScript for resetting and calculating totals
        echo "<script>
        function calculateTotal() {
            // Initialize total variable
            var total = 0;
            
            // Initialize selected services array
            var selectedServices = [];
            
            // Calculate total amount
            var radioButtons = document.querySelectorAll('input[type=radio]:checked');
            radioButtons.forEach(function(radioButton) {
                var serviceName = radioButton.parentNode.parentNode.firstChild.textContent;
                var price = parseFloat(radioButton.dataset.price);
                
                total += price;
                selectedServices.push({name: serviceName, price: price});
            });
            
            // Update total display
            document.getElementById('totalAmount').textContent = total.toFixed(2);
            
            // Update selected service display
            var selectedServiceText = '';
            selectedServices.forEach(function(service) {
                selectedServiceText += service.name + ' (Php ' + service.price.toFixed(2) + '), ';
            });
            document.getElementById('selectedService').textContent = selectedServiceText.slice(0, -2); // Remove the last comma and space
        }

        function resetRadioButtons() {
            var radioButtons = document.querySelectorAll('input[type=radio]');
            radioButtons.forEach(function(radioButton) {
                radioButton.checked = false;
                // Reset the value of the corresponding hidden input field
                var specialtyId = radioButton.getAttribute('data-specialty-id');
                document.getElementById('specialty_' + specialtyId).value = '';
            });
            calculateTotal();
        }

        var radioButtons = document.querySelectorAll('input[type=radio]');
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', calculateTotal);
        });

        // Call calculateTotal function initially to calculate totals on page load
        calculateTotal();
        </script>";
    } else {
        echo "No services found for the selected vehicle type.";
    }
} else {
    echo "Invalid request: Vehicle type is not set or empty.";
}

// Close the database connection
$database->close();
?>
