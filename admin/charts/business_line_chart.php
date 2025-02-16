<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT business_line, COUNT(*) as count FROM alumni_information WHERE business_line IS NOT NULL AND business_line != '' GROUP BY business_line";
$result = $conn->query($query);

$business_lineData = [];
while ($row = $result->fetch_assoc()) {
    $business_lineData[$row['business_line']] = $row['count'];
}

$business_lineLabels = json_encode(array_keys($business_lineData));
$business_lineData = json_encode(array_values($business_lineData));
