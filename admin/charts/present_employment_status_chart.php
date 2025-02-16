<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT present_employment_status, COUNT(*) as count FROM alumni_information WHERE present_employment_status IS NOT NULL AND present_employment_status != '' GROUP BY present_employment_status";
$result = $conn->query($query);

$present_employment_statusData = [];
while ($row = $result->fetch_assoc()) {
    $present_employment_statusData[$row['present_employment_status']] = $row['count'];
}

$present_employment_statusLabels = json_encode(array_keys($present_employment_statusData));
$present_employment_statusData = json_encode(array_values($present_employment_statusData));
