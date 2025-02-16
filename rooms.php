<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require 'inc/links.php'; ?>
    <title><?php echo $site_r['site_title'] ?> - Rooms</title>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.05);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">

    <?php require 'inc/header.php'; ?>


    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line mt-2 bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus eaque totam minus eligendi dicta quos adipisci deleniti sunt ducimus ad.
        </p>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">FILTERS</h4>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                <label class="form-label" style="font-weight: 500">Check-in</label>
                                <input type="date" class="form-control shadown-none">
                                <label class="form-label" style="font-weight: 500">Check-out</label>
                                <input type="date" class="form-control shadown-none">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadown-none me-1">
                                    <label class="form-check-label" for="f1">Facility one</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadown-none me-1">
                                    <label class="form-check-label" for="f2">Facility two</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadown-none me-1">
                                    <label class="form-check-label" for="f3">Facility three</label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                                <div class="mb-2">
                                    <label class="form-label" for="g1">Capacity</label>
                                    <input type="number" id="g1" class="form-input shadown-none me-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">

                <?php

                // Get Features of Rooms

                $room_res = select("SELECT * FROM rooms WHERE status=? AND removed=? ORDER BY id ASC", [1, 0], 'ii');

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

                        $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
                    }

                    echo <<<data
                    <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 p-3 align-items-center text-center">
                            <div class="col-md-5 d-flex justify-content-center align-items-center mb-3 mb-md-0">
                                <img src="$room_thumb" style="height:250px;" class="img-fluid rounded" alt="...">
                            </div>
                            <div class="col-md-5 px-lg-3 px-md-3 px-0 text-start">
                                <h5 class="mb-3">$room_data[name]</h5>
                                <div class="features mb-3">
                                    <h6 class="mb-1">features</h6>
                                    $features_data
                                </div>
    
                                <div class="facilities mb-3">
                                    <h6 class="mb-1">Facilities</h6>
                                    $facilities_data
                                </div>
                                <div class="capacity">
                                    <h6 class="mb-1">Capacity</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[adult] Adults
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[children] Children
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 mt-lg-0 mt-md-0 mt-3 text-align-center text-center">
                                <h6 class="mb-3">₱$room_data[price] / night</h6>
                                $book_btn
                                <a href="room_details.php?id=$room_data[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none"> More Details</a>
                            </div>
                        </div>
                    </div>
                    data;
                }

                ?>




            </div>

        </div>
    </div>




    <?php require 'inc/footer.php'; ?>


</body>

</html>