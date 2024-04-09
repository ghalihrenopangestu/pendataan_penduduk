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

    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body background="<?= base_url('themes/admin') ?>/dist/home1.jpg" style="background-size: cover; background-attachment: fixed;">

    <div class="wrapper">
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
                                            <th class="col-md-3">Nama</th>
                                            <td>
                                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tgl lahir</th>
                                            <td>
                                                <input type="date" name="tgl_lahir" class="form-control" value="<?= date('Y-m-d') ?>" required autocomplete="off">
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td></td>
                                            <th>
                                                <input type="submit" name="cari" value="Cari" class="btn btn-primary">
                                            </th>
                                        </tr>
                                    </form>	 
                                </table>
                            </div>
                            <!-- /.box-header -->

                            <!-- form start -->
                            <?php if($depan == TRUE): ?>
                                <?php if (!empty($data->result_array())): ?>
                                    <div class="box-body table-responsive">
                                        <table id="example1" class="table table-bordered  table-striped table-hover">
                                            <?php $no=1; foreach($data->result_array() as $penduduk): ?>
                                            <tr>
                                                <th class="col-xs-3">No KK</th>
                                                <td><?= tanda($penduduk['no_kk']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td><?= tanda($penduduk['nik']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td><?= $penduduk['nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Lahir</th>
                                                <td><?= tgl_indo($penduduk['tgl_lahir']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Usia</th>
                                                <td><?= hitung_usia($penduduk['tgl_lahir']) ?> Tahun</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Lahir</th>
                                                <td><?= $penduduk['tempat_lahir'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td><?= $penduduk['jenis_kelamin'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td><?= $penduduk['alamat'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>No HP <?= $penduduk['nama'] ?></th>
                                                <td>
                                                    <?php if($penduduk['no_hp_anggota'] == NULL): ?>
                                                        -
                                                    <?php else: ?>
                                                        <?= $penduduk['no_hp_anggota'] ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Agama</th>
                                                <td><?= $penduduk['agama'] ?></td>
                                            </tr>  
                                            <tr>
                                                <th>Pendidikan</th>
                                                <td><?= $penduduk['pendidikan'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td><?= $penduduk['pekerjaan'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status Hubungan Keluarga</th>
                                                <td><?= $penduduk['hubungan'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status Perkawinan</th>
                                                <td><?= $penduduk['perkawinan'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kewarganegaraan</th>
                                                <td><?= $penduduk['kewarganegaraan'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kepala Keluarga</th>
                                                <td><?= $penduduk['nama_kk'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>No HP Kepala Keluarga</th>
                                                <td><?= $penduduk['no_hp'] ?></td>
                                            </tr>
                                            
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php elseif($depan == FALSE): ?>
                        <?php else : ?>
                            <div class="box-body">
                                <div class="alert alert-warning">
                                    <h4><i class="icon fa fa-ban"></i> Data Tidak Ditemukan</h4>
                                    Maaf, data yang anda cari tidak ditemukan mungkin karena data tersebut tidak ada atau salah memasukkan data, 
                                    silahkan coba lagi dengan data yang benar atau hubungi <a href="contact" target="blank">Admin</a>.
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                <?php $this->load->view('template/akses'); ?>

                <?php
 //memberi tanda * pada 350211****
                function tanda($nik){
                    $tanda = substr($nik, 0, 6);
                    $tanda .= "******";
                    return $tanda;
                }

 //format tanggal indonesia
                function tgl_indo($tanggal){
                    $bulan = array (
                      1 =>   'Januari',
                      'Februari',
                      'Maret',
                      'April',
                      'Mei',
                      'Juni',
                      'Juli',
                      'Agustus',
                      'September',
                      'Oktober',
                      'November',
                      'Desember',
                  );
                    $pecahkan = explode('-', $tanggal);
                    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
                    
                    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                }

                function hitung_usia($tanggal_lahir){
                    list($year,$month,$day) = explode("-",$tanggal_lahir);
                    $year_diff  = date("Y") - $year;
                    $month_diff = date("m") - $month;
                    $day_diff   = date("d") - $day;
                    if ($month_diff < 0) {
                        $year_diff--;
                    } elseif (($month_diff==0) && ($day_diff < 0)) {
                        $year_diff--;
                    }
                    return $year_diff;
                }

            ?>