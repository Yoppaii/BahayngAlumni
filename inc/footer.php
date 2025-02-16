<!-- Contact Us -->
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $site_r['site_title'] ?></h3>
            <p>
                <?php echo $site_r['site_about'] ?>
            </p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
            <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a> <br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a> <br>
            <a href="contact_us.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a> <br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a> <br>

        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow us</h5>
            <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-facebook me-1"></i>Facebook
            </a>
            <br>
            <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-twitter me-1"></i>Twitter
            </a>
            <br>
            <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-instagram me-1"></i>Instagram
            </a>
            <br>
        </div>
    </div>

</div>

<h6 class="text-center bg-dark text-white p-3 m-0">Design and Developed by Yopi</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script>
    function alert(type, msg, position = "body") {
        let bs_class = (type === "success") ? "alert-success" : "alert-danger";
        let element = document.createElement('div');
        element.innerHTML = `
    <div class="alert ${bs_class} alert-dismissible fade show" role="alert" id="auto-close-alert">
        ${msg}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;

        if (position == "body") {
            document.body.appendChild(element);
            element.classList.add('custom-alert')
        } else {
            document.getElementById(position).appendChild(element);
        }

        setTimeout(() => {
            const alert = document.getElementById('auto-close-alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 150);
            }
        }, 2500);
    }

    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    let register_form = document.getElementById('register_form');

    register_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('name', register_form.elements['name'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phoneNumber', register_form.elements['phoneNumber'].value);
        data.append('profile', register_form.elements['profile'].files[0]);
        data.append('address', register_form.elements['address'].value);
        data.append('pinCode', register_form.elements['pinCode'].value);
        data.append('dateofBirth', register_form.elements['dateofBirth'].value);
        data.append('password', register_form.elements['password'].value);
        data.append('confirmPassword', register_form.elements['confirmPassword'].value);
        data.append('register', '');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);


        xhr.onload = function() {
            // Add some debug code here to print out the results of the XMLHttpRequest
            if (this.responseText == 'password_mismatch') {
                alert('failed', 'Password Mismatch');
            } else if (this.responseText == 'email_already') {
                alert('failed', 'Email already registered');
            } else if (this.responseText == 'phone_already') {
                alert('failed', 'Phone Number already registered');
            } else if (this.responseText == 'inv_img') {
                alert('failed', 'Only JPG, WEBP, and PNG are allowed ');
            } else if (this.responseText == 'upd_failed') {
                alert('failed', 'Failed to upload the image');
            } else if (this.responseText == 'mail_failed') {
                alert('failed', 'Cannot send confimation mail');
            } else if (this.responseText == 'ins_failed') {
                alert('failed', 'Registration failed');
            } else {
                alert('success', 'Registration successful. Confirmation Link has sent to email');
                register_form.reset();
            }

        }

        xhr.send(data);

    });

    let login_form = document.getElementById('login_form');

    login_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('email_mobile', login_form.elements['email_mobile'].value);
        data.append('password', login_form.elements['password'].value);
        data.append('login', '');

        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);


        xhr.onload = function() {
            // Add some debug code here to print out the results of the XMLHttpRequest
            if (this.responseText == 'inv_email_mobile') {
                alert('failed', 'Invalid Email or Mobile Number');
            } else if (this.responseText == 'not_verified') {
                alert('failed', 'Email is not verified');
            } else if (this.responseText == 'inactive') {
                alert('failed', 'Account inactive, Please contact the Admin');
            } else if (this.responseText == 'invalid_password') {
                alert('failed', 'Incorrect Password, Please try again ');
            } else {
                let fileurl = window.location.href.split('/').pop().split('?').shift();
                if (fileurl == 'room_details.php') {
                    window.location = window.location.href;
                } else {
                    window.location = window.location.pathname;
                }

            }

        }

        xhr.send(data);

    });

    let forgot_form = document.getElementById('forgot_form');

    forgot_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();

        data.append('email', forgot_form.elements['email'].value);
        data.append('forgot_password', '');

        var myModal = document.getElementById('forgotModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);


        xhr.onload = function() {
            if (this.responseText == 'inv_email') {
                alert('failed', 'Invalid Email Address');
            } else if (this.responseText == 'not_verified') {
                alert('failed', 'Email is not verified');
            } else if (this.responseText == 'inactive') {
                alert('failed', 'Account inactive, Please contact the Admin');
            } else if (this.responseText == 'mail_failed') {
                alert('failed', 'Failed to send Confirmation Link');
            } else if (this.responseText == 'upd_failed') {
                alert('failed', 'Password reset failed');
            } else {
                alert('success', 'Reset link sent to email');
                forgot_form.reset();
            }

        }

        xhr.send(data);

    });

    function checkLoginToBook(status, room_id) {
        if (status) {
            window.location.href = 'confirm_booking.php?id=' + room_id;
        } else {
            alert('failed', 'Please login to Book a room');
        }
    }

    setActive();
</script>