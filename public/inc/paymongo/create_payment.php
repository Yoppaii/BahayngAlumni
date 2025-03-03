<?php
// require 'config.php';
// require '../admin/inc/db_config.php';
// require '../admin/inc/essentials.php';


// date_default_timezone_set("Asia/Manila");

// session_start();

// if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
//     redirect('index.php');
// }


// $ORDER_ID = 'ORD_' . $SESSION['userId'] . random_int(11111, 9999999);
// $AMOUNT = $_SESSION['room']['payment'] * 100;
// $CURRENCY = "PHP";


// $secretKey = PAYMONGO_SECRET_KEY;

// $data = [
//     "data" => [
//         "attributes" => [
//             "amount" => $AMOUNT,
//             "currency" => $CURRENCY,
//             "description" => "HAHAHA",
//             "remarks" => $ORDER_ID
//         ]
//     ]
// ];


// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://api.paymongo.com/v1/links");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_ENCODING, "");
// curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
// curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     "Content-Type: application/json",
//     "Accept: application/json",
//     "Authorization: Basic " . base64_encode($secretKey . ":")
// ]);

// $result = curl_exec($ch);
// curl_close($ch);

// $response = json_decode($result, true);

// Check if the Payment Link was created successfully
// if (isset($response['data']['attributes']['checkout_url'])) {
//     header("Location: " . $response['data']['attributes']['checkout_url']);
//     exit();
// } else {
//     echo "Error creating payment link: " . print_r($response, true);
// }
