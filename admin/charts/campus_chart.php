<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT campus, COUNT(*) as count FROM alumni_information WHERE campus IS NOT NULL AND campus != '' GROUP BY campus";
$result = $conn->query($query);

$campusData = [];
while ($row = $result->fetch_assoc()) {
    $campusData[$row['campus']] = $row['count'];
}

$campusLabels = json_encode(array_keys($campusData));
$campusData = json_encode(array_values($campusData));
