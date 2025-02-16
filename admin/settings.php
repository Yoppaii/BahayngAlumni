<?php
require 'inc/essentials.php';
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require 'inc/links.php'; ?>
    <style>
    </style>

</head>

<body class="bg-light">

    <?php require 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">SETTINGS</h3>

                <!-- General Settings Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general_s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title">
                        <p>
                        <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                        <p class="card-text" id="site_about">
                        <p>
                    </div>
                </div>


                <!-- General Settings Modal Section -->

                <div class="modal fade" id="general_s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" name="site_title" id="site_title_inp" class="form-control shadown-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About us</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="site_title.value = general_data.site_title , site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shutdown Section -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Settings</h5>
                            <div class="form-check form-switch">
                                <!-- The toggle switch dynamically reflects the state -->
                                <input onchange="upd_shutdown(this.value)"
                                    class="form-check-input" type="checkbox" id="shutdown-toggle">
                            </div>
                        </div>
                        <p class="card-text">
                            No customers will be allowed to book a hotel room when shutdown mode is turned on.
                        </p>
                    </div>
                </div>


                <!-- Contacts Settings Section -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contacts Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts_s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="google_map"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card-text mt-3">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="phone_number1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="phone_number2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle fw-bold">Social Media Links</h6>
                                    <p class="card-text mt-3">
                                        <i class="bi bi-facebook"></i>
                                        <span id="facebook"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-twitter"></i>
                                        <span id="twitter"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-instagram"></i>
                                        <span id="instagram"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for editing contacts settings -->
                <div class="modal fade" id="contacts_s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <form id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Contacts Settings</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address_inp" class="form-label">Address</label>
                                                    <input type="text" name="address" id="address_inp" class="form-control" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="google_map_inp" class="form-label">Google Map</label>
                                                    <input type="text" name="google_map" id="google_map_inp" class="form-control" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone_number1_inp" class="form-label">Phone Number 1 (with country code) </label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">+63</span>
                                                        <input type="text" name="phone_number1" id="phone_number1_inp" class="form-control" required />
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">+63</span>
                                                        <input type="text" name="phone_number2" id="phone_number2_inp" class="form-control" required />
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email_inp" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email_inp" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="facebook_inp" class="form-label">Socal Media Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                                        <input type="text" name="facebook" id="facebook_inp" class="form-control" />
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                                        <input type="text" name="twitter" id="twitter_inp" class="form-control" />
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                                        <input type="text" name="instagram" id="instagram_inp" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="iframe_inp" class="form-label">iFrame Content</label>
                                                    <textarea name="iframe" id="iframe_inp" class="form-control" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="contacts_inp(contacts_data)" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Team Settings Section -->
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Team Management</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#team_s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="row" id="team_data">

                        </div>
                    </div>
                </div>

                <!-- Team Settings Modal Section -->
                <div class="modal fade" id="team_s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="team_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Team Member</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="member_name" id="member_name_inp" class="form-control shadown-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg" class="form-control shadown-none" required>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="member_name.value = '', member_picture.value='' " class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require 'inc/scripts.php'; ?>
    <script src="page-scripts/settings.js"></script>

    <!-- <script>
        let general_data;
        let general_s_form = document.getElementById('general_s_form');
        let site_title_inp = document.getElementById('site_title_inp');
        let site_about_inp = document.getElementById('site_about_inp');
        let shutdown_toggle = document.getElementById('shutdown-toggle');

        let contacts_data;
        let contacts_s_form = document.getElementById('contacts_s_form');

        let team_s_form = document.getElementById('team_s_form');
        let member_name_inp = document.getElementById('member_name_inp');
        let member_picture_inp = document.getElementById('member_picture_inp');


        function get_general() {
            let site_title = document.getElementById('site_title');
            let site_about = document.getElementById('site_about');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                general_data = JSON.parse(this.responseText);

                site_title.innerText = general_data.site_title;
                site_about.innerText = general_data.site_about;

                site_title_inp.value = general_data.site_title;
                site_about_inp.value = general_data.site_about;

                if (general_data.shutdown == 0) {
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value = 0;
                } else {
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value = 1;
                }
            }

            xhr.send('get_general');
        }

        general_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            upd_general(site_title_inp.value, site_about_inp.value);
        });

        function upd_general(site_title_val, site_about_val) {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                var myModal = document.getElementById('general_s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "Changes saved successfully!");
                    get_general(); // Refresh the general settings
                } else {
                    alert("failed", "No changes were made.");
                }


                console.log(this.responseText);
            };


            xhr.send('site_title=' + encodeURIComponent(site_title_val) +
                '&site_about=' + encodeURIComponent(site_about_val) +
                '&upd_general');
        }



        function upd_shutdown(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1 && general_data.shutdown == 0) {
                    alert("success", "Shutdown mode updated!");
                } else {
                    alert("success", "Shutdown mode off.");
                }
                get_general();
            };

            xhr.send('upd_shutdown=' + encodeURIComponent(val));
        }

        function get_contacts() {
            let contacts_p_id = ['address', 'google_map', 'phone_number1', 'phone_number2', 'email', 'facebook', 'twitter', 'instagram'];
            let ifram = document.getElementById('iframe');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                contacts_data = JSON.parse(this.responseText);

                contacts_data = Object.values(contacts_data);


                for (i = 0; i < contacts_p_id.length; i++) {
                    document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
                }
                ifram.src = contacts_data[9];
                contacts_inp(contacts_data);
            }

            xhr.send('get_contacts');
        }

        function contacts_inp(data) {
            let contacts_inp_id = ['address_inp', 'google_map_inp', 'phone_number1_inp', 'phone_number2_inp', 'email_inp', 'facebook_inp', 'twitter_inp', 'instagram_inp', 'iframe_inp'];

            for (i = 0; i < contacts_inp_id.length; i++) {
                document.getElementById(contacts_inp_id[i]).value = data[i + 1];
            }
        }

        contacts_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            upd_contacts();
        });

        function upd_contacts() {
            let index = ['address', 'google_map', 'phone_number1', 'phone_number2', 'email', 'facebook', 'twitter', 'instagram', 'iframe'];
            let contacts_inp_id = ['address_inp', 'google_map_inp', 'phone_number1_inp', 'phone_number2_inp', 'email_inp', 'facebook_inp', 'twitter_inp', 'instagram_inp', 'iframe_inp'];

            let data_str = "";

            for (i = 0; i < index.length; i++) {
                data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + '&';

            }

            data_str += "upd_contacts";

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {

                var myModal = document.getElementById('contacts_s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "Changes Saved!");
                    get_contacts();
                } else {
                    alert("failed", "No Changes Made!");
                }
            }

            xhr.send(data_str);
        }

        team_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_member();
        });

        function add_member() {
            let data = new FormData();
            data.append('name', member_name_inp.value);
            data.append('picture', member_picture_inp.files[0]);
            data.append('add_member', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('team_s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 'inv_img') {
                    alert("failed", "Only JPG, PNG and JPEG are allowed!");
                } else if (this.responseText == 'inv_size') {
                    alert("failed", "Image should be less than 2MB!");
                } else if (this.responseText == 'upd_failed') {
                    alert("failed", "Image upload failed. Server Down!");
                } else {
                    alert("success", "New Member Added!");
                    member_name_inp.value = "";
                    member_picture_inp.value = "";
                    get_members();
                }

            };


            xhr.send(data);
        }

        function get_members() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('team_data').innerHTML = this.responseText;
            }

            xhr.send('get_members');
        }

        function rem_member(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/site_settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Member removed!');
                    get_members();
                } else {
                    alert('failed', 'No changes made!');
                }
            }

            xhr.send('rem_member=' + val);
        }


        window.onload = function() {
            get_general();
            get_contacts();
            get_members();
        }
    </script> -->

</body>

</html>