<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="description" content="Pendataan penduduk dan keluarga guna mempermudah dalam proses pelayanan administrasi dengan menggunakan teknologi informasi">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/plugins/iCheck/square/blue.css">
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">
  <!-- manifest json -->
  <link rel="manifest" href="<?= base_url('static/manifest.json') ?>">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<!-- sweetalert -->
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

<body class="hold-transition" background="<?= base_url('themes/admin') ?>/dist/img/bgmember.jpg" style="background-size: cover; background-attachment: fixed;">
  <div class="login-box">
    <?= $this->session->flashdata('pesan') ?>
    <!-- /.login-logo -->
    <div class="login-box-body">
     <center>
      <img src="<?= base_url('themes/admin') ?>/dist/img/penduduk-01.png" width="100%" />
      <h4>
       <b>
        Web Aplikasi Data Penduduk
      </b>
    </h4>
    
  </center>
  <form action="" method="post">
    <div class="form-group has-feedback">
      <input type="text" class="form-control" name="email" placeholder="Nama / Email / No KK / No HP" required="">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" name="password" placeholder="Password" required="">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <!-- /.col -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-block" name="login" title="Masuk Sistem">
         <b>LOGIN</b>
       </button>
       <div class="checkbox icheck">
        <label>
          lupa password? <a href="<?= base_url('reset_password') ?>">klik disini</a>
        </label> <br>
        <label>
          Cari data warga tanpa login? <a href="<?= base_url('cari_penduduk') ?>">klik disini</a>
        </label>
      </div>
      
 </div>
</div>
</form>
<!--  <a href="#">I forgot my password</a><br> -->
</div>
<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url('themes/admin/') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('themes/admin/') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url('themes/admin/') ?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
