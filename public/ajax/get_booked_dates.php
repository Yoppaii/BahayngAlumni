<?php

define('ROOT_DIR', 'E:/xampp/htdocs/RoomReservation/');

require ROOT_DIR . 'admin/inc/db_config.php';
require ROOT_DIR . 'admin/inc/essentials.php';
// require '../inc/sendgrid/sendgrid-php.php';

date_default_timezone_set(timezoneId: "Asia/Manila");
session_start();

if (!isset($_SESSION['room']['id'])) {
    echo json_encode(["error" => "Room ID is missing from session"]);
    exit;
}

$room_id = intval($_SESSION['room']['id']); // Get room ID from session
// $room_id = 7;
$bookedDates = [];

$query = "SELECT check_in, check_out FROM booking_order WHERE room_id = ? AND booking_status = 'booked'";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $checkin = new DateTime($row['check_in']);
    $checkout = new DateTime($row['check_out']);

    while ($checkin < $checkout) {
        $bookedDates[] = $checkin->format('Y-m-d');
        $checkin->modify('+1 day'); // Move to the next date
    }
}

echo json_encode($bookedDates);
