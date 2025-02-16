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

    var reasons_for_pursuing_degreesData1 = {
        labels: <?php echo $reasons_for_pursuing_degreesLabels; ?>,
        datasets: [{
            label: 'Reason for Pursuing Degrees Distribution',
            data: <?php echo $reasons_for_pursuing_degreesData; ?>,
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

    var pursue_advanceData1 = {
        labels: <?php echo $pursue_advanceLabels; ?>,
        datasets: [{
            label: 'Pursue Advance Distribution',
            data: <?php echo $pursue_advanceData; ?>,
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

    var employment_statusData1 = {
        labels: <?php echo $employment_statusLabels; ?>,
        datasets: [{
            label: 'Employment Status Distribution',
            data: <?php echo $employment_statusData; ?>,
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

    var not_employed_reasonsData1 = {
        labels: <?php echo $not_employed_reasonsLabels; ?>,
        datasets: [{
            label: 'Not Employed Reasons Distribution',
            data: <?php echo $not_employed_reasonsData; ?>,
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

    var present_employment_statusData1 = {
        labels: <?php echo $present_employment_statusLabels; ?>,
        datasets: [{
            label: 'Present Employment Status Distribution',
            data: <?php echo $present_employment_statusData; ?>,
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

    var business_lineData1 = {
        labels: <?php echo $business_lineLabels; ?>,
        datasets: [{
            label: 'Business Line Distribution',
            data: <?php echo $business_lineData; ?>,
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

    var place_of_workData1 = {
        labels: <?php echo $place_of_workLabels; ?>,
        datasets: [{
            label: 'Place of Work Distribution',
            data: <?php echo $place_of_workData; ?>,
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

    var first_job_after_collegeData1 = {
        labels: <?php echo $first_job_after_collegeLabels; ?>,
        datasets: [{
            label: 'First Job After College Distribution',
            data: <?php echo $first_job_after_collegeData; ?>,
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

    var reasons_stayingData1 = {
        labels: <?php echo $reasons_stayingLabels; ?>,
        datasets: [{
            label: 'Reasons Staying Distribution',
            data: <?php echo $reasons_stayingData; ?>,
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

    var first_job_relatedData1 = {
        labels: <?php echo $first_job_relatedLabels; ?>,
        datasets: [{
            label: 'First Job Related Distribution',
            data: <?php echo $first_job_relatedData; ?>,
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

    var reasons_acceptingData1 = {
        labels: <?php echo $reasons_acceptingLabels; ?>,
        datasets: [{
            label: 'Reasons Accepting Distribution',
            data: <?php echo $reasons_acceptingData; ?>,
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

    var reasons_changingData1 = {
        labels: <?php echo $reasons_changingLabels; ?>,
        datasets: [{
            label: 'Reasons Changing Distribution',
            data: <?php echo $reasons_changingData; ?>,
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

    var duration_first_jobData1 = {
        labels: <?php echo $duration_first_jobLabels; ?>,
        datasets: [{
            label: 'Duration First Job Distribution',
            data: <?php echo $duration_first_jobData; ?>,
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

    var find_first_jobData1 = {
        labels: <?php echo $find_first_jobLabels; ?>,
        datasets: [{
            label: 'Find First Job Distribution',
            data: <?php echo $find_first_jobData; ?>,
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

    var time_to_land_first_jobData1 = {
        labels: <?php echo $time_to_land_first_jobLabels; ?>,
        datasets: [{
            label: 'Time To Land First Job Distribution',
            data: <?php echo $time_to_land_first_jobData; ?>,
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

    var job_level_first_jobData1 = {
        labels: <?php echo $job_level_first_jobLabels; ?>,
        datasets: [{
            label: 'Job Level First Job Distribution',
            data: <?php echo $job_level_first_jobData; ?>,
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

    var job_level_current_jobData1 = {
        labels: <?php echo $job_level_current_jobLabels; ?>,
        datasets: [{
            label: 'Job Level Current Job Distribution',
            data: <?php echo $job_level_current_jobData; ?>,
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

    var initial_gross_monthly_earningData1 = {
        labels: <?php echo $initial_gross_monthly_earningLabels; ?>,
        datasets: [{
            label: 'Initial Gross Monthly Earning Distribution',
            data: <?php echo $initial_gross_monthly_earningData; ?>,
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

    var curriculum_relevanceData1 = {
        labels: <?php echo $curriculum_relevanceLabels; ?>,
        datasets: [{
            label: 'Curriculum Relevance Distribution',
            data: <?php echo $curriculum_relevanceData; ?>,
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

    var useful_competenciesData1 = {
        labels: <?php echo $useful_competenciesLabels; ?>,
        datasets: [{
            label: 'Useful Competencies Distribution',
            data: <?php echo $useful_competenciesData; ?>,
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
                type: 'doughnut', // Use bar chart for course chart
                data: courseData1,
                options: {
                    title: {
                        display: true,
                        text: 'Course Distribution'
                    },
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
                    legend: {
                        display: false
                    }
                }
            });
        } else if (this.value === 'campus') {
            chart = new Chart(ctx1, {
                type: 'doughnut', // Use bar chart for sex chart
                data: campusData1,
                options: {
                    title: {
                        display: true,
                        text: 'Campus Distribution'
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
                    legend: {
                        display: false
                    }
                }
            });
        } else if (this.value === 'degree_specialization') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: degree_specializationData1,
                options: {
                    title: {
                        display: true,
                        text: 'Degree Specialization Distribution'
                    },
                    legend: {
                        display: false
                    }
                }
            });
        } else if (this.value === 'college_or_university') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: college_or_universityData1,
                options: {
                    title: {
                        display: true,
                        text: 'College or University Distribution'
                    },
                    legend: {
                        display: false
                    }
                }
            });
        } else if (this.value === 'year_graduated') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: year_graduatedData1,
                options: {
                    title: {
                        display: true,
                        text: 'Year Graduated Distribution'
                    },
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
                    legend: {
                        display: false
                    }
                }
            });
        } else if (this.value === 'reasons_for_pursuing_degrees') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: reasons_for_pursuing_degreesData1,
                options: {
                    title: {
                        display: true,
                        text: 'Reason for Pursuing Degrees Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'pursue_advance') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: pursue_advanceData1,
                options: {
                    title: {
                        display: true,
                        text: 'Pursue Advance Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'employment_status') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: employment_statusData1,
                options: {
                    title: {
                        display: true,
                        text: 'Employment Status Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'not_employed_reasons') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: not_employed_reasonsData1,
                options: {
                    title: {
                        display: true,
                        text: 'Not Employed Reasons Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'present_employment_status') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: present_employment_statusData1,
                options: {
                    title: {
                        display: true,
                        text: 'Present Employment Status Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'business_line') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: business_lineData1,
                options: {
                    title: {
                        display: true,
                        text: 'Business Line Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'place_of_work') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: place_of_workData1,
                options: {
                    title: {
                        display: true,
                        text: 'Place of Work Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'first_job_after_college') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: first_job_after_collegeData1,
                options: {
                    title: {
                        display: true,
                        text: 'First Job After College Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'reasons_staying') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: reasons_stayingData1,
                options: {
                    title: {
                        display: true,
                        text: 'Reasons Staying Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'first_job_related') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: first_job_relatedData1,
                options: {
                    title: {
                        display: true,
                        text: 'First Job Related Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'reasons_accepting') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: reasons_acceptingData1,
                options: {
                    title: {
                        display: true,
                        text: 'Reasons Accepting Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'reasons_changing') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: reasons_changingData1,
                options: {
                    title: {
                        display: true,
                        text: 'Reasons Changing Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'duration_first_job') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: duration_first_jobData1,
                options: {
                    title: {
                        display: true,
                        text: 'Duration First Job Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'find_first_job') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: find_first_jobData1,
                options: {
                    title: {
                        display: true,
                        text: 'Find First Job Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'time_to_land_first_job') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: time_to_land_first_jobData1,
                options: {
                    title: {
                        display: true,
                        text: 'Time to Land First Job Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'job_level_first_job') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: job_level_first_jobData1,
                options: {
                    title: {
                        display: true,
                        text: 'Job Level First Job Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'job_level_current_job') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: job_level_current_jobData1,
                options: {
                    title: {
                        display: true,
                        text: 'Job Level Current Job Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'initial_gross_monthly_earning') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: initial_gross_monthly_earningData1,
                options: {
                    title: {
                        display: true,
                        text: 'Initial Gross Monthly Earning Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'curriculum_relevance') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: curriculum_relevanceData1,
                options: {
                    title: {
                        display: true,
                        text: 'Curriculum Relevance Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
                    }
                }
            });
        } else if (this.value === 'useful_competencies') {
            chart = new Chart(ctx1, {
                type: 'doughnut',
                data: useful_competenciesData1,
                options: {
                    title: {
                        display: true,
                        text: 'Useful Competencies Distribution'
                    },
                    legend: {
                        display: false // Hides the legend completely
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