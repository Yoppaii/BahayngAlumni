<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT employment_status, COUNT(*) as count FROM alumni_information WHERE employment_status IS NOT NULL AND employment_status != '' GROUP BY employment_status";
$result = $conn->query($query);

$employment_statusData = [];
while ($row = $result->fetch_assoc()) {
    $employment_statusData[$row['employment_status']] = $row['count'];
}

$employment_statusLabels = json_encode(array_keys($employment_statusData));
$employment_statusData = json_encode(array_values($employment_statusData));
