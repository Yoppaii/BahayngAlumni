<?php
require 'tracer_config.php'; // Include your database configuration
require 'tracer_requires.php';

$chartType = $_GET['chartType2'] ?? '';

$data = [];

switch ($chartType) {
    case 'course':
        $query = "SELECT course, COUNT(*) as count FROM alumni_information WHERE course IS NOT NULL AND course != '' GROUP BY course";
        break;
    case 'civil_status':
        $query = "SELECT civil_status, COUNT(*) as count FROM alumni_information WHERE civil_status IS NOT NULL AND civil_status != '' GROUP BY civil_status";
        break;
    case 'sex':
        $query = "SELECT sex, COUNT(*) as count FROM alumni_information WHERE sex IS NOT NULL AND sex != '' GROUP BY sex";
        break;
    case 'business_line':
        $query = "SELECT business_line, COUNT(*) as count FROM alumni_information WHERE business_line IS NOT NULL AND business_line != '' GROUP BY business_line";
        break;
    case 'campus':
        $query = "SELECT campus, COUNT(*) as count FROM alumni_information WHERE campus IS NOT NULL AND campus != '' GROUP BY campus";
        break;
    case 'college_or_university':
        $query = "SELECT college_or_university, COUNT(*) as count FROM alumni_information WHERE college_or_university IS NOT NULL AND college_or_university != '' GROUP BY college_or_university";
        break;
    case 'curriculum_relevance':
        $query = "SELECT curriculum_relevance, COUNT(*) as count FROM alumni_information WHERE curriculum_relevance IS NOT NULL AND curriculum_relevance != '' GROUP BY curriculum_relevance";
        break;
    case 'degree_specialization':
        $query = "SELECT degree_specialization, COUNT(*) as count FROM alumni_information WHERE degree_specialization IS NOT NULL AND degree_specialization != '' GROUP BY degree_specialization";
        break;
    case 'duration_first_job':
        $query = "SELECT duration_first_job, COUNT(*) as count FROM alumni_information WHERE duration_first_job IS NOT NULL AND duration_first_job != '' GROUP BY duration_first_job";
        break;
    case 'education_level':
        $query = "SELECT education_level, COUNT(*) as count FROM alumni_information WHERE education_level IS NOT NULL AND education_level != '' GROUP BY education_level";
        break;
    case 'employment_status':
        $query = "SELECT employment_status, COUNT(*) as count FROM alumni_information WHERE employment_status IS NOT NULL AND employment_status != '' GROUP BY employment_status";
        break;
    case 'find_first_job':
        $query = "SELECT find_first_job, COUNT(*) as count FROM alumni_information WHERE find_first_job IS NOT NULL AND find_first_job != '' GROUP BY find_first_job";
        break;
    case 'first_job_after_college':
        $query = "SELECT first_job_after_college, COUNT(*) as count FROM alumni_information WHERE first_job_after_college IS NOT NULL AND first_job_after_college != '' GROUP BY first_job_after_college";
        break;
    case 'first_job_related':
        $query = "SELECT first_job_related, COUNT(*) as count FROM alumni_information WHERE first_job_related IS NOT NULL AND first_job_related != '' GROUP BY first_job_related";
        break;
    case 'honors_or_awards':
        $query = "SELECT honors_or_awards, COUNT(*) as count FROM alumni_information WHERE honors_or_awards IS NOT NULL AND honors_or_awards != '' GROUP BY honors_or_awards";
        break;
    case 'initial_gross_monthly_earning':
        $query = "SELECT initial_gross_monthly_earning, COUNT(*) as count FROM alumni_information WHERE initial_gross_monthly_earning IS NOT NULL AND initial_gross_monthly_earning != '' GROUP BY initial_gross_monthly_earning";
        break;
    case 'job_level_current_job':
        $query = "SELECT job_level_current_job, COUNT(*) as count FROM alumni_information WHERE job_level_current_job IS NOT NULL AND job_level_current_job != '' GROUP BY job_level_current_job";
        break;
    case 'job_level_first_job':
        $query = "SELECT job_level_first_job, COUNT(*) as count FROM alumni_information WHERE job_level_first_job IS NOT NULL AND job_level_first_job != '' GROUP BY job_level_first_job";
        break;
    case 'location_of_residence':
        $query = "SELECT location_of_residence, COUNT(*) as count FROM alumni_information WHERE location_of_residence IS NOT NULL AND location_of_residence != '' GROUP BY location_of_residence";
        break;
    case 'place_of_work':
        $query = "SELECT place_of_work, COUNT(*) as count FROM alumni_information WHERE place_of_work IS NOT NULL AND place_of_work != '' GROUP BY place_of_work";
        break;
    case 'present_employment_status':
        $query = "SELECT present_employment_status, COUNT(*) as count FROM alumni_information WHERE present_employment_status IS NOT NULL AND present_employment_status != '' GROUP BY present_employment_status";
        break;
    case 'pursue_advance':
        $query = "SELECT pursue_advance, COUNT(*) as count FROM alumni_information WHERE pursue_advance IS NOT NULL AND pursue_advance != '' GROUP BY pursue_advance";
        break;
    case 'time_to_land_first_job':
        $query = "SELECT time_to_land_first_job, COUNT(*) as count FROM alumni_information WHERE time_to_land_first_job IS NOT NULL AND time_to_land_first_job != '' GROUP BY time_to_land_first_job";
        break;
    case 'year_graduated':
        $query = "SELECT year_graduated, COUNT(*) as count FROM alumni_information WHERE year_graduated IS NOT NULL AND year_graduated != '' GROUP BY year_graduated";
        break;
    case 'reasons_staying':
        // Fetch all reasons for staying
        $query = "SELECT reasons_staying FROM alumni_information WHERE reasons_staying IS NOT NULL AND reasons_staying != ''";
        $result = $conn->query($query);

        $reasons_count = [];
        while ($row = $result->fetch_assoc()) {
            // Split the reasons by comma and trim spaces
            $reasons = array_map('trim', explode(',', $row['reasons_staying']));

            // Count each reason
            foreach ($reasons as $reason) {
                if (!empty($reason)) {
                    if (isset($reasons_count[$reason])) {
                        $reasons_count[$reason]++;
                    } else {
                        $reasons_count[$reason] = 1;
                    }
                }
            }
        }

        $data['labels'] = json_encode(array_keys($reasons_count));
        $data['data'] = json_encode(array_values($reasons_count));
        echo json_encode($data);
        exit; // Exit after handling this case

    case 'reasons_accepting':
        // Fetch all reasons for accepting
        $query = "SELECT reasons_accepting FROM alumni_information WHERE reasons_accepting IS NOT NULL AND reasons_accepting != ''";
        $result = $conn->query($query);

        $reasons_count = [];
        while ($row = $result->fetch_assoc()) {
            // Split the reasons by comma and trim spaces
            $reasons = array_map('trim', explode(',', $row['reasons_accepting']));

            // Count each reason
            foreach ($reasons as $reason) {
                if (!empty($reason)) {
                    if (isset($reasons_count[$reason])) {
                        $reasons_count[$reason]++;
                    } else {
                        $reasons_count[$reason] = 1;
                    }
                }
            }
        }

        $data['labels'] = json_encode(array_keys($reasons_count));
        $data['data'] = json_encode(array_values($reasons_count));
        echo json_encode($data);
        exit; // Exit after handling this case

    case 'reasons_changing':
        // Fetch all reasons for changing
        $query = "SELECT reasons_changing FROM alumni_information WHERE reasons_changing IS NOT NULL AND reasons_changing != ''";
        $result = $conn->query($query);

        $reasons_count = [];
        while ($row = $result->fetch_assoc()) {
            // Split the reasons by comma and trim spaces
            $reasons = array_map('trim', explode(',', $row['reasons_changing']));

            // Count each reason
            foreach ($reasons as $reason) {
                if (!empty($reason)) {
                    if (isset($reasons_count[$reason])) {
                        $reasons_count[$reason]++;
                    } else {
                        $reasons_count[$reason] = 1;
                    }
                }
            }
        }

        $data['labels'] = json_encode(array_keys($reasons_count));
        $data['data'] = json_encode(array_values($reasons_count));
        echo json_encode($data);
        exit; // Exit after handling this case

    case 'reasons_for_pursuing_degrees':
        // Fetch all reasons for changing
        $query = "SELECT reasons_for_pursuing_degrees FROM alumni_information WHERE reasons_for_pursuing_degrees IS NOT NULL AND reasons_for_pursuing_degrees != ''";
        $result = $conn->query($query);

        $reasons_count = [];
        while ($row = $result->fetch_assoc()) {
            // Split the reasons by comma and trim spaces
            $reasons = array_map('trim', explode(',', $row['reasons_for_pursuing_degrees']));

            // Count each reason
            foreach ($reasons as $reason) {
                if (!empty($reason)) {
                    if (isset($reasons_count[$reason])) {
                        $reasons_count[$reason]++;
                    } else {
                        $reasons_count[$reason] = 1;
                    }
                }
            }
        }

        $data['labels'] = json_encode(array_keys($reasons_count));
        $data['data'] = json_encode(array_values($reasons_count));
        echo json_encode($data);
        exit; // Exit after handling this case

    case 'useful_competencies':
        // Fetch all reasons for changing
        $query = "SELECT useful_competencies FROM alumni_information WHERE useful_competencies IS NOT NULL AND useful_competencies != ''";
        $result = $conn->query($query);

        $reasons_count = [];
        while ($row = $result->fetch_assoc()) {
            // Split the reasons by comma and trim spaces
            $reasons = array_map('trim', explode(',', $row['useful_competencies']));

            // Count each reason
            foreach ($reasons as $reason) {
                if (!empty($reason)) {
                    if (isset($reasons_count[$reason])) {
                        $reasons_count[$reason]++;
                    } else {
                        $reasons_count[$reason] = 1;
                    }
                }
            }
        }

        $data['labels'] = json_encode(array_keys($reasons_count));
        $data['data'] = json_encode(array_values($reasons_count));
        echo json_encode($data);
        exit; // Exit after handling this case

    default:
        echo json_encode(['error' => 'Invalid chart type']);
        exit;
}

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $data[$row['course']] = $row['count']; // Adjust this line based on the chart type
}

$labels = json_encode(array_keys($data));
$values = json_encode(array_values($data));

echo json_encode(['labels' => $labels, 'data' => $values]);
