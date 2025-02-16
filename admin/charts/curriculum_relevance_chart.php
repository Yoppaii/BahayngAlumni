<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT curriculum_relevance, COUNT(*) as count FROM alumni_information WHERE curriculum_relevance IS NOT NULL AND curriculum_relevance != '' GROUP BY curriculum_relevance";
$result = $conn->query($query);

$curriculum_relevanceData = [];
while ($row = $result->fetch_assoc()) {
    $curriculum_relevanceData[$row['curriculum_relevance']] = $row['count'];
}

$curriculum_relevanceLabels = json_encode(array_keys($curriculum_relevanceData));
$curriculum_relevanceData = json_encode(array_values($curriculum_relevanceData));
