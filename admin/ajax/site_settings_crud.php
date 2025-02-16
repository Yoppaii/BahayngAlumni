<?php

require '../inc/db_config.php';
require '../inc/essentials.php';


adminLogin();

if (isset($_POST['get_general'])) {
    $query = "SELECT * FROM site_settings WHERE sr_no = ?";
    $values = [1];
    $res = select($query, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);

    echo $json_data;
}

if (isset($_POST['upd_general'])) {
    $frm_data = $_POST;

    $query = "UPDATE site_settings SET site_title=?, site_about=? WHERE sr_no=?";
    $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
    $res = update($query, $values, 'ssi');
    echo $res;
    // echo json_encode(['status' => $res > 0 ? 'success' : 'no_change']);
}

if (isset($_POST['upd_shutdown'])) {
    $frm_data = ($_POST['upd_shutdown'] == 0) ? 1 : 0;

    $query = "UPDATE site_settings SET shutdown=? WHERE sr_no=?";
    $values = [$frm_data, 1];
    $res = update($query, $values, 'ii');
    echo $res;
}

if (isset($_POST['get_contacts'])) {
    $query = "SELECT * FROM contact_settings WHERE sr_no = ?";
    $values = [1];
    $res = select($query, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);

    echo $json_data;
}

if (isset($_POST['upd_contacts'])) {
    $frm_data = $_POST;

    $query = "UPDATE contact_settings SET address=?, google_map=?, phone_number1=?, phone_number2=?, email=?, facebook=?, twitter=?, instagram=?, iframe=? WHERE sr_no=?";
    $values = [
        $frm_data['address'],
        $frm_data['google_map'],
        $frm_data['phone_number1'],
        $frm_data['phone_number2'],
        $frm_data['email'],
        $frm_data['facebook'],
        $frm_data['twitter'],
        $frm_data['instagram'],
        $frm_data['iframe'],
        1
    ];

    $res = update($query, $values, 'sssssssssi');
    echo $res;
}

if (isset($_POST['add_member'])) {
    $frm_data = filteration($_POST);

    // Handle the image upload
    $img_r = uploadImage($_FILES['picture'], ABOUT_FOLDER);

    switch ($img_r) {
        case 'inv_img':
            echo $img_r; // Invalid image mime or format
            break;
        case 'inv_size':
            echo $img_r; // Invalid size greater than 2mb
            break;
        case 'upd_failed':
            echo $img_r; // Upload failed
            break;
        default:
            // Insert into the database
            $query = "INSERT INTO team_details (name, picture) VALUES (?, ?)";
            $values = [$frm_data['name'], $img_r];
            $res = insert($query, $values, 'ss');
            echo $res; // This will return 1 on success
            break;
    }
}

if (isset($_POST['get_members'])) {
    $res = selectAll('team_details');

    while ($row = mysqli_fetch_assoc($res)) {
        $path = ABOUT_IMG_PATH;
        echo <<<data
        <div class="col-md-2 mb-3">
            <div class="card bg-dark text-white">
                <img src="$path$row[picture]" class="card-img">
                <div class="card-img-overlay text-end">
                <button type="button" onclick="rem_member($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash"></i>DELETE
                </button>
                </div>
                <p class="card-text text-center px-3 py-2">$row[name]</p>
            </div>
        </div>

        data;
    }
}

if (isset($_POST['rem_member'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_member']];

    $pre_query = "SELECT * FROM team_details WHERE sr_no=?";
    $res = select($pre_query, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['picture'], ABOUT_FOLDER)) {
        $query = "DELETE FROM team_details WHERE sr_no=?";
        $res = destroy($query, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}
