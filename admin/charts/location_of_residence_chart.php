<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT location_of_residence, COUNT(*) as count FROM alumni_information WHERE location_of_residence IS NOT NULL AND location_of_residence != '' GROUP BY location_of_residence";
$result = $conn->query($query);

$location_of_residenceData = [];
while ($row = $result->fetch_assoc()) {
    $location_of_residenceData[$row['location_of_residence']] = $row['count'];
}

$location_of_residenceLabels = json_encode(array_keys($location_of_residenceData));
$location_of_residenceData = json_encode(array_values($location_of_residenceData));
