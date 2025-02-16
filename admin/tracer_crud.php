<?php
require 'tracer_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // STEP 1
    $alumni_name = $_POST['alumni_name'];
    $permanent_address = $_POST['permanent_address'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $mobile_number = $_POST['mobile_number'];
    $civil_status = $_POST['civil_status'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $course = $_POST['course'];
    $campus = $_POST['campus'];
    $location_of_residence = $_POST['location_of_residence'];

    // STEP 2 

    $degree_specialization = $_POST['degree_specialization'];
    $college_university = $_POST['college_university'];
    $year_graduated = $_POST['year_graduated'];
    $honors_or_awards = $_POST['honors_or_awards'];
    $name_of_examination = $_POST['name_of_examination'];
    $date_taken = $_POST['date_taken'];
    $rating = $_POST['rating'];
    $education_level = $_POST['education_level'];

    if (isset($_POST['reasons_for_pursuing_degrees']) && is_array($_POST['reasons_for_pursuing_degrees'])) {
        $reasons_for_pursuing_degrees = implode(", ", $_POST['reasons_for_pursuing_degrees']);
    } else {
        $reasons_for_pursuing_degrees = "";
    }

    // STEP 3

    $title_of_training = $_POST['title_of_training'];
    $duration_and_credits = $_POST['duration_and_credits'];
    $name_of_training = $_POST['name_of_training'];

    $pursue_advance = $_POST['pursue_advance'];

    if ($pursue_advance === "Others") {
        $pursue_advance = $_POST['other_pursue_advance'];
    } else {
        $other_pursue_advance = '';
    }

    // STEP 4

    $employment_status = $_POST['employment_status'];

    if (isset($_POST['not_employed_reasons']) && is_array($_POST['not_employed_reasons'])) {
        $not_employed_reasons = implode(", ", $_POST['not_employed_reasons']);
    } else {
        $not_employed_reasons = "";
    }

    $present_employment_status = $_POST['present_employment_status'];
    $self_employed_skills = $_POST['self_employed_skills'];

    $present_occupation = $_POST['present_occupation'];
    $business_line = $_POST['business_line'];
    $place_of_work = $_POST['place_of_work'];

    //STEP 5

    $first_job_after_college = $_POST['first_job_after_college'];

    if (isset($_POST['reasons_staying']) && is_array($_POST['reasons_staying'])) {
        $reasons_staying = $_POST['reasons_staying'];

        if (in_array("Other reason(s)", $reasons_staying)) {
            $other_reason = trim($_POST['other_reason_staying']);
            if (!empty($other_reason)) {
                $index = array_search("Other reason(s)", $reasons_staying);
                if ($index !== false) {
                    $reasons_staying[$index] = $other_reason;
                }
            } else {
                $reasons_staying = array_diff($reasons_staying, ["Other reason(s)"]);
            }
        }

        $reasons_staying = implode(", ", $reasons_staying);
    } else {
        $reasons_staying = "";
    }

    $first_job_related = $_POST['first_job_related'];

    if (isset($_POST['reasons_accepting']) && is_array($_POST['reasons_accepting'])) {
        $reasons_accepting = $_POST['reasons_accepting'];

        if (in_array("Other reason(s)", $reasons_accepting)) {
            $other_reason = trim($_POST['other_reason_accepting']);
            if (!empty($other_reason)) {
                $index = array_search("Other reason(s)", $reasons_accepting);
                if ($index !== false) {
                    $reasons_accepting[$index] = $other_reason;
                }
            } else {
                $reasons_accepting = array_diff($reasons_accepting, ["Other reason(s)"]);
            }
        }

        $reasons_accepting = implode(", ", $reasons_accepting);
    } else {
        $reasons_accepting = "";
    }

    // STEP 6

    if (isset($_POST['reasons_changing']) && is_array($_POST['reasons_changing'])) {
        $reasons_changing = $_POST['reasons_changing'];

        if (in_array("Other reason(s)", $reasons_changing)) {
            $other_reason = trim($_POST['other_reason_changing']);
            if (!empty($other_reason)) {
                $index = array_search("Other reason(s)", $reasons_changing);
                if ($index !== false) {
                    $reasons_changing[$index] = $other_reason;
                }
            } else {
                $reasons_changing = array_diff($reasons_changing, ["Other reason(s)"]);
            }
        }

        $reasons_changing = implode(", ", $reasons_changing);
    } else {
        $reasons_changing = "";
    }

    $duration_first_job = $_POST['duration_first_job'];

    $find_first_job = $_POST['find_first_job'];

    if ($find_first_job === "Others") {
        $find_first_job = $_POST['other_find_first_job'];
    } else {
        $other_find_first_job = '';
    }

    $time_to_land_first_job = $_POST['time_to_land_first_job'];

    $job_level_first_job = $_POST['job_level_first_job'];
    $job_level_current_job = $_POST['job_level_current_job'];
    $initial_gross_monthly_earning = $_POST['initial_gross_monthly_earning'];
    $curriculum_relevance = $_POST['curriculum_relevance'];

    if (isset($_POST['useful_competencies']) && is_array($_POST['useful_competencies'])) {
        $useful_competencies = $_POST['useful_competencies'];

        if (in_array("Other skills", $useful_competencies)) {
            $other_competency = trim($_POST['other_useful_competencies']);
            if (!empty($other_competency)) {
                $index = array_search("Other skills", $useful_competencies);
                if ($index !== false) {
                    $useful_competencies[$index] = $other_competency;
                }
            } else {
                $useful_competencies = array_diff($useful_competencies, ["Other skills"]);
            }
        }

        $useful_competencies = implode(", ", $useful_competencies);
    } else {
        $useful_competencies = "";
    }

    // STEP 7

    $curriculum_suggestions = $_POST['curriculum_suggestions'];







    // Use prepared statements
    $stmt = $conn->prepare(
        "INSERT INTO alumni_information (alumni_name, permanent_address, email, contact_number, mobile_number, civil_status, sex, birthday, course, campus, location_of_residence, 
        degree_specialization, college_or_university, year_graduated, honors_or_awards, name_of_examination, date_taken, rating, education_level, reasons_for_pursuing_degrees, 
        title_of_training, duration_and_credits, name_of_training, pursue_advance,
        employment_status, not_employed_reasons, present_employment_status, self_employed_skills, present_occupation, business_line, place_of_work,
        first_job_after_college, reasons_staying, first_job_related, reasons_accepting,
        reasons_changing, duration_first_job, find_first_job, time_to_land_first_job, job_level_first_job,  job_level_current_job, initial_gross_monthly_earning, curriculum_relevance, useful_competencies,
        curriculum_suggestions) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
        ?, ?, ?, ?, ?, ?, ?, ?, ?, 
        ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?)"
    );

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssisssssssssssssssssssssssssss",
            $alumni_name,
            $permanent_address,
            $email,
            $contact_number,
            $mobile_number,
            $civil_status,
            $sex,
            $birthday,
            $course,
            $campus,
            $location_of_residence,
            $degree_specialization,
            $college_university,
            $year_graduated,
            $honors_or_awards,
            $name_of_examination,
            $date_taken,
            $rating,
            $education_level,
            $reasons_for_pursuing_degrees,
            $title_of_training,
            $duration_and_credits,
            $name_of_training,
            $pursue_advance,
            $employment_status,
            $not_employed_reasons,
            $present_employment_status,
            $self_employed_skills,
            $present_occupation,
            $business_line,
            $place_of_work,
            $first_job_after_college,
            $reasons_staying,
            $first_job_related,
            $reasons_accepting,
            $reasons_changing,
            $duration_first_job,
            $find_first_job,
            $time_to_land_first_job,
            $job_level_first_job,
            $job_level_current_job,
            $initial_gross_monthly_earning,
            $curriculum_relevance,
            $useful_competencies,
            $curriculum_suggestions


        );

        if ($stmt->execute()) {
            // Redirect to the same page after successful insertion
            header("Location: "
                . $_SERVER['PHP_SELF']);
            exit(); // Ensure no further code is executed
        } else {
            echo "<script>alert('Failed to insert data: " . $stmt->error . "')</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Failed to prepare query: " . $conn->error . "')</script>";
    }
}
$conn->close();
