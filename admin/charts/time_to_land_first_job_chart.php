<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT time_to_land_first_job, COUNT(*) as count FROM alumni_information WHERE time_to_land_first_job IS NOT NULL AND time_to_land_first_job != '' GROUP BY time_to_land_first_job";
$result = $conn->query($query);

$time_to_land_first_jobData = [];
while ($row = $result->fetch_assoc()) {
    $time_to_land_first_jobData[$row['time_to_land_first_job']] = $row['count'];
}

$time_to_land_first_jobLabels = json_encode(array_keys($time_to_land_first_jobData));
$time_to_land_first_jobData = json_encode(array_values($time_to_land_first_jobData));
