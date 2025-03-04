<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;500;600&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<?php

session_start();

date_default_timezone_set("Asia/Manila");


require(__DIR__ . '/../../admin/inc/db_config.php');
require(__DIR__ . '/../../admin/inc/essentials.php');


$site_q = "SELECT * FROM site_settings WHERE sr_no=?";
$values = [1];
$site_r = mysqli_fetch_assoc(select($site_q, $values, 'i'));

$contact_q = "SELECT * FROM contact_settings WHERE sr_no=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

if ($site_r['shutdown']) {
    echo <<< alertbar
        <div class='bg-danger text-center p-2 fw-bold'>
            <i class="bi bi-exclamation-triangle-fill"> </i>
            Bookings are temporarily closed!
        </div>
    alertbar;
}



?>