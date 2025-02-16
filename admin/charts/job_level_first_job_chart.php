<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT job_level_first_job, COUNT(*) as count FROM alumni_information WHERE job_level_first_job IS NOT NULL AND job_level_first_job != '' GROUP BY job_level_first_job";
$result = $conn->query($query);

$job_level_first_jobData = [];
while ($row = $result->fetch_assoc()) {
    $job_level_first_jobData[$row['job_level_first_job']] = $row['count'];
}

$job_level_first_jobLabels = json_encode(array_keys($job_level_first_jobData));
$job_level_first_jobData = json_encode(array_values($job_level_first_jobData));
