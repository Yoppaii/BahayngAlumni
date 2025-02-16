<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT reasons_changing FROM alumni_information WHERE reasons_changing IS NOT NULL AND reasons_changing != ''";
$result = $conn->query($query);

$reasons_count = [];

// Loop through each user input
while ($row = $result->fetch_assoc()) {
    // Split the reasons by comma and trim spaces
    $reasons = array_map('trim', explode(',', $row['reasons_changing']));

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
$reasons_changingLabels = json_encode(array_keys($reasons_count));
$reasons_changingData = json_encode(array_values($reasons_count));
