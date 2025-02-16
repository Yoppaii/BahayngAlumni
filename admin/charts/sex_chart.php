<?php
// sex_chart.php

require 'tracer_config.php'; // Include your database configuration

// Fetch sex data
$query = "SELECT sex, COUNT(*) as count FROM alumni_information WHERE sex IS NOT NULL AND sex != '' GROUP BY sex";
$result = $conn->query($query);

$sexData = [];
while ($row = $result->fetch_assoc()) {
    $sexData[$row['sex']] = $row['count'];
}

$sexLabels = json_encode(array_keys($sexData));
$sexData = json_encode(array_values($sexData));
