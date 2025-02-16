<?php

require '../admin/inc/db_config.php';
require '../admin/inc/essentials.php';

date_default_timezone_set("Asia/Manila");

if (isset($_POST['information_form'])) {
    $frm_data = filteration($_POST);
    session_start();

    $user_exist = select(
        "SELECT * FROM `user_credentials` WHERE phoneNumber = ? AND id != ? LIMIT 1",
        [$data['phoneNumber'], $data['userId']],
        'ss'
    );

    if (mysqli_num_rows($user_exist) != 0) {
        $user_exist_fetch = mysqli_fetch_assoc($user_exist);
        echo 'phone_already';
        exit;
    }

    $query = "UPDATE user_credentials SET name=?, address=?, phoneNumber=?, pinCode=?, dateofBirth=? WHERE id=? LIMIT 1";

    $values = [$frm_data['name'], $frm_data['address'], $frm_data['phoneNumber'], $frm_data['pinCode'], $frm_data['dateofBirth'], $_SESSION['userId']];

    if (update($query, $values, 'ssssss')) {
        $_SESSION['uName'] = $frm_data['name'];
        echo 1;
    } else {
        echo 0;
    }
}


if (isset($_POST['profile_form'])) {
    session_start();

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    };


    // fetching old profile and delete it.
    $user_exist = select(
        "SELECT profile FROM user_credentials WHERE id = ? LIMIT 1",
        [$_SESSION['userId']],
        's'
    );

    $user_exist_fetch = mysqli_fetch_assoc($user_exist);

    deleteImage($user_exist_fetch['profile'], USERS_FOLDER);

    $query = "UPDATE user_credentials SET profile=? WHERE id=?";

    $values = [$img, $_SESSION['userId']];

    if (update($query, $values, 'ss')) {
        $_SESSION['userProfile'] = $img;
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['password_form'])) {
    $frm_data = filteration($_POST);
    session_start();

    if ($frm_data['new_passowrd'] != $frm_data['confirm_password']) {
        echo 'mismatch';
        exit;
    }

    $encrypt_password = password_hash($frm_data['new_password'], PASSWORD_BCRYPT);

    $query = "UPDATE user_credentials SET password=? WHERE id=?";

    $values = [$encrypt_password, $_SESSION['userId']];

    if (update($query, $values, 'ss')) {
        echo 1;
    } else {
        echo 0;
    }
}
