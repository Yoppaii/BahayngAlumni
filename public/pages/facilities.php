<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require '../inc/links.php'; ?>
    <title><?php echo $site_r['site_title'] ?> - Facilities</title>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.05);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">

    <?php require '../inc/header.php'; ?>


    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line mt-2 bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus eaque totam minus eligendi dicta quos adipisci deleniti sunt ducimus ad.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $res = selectAll('facilities');
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                <div class="col-lg-4 col-md-6 mb-5 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                        <div class="d-flex align-items-center mb-2">
                            <img src="$path$row[icon]" width="40px" alt="Icon" class="mb-3">
                            <h5 class="mb-3">$row[name]</h5>
                        </div
                        <p class="mb-3">$row[description]</p>
                    </div>
                </div>
                data;
            }

            ?>

        </div>
    </div>




    <?php require '../inc/footer.php'; ?>

</body>

</html>