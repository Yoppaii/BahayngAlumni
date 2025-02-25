<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require 'inc/links.php'; ?>
    <title><?php echo $site_r['site_title'] ?> - Confirm Booking</title>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.05);
            transition: all 0.3s;
        }

        .booked {
            background-color: red !important;
            color: white !important;
            pointer-events: none;
            /* Prevent selection */
        }
    </style>
</head>

<body class="bg-light">

    <?php require 'inc/header.php'; ?>

    <?php

    /* 
        Check room id from url if present or not
        Shutdown mode is active or not
        User is logged in or not
    */

    if (!isset($_GET['id']) || $site_r['shutdown'] == true) {
        redirect('rooms.php');
    } else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('rooms.php');
    }

    //filter and get room and user data

    $data = filteration($_GET);

    $room_res = select(
        "SELECT * FROM rooms WHERE id=? AND status=? AND removed=?",
        [$data['id'], 1, 0],
        'iii'
    );

    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
        "id" => $room_data['id'],
        "name" => $room_data['name'],
        "price" => $room_data['price'],
        "payment" => NULL,
        "available" => false,
    ];

    // for debugging
    // print_r($_SESSION);


    $user_res = select(
        "SELECT * FROM `user_credentials` WHERE id=? LIMIT 1",
        [$_SESSION['userId']],
        'i'
    );
    $user_data = mysqli_fetch_assoc($user_res);

    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">Confirm Booking</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">Rooms</a>
                    <span class="text-secondary"> > </span>
                    <a href="#.php" class="text-secondary text-decoration-none">Confirm</a>

                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">

                <?php
                // Get Thumbnail

                $room_thumb = ROOMS_IMG_PATH . "thumbnail.png";
                $thumb_query = mysqli_query($con, "SELECT * FROM room_images 
                WHERE room_id = $room_data[id] AND thumb = '1'");

                if (mysqli_num_rows($thumb_query) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_query);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                echo <<<data
                    <div class='card p-3 shadow-sm rounded'>
                        <img src="$room_thumb" style="height:400px;" class="img-fluid rounded mb-3">
                        <h5>$room_data[name]</h5>
                        <h6>₱$room_data[price] per night</h6>
                    </div>
                data;
                ?>

            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <div class="card-body">
                        <form action="pay_now.php" id="booking_form" method="POST">
                            <h6 class="mb-3">Booking Details</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadown-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input name="phoneNumber" type="number" value="<?php echo $user_data['phoneNumber'] ?>" class="form-control shadown-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $user_data['address'] ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-in</label>
                                    <input name="checkin" id="checkin" onchange="check_availability()" type="date" class="form-control shadown-none" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Check-out</label>
                                    <input name="checkout" id="checkout" onchange="check_availability()" type="date" class="form-control shadown-none" required>
                                </div>
                                <div class="col-12">
                                    <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h6 class="mb-3 text-danger" id="pay_info">Provide check-in & check-out date!</h6>
                                    <button name="pay_now" class="btn w-100 text-white custom-bg shadow-none mb-1" disabled>Pay Now</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>

        </div>
    </div>




    <?php require 'inc/footer.php'; ?>

    <!-- <script>
        function fetchBookedDates() {
            let formData = new FormData();
            formData.append("fetch_booked_dates", true);

            fetch("fetch_booked_dates.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Booked Dates Response:", data); // Debugging output

                    if (data.status === "success") {
                        initializeFlatpickr(data.booked_dates);
                    } else {
                        console.error("Error: Invalid response format");
                    }
                })
                .catch(error => console.error("Error fetching booked dates:", error));
        }
    </script> -->

    <script>
        let booking_form = document.getElementById('booking_form');
        let info_loader = document.getElementById('info_loader');
        let pay_info = document.getElementById('pay_info');

        function check_availability() {
            let checkin_value = booking_form.elements['checkin'].value;
            let checkout_value = booking_form.elements['checkout'].value;

            booking_form.elements['pay_now'].setAttribute('disabled', true);

            if (checkin_value != '' && checkout_value != '') {

                pay_info.classList.add('d-none');
                pay_info.classList.replace('text-dark', 'text-danger');
                info_loader.classList.remove('d-none');

                let data = new FormData();

                data.append('check_availability', '');
                data.append('checkin', checkin_value);
                data.append('checkout', checkout_value);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/confirm_booking.php", true);

                xhr.onload = function() {

                    let data = JSON.parse(this.responseText);

                    if (data.status == 'check_in_out_equal') {
                        pay_info.innerText = "You cannot check-out on the same day";
                    } else if (data.status == 'check_out_earlier') {
                        pay_info.innerText = "You cannot check-out earlier than check-in date";
                    } else if (data.status == 'check_in_earlier') {
                        pay_info.innerText = "You cannot check-in earlier than today's date";
                    } else if (data.status == 'unavailable') {
                        pay_info.innerText = "Room is not available for this check-in date";
                    } else {
                        pay_info.innerHTML = "No. of Days: " + data.days + "<br>Total Amount to pay: ₱" + data.payment;
                        pay_info.classList.replace('text-danger', 'text-dark');
                        booking_form.elements['pay_now'].removeAttribute('disabled');
                    }

                    pay_info.classList.remove('d-none');
                    info_loader.classList.add('d-none');

                }

                xhr.send(data);

            }
        }
    </script>


</body>

</html>