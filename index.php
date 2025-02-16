<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>
    <title><?php echo $site_r['site_title'] ?> - Home</title>
    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 25;
                padding: 0 35px;
            }

        }
    </style>


</head>

<body>

    <?php require('inc/header.php'); ?>

    <!-- Index Carousel -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-index">
            <div class="swiper-wrapper">
                <?php
                $res = selectAll('hero_details');
                while ($row = mysqli_fetch_assoc($res)) {
                    $path = HERO_IMG_PATH;
                    echo <<<data
                    <div class="swiper-slide">
                        <img src="$path$row[picture]" class="w-100 d-block">
                    </div>
            
                    data;
                }
                ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Check Availability Form -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5>Check Booking Availability</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Check-in</label>
                            <input type="date" class="form-control shadown-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Check-in</label>
                            <input type="date" class="form-control shadown-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Adult</label>
                            <select class="form-select shadown-none">
                                <option selected>Open this select </option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Children</label>
                            <select class="form-select shadown-none">
                                <option selected>Open this select </option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadown-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Our Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

    <div class="container">
        <div class="row">

            <?php

            // Get Features of Rooms

            $room_res = select("SELECT * FROM rooms WHERE status=? AND removed=? ORDER BY id ASC LIMIT 3 ", [1, 0], 'ii');

            while ($room_data = mysqli_fetch_assoc($room_res)) {

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

                // Room Card


                $book_btn = "";

                if (!$site_r['shutdown']) {

                    $login = 0;
                    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                        $login = 1;
                    }

                    $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
                }


                echo <<<data
                
                <div class="col-lg-4 col-md-6 my-3">

                    <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                        <img src="$room_thumb" style="height:250px;" class="card-img-top">

                        <div class="card-body">
                            <h5>$room_data[name]</h5>
                            <h6 class="mb-4">₱$room_data[price]</h6>
                            <div class="features mb-4">
                                <h6 class="mb-1">features</h6>
                                $features_data

                            </div>

                            <div class="facilities mb-4">
                                <h6 class="mb-1">Facilities</h6>
                                $facilities_data
                            </div>

                            <div class="capacity mb-4">
                                    <h6 class="mb-1">Capacity</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[adult] Adults
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[children] Children
                                    </span>
                                </div>
                            <div class="rating mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <!-- Display 5 stars -->
                                <span>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                            </div>

                            <div class="d-flex justify-content-evenly mb-2">
                                $book_btn
                                <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none"> More Details</a>

                            </div>

                        </div>
                    </div>

                </div>
                data;
            }

            ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>

            </div>
        </div>
    </div>


    <!-- Our Facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <?php
            $res = mysqli_query($con, "SELECT * FROM facilities  ORDER BY id DESC LIMIT 5");
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="$path$row[icon]" width="60px">
                    <h5 class="mt-3">$row[name]</h5>
                </div>
                data;
            }

            ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities</a>

            </div>
        </div>
    </div>


    <!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>

    <div class="container">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User</h6>
                    </div>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum assumenda voluptatibus dolor
                        amet
                        nulla atque culpa ex? Error, nihil adipisci!
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        </span>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User</h6>
                    </div>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum assumenda voluptatibus dolor
                        amet
                        nulla atque culpa ex? Error, nihil adipisci!
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        </span>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User</h6>
                    </div>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum assumenda voluptatibus dolor
                        amet
                        nulla atque culpa ex? Error, nihil adipisci!
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        </span>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User</h6>
                    </div>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum assumenda voluptatibus dolor
                        amet
                        nulla atque culpa ex? Error, nihil adipisci!
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        </span>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="" width="30px">
                        <h6 class="m-0 ms-2">Random User</h6>
                    </div>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum assumenda voluptatibus dolor
                        amet
                        nulla atque culpa ex? Error, nihil adipisci!
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        </span>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More</a>
        </div>
    </div>


    <!-- Contact Us -->


    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100 rounded"
                    src="<?php echo $contact_r['iframe'] ?>"
                    height="320px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call us</h5>
                    <a href="tel: +63 9354390173" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +63 <?php echo $contact_r['phone_number1'] ?>
                    </a>
                    <br>
                    <a href="tel: +63 9354390173" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +63 <?php echo $contact_r['phone_number2'] ?>
                    </a>
                </div>

                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow us</h5>
                    <a href="<?php echo $contact_r['facebook'] ?>" target="_blank" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p2">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['twitter'] ?>" target="_blank" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p2">
                            <i class="bi bi-twitter me-1"></i> Twitter
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['instagram'] ?>" target="_blank" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p2">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal and Code -->

    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="recovery_form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control shadown-none mb-3" required>
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control shadown-none" required>
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>
                        <div class="mb-2 text-end">
                            <button type="button" class="btn shadown-none p-0 me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark shadown-none">Submit</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <?php require('inc/footer.php'); ?>

    <?php
    if (isset($_GET['account_recovery'])) {
        $data = filteration($_GET);

        $token_date = date("Y-m-d");

        $query = select(
            "SELECT * FROM user_credentials WHERE email=? AND token=? AND token_expire=? LIMIT 1",
            [$data['email'], $data['token'], $token_date],
            'sss'
        );

        if (mysqli_num_rows($query) == 1) {
            echo <<< showModal
                <script>
                    var myModal = document.getElementById('recoveryModal');

                    myModal.querySelector("input[name='email']").value = '$data[email]';
                    myModal.querySelector("input[name='token']").value = '$data[token]';

                    var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                    modal.show();
                </script>
            showModal;
        } else {
            alert("failed", "Invalid or Expired Link");
        }
    }
    ?>

    <!-- SwiperJS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper Index -->
    <script>
        var swiper = new Swiper(".swiper-index", {
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <!-- Initialize Swiper Testimonials -->
    <script>
        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>

    <!-- Account Recovery -->
    <script>
        let recovery_form = document.getElementById('recovery_form');

        recovery_form.addEventListener('submit', (e) => {
            e.preventDefault();

            let data = new FormData();

            data.append('email', recovery_form.elements['email'].value);
            data.append('token', recovery_form.elements['token'].value);
            data.append('password', recovery_form.elements['password'].value);
            data.append('confirmPassword', recovery_form.elements['confirmPassword'].value);
            data.append('recover_user', '');

            var myModal = document.getElementById('recoveryModal');
            var modal = bootstrap.Modal.getInstance(myModal);


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/login_register.php", true);


            xhr.onload = function() {
                if (this.responseText == 'reset_failed') {
                    alert('failed', 'Password reset failed');
                } else if (this.responseText == 'password_mismatch') {
                    alert('failed', 'Password and Confirm password must be match');
                } else {
                    alert('success', 'Password reset successful');
                    recovery_form.reset();
                    modal.hide();
                }

            }

            xhr.send(data);

        });
    </script>

</body>

</html>