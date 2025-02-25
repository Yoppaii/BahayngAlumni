<?php

define('ROOT_DIR', 'E:/xampp/htdocs/RoomReservation/');

require ROOT_DIR . 'admin/inc/db_config.php';
require ROOT_DIR . 'admin/inc/essentials.php';
// require '../inc/sendgrid/sendgrid-php.php';

date_default_timezone_set(timezoneId: "Asia/Manila");
session_start();

if (isset($_GET['fetch_rooms'])) {


    // Availability Filter data decode

    $check_availability = json_decode($_GET['check_availability'], true);

    if ($check_availability['checkin'] != '' && $check_availability['checkout'] != '') {
        // check in and out validation
        $today_date = new DateTime(date("Y-m-d"));
        $checkin_date = new DateTime($check_availability['checkin']);
        $checkout_date = new DateTime($check_availability['checkout']);

        if ($checkin_date < $today_date) {
            echo "<h3 class='text-center text-danger'>Invalid Dates!</h3>";
            exit;
        } else if ($checkin_date == $checkout_date) {
            echo "<h3 class='text-center text-danger'>Invalid Dates!</h3>";
            exit;
        } else if ($checkout_date < $checkin_date) {
            echo "<h3 class='text-center text-danger'>Invalid Dates!</h3>";
            exit;
        }
    }


    // guests data decode
    $guests = json_decode($_GET['guests'], true);
    $capacity = ($guests['capacity'] != '') ? $guests['capacity'] : 0;
    // $capacity = (!empty($guests->capacity)) ? $guests->capacity : 0;


    // counter number of rooms

    $count_rooms = 0;
    $output = "";

    // fetching settings table to check if the website is shutdown or not
    $site_q = "SELECT * FROM site_settings WHERE sr_no=1";
    $site_r = mysqli_fetch_assoc(mysqli_query($con, $site_q));


    // Get Features of Rooms

    $room_res = select("SELECT * FROM rooms WHERE capacity>=? AND status=? AND removed=? ORDER BY id ASC", [$capacity, 1, 0], 'iii');

    while ($room_data = mysqli_fetch_assoc($room_res)) {

        if (!empty($check_availability['checkin']) && !empty($check_availability['checkout'])) {
            // run query to check room availability

            $tb_query = "SELECT COUNT(*) AS total_bookings FROM booking_order
                WHERE room_id=?
                AND check_out >? AND check_in <?";

            $values = [$room_data['id'], $check_availability['checkin'], $check_availability['checkout']];
            $tb_fetch = mysqli_fetch_assoc(select($tb_query, $values, 'iss'));

            if ($room_data['quantity'] <= $tb_fetch['total_bookings']) {
                continue;
            }
        }

        $features_query = mysqli_query($con, "SELECT f.name FROM `features` f
                        INNER JOIN room_features rfea ON f.id = rfea.features_id
                        WHERE rfea.room_id = '$room_data[id]'");

        $features_data = "";

        while ($features_row = mysqli_fetch_assoc($features_query)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $features_row[name]
                            </span>";
        }


        // Get Facilities of Rooms

        $facilities_query = mysqli_query($con, "SELECT f.name FROM `facilities` f
                        INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id
                        WHERE rfac.room_id = '$room_data[id]'");

        $facilities_data = "";

        while ($facilities_row = mysqli_fetch_assoc($facilities_query)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $facilities_row[name]
                            </span>";
        }

        // Get Thumbnail

        $room_thumb = ROOMS_IMG_PATH . "thumbnail.png";
        $thumb_query = mysqli_query($con, "SELECT * FROM room_images 
                        WHERE room_id = $room_data[id] AND thumb = '1'");

        if (mysqli_num_rows($thumb_query) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_query);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        }

        // Room Cards

        $book_btn = "";

        if (!$site_r['shutdown']) {

            $login = 0;
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $login = 1;
            }

            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
        }

        $output .= "
            <div class='card mb-4 border-0 shadow'>
                <div class='row g-0 p-3 align-items-center text-center'>
                    <div class='col-md-5 d-flex justify-content-center align-items-center mb-3 mb-md-0'>
                        <img src='$room_thumb' style='height:250px;' class='img-fluid rounded' alt='...'>
                    </div>
                    <div class='col-md-5 px-lg-3 px-md-3 px-0 text-start'>
                        <h5 class='mb-3'>$room_data[name]</h5>
                        <div class='features mb-3'>
                            <h6 class='mb-1'>features</h6>
                            $features_data
                        </div>

                        <div class='facilities mb-3'>
                            <h6 class='mb-1'>Facilities</h6>
                            $facilities_data
                        </div>
                        <div class='capacity'>
                        <h6 class='mb-1'>Max Capacity</h6>
                        <span class='badge rounded-pill bg-light text-dark text-wrap'>
                            $room_data[capacity] Guests
                        </span>
                    </div>
                    </div>
                    <div class='col-md-2 mt-lg-0 mt-md-0 mt-3 text-align-center text-center'>
                        <h6 class='mb-3'>₱$room_data[price] / night</h6>
                        $book_btn
                        <a href='room_details.php?id=$room_data[id]' class='btn btn-sm w-100 btn-outline-dark shadow-none'> More Details</a>
                    </div>
                </div>
            </div>
        ";
        $count_rooms++;
    }

    if ($count_rooms > 0) {
        echo $output;
    } else {
        echo "<h3 class='text-center text-danger'>No rooms to show</h3>";
    }
}
