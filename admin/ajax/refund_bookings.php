<?php

require '../inc/db_config.php';
require '../inc/essentials.php';


adminLogin();



if (isset($_POST['get_bookings'])) {

    $frm_data = filteration($_POST);

    $query = "SELECT bo.*, bd.* FROM booking_order bo
    INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
    WHERE (bo.order_id LIKE ? OR bd.phone_number LIKE ? OR bd.user_name LIKE ?) 
    AND bo.booking_status = ? AND bo.refund = ? ORDER BY bo.booking_id ASC";

    $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "cancelled", 0], 'ssssi');
    $i = 1;
    $new_booking_data = "";

    if (mysqli_num_rows($res) == 0) {
        echo "<b>No Data Found!</b>";
        exit;
    }

    while ($data = mysqli_fetch_assoc($res)) {
        $date = date("d-m-Y", strtotime($data['dateandtime']));
        $checkin = date("d-m-Y", strtotime($data['check_in']));
        $checkout = date("d-m-Y", strtotime($data['check_out']));

        $new_booking_data .= "
        <tr>
            <td>$i</td>
            <td>
                <span class='badge bg-primary'>
                    Order ID: $data[order_id]
                </span>
                <br>
                <b>Name: </b> $data[user_name]
                <br>
                <b>Phone No.: </b> $data[phone_number]
            </td>
            <td>
                <b>Room: </b> $data[room_name]
                <br>
                <b>Price: </b> ₱$data[price]
            </td>
            <td>
                <b>Check in: </b> $checkin
                <br>
                <b>Check out: </b> $checkout
                <br>
            </td>
            <td>
                <b>Date: </b> $date
            </td>
            <td>
            <button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-success btn-sm fw-bold shadow-none '>
                <i class='bi bi-cash-stack'></i> Refund
            </button>
            </td>
        </tr>

        ";
        $i++;
    }

    echo $new_booking_data;
}

if (isset($_POST['assign_room'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE booking_order bo INNER JOIN booking_details bd
        ON bo.booking_id = bd.booking_id
        SET bo.arrival = ?, bd.room_no = ?
        WHERE bo.booking_id = ?";

    $values = [1, $frm_data['room_no'], $frm_data['booking_id']];
    $res = update($query, $values, 'isi');

    echo ($res == 2) ? 1 : 0;
}


if (isset($_POST['cancel_booking'])) {
    $frm_data = filteration($_POST);

    $query = "UPDATE booking_order 
    SET booking_status=?, refund=?
    WHERE booking_id = ?";

    $values = ['cancelled', 0, $frm_data['booking_id']];

    $res = update($query, $values, 'sii');

    echo $res;
}
