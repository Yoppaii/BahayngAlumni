<?php

require '../inc/db_config.php';
require '../inc/essentials.php';


adminLogin();

if (isset($_POST['add_hero'])) {

    // Handle the image upload
    $img_r = uploadImage($_FILES['picture'], HERO_FOLDER);

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
            $query = "INSERT INTO hero_details (picture) VALUES (?)";
            $values = [$img_r];
            $res = insert($query, $values, 's');
            echo $res; // This will return 1 on success
            break;
    }
}

if (isset($_POST['get_hero'])) {
    $res = selectAll('hero_details');

    while ($row = mysqli_fetch_assoc($res)) {
        $path = HERO_IMG_PATH;
        echo <<<data
        <div class="col-md-2 mb-3">
            <div class="card bg-dark text-white">
                <img src="$path$row[picture]" class="card-img">
                <div class="card-img-overlay text-end">
                <button type="button" onclick="rem_hero($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash"></i>DELETE
                </button>
                </div>
            </div>
        </div>

        data;
    }
}

if (isset($_POST['rem_hero'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_hero']];

    $pre_query = "SELECT * FROM hero_details WHERE sr_no=?";
    $res = select($pre_query, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['picture'], HERO_FOLDER)) {
        $query = "DELETE FROM hero_details WHERE sr_no=?";
        $res = destroy($query, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}
