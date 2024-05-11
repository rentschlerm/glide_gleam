<?php
session_start();
// Include database connection
include("../connection.php");

// Check if the vehicle type and shop ID are set and not empty
if(isset($_POST['vehicle_type']) && !empty($_POST['vehicle_type']) && isset($_POST['shop_id']) && !empty($_POST['shop_id'])) {
    // Sanitize the inputs to prevent SQL injection
    $vehicleType = mysqli_real_escape_string($database, $_POST['vehicle_type']);
    $shopId = mysqli_real_escape_string($database, $_POST['shop_id']);
    
    // Fetch services based on the selected vehicle type and shop
    $sql = "SELECT * FROM services WHERE vehicle_type = '$vehicleType' AND shop_info_id = '$shopId'";
    $result = $database->query($sql);

    if ($result->num_rows > 0) {
        // Start table
        echo "<table class='table'>";
        echo "<thead><tr><th>Service Name</th><th>Price</th></thead>";
        echo "<tbody>";
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['serviceName'] . "</td>"; // Display service name
            
            // Display the price
            $price = $row['service_price'];
            echo "<td>&#x20B1;$price</td>";
            
            // Display checkbox buttons for service selection
            echo "<td><input type='checkbox' name='service_id' value='{$row['service_id']}' data-price='$price'></td>";
            
            // Hidden input field to store specialties id
            echo "<input type='hidden' name='specialties_id[" . $row['service_id'] . "]' id='specialty_" . $row['service_id'] . "' value=''>";
            
            echo "</tr>";
        }
        
        // End table
        echo "</tbody></table>";
        
        // Reset button
        echo "<button type='button' onclick='resetCheckboxes()'>Clear Selection</button>";
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
            var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
            if (checkboxes.length > 0) {
                checkboxes.forEach(function(checkbox) {
                    var serviceName = checkbox.parentNode.parentNode.firstChild.textContent;
                    var price = parseFloat(checkbox.dataset.price);
                    
                    total += price;
                    selectedServices.push({name: serviceName, price: price});
                });
            }
            
            // Update total display
            document.getElementById('totalAmount').textContent = total.toFixed(2);
            
            // Update selected service display
            var selectedServiceText = '';
            selectedServices.forEach(function(service) {
                selectedServiceText += service.name + ', '; // Concatenate service names
            });
            document.getElementById('selectedService').textContent = selectedServiceText.slice(0, -2); // Remove the last comma and space
        }
        
        function resetCheckboxes() {
            var checkboxes = document.querySelectorAll('input[type=checkbox]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
                // Reset the value of the corresponding hidden input field
                var specialtyId = checkbox.value;
                document.getElementById('specialty_' + specialtyId).value = '';
            });
            calculateTotal();
        }
        
        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', calculateTotal);
        });
        
        // Call calculateTotal function initially to calculate totals on page load
        calculateTotal();
        </script>";
    } else {
        echo "No services found for the selected vehicle type and shop.";
    }
} else {
    echo "Please select a shop and vehicle type to see the services.";
}

// Close the database connection
$database->close();
?>
