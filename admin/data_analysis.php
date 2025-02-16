<?php
require 'inc/essentials.php';
require 'tracer_requires.php';
adminLogin();

$query = "SELECT initial_gross_monthly_earning, COUNT(*) as count FROM alumni_information WHERE initial_gross_monthly_earning IS NOT NULL AND initial_gross_monthly_earning != '' GROUP BY initial_gross_monthly_earning";
$result = $conn->query($query);

$initial_gross_monthly_earningData = [];
while ($row = $result->fetch_assoc()) {
    $initial_gross_monthly_earningData[$row['initial_gross_monthly_earning']] = $row['count'];
}

$initial_gross_monthly_earningLabels = json_encode(array_keys($initial_gross_monthly_earningData));
$initial_gross_monthly_earningData = json_encode(array_values($initial_gross_monthly_earningData));


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tracer Display</title>
    <?php require 'inc/links.php'; ?>


</head>

<body class="bg-light">

    <?php require 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <canvas id="myChart" style="width: 800px; height: 600px;"></canvas>




                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Assuming you have the following data from your PHP script
        const initial_gross_monthly_earningLabels = <?php echo $initial_gross_monthly_earningLabels; ?>;
        const initial_gross_monthly_earningData = <?php echo $initial_gross_monthly_earningData; ?>;

        // Create the chart data
        const data = {
            labels: initial_gross_monthly_earningLabels,
            datasets: [{
                data: initial_gross_monthly_earningData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ],
                borderWidth: 1
            }]
        };

        // Create the chart configuration
        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Initial Gross Monthly Earning Distribution'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Alumni'
                        }
                    },

                },
                interaction: {
                    intersect: false,
                },
                responsive: true,
                maintainAspectRatio: false,
            },
        };

        // Create the chart
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

</body>

</html>