<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>

<?php 
if($aksi == "kirimemail_plg"):
?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?= base_url('admin') ?>" class="btn btn-primary btn-block margin-bottom">Back to Home</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="<?= base_url('email/kirimemail_plg') ?>"><i class="fa fa-inbox"></i> Kirim email pelanggan</a></li>
                            <li><a href="<?= base_url('email/kirimemail_semua/E001') ?>"><i class="fa fa-envelope-o"></i> Kirim email semua plg</a></li>
                            <li><a href="<?= base_url('email/kirimemail_umum') ?>"><i class="fa fa-file-text-o"></i> Kirim email umum</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New Message</h3>
                    </div>
                    <!-- /.box-header -->
                    <form class="form-horizontal" action="<?= base_url('email/sendmail_plg') ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <select class="form-control select2" style="width: 100%;" name="email_pengirim" id="email_pengirim">
                                    <option value="wifi@alimochtar.my.id">wifi@alimochtar.my.id</option>
                                    <option value="cs@alimochtar.my.id">cs@alimochtar.my.id</option>
                                    <option value="ALIMOCHTAR

wifi@alimochtar.my.id">ALIMOCHTAR

wifi@alimochtar.my.id</option>
                                    <option value="erik@alimochtar.my.id">erik@alimochtar.my.id</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="ALIMOCHTAR

 WIFI" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <select name="email_penerima" id="email_penerima" class="form-control" required="">
                                    <option value="">--Pilih Pelanggan--</option>
                                    <?php $no=1; foreach($pelanggan as $plg): ?>
                                    <option value="<?= $plg['email'] ?>">
                                       <?= $no++ ?> | <?= ucfirst($plg['nama']) ?> | <?= ucfirst($plg['email']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" autocomplete="off" placeholder="Subject :" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control ckeditor" id="isi_pesan" name="isi_pesan" autocomplete="off" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ttd" name="ttd" autocomplete="off" value="wifi@alimochtar.my.id" required>
                            </div>
              
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" name="send" id="send" value="send" class="btn btn-primary"><i class="fa fa-envelope-o"></i>
                                Send
                                </button>
                    </form>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  <?php 
  elseif($aksi == "kirimemail_semua"):
  ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?= base_url('admin') ?>" class="btn btn-primary btn-block margin-bottom">Back to home</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="<?= base_url('email/kirimemail_plg') ?>"><i class="fa fa-inbox"></i> Kirim email pelanggan</a></li>
                            <li class="active"><a href="<?= base_url('email/kirimemail_semua/E001') ?>"><i class="fa fa-envelope-o"></i> Kirim email semua plg</a></li>
                            <li><a href="<?= base_url('email/kirimemail_umum') ?>"><i class="fa fa-file-text-o"></i> Kirim email umum</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New Message</h3>
                      <div class="pull-right">
                      <a href="<?= base_url('email/sendmail_semua') ?>" class="btn btn-warning"><i class="fa fa-envelope"></i> Kirim Email Sekarang</a>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <select class="form-control select2" style="width: 100%;" name="email_pengirim" id="email_pengirim">
                                    <option value="wifi@alimochtar.my.id">wifi@alimochtar.my.id</option>
                                    <option value="cs@alimochtar.my.id">cs@alimochtar.my.id</option>
                                    <option value="ALIMOCHTAR

wifi@alimochtar.my.id">ALIMOCHTAR

wifi@alimochtar.my.id</option>
                                    <option value="erik@alimochtar.my.id">erik@alimochtar.my.id</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="ALIMOCHTAR

 WIFI" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" value="<?= $subject ?>" autocomplete="off" placeholder="Subject :" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control ckeditor" id="isi_pesan" name="isi_pesan"  autocomplete="off" required><?= $isi_pesan ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="tanda_tangan" name="tanda_tangan" autocomplete="off" value="<?= $tanda_tangan ?>" required>
                            </div>
              
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" name="kirim" id="kirim" value="Simpan" class="btn btn-success"><i class="fa fa-envelope-o"></i>
                                Simpan pesan
                                </button>
                    </form>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php 
  elseif($aksi == "kirimemail_umum"):
  ?>
 <!-- Main content -->
 <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?= base_url('admin') ?>" class="btn btn-primary btn-block margin-bottom">Back to Home</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="<?= base_url('email/kirimemail_plg') ?>"><i class="fa fa-inbox"></i> Kirim email pelanggan</a></li>
                            <li><a href="<?= base_url('email/kirimemail_semua/E001') ?>"><i class="fa fa-envelope-o"></i> Kirim email semua plg</a></li>
                            <li class="active"><a href="<?= base_url('email/kirimemail_umum') ?>"><i class="fa fa-file-text-o"></i> Kirim email umum</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New Message</h3>
                    </div>
                    <!-- /.box-header -->
                    <form class="form-horizontal" action="<?= base_url('email/sendmail_umum') ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <select class="form-control select2" style="width: 100%;" name="email_pengirim" id="email_pengirim">
                                    <option value="wifi@alimochtar.my.id">wifi@alimochtar.my.id</option>
                                    <option value="cs@alimochtar.my.id">cs@alimochtar.my.id</option>
                                    <option value="ALIMOCHTAR

wifi@alimochtar.my.id">ALIMOCHTAR

wifi@alimochtar.my.id</option>
                                    <option value="erik@alimochtar.my.id">erik@alimochtar.my.id</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="ALIMOCHTAR

 WIFI" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email_penerima" name="email_penerima" autocomplete="off" placeholder="Email penerima :" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" autocomplete="off" placeholder="Subject :" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control ckeditor" id="isi_pesan" name="isi_pesan" autocomplete="off" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ttd" name="ttd" autocomplete="off" value="wifi@alimochtar.my.id" required>
                            </div>
              
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" name="send" id="send" value="send" class="btn btn-primary"><i class="fa fa-envelope-o"></i>
                                Send
                                </button>
                    </form>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<?php endif; ?>
    <script type="text/javascript" src="<?php echo base_url('themes/ALIMOCHTAR

-wifi/ckeditor/ckeditor.js')?>"></script>

<?php $this->load->view('template/footer'); ?>