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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/skins/_all-skins.min.css">
   <!-- Morris chart -->
   <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/morris.js/morris.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/jvectormap/jquery-jvectormap.css">
   <!-- Date Picker -->
   <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
   <!-- Daterange picker -->
   <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
   <!-- bootstrap wysihtml5 - text editor -->
   <script src="<?= base_url('themes/admin') ?>/bower_components/jquery/jquery-1.11.2.min.js"></script>
   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->
    <!-- select2 -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/select2/dist/css/select2.min.css">

    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">
    
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>

      #preview_kk {
        display: none;
      }
    </style>
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
      <?php
//error_reporting(0);
      if($this->session->userdata('level') =="Administrator"){
       $id  = $this->session->userdata('id_admin');
       $data= $this->db->get_where('tb_admin',array('id_admin'=>$id))->row_array();
     }elseif($this->session->userdata('level') == "ketua_rt"){
       $id  = $this->session->userdata('id_rt');
       $data= $this->db->get_where('tb_rt',array('id_rt'=>$id))->row_array();
     }
     ?>


     <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <marquee>
            <b>Data Penduduk</b>
          </marquee>
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if($this->session->userdata('level') == "Administrator"){ ?>
                  <img src="<?= base_url('themes/admin') ?>/dist/img/komp.png" class="user-image" width="30%" alt="User Image">
                  <span class="hidden-xs"><?= $data['nama'] ?></span>
                </a>
              <?php }elseif($this->session->userdata('level') == "ketua_rt"){ ?>
                <img src="<?= base_url('themes/admin') ?>/dist/img/user.png" class="user-image" width="30%" alt="User Image">
                <span class="hidden-xs"><?= $data['nama_rt'] ?></span>
              </a>                  
            <?php } ?> 
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  <?php if($this->session->userdata('level') == "Administrator"){ ?>
                    <img src="<?= base_url('themes/admin') ?>/dist/img/komp.png" class="img-circle" width="30%" alt="User Image"> <br>
                    <?= $data['nama'] ?> <br>
                    <span class="label label-warning">
                      <small>
                        <span>Administrator</span>
                      <?php }elseif($this->session->userdata('level') == "ketua_rt"){ ?>
                        <img src="<?= base_url('themes/admin') ?>/dist/img/user.png" class="img-circle" width="30%" alt="User Image"> <br>                  
                        <?= $data['nama_rt'] ?> <br>
                        <span class="label label-warning">
                          <small>
                            <span>Ketua RT <?= $data['no_rt'] ?></span> |
                            <span> <?= $data['alamat'] ?></span>
                          <?php } ?> 
                        </small>
                      </span>
                    </p>
                  </li>
                  
                  <?php if($this->session->userdata('level') == "Administrator"){ ?>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="<?= base_url('admin/user_admin') ?>" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="javascript:void(0)" onclick="keluar()" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  <?php }elseif($this->session->userdata('level') == "ketua_rt"){ ?>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="<?= base_url('ketua_rt/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="javascript:void(0)" onclick="keluar()" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  <?php } ?>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <br /><br />
        </div>
        <?php if($this->session->userdata('level') == "Administrator"){ ?>
          <img src="<?= base_url('themes/admin') ?>/dist/img/komp.png" class="img-circle" width="25%" alt="User Image">
          <span class="pull-left info"><?= ucfirst($data['nama']) ?> <br><br>
            <small class="label label-warning">
              <span>Administrator</span>
            <?php }elseif($this->session->userdata('level') == "ketua_rt"){ ?>
              <img src="<?= base_url('themes/admin') ?>/dist/img/user.png" class="img-circle" width="25%" alt="User Image">                  
              <span class="pull-left info"><?= ucfirst($data['nama_rt']) ?> <br><br>
                <small class="label label-warning">
                  <span>Ketua RT <?= $data['no_rt'] ?></span> |
                  <span> <?= $data['alamat'] ?></span>               
                <?php } ?> 
              </small>
            </span>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            

            <?php if($this->session->userdata('level') == "Administrator"){ ?>
              <li class="">
                <a href="<?= base_url('admin/home') ?>">
                  <i class="fa fa-dashboard"></i> <span>Dasboard</span>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-green">Home</small>
                  </span>
                </a>
              </li>
              <li class="header">OLAH DATA</li>
              <li><a href="<?= base_url('admin/ketua_rt'); ?>"><i class="fa fa-user"></i> <span>Ketua RT</span></a></li>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Data Keluarga</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu active">
                <li><a href="<?= base_url('admin/kepala_keluarga') ?>" class="active"><i class="fa fa-cubes"></i>Kepala Keluarga</a></li>
                <li><a href="<?= base_url('admin/anggota') ?>"><i class="fa fa-creative-commons"></i>Data Penduduk</a></li>
              </ul>
            </li>
            <li><a href="<?= base_url('admin/data_lain') ?>"><i class="fa fa-odnoklassniki-square"></i> <span>Data Lainnya</span></a></li>
            <li class="header">OTHER</li>
            <li><a href="<?= base_url('admin/informasi') ?>"><i class="fa fa-bullhorn"></i> <span>Informasi</span></a></li>
            <li><a href="<?= base_url('admin/user_admin') ?>" class="active"><i class="fa fa-user"></i> Data Administrator</a></li>
          </li>

        <?php }elseif($this->session->userdata('level') == "ketua_rt"){ ?>

          <li class="">
            <a href="<?= base_url('ketua_rt/home') ?>">
              <i class="fa fa-dashboard"></i> <span>Dasboard</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">Home</small>
              </span>
            </a>
          </li>
          <li class="header">OLAH DATA</li>
          <li class="treeview"> 
            <li><a href="<?= base_url('ketua_rt/kepala_keluarga'); ?>"><i class="fa fa-cubes"></i>Kepala Keluarga</a></li>
            <li><a href="<?= base_url('ketua_rt/anggota'); ?>"><i class="fa fa-creative-commons"></i>Data Penduduk</a></li>
          </li> 
          <li><a href="<?= base_url('ketua_rt/data_lain') ?>"><i class="fa fa-odnoklassniki-square"></i> <span>Data Lainnya</span></a></li>
          <li class="header">OTHER</li>
          <li><a href="<?= base_url('ketua_rt/profile'); ?>"><i class="fa fa-user"></i>Profile RT</a></li>
          <li><a href="<?= base_url('ketua_rt/informasi'); ?>"><i class="fa fa-bullhorn"></i> Informasi</a></li>
        </li> 
        
      <?php } ?>
      <!-- logout -->
      <li> <a href="javascript:void(0)" onclick="keluar()"><i class="fa fa-sign-out"></i>Sign out</a>
        <li class="header">END MAIN NAVIGATION</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard |
        <small><?= $judul ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li  class="active"><?= $judul ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
      <div class="col-md-12">
       <!-- general form elements -->
       <div class="box box-success">
        <div class="box-header with-border">
          
          
