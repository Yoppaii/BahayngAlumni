<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT first_job_related, COUNT(*) as count FROM alumni_information WHERE first_job_related IS NOT NULL AND first_job_related != '' GROUP BY first_job_related";
$result = $conn->query($query);

$first_job_relatedData = [];
while ($row = $result->fetch_assoc()) {
    $first_job_relatedData[$row['first_job_related']] = $row['count'];
}

$first_job_relatedLabels = json_encode(array_keys($first_job_relatedData));
$first_job_relatedData = json_encode(array_values($first_job_relatedData));
