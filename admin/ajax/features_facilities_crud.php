<?php

require '../inc/db_config.php';
require '../inc/essentials.php';


adminLogin();


if (isset($_POST['add_feature'])) {
    $frm_data = filteration($_POST);

    $query = "INSERT INTO features(name) VALUES (?)";
    $values = [$frm_data['name']];
    $res = insert($query, $values, 's');
    echo $res; // This will return 1 on success
}

if (isset($_POST['get_features'])) {
    $res = selectAll('features');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        $path = ABOUT_IMG_PATH;
        echo <<<data
        <tr>
        <td>$i</td>
        <td>$row[name]</td>
        <td>
        <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
            <i class="bi bi-trash"></i>DELETE
        </button></td>
        </tr>

        data;
        $i++;
    }
}

if (isset($_POST['rem_feature'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_feature']];

    $check_query = select('SELECT * FROM `room_features` WHERE features_id=?', [$frm_data['rem_feature']], 'i');

    if (mysqli_num_rows($check_query) == 0) {
        $query = "DELETE FROM features WHERE id=?";
        $res = destroy($query, $values, 'i');
        echo $res;
    } else {
        echo 'room_added';
    }
}

if (isset($_POST['add_facility'])) {
    $frm_data = filteration($_POST);

    // Handle the image upload
    $img_r = uploadImage($_FILES['icon'], FACILITIES_FOLDER);

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
            $query = "INSERT INTO facilities (icon, name, description) VALUES (?, ?, ?)";
            $values = [$img_r, $frm_data['name'], $frm_data['description'],];
            $res = insert($query, $values, 'sss');
            echo $res; // This will return 1 on success
            break;
    }
}

if (isset($_POST['get_facilities'])) {
    $res = selectAll('facilities');
    $i = 1;
    $path = FACILITIES_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
        <tr>
        <td>$i</td>
        <td><img src="$path$row[icon]" width="30px"></td>
        <td>$row[name]</td>
        <td>$row[description]</td>
        <td>
        <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
            <i class="bi bi-trash"></i>DELETE
        </button></td>
        </tr>

        data;
        $i++;
    }
}

if (isset($_POST['rem_facility'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_facility']];

    $check_query = select('SELECT * FROM `room_facilities` WHERE facilities_id=?', [$frm_data['rem_facility']], 'i');

    if (mysqli_num_rows($check_query) == 0) {
        $pre_query = "SELECT * FROM facilities WHERE id=?";
        $res = select($pre_query, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['icon'], FACILITIES_FOLDER)) {
            $query = "DELETE FROM facilities WHERE id=?";
            $res = destroy($query, $values, 'i');
            echo $res;
        } else {
            echo 0;
        }
    } else {
        echo 'room_added';
    }
}
