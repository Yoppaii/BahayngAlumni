<?php

require 'admin/inc/db_config.php';
require 'admin/inc/essentials.php';

if (isset($_GET['email_confirmation'])) {

    $data = filteration($_GET);

    $query = select(
        "SELECT * FROM user_credentials WHERE email=? AND token=? LIMIT 1",
        [$data['email'], $data['token']],
        'ss'
    );

    if (mysqli_num_rows($query) == 1) {
        $fetch = mysqli_fetch_assoc($query);

        if ($fetch['is_verified'] == 1) {
            echo "<script>alert('Email already verified!')</script>";
            redirect('index.php');
        } else {
            $update = update("UPDATE user_credentials SET is_verified =? WHERE id=?", [1, $fetch['id']], 'ii');
            if ($update) {
                echo "<script>alert('Email Verification Successful!')</script>";
            } else {
                echo "<script>alert('Failed to verify email')</script>";
            }
            redirect('index.php');
        }
    } else {
        echo "<script>alert('Invalid Link!')</script>";
    }
}
