<?php
require '../inc/paymongo/config.php';
require __DIR__ . '/../../admin/inc/db_config.php';
require __DIR__ . '/../../admin/inc/essentials.php';


date_default_timezone_set("Asia/Manila");

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['pay_now'])) {

    $ORDER_ID = 'ORD_' . $_SESSION['userId'] . random_int(11111, 9999999);
    $CUST_ID = $_SESSION['userId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'] * 100;
    $ROOM_NAME = $_SESSION['room']['name'];

    $secretKey = PAYMONGO_SECRET_KEY;

    $data = [
        "data" => [
            "attributes" => [
                "amount" => $TXN_AMOUNT,
                "description" => $ROOM_NAME,
                "remarks" => $ORDER_ID,
            ]
        ]
    ];

    $frm_data = filteration($_POST);

    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) 
        VALUES (?,?,?,?,?)";

    insert(
        $query1,
        [$CUST_ID, $_SESSION['room']['id'], $frm_data['checkin'], $frm_data['checkout'], $ORDER_ID],
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

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paymongo.com/v1/links");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Accept: application/json",
        "Authorization: Basic " . base64_encode($secretKey . ":")
    ]);

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    // Check if the Payment Link was created successfully
    if (isset($response['data']['attributes']['checkout_url'])) {
        header("Location: " . $response['data']['attributes']['checkout_url']);
        exit();
    } else {
        echo "Error creating payment link: " . print_r($response, true);
    }
}
