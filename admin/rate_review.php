<?php
require 'inc/essentials.php';
require 'inc/db_config.php';
adminLogin();

if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['seen'] == 'all') {
        $query = "UPDATE rating_review SET seen=?";
        $values = [1];
        if (update($query, $values, 'i')) {
            alert('success', 'Marked all as read!');
        } else {
            alert('error', 'Failed to mark all as read!');
        }
    } else {
        $query = "UPDATE rating_review SET seen=? WHERE sr_no=?";
        $values = [1, $frm_data['seen']];
        if (update($query, $values, 'ii')) {
            alert('success', 'Marked as read!');
        } else {
            alert('error', 'Failed to mark as read!');
        }
    }
}

if (isset($_GET['delete'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['delete'] == 'all') {
        $query = "DELETE FROM rating_review";
        if (mysqli_query($con, $query)) {
            alert('success', 'All Data deleted!');
        } else {
            alert('error', 'Failed to delete all data!');
        }
    } else {
        $query = "DELETE FROM rating_review WHERE sr_no=?";
        $values = [$frm_data['delete']];
        if (destroy($query, $values, 'i')) {
            alert('success', 'Data deleted!');
        } else {
            alert('error', 'Failed to delete!');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rating & Reviews</title>
    <?php require 'inc/links.php'; ?>
    <style>
    </style>

</head>

<body class="bg-light">

    <?php require 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Rating & Reviews</h3>

                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow-sm btn-sm">Mark all as read</a>
                            <a href="?delete=all" class="btn btn-danger rounded-pill shadow-sm btn-sm">Delete all</a>
                        </div>

                        <div class="table-responsive-md">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Room Name</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col" width="30%">Review</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT rr.*, uc.name AS username, r.name AS roomname FROM rating_review rr 
                                    INNER JOIN user_credentials uc ON rr.user_id = uc.id
                                    INNER JOIN rooms r ON rr.room_id = r.id
                                    ORDER BY sr_no DESC";

                                    $data = mysqli_query($con, $query);
                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($data)) {

                                        $date = date('d-m-Y', timestamp: strtotime($row['dateandtime']));


                                        $seen = '';
                                        if ($row['seen'] != 1) {
                                            $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Mark as read</a> <br>";
                                        }
                                        $seen .= "<a href='?delete=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";
                                        echo <<<query
                                        <tr>
                                        <td>$i</td>
                                        <td>$row[roomname]</td>
                                        <td>$row[username]</td>
                                        <td>$row[rating]</td>
                                        <td>$row[review]</td>
                                        <td>$date</td>
                                        <td>$seen</td>
                                        

                                        </tr>
                                        query;
                                        $i++;
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require 'inc/scripts.php'; ?>

</body>

</html>