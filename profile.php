<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require 'inc/links.php'; ?>
    <title><?php echo $site_r['site_title'] ?> - Bookings</title>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.05);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">

    <?php require 'inc/header.php';

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }

    $user_exist = select("SELECT * FROM user_credentials WHERE id=? LIMIT 1", [$_SESSION['userId']], 's');

    if (mysqli_num_rows($user_exist) == 0) {
        redirect('index.php');
    }

    $user_exist_fetch = mysqli_fetch_assoc($user_exist);

    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Profile</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="#.php" class="text-secondary text-decoration-none">Profile</a>
                </div>
            </div>

            <div class="col-12 my-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="information_form">
                        <h5 class="mb-3 fw-bold">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" value="<?php echo $user_exist_fetch['name'] ?>" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input name="phoneNumber" type="number" value="<?php echo $user_exist_fetch['phoneNumber'] ?>" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input name="dateofBirth" type="date" value="<?php echo $user_exist_fetch['dateofBirth'] ?>" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pin Code</label>
                                <input name="pinCode" type="number" value="<?php echo $user_exist_fetch['pinCode'] ?>" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $user_exist_fetch['address'] ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn text-white custom-bg shadown-none">Save Changes</button>

                    </form>
                </div>
            </div>


            <div class="col-md-4 my-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="profile_form">
                        <h5 class="mb-3 fw-bold">Profile</h5>
                        <img src="<?php echo USERS_IMG_PATH . $user_exist_fetch['profile'] ?>" class="rounded-circle img-fluid mb-3">

                        <label class="form-label">New Profile</label>
                        <input name="profile" type="file" accept=".jpg, .jpeg, ..png, .webp" class="form-control shadown-none mb-4" required>

                        <button type="submit" class="btn text-white custom-bg shadown-none">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8 my-5 px-4">
                <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                    <form id="password_form">
                        <h5 class="mb-3 fw-bold">Change Password</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">New Password</label>
                                <input name="new_password" type="password" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input name="confirm_password" type="password" class="form-control shadown-none" required>
                            </div>
                        </div>

                        <button type="submit" class="btn text-white custom-bg shadown-none">Save Changes</button>
                    </form>
                </div>
            </div>

        </div>
    </div>



    <?php require 'inc/footer.php'; ?>

    <script>
        let information_form = document.getElementById('information_form');

        information_form.addEventListener('submit', (e) => {
            e.preventDefault();

            let data = new FormData();

            data.append('information_form', '');
            data.append('name', information_form.elements['name'].value);
            data.append('phoneNumber', information_form.elements['phoneNumber'].value);
            data.append('dateofBirth', information_form.elements['dateofBirth'].value);
            data.append('pinCode', information_form.elements['pinCode'].value);
            data.append('address', information_form.elements['address'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);

            xhr.onload = function() {
                if (this.responseText == 'phone_already') {
                    alert('failed', 'Phone Number already registered');
                } else if (this.responseText == 0) {
                    alert('failed', 'No changes made');
                } else {
                    alert('success', 'Changes saved');
                }
            }

            xhr.send(data);
        });

        let profile_form = document.getElementById('profile_form');

        profile_form.addEventListener('submit', (e) => {

            e.preventDefault();

            if (profile_form.elements['profile'].files.length === 0) {
                alert('failed', 'Please select a file');
                return;
            }

            let data = new FormData();

            data.append('profile_form', '');
            data.append('profile', profile_form.elements['profile'].files[0]);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);

            xhr.onload = function() {
                if (this.responseText == 'inv_img') {
                    alert('failed', 'Only JPG, WEBP, and PNG are allowed ');
                } else if (this.responseText == 'upd_failed') {
                    alert('failed', 'Failed to upload the image');
                } else if (this.responseText == 0) {
                    alert('failed', 'No changes made');
                } else {
                    window.location.href = window.location.pathname;
                }

            }
            xhr.send(data);
        });

        let password_form = document.getElementById('password_form');

        password_form.addEventListener('submit', (e) => {

            e.preventDefault();

            let new_password = password_form.elements['new_password'].value;
            let confirm_password = password_form.elements['confirm_password'].value;

            if (new_password != confirm_password) {
                alert('failed', 'Passwords do not match');
                return false;
            }

            let data = new FormData();

            data.append('password_form', '');
            data.append('new_password', new_password);
            data.append('confirm_password', confirm_password);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile.php", true);

            xhr.onload = function() {
                if (this.responseText == 'mismatch') {
                    alert('failed', 'Password do not match!');
                } else if (this.responseText == 0) {
                    alert('failed', 'No changes made');
                } else {
                    alert('success', 'Password change succesfully!');
                    password_form.reset();
                }

            }
            xhr.send(data);
        });
    </script>

</body>

</html>