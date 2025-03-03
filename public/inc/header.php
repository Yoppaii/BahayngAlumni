<!-- Navbar -->
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $site_r['site_title'] ?></a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex">

                <ul class="navbar-nav mb-2 mb-lg-0" id="dashboard-menu">
                    <li class="nav-item">
                        <a class="nav-link me-2" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="facilities.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="events.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="alumni_tracer.php">Alumni Tracer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="careers.php">Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="campus_satellites.php">Campus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="contact_us.php">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex ms-auto">
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    $user_img_path = USERS_IMG_PATH;

                    echo <<<data
                        <div class="sidebar">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-dark shadown-none dropdown-toggle me-3" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <img src="$user_img_path$_SESSION[userProfile]" style="width: 25px; height: 25px;" class="rounded-circle me-1">
                                    $_SESSION[userName]
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="alumniTracer.php">Alumni Tracer</a></li>
                                    <li><a class="dropdown-item" href="verifyAlumni.php">Verify Alumni</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    data;
                } else {
                    echo <<<data
                        <div class="sidebar">
                            <button type="button" class="btn btn-outline-dark shadown-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target='#loginModal'>
                                Login
                            </button>
                            <button type="button" class="btn btn-outline-dark shadown-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target='#registerModal'>
                                Register
                            </button>
                        </div>
                    data;
                }

                ?>
                <br>



            </div>
        </div>
    </div>
</nav>

<!-- <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">
            <?php echo htmlspecialchars($site_r['site_title']); ?>
        </a>

        <ul class="navbar-nav mx-auto" id="dashboard-menu">
            <?php
            $menuItems = [
                'Home' => 'index.php',
                'Rooms' => 'rooms.php',
                'Facilities' => 'facilities.php',
                'News' => 'news.php',
                'Events' => 'events.php',
                'Alumni Tracer' => 'alumni_tracer.php',
                'Careers' => 'careers.php',
                'Campus' => 'campus_satellites.php',
                'About Us' => 'about.php',
                'Contact Us' => 'contact_us.php'
            ];
            foreach ($menuItems as $label => $link): ?>
                <li class="nav-item"><a class="nav-link me-1" href="<?php echo $link; ?>"><?php echo $label; ?></a></li>
            <?php endforeach; ?>
        </ul>

        <div class="d-flex">
            <?php if (!empty($_SESSION['login'])): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="<?php echo USERS_IMG_PATH . htmlspecialchars($_SESSION['userProfile']); ?>" class="rounded-circle" width="30" height="30">
                        <?php echo htmlspecialchars($_SESSION['userName']); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php foreach (
                            [
                                'Profile' => 'profile.php',
                                'Settings' => 'settings.php',
                                'Bookings' => 'bookings.php',
                                'Logout' => 'logout.php'
                            ] as $label => $link
                        ): ?>
                            <li><a class="dropdown-item" href="<?php echo $link; ?>"><?php echo $label; ?></a></li>
                            <?php if ($label === 'Settings') echo '<li><hr class="dropdown-divider"></li>'; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <button class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
            <?php endif; ?>
        </div>
    </div>
</nav> -->

<!-- Responsive Navbar with Dashboard Menu Underneath-->
<!-- <nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold fs-4" href="index.php">
            <?php echo htmlspecialchars($site_r['site_title']); ?>
        </a>

        <div class="d-flex">
            <?php if (!empty($_SESSION['login'])): ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="<?php echo USERS_IMG_PATH . htmlspecialchars($_SESSION['userProfile']); ?>" class="rounded-circle" width="30" height="30">
                        <?php echo htmlspecialchars($_SESSION['userName']); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php foreach (['Profile' => 'profile.php', 'Settings' => 'settings.php', 'Bookings' => 'bookings.php', 'Logout' => 'logout.php'] as $label => $link): ?>
                            <li><a class="dropdown-item" href="<?php echo $link; ?>"><?php echo $label; ?></a></li>
                            <?php if ($label === 'Settings') echo '<li><hr class="dropdown-divider"></li>'; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <button class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
            <?php endif; ?>
        </div>
    </div>
</nav> -->

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top border-bottom">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <ul class="navbar-nav w-100 d-flex justify-content-center py-2" id="dashboard-menu">
            <?php foreach (
                [
                    'Home' => 'index.php',
                    'Rooms' => 'rooms.php',
                    'Facilities' => 'facilities.php',
                    'News' => 'news.php',
                    'Events' => 'events.php',
                    'Alumni Tracer' => 'alumni_tracer.php',
                    'Careers' => 'careers.php',
                    'Campus' => 'campus_satellites.php',
                    'About Us' => 'about.php',
                    'Contact Us' => 'contact_us.php'
                ] as $label => $link
            ): ?>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?php echo $link; ?>"><?php echo $label; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav> -->


<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login_form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email / Mobile Number</label>
                        <input name="email_mobile" type="text" class="form-control shadown-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input name="password" type="password" class="form-control shadown-none" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadown-none">Login</button>
                        <button type="button" class="btn text-secondary text-decoration-none shadown-none me-lg-2 me-3 p-0" data-bs-toggle="modal" data-bs-target='#forgotModal' data-bs-dismiss="modal">
                            Forgot Password?
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register_form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID (Valid ID)
                        that will be required during check-in.
                    </span>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="email" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input name="phoneNumber" type="number" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Picture</label>
                                <input name="profile" type="file" accept=".jpg, .jpeg, ..png, .webp" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Pin Code</label>
                                <input name="pinCode" type="number" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input name="dateofBirth" type="date" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control shadown-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input name="confirmPassword" type="password" class="form-control shadown-none" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-start my-1">
                        <button type="submit" class="btn btn-dark shadown-none">REGISTER</button>

                    </div>
                    <!-- <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control shadown-none">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control shadown-none">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadown-none">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div> -->
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgot_form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: A link will be sent to your email to reset your password
                    </span>
                    <div class="mb-3">
                        <label class="form-label">Email / Mobile Number</label>
                        <input name="email" type="email" class="form-control shadown-none" required>
                    </div>
                    <div class="mb-2 text-end">
                        <button type="button" class="btn shadown-none p-0 me-2" data-bs-toggle="modal" data-bs-target='#loginModal' data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark shadown-none">Send Link</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>