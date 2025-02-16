<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require 'inc/links.php'; ?>
    <title><?php echo $site_r['site_title'] ?> - Room Details</title>
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

    <?php
    if (!isset($_GET['id'])) {
        redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM rooms WHERE id=? AND status=? AND removed=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);



    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold"><?php echo $room_data['name'] ?></h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>

                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        // Get Thumbnail

                        $room_img = ROOMS_IMG_PATH . "thumbnail.png";
                        $img_query = mysqli_query($con, "SELECT * FROM room_images 
                            WHERE room_id = $room_data[id]");

                        if (mysqli_num_rows($img_query) > 0) {
                            $active_class = 'active';

                            while ($img_res = mysqli_fetch_assoc($img_query)) {
                                echo "<div class='carousel-item $active_class'>                                    
                                    <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='rounded''>
                                </div>";
                                $active_class = '';
                            }
                        } else {
                            echo "<div class='carousel-item active'>
                                <img src='$room_img' class='d-block w-100'>
                            </div>";
                        }


                        ?>
                    </div>

                    <div class="carousel-controls">
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow rounded-3">
                    <div class="card-body">
                        <?php

                        echo <<<price
                                <h4>₱$room_data[price] per night</h4>
                            price;

                        echo <<<rating
                            <div class="rating mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                </span>
                            </div>
                            rating;

                        $features_query = mysqli_query($con, "SELECT f.name FROM `features` f
                        INNER JOIN room_features rfea ON f.id = rfea.features_id
                        WHERE rfea.room_id = '$room_data[id]'");

                        $features_data = "";

                        while ($features_row = mysqli_fetch_assoc($features_query)) {
                            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                $features_row[name]
                            </span>";
                        }

                        echo <<<features
                            <div class="features mb-3">
                                <h6 class="mb-1">Features</h6>
                                $features_data
                            </div>
                        features;


                        $facilities_query = mysqli_query($con, "SELECT f.name FROM `facilities` f
                        INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id
                        WHERE rfac.room_id = '$room_data[id]'");

                        $facilities_data = "";

                        while ($facilities_row = mysqli_fetch_assoc($facilities_query)) {
                            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                $facilities_row[name]
                            </span>";
                        }

                        echo <<<facilities
                        <div class="facilities mb-3">
                            <h6 class="mb-1">Facilities</h6>
                            $facilities_data
                        </div>
                        facilities;

                        echo <<<guests
                        
                        <div class="guests mb-3">
                            <h6 class="mb-1">Capacity</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                $room_data[adult] Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                 $room_data[children] Children
                            </span>
                        </div>
                        guests;

                        echo <<<area
                        <div class="area mb-3">
                            <h6 class="mb-1">Area</h6>
                            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $room_data[area] sq. ft.
                            </span>
                        </div>
                        area;

                        $book_btn = "";

                        if (!$site_r['shutdown']) {
                            $login = 0;
                            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                $login = 1;
                            }
                            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
                        }

                        echo <<<book
                            $book_btn
                        book;
                        ?>
                    </div>
                </div>

            </div>

            <div class="col-12 mt-4 px-4">
                <div class="mb-5">
                    <h5>Description</h5>
                    <p>
                        <?php
                        echo $room_data['description'];
                        ?>
                    </p>
                </div>

                <div>
                    <h5 class="mb-3"> Reviews and Ratings</h5>
                    <div>
                        <div class="d-flex align-items-center mb-3">
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

            </div>
        </div>
    </div>




    <?php require 'inc/footer.php'; ?>


</body>

</html>