<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT first_job_after_college, COUNT(*) as count FROM alumni_information WHERE first_job_after_college IS NOT NULL AND first_job_after_college != '' GROUP BY first_job_after_college";
$result = $conn->query($query);

$first_job_after_collegeData = [];
while ($row = $result->fetch_assoc()) {
    $first_job_after_collegeData[$row['first_job_after_college']] = $row['count'];
}

$first_job_after_collegeLabels = json_encode(array_keys($first_job_after_collegeData));
$first_job_after_collegeData = json_encode(array_values($first_job_after_collegeData));
