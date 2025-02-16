<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT useful_competencies FROM alumni_information WHERE useful_competencies IS NOT NULL AND useful_competencies != ''";
$result = $conn->query($query);

$reasons_count = [];

// Loop through each user input
while ($row = $result->fetch_assoc()) {
    // Split the reasons by comma and trim spaces
    $reasons = array_map('trim', explode(',', $row['useful_competencies']));

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
$useful_competenciesLabels = json_encode(array_keys($reasons_count));
$useful_competenciesData = json_encode(array_values($reasons_count));
