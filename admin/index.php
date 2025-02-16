<?php
require 'inc/essentials.php';
require 'inc/db_config.php';

session_start();
if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect('dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php'); ?>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>

</head>

<body class="bg-light">

    <div class="login-form text-center rounded bg-white shadow overflow-none">
        <form method="POST" action="">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" type="text" required class="form-control shadown-none text-center" placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input name="admin_password" type="password" required class="form-control shadown-none text-center" placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>
    <?php

    if (isset($_POST['login'])) {
        $frm_data = $_POST;

        $query = "SELECT * FROM admin_credential WHERE admin_name = ? AND admin_password = ?";

        $values = [$frm_data['admin_name'], $frm_data['admin_password']];

        $res = select($query, $values, "ss");
        if ($res->num_rows == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];

            redirect('dashboard.php');

            alert('success', 'Admin Successfuly Login!');
        } else {
            alert('failed', 'Admin Login failed - Invalid Credentials!');
        }
    }

    ?>

    <?php require 'inc/scripts.php'; ?>
</body>

</html>