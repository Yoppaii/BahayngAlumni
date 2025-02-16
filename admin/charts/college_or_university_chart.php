<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT college_or_university, COUNT(*) as count FROM alumni_information WHERE college_or_university IS NOT NULL AND college_or_university != '' GROUP BY college_or_university";
$result = $conn->query($query);

$college_or_universityData = [];
while ($row = $result->fetch_assoc()) {
    $college_or_universityData[$row['college_or_university']] = $row['count'];
}

$college_or_universityLabels = json_encode(array_keys($college_or_universityData));
$college_or_universityData = json_encode(array_values($college_or_universityData));
