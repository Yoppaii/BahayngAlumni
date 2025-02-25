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
                            <!-- Check Availability -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                                    <span>Check Availability</span>
                                    <button id="check_availability_btn" class="btn btn-sm text-secondary shadow-none d-none" onclick="check_availability_clear()">Reset</button>
                                </h5>
                                <label class="form-label" style="font-weight: 500">Check-in</label>
                                <input type="date" class="form-control shadown-none mb-3" id="checkin" onchange="check_availability_filter()">
                                <label class="form-label" style="font-weight: 500">Check-out</label>
                                <input type="date" class="form-control shadown-none" id="checkout" onchange="check_availability_filter()">
                            </div>
                            <!-- <div class="border bg-light p-3 rounded mb-3">
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
                            </div> -->
                            <!-- Guests -->
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size: 18px;">
                                    <span>Guests</span>
                                    <button id="guests_btn" class="btn btn-sm text-secondary shadow-none d-none" onclick="guests_clear()">Reset</button>
                                </h5>

                                <div class="mb-2">
                                    <label class="form-label" for="capacity">Capacity</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseCapacity()">&#x2212;</button>
                                        <input type="number" min="1" id="capacity" oninput="guests_filter()" class="form-control shadow-none text-center">
                                        <button class="btn btn-outline-secondary" type="button" onclick="increaseCapacity()">&#x2b;</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4" id="rooms_data">

            </div>

        </div>
    </div>

    <script>
        let rooms_data = document.getElementById('rooms_data');

        let checkin = document.getElementById('checkin');
        let checkout = document.getElementById('checkout');
        let check_availability_btn = document.getElementById('check_availability_btn');

        let capacity = document.getElementById('capacity');
        let guests_btn = document.getElementById('guests_btn');

        function fetch_rooms() {
            let check_availability = JSON.stringify({
                checkin: checkin.value,
                checkout: checkout.value
            });

            let guests = JSON.stringify({
                capacity: capacity.value
            });

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "public/ajax/rooms.php?fetch_rooms&check_availability=" + check_availability + "&guests=" + guests, true);

            xhr.onprogress = function() {
                rooms_data.innerHTML = '<div class="spinner-border text-info mb-3 d-block mx-auto " id="loader" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>';
            }

            xhr.onload = function() {
                rooms_data.innerHTML = this.responseText;
            }

            xhr.send();

        }

        function check_availability_filter() {
            if (checkin.value != '' && checkout.value != '') {
                fetch_rooms();
                check_availability_btn.classList.remove('d-none');
            }
        }

        function check_availability_clear() {
            checkin.value = '';
            checkout.value = '';
            fetch_rooms();
            check_availability_btn.classList.add('d-none');

        }

        function guests_filter() {
            if (capacity.value > 0) {
                fetch_rooms();
                guests_btn.classList.remove('d-none');
            }
        }

        function guests_clear() {
            capacity.value = ''
            guests_btn.classList.add('d-none');
            fetch_rooms();
        }

        fetch_rooms();
    </script>

    <script>
        function increaseCapacity() {
            let input = document.getElementById('capacity');
            input.stepUp();
            guests_filter();
        }

        function decreaseCapacity() {
            let input = document.getElementById('capacity');
            if (input.value > 1) {
                input.stepDown();
                guests_filter();
            }
        }
    </script>

    <?php require 'inc/footer.php'; ?>


</body>

</html>