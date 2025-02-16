<?php
require 'inc/essentials.php';
adminLogin();

require 'tracer_crud.php';
require 'charts/civil_status_chart.php';
require 'charts/sex_chart.php';
require 'charts/course_chart.php';
require 'charts/campus_chart.php';
require 'charts/location_of_residence_chart.php';
require 'charts/degree_specialization_chart.php';
require 'charts/college_or_university_chart.php';
require 'charts/year_graduated_chart.php';
require 'charts/honors_or_awards_chart.php';
require 'charts/education_level_chart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require 'inc/links.php'; ?>
    <style>
        /* Base font size */
        body {
            font-size: 16px;
            /* Default font size */
        }

        /* Adjust font size for smaller screens */
        @media (max-width: 768px) {
            body {
                font-size: 14px;
                /* Smaller font size for tablets and smaller devices */
            }

            .form-label {
                font-size: 12px;
                /* Smaller font size for labels */
            }
        }

        /* Adjust font size for very small screens */
        @media (max-width: 576px) {
            body {
                font-size: 12px;
                /* Even smaller font size for mobile devices */
            }
        }

        /* Adjust font size for larger screens */
        @media (min-width: 992px) {
            body {
                font-size: 18px;
                /* Larger font size for desktops */
            }
        }

        #myChart {
            max-width: 400px;
            /* Set a maximum width for the chart */
            /* width: 100%; */
            /* Make the chart responsive */
            height: 200px;
            /* Maintain aspect ratio */
        }
    </style>

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
                            <div class="form-group">
                                <label for="chartType2">Select Chart 2:</label>
                                <select id="chartType2" class="form-control">
                                    <option value="sex">Sex</option>
                                    <option value="civil_status">Civil Status</option>
                                    <option value="course">Course</option>
                                    <option value="campus">Campus</option>
                                    <option value="location_of_residence">Location of Residence</option>
                                    <option value="degree_specialization">Degree Specialization</option>
                                </select>
                            </div>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart2" width="100" height="100"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        //CHART 1
        var ctx1 = document.getElementById('myChart1').getContext('2d');

        var courseData1 = {
            labels: <?php echo $courseLabels; ?>,
            datasets: [{
                label: 'Course Distribution',
                data: <?php echo $courseData; ?>,
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
        };

        var civilStatusData1 = {
            labels: <?php echo $civilStatusLabels; ?>,
            datasets: [{
                label: 'Civil Status Distribution',
                data: <?php echo $civilStatusData; ?>,
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
        };

        var sexData1 = {
            labels: <?php echo $sexLabels; ?>,
            datasets: [{
                label: 'Sex Distribution',
                data: <?php echo $sexData; ?>,
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
        };

        var campusData1 = {
            labels: <?php echo $campusLabels; ?>,
            datasets: [{
                label: 'campus Distribution',
                data: <?php echo $campusData; ?>,
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
        };

        var location_of_residenceData1 = {
            labels: <?php echo $location_of_residenceLabels; ?>,
            datasets: [{
                label: 'Location of Residence Distribution',
                data: <?php echo $location_of_residenceData; ?>,
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
        };

        var degree_specializationData1 = {
            labels: <?php echo $degree_specializationLabels; ?>,
            datasets: [{
                label: 'Degree Specialization Distribution',
                data: <?php echo $degree_specializationData; ?>,
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
        };

        var college_or_universityData1 = {
            labels: <?php echo $college_or_universityLabels; ?>,
            datasets: [{
                label: 'College or University Distribution',
                data: <?php echo $college_or_universityData; ?>,
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
        };

        var year_graduatedData1 = {
            labels: <?php echo $year_graduatedLabels; ?>,
            datasets: [{
                label: 'Year Graduated Distribution',
                data: <?php echo $year_graduatedData; ?>,
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
        };

        var honors_or_awardsData1 = {
            labels: <?php echo $honors_or_awardsLabels; ?>,
            datasets: [{
                label: 'Honors or Awards Distribution',
                data: <?php echo $honors_or_awardsData; ?>,
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
        };

        var education_levelData1 = {
            labels: <?php echo $education_levelLabels; ?>,
            datasets: [{
                label: 'Education Level Distribution',
                data: <?php echo $education_levelData; ?>,
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
        };

        var chartOptions1 = {
            title: {
                display: true,
                text: 'Chart Title'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        var chart = new Chart(ctx1, {
            type: 'doughnut', // Change this to 'line' or 'pie' to change the chart type
            data: sexData1,
            options: chartOptions1
        });

        document.getElementById('chartType1').addEventListener('change', function() {
            chart.destroy();
            if (this.value === 'course') {
                chart = new Chart(ctx1, {
                    type: 'bar', // Use bar chart for course chart
                    data: courseData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Course Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'civil_status') {
                chart = new Chart(ctx1, {
                    type: 'doughnut', // Use bar chart for civil status chart
                    data: civilStatusData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Civil Status Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'sex') {
                chart = new Chart(ctx1, {
                    type: 'doughnut', // Use bar chart for sex chart
                    data: sexData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Sex Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'campus') {
                chart = new Chart(ctx1, {
                    type: 'bar', // Use bar chart for sex chart
                    data: campusData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Campus Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'location_of_residence') {
                chart = new Chart(ctx1, {
                    type: 'doughnut',
                    data: location_of_residenceData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Location of Residence Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'degree_specialization') {
                chart = new Chart(ctx1, {
                    type: 'bar',
                    data: degree_specializationData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Degree Specialization Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'college_or_university') {
                chart = new Chart(ctx1, {
                    type: 'bar',
                    data: college_or_universityData1,
                    options: {
                        title: {
                            display: true,
                            text: 'College or University Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'year_graduated') {
                chart = new Chart(ctx1, {
                    type: 'bar',
                    data: year_graduatedData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Year Graduated Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'honors_or_awards') {
                chart = new Chart(ctx1, {
                    type: 'doughnut',
                    data: honors_or_awardsData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Honors or Awards Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'education_level') {
                chart = new Chart(ctx1, {
                    type: 'doughnut',
                    data: education_levelData1,
                    options: {
                        title: {
                            display: true,
                            text: 'Education Level Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            }
        });


        //CHART 2
        var ctx2 = document.getElementById('myChart2').getContext('2d');

        var courseData2 = {
            labels: <?php echo $courseLabels; ?>,
            datasets: [{
                label: 'Course Distribution',
                data: <?php echo $courseData; ?>,
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
        };

        var civilStatusData2 = {
            labels: <?php echo $civilStatusLabels; ?>,
            datasets: [{
                label: 'Civil Status Distribution',
                data: <?php echo $civilStatusData; ?>,
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
        };

        var sexData2 = {
            labels: <?php echo $sexLabels; ?>,
            datasets: [{
                label: 'Sex Distribution',
                data: <?php echo $sexData; ?>,
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
        };

        var campusData2 = {
            labels: <?php echo $campusLabels; ?>,
            datasets: [{
                label: 'campus Distribution',
                data: <?php echo $campusData; ?>,
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
        };

        var location_of_residenceData2 = {
            labels: <?php echo $location_of_residenceLabels; ?>,
            datasets: [{
                label: 'Location of Residence Distribution',
                data: <?php echo $location_of_residenceData; ?>,
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
        };

        var degree_specializationData2 = {
            labels: <?php echo $degree_specializationLabels; ?>,
            datasets: [{
                label: 'Degree Specialization Distribution',
                data: <?php echo $degree_specializationData; ?>,
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
        };

        var chartOptions2 = {
            title: {
                display: true,
                text: 'Chart Title'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        var chart2 = new Chart(ctx2, {
            type: 'doughnut', // Change this to 'line' or 'pie' to change the chart type
            data: sexData2,
            options: chartOptions2
        });

        document.getElementById('chartType2').addEventListener('change', function() {
            chart2.destroy();
            if (this.value === 'course') {
                chart2 = new Chart(ctx2, {
                    type: 'bar', // Use bar chart for course chart
                    data: courseData2,
                    options: {
                        title: {
                            display: true,
                            text: 'Course Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'civil_status') {
                chart2 = new Chart(ctx2, {
                    type: 'doughnut', // Use bar chart for civil status chart
                    data: civilStatusData2,
                    options: {
                        title: {
                            display: true,
                            text: 'Civil Status Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'sex') {
                chart2 = new Chart(ctx2, {
                    type: 'doughnut', // Use bar chart for sex chart
                    data: sexData2,
                    options: {
                        title: {
                            display: true,
                            text: 'Sex Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'campus') {
                chart2 = new Chart(ctx2, {
                    type: 'bar', // Use bar chart for sex chart
                    data: campusData2,
                    options: {
                        title: {
                            display: true,
                            text: 'Campus Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'location_of_residence') {
                chart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: location_of_residenceData2,
                    options: {
                        title: {
                            display: true,
                            text: 'Location of Residence Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            } else if (this.value === 'degree_specialization') {
                chart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: degree_specializationData2,
                    options: {
                        title: {
                            display: true,
                            text: 'Degree Specialization Distribution'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>