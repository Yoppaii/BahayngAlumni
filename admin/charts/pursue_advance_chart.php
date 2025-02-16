<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT pursue_advance, COUNT(*) as count FROM alumni_information WHERE pursue_advance IS NOT NULL AND pursue_advance != '' GROUP BY pursue_advance";
$result = $conn->query($query);

$pursue_advanceData = [];
while ($row = $result->fetch_assoc()) {
    $pursue_advanceData[$row['pursue_advance']] = $row['count'];
}

$pursue_advanceLabels = json_encode(array_keys($pursue_advanceData));
$pursue_advanceData = json_encode(array_values($pursue_advanceData));
