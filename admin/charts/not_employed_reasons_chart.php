<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT not_employed_reasons FROM alumni_information WHERE not_employed_reasons IS NOT NULL AND not_employed_reasons != ''";
$result = $conn->query($query);

$reasons_count = [];

// Loop through each user input
while ($row = $result->fetch_assoc()) {
    // Split the reasons by comma and trim spaces
    $reasons = array_map('trim', explode(',', $row['not_employed_reasons']));

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
$not_employed_reasonsLabels = json_encode(array_keys($reasons_count));
$not_employed_reasonsData = json_encode(array_values($reasons_count));
