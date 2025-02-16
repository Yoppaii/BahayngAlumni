<?php

// // Listen for incoming webhook events
// $input = file_get_contents("php://input");
// $event = json_decode($input, true);

// if ($event['data']['attributes']['status'] == "paid") {
//     $paymentId = $event['data']['id'];
//     $orderId = $event['data']['attributes']['remarks']; // Assuming the order ID is stored in the remarks field

//     // Update the order status in your database
//     $query = "UPDATE booking_order SET trans_status = 'paid' WHERE order_id = '$orderId'";
//     mysqli_query($con, $query);

//     file_put_contents("payments.log", "Payment successful for ID: " . $paymentId . "\n", FILE_APPEND);
// } else {
//     file_put_contents("payments.log", "Payment failed or pending\n", FILE_APPEND);
// }

// // Respond with a 200 OK
// http_response_code(200);
