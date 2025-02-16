<?php
require 'inc/essentials.php';
require 'inc/db_config.php';
adminLogin();

if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['seen'] == 'all') {
        $query = "UPDATE user_queries SET seen=?";
        $values = [1];
        if (update($query, $values, 'i')) {
            alert('success', 'Marked all as read!');
        } else {
            alert('error', 'Failed to mark all as read!');
        }
    } else {
        $query = "UPDATE user_queries SET seen=? WHERE sr_no=?";
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
        $query = "DELETE FROM user_queries";
        if (mysqli_query($con, $query)) {
            alert('success', 'All Data deleted!');
        } else {
            alert('error', 'Failed to delete all data!');
        }
    } else {
        $query = "DELETE FROM user_queries WHERE sr_no=?";
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
    <title>Admin Panel - Features and Facilities</title>
    <?php require 'inc/links.php'; ?>
    <style>
    </style>

</head>

<body class="bg-light">

    <?php require 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">FEATURES & FACILITIES</h3>

                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Features</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature_s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-md" style="height:350px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="feature_data">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility_s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-md" style="height:350px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities_data">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Features Modal Section -->
    <div class="modal fade" id="feature_s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="feature_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Feature</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="feature_name" class="form-control shadown-none" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!-- Facilities Modal Section -->
    <div class="modal fade" id="facility_s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Facilitiy</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="facility_name" class="form-control shadown-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="file" name="facility_icon" accept=".svg" class="form-control shadown-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="facility_description" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <?php require 'inc/scripts.php'; ?>

    <script src="page-scripts/features_facilities.js"></script>

</body>

</html>