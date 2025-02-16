<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT education_level, COUNT(*) as count FROM alumni_information WHERE education_level IS NOT NULL AND education_level != '' GROUP BY education_level";
$result = $conn->query($query);

$education_levelData = [];
while ($row = $result->fetch_assoc()) {
    $education_levelData[$row['education_level']] = $row['count'];
}

$education_levelLabels = json_encode(array_keys($education_levelData));
$education_levelData = json_encode(array_values($education_levelData));
