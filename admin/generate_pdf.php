<?php

require 'inc/db_config.php';
require 'inc/essentials.php';
require 'inc/mpdf/vendor/autoload.php';

adminLogin();

if (isset($_GET['gen_pdf']) && isset($_GET['id'])) {
    $frm_data = filteration($_GET);

    $query = "SELECT bo.*, bd.*, uc.email FROM booking_order bo
    INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
    INNER JOIN user_credentials uc ON bo.user_id = uc.id
    WHERE ((bo.booking_status = 'booked' AND bo.arrival = 1)
    OR (bo.booking_status = 'cancelled'))
    AND bo.booking_id = '$frm_data[id]'";

    $res = mysqli_query($con, $query);

    $total_rows = (mysqli_num_rows($res));

    if ($total_rows == 0) {
        header('location: dashboard.php');
        exit;
    }

    $data = mysqli_fetch_assoc($res);

    $date = date("h:ia | d-m-Y", strtotime($data['dateandtime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));


    $table_data = "
    <h2>Booking Receipt</h2>
    <table border='1'>
        <tr>
            <td> Order ID: $data[order_id]</td>
            <td> Booking Date: $date</td>
        </tr>
        <tr>
            <td colspan='2'>Status: $data[booking_status]</td>
        </td>
        <tr>
            <td> Name: $data[user_name]</td>
            <td> Email: $data[email]</td>
        </tr>
        <tr>
            <td> Phone Number: $data[phone_number]</td>
            <td> Address: $data[address]</td>
        </tr>
        <tr>
            <td> Room Name: $data[room_name]</td>
            <td> Cost: ₱$data[price] per night</td>
        </tr>
        <tr>
            <td> Check-in: $checkin</td>
            <td> Check-out: $checkout</td>
        </tr>
    </table>";

    // if ($data['booking_status'] == '?') {
    //     $table_data .= "<tr>

    //     </tr>";
    // }

    // $table_data .= "</table>";

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($table_data);
    $mpdf->Output($data['order_id'] . '.pdf', 'D'); // Display in the browser
} else {
    header('location: dashbaord.php');
}
