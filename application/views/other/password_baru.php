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
    <link rel="stylesheet"
    href="<?= base_url('themes/admin') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="<?= base_url('themes/admin') ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet"
     href="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
     <link rel="stylesheet"
     href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 </head>

 <body background="<?= base_url('themes/admin') ?>/dist/home1.jpg" style="background-size: cover;">

    <?php
//membuat waktu gmt +7
    date_default_timezone_set('Asia/Jakarta');
    $datetime = date('Y-m-d H:i:s');
    if($expired >= $datetime) :
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= $judul ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?= $judul ?></li>
                </ol>
            </section>

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
                                            <th class="col-md-3">Nama Pengguna</th>
                                            <td>
                                                <input type="text" name="nama_rt" class="form-control" value="<?= $nama_rt ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Masukkan Password Baru</th>
                                            <td>
                                                <input type="password" name="password" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th>
                                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                            </th>
                                        </tr>
                                    </form>	 
                                </table>
                            </div>
                        <?php 
                        date_default_timezone_set('Asia/Jakarta');
                        $datetime = date('Y-m-d H:i:s');
                    elseif($expired <= $datetime):
                        ?>
                        <br><br><br><br><br><br><br><br><br><br>
                        <!-- menampilkan expired -->
                        <center>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <h3>Maaf, token reset password anda sudah expired silakan melakukan reset password kembali</h3>
                                            <a href="<?= base_url('reset_password') ?>" class="btn btn-warning">Reset Password</a>
                                    </div>
                                </div>
                            </div>
                        </center>

                    <?php endif; ?>

