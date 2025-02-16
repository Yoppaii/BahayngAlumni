<?php

require 'tracer_config.php'; // Include your database configuration

// Fetch civil status data
$query = "SELECT honors_or_awards, COUNT(*) as count 
          FROM alumni_information 
          WHERE honors_or_awards IS NOT NULL AND honors_or_awards != '' 
          GROUP BY honors_or_awards";
$result = $conn->query($query);

$honors_or_awardsData = [];
while ($row = $result->fetch_assoc()) {
    $honors_or_awardsData[$row['honors_or_awards']] = $row['count'];
}

$honors_or_awardsLabels = json_encode(array_keys($honors_or_awardsData));
$honors_or_awardsData = json_encode(array_values($honors_or_awardsData));
