<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require '../inc/links.php'; ?>
    <title><?php echo $site_r['site_title'] ?> - Bookings</title>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.05);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">

    <?php require '../inc/header.php';

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }

    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Bookings</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="#.php" class="text-secondary text-decoration-none">Bookings</a>

                </div>
            </div>

            <?php
            $query = "SELECT bo.*, bd.* FROM booking_order bo
            INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
            WHERE ((bo.booking_status = 'booked')
            OR (bo.booking_status = 'cancelled'))
            AND (bo.user_id = ?)
            ORDER BY bo.booking_id DESC";

            $result = select($query, [$_SESSION['userId']], 'i');

            while ($data = mysqli_fetch_assoc($result)) {
                $checkin = new DateTime($data['check_in']);
                $checkout = new DateTime($data['check_out']);
                $created_date = new DateTime($data['dateandtime']); // Creation date
                $current_time = new DateTime(); // Current time

                // Calculate the deadline (24 hours after creation)
                $deadline = clone $created_date;
                $deadline->modify('+24 hours');

                // Get remaining time in seconds
                $remaining_time = $deadline->getTimestamp() - $current_time->getTimestamp();

                $status_bg = "";
                $btn = "";

                if ($data['booking_status'] == 'booked') {
                    $status_bg = "bg-success";

                    if ($data['arrival'] == 1) {
                        // User has checked in
                        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm fw-bold shadow-none me-1'>Download PDF</a>";

                        if ($data['rate_review'] == 0) {
                            $btn .= "<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm shadow-none'>Rate & Review</button>";
                        }
                    } else {
                        // Check if the 24-hour deadline has passed
                        if ($remaining_time <= 0) {
                            $btn .= "<span class='text-danger fw-bold'>No-Show</span>";
                            $status_bg = "bg-secondary";
                        } else {
                            // Convert remaining time into hours and minutes
                            $remaining_time_hours = floor($remaining_time / 3600);
                            $remaining_time_minutes = floor(($remaining_time % 3600) / 60);

                            // echo "Current time: " . $current_time->format("d-m-Y h:i A") . "<br>";
                            // echo "Deadline time: " . $deadline->format("d-m-Y h:i A") . "<br>";

                            $btn .= "<button id='cancel_btn_$data[booking_id]' onclick='cancel_booking($data[booking_id])' type='button' class='btn btn-danger btn-sm shadow-none' ";

                            if ($remaining_time <= 0) {
                                $btn .= "disabled>Cannot Cancel</button>";
                            } else {
                                $btn .= ">Cancel ($remaining_time_hours hrs $remaining_time_minutes mins left)</button>";
                            }
                        }
                    }
                } else if ($data['booking_status'] == 'cancelled') {
                    $status_bg = "bg-danger";
                    $btn = "<span class='text-light fw-bold'>Cancelled</span>";
                } else {
                    $status_bg = "bg-warning";
                    $btn = "<button type='button' class='btn btn-dark btn-sm shadow-none'>Rate & Review</button>";
                }



                echo <<<bookings
                    <div class='col-md-4 px-4 mb-4'>
                        <div class='bg-white p-3 rounded shadow-sm'>
                            <h5 class='fw-bold'>$data[room_name]</h5>
                            <p>$data[price] per night</p>
                            <p>
                                <b>Check-in: <br></b> {$checkin->format('d F Y - h:i A')}<br>
                                <b>Check-out: <br></b> {$checkout->format('d F Y - h:i A')}
                            </p>
                            <p>
                                <b>Amount: </b>₱$data[price] <br>
                                <b>Order ID: </b>$data[order_id]<br>
                            </p>
                            <p>
                                <span class='badge $status_bg'>$data[booking_status]</span>
                            </p>
                            $btn
                        </div>
                    </div>
                bookings;
            }
            ?>



        </div>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="review_form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i> Rate & Review
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select class="form-select shadow-none" name="rating">
                                <option value="5">Excellent</option>
                                <option value="4">Good</option>
                                <option value="3">Fair</option>
                                <option value="2">Poor</option>
                                <option value="1">Bad</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Review</label>
                            <textarea type="text" name="review" rows="3" class="form-control shadown-none" required></textarea>
                        </div>

                        <input type="hidden" name="booking_id">
                        <input type="hidden" name="room_id">

                        <div class="text-end">
                            <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    if (isset($_GET['cancel_status'])) {
        alert('success', 'Booking Cancelled!');
    } else if (isset($_GET['review_status'])) {
        alert('success', 'Thank you for your rating & review!');
    }
    ?>

    <?php require '../inc/footer.php'; ?>

    <script>
        function cancel_booking(id) {
            if (confirm("Are you sure you want to cancel this booking?")) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "/RoomReservation/public/ajax/cancel_booking.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (this.responseText == 1) {
                        window.location.href = "bookings.php?cancel_status=true";
                    } else {
                        alert('failed', 'Booking Cancellation Failed!');
                    }
                }

                xhr.send('cancel_booking&id=' + id);
            }
        }

        let review_form = document.getElementById('review_form');

        function review_room(booking_id, room_id) {
            review_form.elements['booking_id'].value = booking_id;
            review_form.elements['room_id'].value = room_id;;

        }

        review_form.addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData();
            data.append('review_form', '');
            data.append('rating', review_form.elements['rating'].value);
            data.append('review', review_form.elements['review'].value);
            data.append('booking_id', review_form.elements['booking_id'].value);
            data.append('room_id', review_form.elements['room_id'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "/RoomReservation/public/ajax/review_room.php", true);

            xhr.onload = function() {
                if (this.responseText == 1) {
                    // var myModal = document.getElementById('reviewModal');
                    // var modal = bootstrap.Modal.getInstance(myModal);
                    // modal.hide();
                    // alert('success', 'Thank you for your rating & review!');

                    window.location.href = 'bookings.php?review_status=true';
                } else {
                    var myModal = document.getElementById('reviewModal');
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();

                    alert('failed', 'Rating & Review Failed!');
                }
            }

            xhr.send(data);
        });

        // function updateCancelCountdown(bookingId, remainingHours) {
        //     let btn = document.getElementById(`cancel_btn_${bookingId}`);
        //     if (!btn) return;

        //     let interval = setInterval(() => {
        //         remainingHours--;
        //         if (remainingHours <= 0) {
        //             btn.innerText = "Cannot Cancel";
        //             btn.disabled = true;
        //             clearInterval(interval);
        //         } else {
        //             btn.innerText = `Cancel (${remainingHours} hrs left)`;
        //         }
        //     }, 3600000); // Update every hour
        // }

        // // Call this function when loading the page with real values
        // updateCancelCountdown(booking_id, remaining_time);
    </script>
</body>

</html>