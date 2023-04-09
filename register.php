<?php
require 'SQLWorker.php';
$error = null;
if (isset($_POST['register'])) {
    $sqlWorker = new SQLWorker();
    $user = $sqlWorker->getUserByMail($_POST['email']);
    if (!$user) {
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $result = $sqlWorker->register($_POST);
        if ($result) {
            header('Location: login.php?action=just_registered');
        }
    }
    $error = "email already in use";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elomoas - Online Course and LMS HTML Template</title>

    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">


</head>

<body class="color-theme-blue">

<div class="preloader"></div>

<div class="main-wrap">

    <div class="nav-header bg-transparent shadow-none border-0">
        <div class="nav-top w-100">
            <a href="index.html"><i class="feather-zap text-success display1-size me-2 ms-0"></i><span
                        class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Sociala. </span>
            </a>
            <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i
                        class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <a href="default-video.html" class="mob-menu me-2"><i
                        class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <a href="#" class="me-2 menu-search-icon mob-menu"><i
                        class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <button class="nav-menu me-0 ms-2"></button>

            <a href="login.php"
               class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl">Login</a>
            <a href="register.php"
               class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl">Register</a>

        </div>


    </div>

    <div class="row">
        <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
             style="background-image: url(images/login-bg-2.jpg);"></div>
        <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
            <div class="card shadow-none border-0 ms-auto me-auto login-card">
                <div class="card-body rounded-0 text-left">
                    <h2 class="fw-700 display1-size display2-md-size mb-4">Create <br>your account</h2>
                    <form method="POST">
                        <?php
                        if ($error != null) {
                            echo '<badge class="badge badge-danger w-100">' . $error . '</badge>';
                        }
                        ?>
                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-user text-grey-500 pe-0"></i>
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                   placeholder="Your Name" name="user_name" required>
                        </div>
                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-email text-grey-500 pe-0"></i>
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                   placeholder="Your Email Address" name="email" required>
                        </div>
                        <div class="form-group icon-input mb-3">
                            <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                   placeholder="Password" name="password" required>
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="form-group icon-input mb-1">
                            <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                   placeholder="Confirm Password" name="confirm_password" required>
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="form-check text-left mb-3">
                            <input type="checkbox" class="form-check-input mt-2" id="exampleCheck2">
                            <label class="form-check-label font-xsss text-grey-500" for="exampleCheck2">Accept Term and
                                Conditions</label>
                        </div>

                        <div class="col-sm-12 p-0 text-left">
                            <div class="form-group mb-1">
                                <button type="submit"
                                        class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0"
                                        name="register">Register
                                </button>
                            </div>
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Already have account <a
                                        href="login.php" class="fw-700 ms-1">Login</a></h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/plugin.js"></script>
<script src="js/scripts.js"></script>

</body>


</html>