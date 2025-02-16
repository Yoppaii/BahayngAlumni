<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT course, COUNT(*) as count FROM alumni_information WHERE course IS NOT NULL AND course != '' GROUP BY course";
$result = $conn->query($query);

$courseData = [];
while ($row = $result->fetch_assoc()) {
    $courseData[$row['course']] = $row['count'];
}

$courseLabels = json_encode(array_keys($courseData));
$courseData = json_encode(array_values($courseData));
