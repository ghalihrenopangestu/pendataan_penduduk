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
    <script src="<?= base_url('themes/admin') ?>/bower_components/jquery/jquery-1.11.2.min.js"></script>

    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body background="<?= base_url('themes/admin') ?>/dist/home1.jpg" style="background-size: cover; background-attachment: fixed;">

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1 class="text-center">
                    <?= $judul ?>
                </h1>
                <ol class="breadcrumb">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>">Home</a>
                    </li>
                    <li class="active"><?= $judul ?></li>
                </ol>
            </section>
            <?= $this->session->flashdata('pesan'); ?>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <table class="table table-reposive">
                                    <form action="" method="POST">
                                        <tr>
                                            <th class="col-md-3">Nama</th>
                                            <td>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" autocomplete="off" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email Terdaftar</th>
                                            <td>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email aktif" required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th></th>
                                            <td>
                                                <input type="checkbox" required> Saya memastikan data yang saya tuliskan sudah benar
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>

                                            </td>
                                            <th>
                                                <input type="submit" name="kirim" value="Reset password" class="btn btn-primary rounded-pill py-3 px-5">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>
                                                <p style="color:red">*Setelah mengisi data silakan cek email anda untuk mendapatkan password baru.</p>
                                            </td>
                                        </tr>
                                    </form>  
                                </table>
                        </body>
                        </html>