<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT reasons_for_pursuing_degrees FROM alumni_information WHERE reasons_for_pursuing_degrees IS NOT NULL AND reasons_for_pursuing_degrees != ''";
$result = $conn->query($query);

$reasons_count = [];

// Loop through each user input
while ($row = $result->fetch_assoc()) {
    // Split the reasons by comma and trim spaces
    $reasons = array_map('trim', explode(',', $row['reasons_for_pursuing_degrees']));

    // Count each reason
    foreach ($reasons as $reason) {
        if (!empty($reason)) {
            if (isset($reasons_count[$reason])) {
                $reasons_count[$reason]++;
            } else {
                $reasons_count[$reason] = 1;
            }
        }
    }
}

// Prepare data for JSON output
$reasons_for_pursuing_degreesLabels = json_encode(array_keys($reasons_count));
$reasons_for_pursuing_degreesData = json_encode(array_values($reasons_count));
