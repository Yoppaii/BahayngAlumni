<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT degree_specialization, COUNT(*) as count FROM alumni_information WHERE degree_specialization IS NOT NULL AND degree_specialization != '' GROUP BY degree_specialization";
$result = $conn->query($query);

$degree_specializationData = [];
while ($row = $result->fetch_assoc()) {
    $degree_specializationData[$row['degree_specialization']] = $row['count'];
}

$degree_specializationLabels = json_encode(array_keys($degree_specializationData));
$degree_specializationData = json_encode(array_values($degree_specializationData));
