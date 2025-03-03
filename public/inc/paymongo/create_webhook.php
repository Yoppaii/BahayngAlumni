<?php

// require 'config.php';
// require '../admin/inc/db_config.php';
// require '../admin/inc/essentials.php';


// $api_key = PAYMONGO_SECRET_KEY;
// $webhook_url = WEBHOOK_URL;

// $curl = curl_init();
// curl_setopt($curl, CURLOPT_URL, 'https://api.paymongo.com/v1/webhooks');
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
//     'data' => [
//         'attributes' => [
//             'url' => $webhook_url,
//             'events' => ['payment.paid'],
//         ],
//     ],
// ]));
// curl_setopt($curl, CURLOPT_HTTPHEADER, [
//     'Authorization: Basic ' . base64_encode($api_key . ':'),
//     'Content-Type: application/json',
// ]);

// $response = curl_exec($curl);
// curl_close($curl);

// echo $response;
