<?php

require '../admin/inc/db_config.php';
require '../admin/inc/essentials.php';
require '../inc/sendgrid/sendgrid-php.php';

date_default_timezone_set("Asia/Manila");

function sendMail($uemail, $token, $type)
{
    if ($type == 'email_confirmation') {
        $page = 'email_confirm.php';
        $subject = 'Account Verification Link';
        $content = "Confirm your email address by clicking on the link below:\n\n";
    } else {
        $page = 'index.php';
        $subject = 'Password Reset Link';
        $content = "Reset your password by clicking on the link below:\n\n";
    }

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom(SENDGRID_EMAIL, SENDGRID_NAME);
    $email->setSubject($subject);

    $email->addTo($uemail);

    $email->addContent(
        "text/html",
        "
                $content: <br>
                <a href='" . SITE_URL . "$page?$type&email=$uemail&token=$token" . "'> 
                CLICK ME
                </a>
            "
    );

    $sendgrid = new \SendGrid(SENDGRID_API_KEY);

    try {
        $sendgrid->send($email);
        return 1;
    } catch (Exception $e) {
        return 0;
    }
}

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Check password

    if ($data['password'] != $data['confirmPassword']) {
        echo 'password_mismatch';
        exit;
    }

    // Check if user exists or not

    $user_exist = select(
        "SELECT * FROM `user_credentials` WHERE email=? OR phoneNumber =? LIMIT 1",
        [$data['email'], $data['phoneNumber']],
        'ss'
    );

    if (mysqli_num_rows($user_exist) != 0) {
        $user_exist_fetch = mysqli_fetch_assoc($user_exist);
        echo ($user_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Upload user img to server

    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    };

    // Send confirmation link to user's email

    $token = bin2hex(random_bytes(16));

    if (!sendMail($data['email'], $token, 'email_confirmation')) {
        echo 'mail_failed';
        exit;
    };

    $encrypt_password = password_hash($data['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO user_credentials (name, email, address, phoneNumber, pinCode, dateofBirth, 
        profile, password, token) 
        VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [
        $data['name'],
        $data['email'],
        $data['address'],
        $data['phoneNumber'],
        $data['pinCode'],
        $data['dateofBirth'],
        $img,
        $encrypt_password,
        $token
    ];

    if (insert($query, $values, 'ssssissss')) {
        print_r($values);
        echo 1;
    } else {
        echo 'ins_failed';
    }
}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    $user_exist = select(
        "SELECT * FROM `user_credentials` WHERE email=? OR phoneNumber =? LIMIT 1",
        [$data['email_mobile'], $data['email_mobile']],
        'ss'
    );

    if (mysqli_num_rows($user_exist) == 0) {
        echo 'inv_email_mobile';
        exit;
    } else {
        $user_exist_fetch = mysqli_fetch_assoc($user_exist);
        if ($user_exist_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($user_exist_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            if (!password_verify($data['password'], $user_exist_fetch['password'])) {
                echo 'invalid_password';
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['userId'] = $user_exist_fetch['id'];
                $_SESSION['userName'] = $user_exist_fetch['name'];
                $_SESSION['userProfile'] = $user_exist_fetch['profile'];
                $_SESSION['userPhone'] = $user_exist_fetch['phoneNumber'];
                echo 1;
            }
        }
    }
}

if (isset($_POST['forgot_password'])) {
    $data = filteration($_POST);

    $user_exist = select(
        "SELECT * FROM `user_credentials` WHERE email=? LIMIT 1",
        [$data['email']],
        's'
    );

    if (mysqli_num_rows($user_exist) == 0) {
        echo 'inv_email';
        exit;
    } else {
        $user_exist_fetch = mysqli_fetch_assoc($user_exist);
        if ($user_exist_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($user_exist_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            $token = bin2hex(random_bytes(16));
            if (!sendMail($data['email'], $token, 'account_recovery')) {
                echo 'mail_failed';
            } else {
                $date = date("Y-m-d");

                $query = mysqli_query($con, "UPDATE user_credentials SET token='$token', token_expire='$date' 
                WHERE id=$user_exist_fetch[id]");

                if ($query) {
                    echo 1;
                } else {
                    echo 'upd_failed';
                }
            }
        }
    }
}

// if (isset($_POST['recover_user'])) {
//     $data = filteration($_POST);

//     $encrypt_password = password_hash($data['password'], PASSWORD_BCRYPT);

//     $query = "UPDATE user_credentials SET password=?, token='?', token_expire='?' 
//                 WHERE email=? AND token=?";

//     $values = [$encrypt_password, null, null, $data['email'], $data['token']];

//     if (update($query, $values, 'sssss')) {
//         echo 1;
//     } else {
//         echo 'reset_failed';
//     }

// }

if (isset($_POST['recover_user'])) {
    $data = filteration($_POST);

    if ($data['password'] != $data['confirmPassword']) {
        echo 'password_mismatch';
        exit;
    }

    $encrypt_password = password_hash($data['password'], PASSWORD_BCRYPT);

    $query = "UPDATE user_credentials SET password=?, token=?, token_expire=? 
                WHERE email=? AND token=?";

    $values = [$encrypt_password, NULL, NULL, $data['email'], $data['token']];

    if (update($query, $values, 'sssss')) {
        echo 1;
    } else {
        echo 'reset_failed';
    }
}
