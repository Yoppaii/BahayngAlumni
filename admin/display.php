<?php
require 'inc/essentials.php';
require 'tracer_requires.php';
adminLogin();


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
                            <div class="form-group">
                                <label for="chartType1">Select Chart:</label>
                                <select id="chartType1" class="form-control">
                                    <option value="sex">Sex</option>
                                    <option value="civil_status">Civil Status</option>
                                    <option value="course">Course</option>
                                    <option value="campus">Campus</option>
                                    <option value="location_of_residence">Location of Residence</option>
                                    <option value="degree_specialization">Degree Specialization</option>
                                    <option value="college_or_university">College or University</option>
                                    <option value="year_graduated">Year Graduated</option>
                                    <option value="honors_or_awards">Honors or Awards</option>
                                    <option value="education_level">Education Level</option>
                                    <option value="reasons_for_pursuing_degrees">Reasons for Pursuing Degrees</option>
                                    <option value="pursue_advance">Pursue Advance</option>
                                    <option value="employment_status">Employment Status</option>
                                    <option value="not_employed_reasons">Not Employed Reasons</option>
                                    <option value="present_employment_status">Present Employment Status</option>
                                    <option value="business_line">Business Line</option>
                                    <option value="place_of_work">Place of Work</option>
                                    <option value="first_job_after_college">First Job After College</option>
                                    <option value="reasons_staying">Reasons Staying</option>
                                    <option value="first_job_related">First Job Related</option>
                                    <option value="reasons_accepting">Reasons Accepting</option>
                                    <option value="reasons_changing">Reasons Changing</option>
                                    <option value="duration_first_job">Duration First Job</option>
                                    <option value="find_first_job">Find First Job</option>
                                    <option value="time_to_land_first_job">Time to Land First Job</option>
                                    <option value="job_level_first_job">Job Level First Job</option>
                                    <option value="job_level_current_job">Job Level Current Job</option>
                                    <option value="initial_gross_monthly_earning">Initial Gross Monthly Earning</option>
                                    <option value="curriculum_relevance">Curriculum Relevance</option>
                                    <option value="useful_competencies">Useful Competencies</option>

                                </select>
                            </div>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart1" width="100" height="100"></canvas> <!-- Adjusted width and height -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div>
                                        <canvas id="courseSalaryChart" width="100" height="100"></canvas> <!-- Adjusted width and height -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require 'inc/scripts.php'; ?>

    <?php require 'tracer_script_chart_1.php'; ?>
    <?php require 'tracer_chart_2.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        var ctx2 = document.getElementById('myChart2').getContext('2d');

        document.getElementById('chartType2').addEventListener('change', function() {
            const chartType = this.value;
            fetch(`chart_data.php?chartType=${chartType}`)
                .then(response => response.json())
                .then(chartData => {
                    chart.destroy();
                    chart = new Chart(ctx2, {
                        type: 'doughnut', // Change this to the desired chart type
                        data: {
                            labels: chartData.labels,
                            datasets: [{
                                label: `${chartType.charAt(0).toUpperCase() + chartType.slice(1)} Distribution`,
                                data: chartData.data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: `${chartType.charAt(0).toUpperCase() + chartType.slice(1)} Distribution`
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        display: false // Hides the x-axis labels
                                    }
                                }]
                            },
                            legend: {
                                display: false // Hides the legend completely
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching chart data:', error));
        });
    </script>


</body>

</html>