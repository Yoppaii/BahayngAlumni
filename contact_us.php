<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require 'inc/links.php'; ?>
    <title><?php echo $site_r['site_title'] ?> - Contact Us</title>
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

    $contact_q = "SELECT * FROM contact_settings WHERE sr_no=?";
    $values = [1];
    $result = select($contact_q, $values, 'i');
    $contact_r = mysqli_fetch_assoc($result);

    ?>
    <?php

    if (isset($_POST['send'])) {
        $frm_data = filteration($_POST);

        $query = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

        $res = insert($query, $values, 'ssss');
        if ($res == 1) {
            alert('success', 'Mail sent!');
        } else {
            alert('error', 'Mail not sent!');
        }
    }
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line mt-2 bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus eaque totam minus eligendi dicta quos adipisci deleniti sunt ducimus ad.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <div class="d-flex align-items-center mb-2">
                        <iframe class="w-100 rounded mb-4"
                            src="<?php echo $contact_r['iframe'] ?>"
                            height="320px" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <h5>Address</h5>
                    <a class="d-inline-block text-decoration-none text-dark mb-2">
                        <?php echo $contact_r['address'] ?>
                    </a>
                    <h5 class="mt-3">Call us</h5>
                    <a class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +62 9354390173
                    </a>
                    <br>
                    <a class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +62 9354390173
                    </a>
                    <h5 class="mt-3">Email</h5>
                    <a href="mailto: sacmacrossxxv@gmail.com" class="d-inline-block text-decoration-none text-dark">
                        sacmacrossxxv@gmail.com
                    </a>

                    <h5 class="mt-3">Follow Us</h5>
                    <a href="<?php echo $contact_r['facebook'] ?>" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="<?php echo $contact_r['twitter'] ?>" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-twitter me-1"></i>
                    </a>
                    <a href="<?php echo $contact_r['instagram'] ?>" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4">
                    <form method="POST">
                        <h5>Send us a message</h5>
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input name="name" required type="text" class="form-control shadown-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input name="email" required type="email" class="form-control shadown-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input name="subject" required type="text" class="form-control shadown-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea name="message" required class="form-control shadown-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" name="send" class="btn custom-bg text-white mt-3">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <?php require 'inc/footer.php'; ?>

</body>

</html>