<?php
require '../inc/paymongo/config.php';
require __DIR__ . '/../../admin/inc/db_config.php';
require __DIR__ . '/../../admin/inc/essentials.php';


date_default_timezone_set("Asia/Manila");

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['book_now'])) {
    $frm_data = filteration($_POST);

    $ORDER_ID = 'ORD_' . $_SESSION['userId'] . random_int(11111, 9999999);
    $CUST_ID = $_SESSION['userId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'] * 100;
    $ROOM_NAME = $_SESSION['room']['name'];

    $checkin = $frm_data['checkin'] . " 14:00:00";
    $checkout = $frm_data['checkout'] . " 11:00:00";

    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) 
        VALUES (?,?,?,?,?)";

    insert(
        $query1,
        [$CUST_ID, $_SESSION['room']['id'], $checkin, $checkout, $ORDER_ID],
        'issss'
    );

    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, 
        `user_name`, `phone_number`, `address`)
        VALUES (?,?,?,?,?,?,?)";

    insert($query2, [
        $booking_id,
        $_SESSION['room']['name'],
        $_SESSION['room']['price'],
        $TXN_AMOUNT,
        $frm_data['name'],
        $frm_data['phoneNumber'],
        $frm_data['address']
    ], 'issssss');

    // ✅ Add success message & redirect
    echo "<script>
            alert('Success! Your booking has been confirmed.');
            window.location.href = 'bookings.php';
          </script>";
    exit();
}
