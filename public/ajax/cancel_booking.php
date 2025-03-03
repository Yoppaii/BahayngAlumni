<?php
define('ROOT_DIR', 'E:/xampp/htdocs/RoomReservation/');

require ROOT_DIR . 'admin/inc/db_config.php';
require ROOT_DIR . 'admin/inc/essentials.php';
require '../inc/sendgrid/sendgrid-php.php';

date_default_timezone_set("Asia/Manila");
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['cancel_booking'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE booking_order SET booking_status =?
    WHERE booking_id = ? AND user_id = ?";

    $values = ['cancelled', $frm_data['id'], $_SESSION['userId']];

    $result = update($query, $values, 'sii');
    echo $result;
}
