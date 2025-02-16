<?php

require 'tracer_config.php'; // Include your database configuration 

// Fetch all reasons for pursuing degrees
$query = "SELECT initial_gross_monthly_earning, COUNT(*) as count FROM alumni_information WHERE initial_gross_monthly_earning IS NOT NULL AND initial_gross_monthly_earning != '' GROUP BY initial_gross_monthly_earning";
$result = $conn->query($query);

$initial_gross_monthly_earningData = [];
while ($row = $result->fetch_assoc()) {
    $initial_gross_monthly_earningData[$row['initial_gross_monthly_earning']] = $row['count'];
}

$initial_gross_monthly_earningLabels = json_encode(array_keys($initial_gross_monthly_earningData));
$initial_gross_monthly_earningData = json_encode(array_values($initial_gross_monthly_earningData));
