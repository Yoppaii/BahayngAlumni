<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT duration_first_job, COUNT(*) as count FROM alumni_information WHERE duration_first_job IS NOT NULL AND duration_first_job != '' GROUP BY duration_first_job";
$result = $conn->query($query);

$duration_first_jobData = [];
while ($row = $result->fetch_assoc()) {
    $duration_first_jobData[$row['duration_first_job']] = $row['count'];
}

$duration_first_jobLabels = json_encode(array_keys($duration_first_jobData));
$duration_first_jobData = json_encode(array_values($duration_first_jobData));
