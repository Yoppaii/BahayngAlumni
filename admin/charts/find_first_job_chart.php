<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT find_first_job, COUNT(*) as count FROM alumni_information WHERE find_first_job IS NOT NULL AND find_first_job != '' GROUP BY find_first_job";
$result = $conn->query($query);

$find_first_jobData = [];
while ($row = $result->fetch_assoc()) {
    $find_first_jobData[$row['find_first_job']] = $row['count'];
}

$find_first_jobLabels = json_encode(array_keys($find_first_jobData));
$find_first_jobData = json_encode(array_values($find_first_jobData));
