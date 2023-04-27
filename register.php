<?php
require 'bdd.php';
$error = null;
if (isset($_POST['register'])) {
    if ($_POST['password'] == $_POST['confirm_password']) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=:em");

        $stmt->bindParam(':em', $_POST['email']);

        $stmt->execute();
        $userExist = $stmt->fetchObject();
        if (!$userExist) {
            $name = $_POST['user_name'];
            $email = $_POST['email'];
            //$password = $_POST['password'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $confirm_password = $_POST['confirm_password'];
            $created_at = date("Y-m-d H:i:s");
            $stmt = $conn->prepare("INSERT INTO users(name,password,email,created_at) VALUES (:nm,:pwd,:em,:cr)");
            $stmt->bindParam(':nm', $name);
            $stmt->bindParam(':pwd', $password);
            $stmt->bindParam(':em', $email);
            $stmt->bindParam(':cr', $created_at);
            $stmt->execute();
            if ($stmt->rowCount() != 0) {
                $success = "Your account has been created successfully";
            } else {
                $error = "Failed to create account !!";
            }
        } else {
            $error = "Email already in use!!!";
        }
    } else
        $error = "Confirm password does not match!!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EPI Network</title>
    ²
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
                <a href="index.html"><span
                        class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0"><img
                            src="images/logo.png" width="250"> </span>
                </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i
                        class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="default-video.html" class="mob-menu me-2"><i
                        class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="#" class="me-2 menu-search-icon mob-menu"><i
                        class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <button class="nav-menu me-0 ms-2"></button>

                <a href="login.php"
                    class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl">Connexion</a>
                <a href="register.php"
                    class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl">S'inscrire</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat">
                <div class="h-100 d-flex align-items-center justify-content-end">
                    <img src="images/login-bg.png" width="525" height="525">
                </div>
            </div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left">
                        <h2 class="fw-700 display1-size display2-md-size mb-4">Crée votre Compte</h2>
                        <form method="POST" action="">
                            <?php
                            if ($error != null) {
                                echo '<badge class="badge badge-danger w-100">' . $error . '</badge>'; /*BADGEEEEEEE*/
                            }
                            if (isset($success)) {
                                echo '<badge class="badge badge-success w-100">' . $success . '</badge>'; /*BADGEEEEEEE*/
                            }
                            ?>
                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-user text-grey-500 pe-0"></i>
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                   placeholder="Nom et prénom" name="user_name" required>
                        </div>
                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-email text-grey-500 pe-0"></i>
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                   placeholder="Addresse Email" name="email" required>
                        </div>
                        
                        <div class="form-group icon-input mb-3">
                            <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                   placeholder="Mot de passe" name="password" required>
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="form-group icon-input mb-1">
                            <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                   placeholder="Confirmer votre Mot de passe" name="confirm_password" required>
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="col-sm-12 p-0 text-left">
                            <div class="form-group mb-1">
                                <button type="submit"
                                        class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0"
                                        name="register">S'insrire
                                </button>
                            </div>
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Vous avez deja un compte ? <a
                                        href="login.php" class="fw-700 ms-1">Se connecter</a></h6>
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