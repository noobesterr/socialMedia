<?php
session_start();
if (!isset($_SESSION['id']) || isset($_GET['logout'])) {
    session_destroy();
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social network</title>

    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/emoji.css">

    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

</head>

<body class="color-theme-blue mont-font">

<div class="preloader"></div>


<div class="main-wrapper">

    <div class="nav-header bg-white shadow-xs border-0">
        <div class="nav-top">
            <a href="home.php"><i class="feather-zap text-success display1-size me-2 ms-0"></i><span
                        class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Med. amine mghirbi</span>
            </a>
        </div>
        <a href="home.php" class="ms-auto p-2 text-center ms-3 menu-icon center-menu-icon">
            <i class="feather-home font-lg alert-primary btn-round-lg theme-dark-bg text-current "></i>
        </a>
        <a href="profile.php" class="p-2 text-center ms-auto menu-icon">
            <img src="<?= $_SESSION['avatar'] ?>" alt="user" class="w40 mt--1">
        </a>
        <a href="?logout" class="p-10 ms-3 menu-icon">
            <img src="images/log-out.svg">
        </a>
    </div>
