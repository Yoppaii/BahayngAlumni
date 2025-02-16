<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT year_graduated, COUNT(*) as count FROM alumni_information WHERE year_graduated IS NOT NULL AND year_graduated != '' GROUP BY year_graduated";
$result = $conn->query($query);

$year_graduatedData = [];
while ($row = $result->fetch_assoc()) {
    $year_graduatedData[$row['year_graduated']] = $row['count'];
}

$year_graduatedLabels = json_encode(array_keys($year_graduatedData));
$year_graduatedData = json_encode(array_values($year_graduatedData));
