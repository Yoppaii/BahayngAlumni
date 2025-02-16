<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT place_of_work, COUNT(*) as count FROM alumni_information WHERE place_of_work IS NOT NULL AND place_of_work != '' GROUP BY place_of_work";
$result = $conn->query($query);

$place_of_workData = [];
while ($row = $result->fetch_assoc()) {
    $place_of_workData[$row['place_of_work']] = $row['count'];
}

$place_of_workLabels = json_encode(array_keys($place_of_workData));
$place_of_workData = json_encode(array_values($place_of_workData));
