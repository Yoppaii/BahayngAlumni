<?php

require '../inc/db_config.php';
require '../inc/essentials.php';


adminLogin();



if (isset($_POST['get_users'])) {

    $res = selectAll("user_credentials");
    $i = 1;
    $path = USERS_IMG_PATH;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {


        if ($row['status'] == 1) {
            $status = "<button onclick='toggle_status($row[id], 0)' class='btn btn-dark btn-sm shadow-none'>active</button>
            ";
        } else {
            $status = "<button onclick='toggle_status($row[id], 1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>
            ";
        }

        if ($row['is_verified'] == 0) {
            $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></></span>";
            $delete_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
                    <i class='bi bi-trash'></i>
                </button>";
        } else {

            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></></span>";
            $delete_btn = "<span class='badge bg-success'><i class='bi bi-shield-check'></i></span>";
        }

        $date = date("Y-m-d", strtotime($row['dateandtime']));


        $data .= "
        <tr class='align-middle'>
            <td>$i</td>
            <td>
            <img src='$path$row[profile]' loading='lazy' class='rounded-circle' width='55px' height='50px'>
            </td>
            <td>$row[name]</td>
            <td>$row[email]</td>
            <td>$row[phoneNumber]</td>
            <td>$row[address]</td>
            <td>$row[dateofBirth]</td>
            <td>$verified</td>
            <td>$status</td>
            <td>$date</td>
            <td>$delete_btn</td>
        </tr>
    ";
        $i++;
    }
    echo $data;
}

if (isset($_POST['toggle_status'])) {
    $frm_data = filteration(data: $_POST);

    $query = "UPDATE user_credentials SET status=? WHERE id=?";
    $value = [$frm_data['value'], $frm_data['toggle_status']];

    if (update($query, $value, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['remove_user'])) {
    $frm_data = filteration($_POST);

    $res = destroy("DELETE FROM user_credentials WHERE id =? AND is_verified=?", [$frm_data['user_id'], 0], 'ii');

    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['search_user'])) {

    $frm_data = filteration($_POST);

    $query = "SELECT * FROM user_credentials WHERE name LIKE ?";

    $res = select($query, ["%$frm_data[name]%"], 's');
    $i = 1;
    $path = USERS_IMG_PATH;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {


        if ($row['status'] == 1) {
            $status = "<button onclick='toggle_status($row[id], 0)' class='btn btn-dark btn-sm shadow-none'>active</button>
            ";
        } else {
            $status = "<button onclick='toggle_status($row[id], 1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>
            ";
        }

        if ($row['is_verified'] == 0) {
            $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></></span>";
            $delete_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm'>
                    <i class='bi bi-trash'></i>
                </button>";
        } else {

            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></></span>";
            $delete_btn = "<span class='badge bg-success'><i class='bi bi-shield-check'></i></span>";
        }

        $date = date("Y-m-d", strtotime($row['dateandtime']));


        $data .= "
        <tr class='align-middle'>
            <td>$i</td>
            <td>
            <img src='$path$row[profile]' width='55px'>
            </td>
            <td>$row[name]</td>
            <td>$row[email]</td>
            <td>$row[phoneNumber]</td>
            <td>$row[address]</td>
            <td>$row[dateofBirth]</td>
            <td>$verified</td>
            <td>$status</td>
            <td>$date</td>
            <td>$delete_btn</td>
        </tr>
    ";
        $i++;
    }
    echo $data;
}
