<?php
require 'inc/essentials.php';
require 'inc/db_config.php';
adminLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Refund Bookings</title>
    <?php require 'inc/links.php'; ?>
    <style>
    </style>

</head>

<body class="bg-light">

    <?php require 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Refund Bookings</h3>

                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">

                        <div class="image_alert"></div>

                        <div class="text-end mb-4">
                            <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Search here: ">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border"style="min-width: 1200px;">
                                <thead>
                                    <tr class="bg-dark text-light" >
                                        <th scope="col">#</th>
                                        <th scope="col">User Details</th>
                                        <th scope="col">Room Details</th>
                                        <th scope="col">Bookings Period</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="refund_bookings_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require 'inc/scripts.php'; ?>


    <script src="page-scripts/refund_bookings.js"></script>
</body>

</html>