<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $judul ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <meta name="description" content="Pendataan penduduk dan keluarga guna mempermudah dalam proses pelayanan administrasi dengan menggunakan teknologi informasi">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body background="<?= base_url('themes/admin') ?>/dist/home1.jpg" style="background-size: cover;">
    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $judul ?>
            </h1>
            <ol class="breadcrumb">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('login') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                </li>
                <li class="active"><?= $judul ?></li>
            </ol>
        </section>
    </div>
    
    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-6 mb-4">Contact Us</h1>
                <p class="text-center mb-4">Call : Ali Mochtar Development System | 08179851011</p>
            </div>

            