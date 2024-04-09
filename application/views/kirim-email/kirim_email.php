<?php
                  $no = 1;
                  $sql = $koneksi->query("SELECT * from tb_email order by id_email asc");
                  while ($data= $sql->fetch_assoc()) {
                ?>

<section class="content-header">
	<h1 class="fa fa-users">
		Kirim Email |
		<small>
			<a href="?page=admin">Beranda</a> >  
			<a href="">Kirim Email</a>
		</small>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Kirim Email</h3><br>
					<div class="box-footer pull-left">
						<a href="?page=kirim-email-semua&kode=<?php echo $data['id_email']; ?>" class="btn btn-primary">
						<i class="fa fa-envelope"></i> Kirim Email Semua</a>
					</div>
					<div class="box-footer pull-right">
						<a href="?page=kirim-email-umum" class="btn btn-info">
						<i class="fa fa-envelope"></i> Kirim Email Umum</a>
					</div>
				</div>
				<!-- /.box-header -->
				<form class="form-horizontal" action="sendemail.php" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Email Pengirim</label>
							<div class="col-sm-6">
								<select class="form-control select2" style="width: 100%;" name="email_pengirim" id="email_pengirim">
									<option value="wifi@alimochtar.my.id">wifi@alimochtar.my.id</option>
									<option value="cs@alimochtar.my.id">cs@alimochtar.my.id</option>
									<option value="ALIMOCHTAR

wifi@alimochtar.my.id">ALIMOCHTAR

wifi@alimochtar.my.id</option>
									<option value="erik@alimochtar.my.id">erik@alimochtar.my.id</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Pengirim</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" autocomplete="off" value="ALIMOCHTAR

 WiFi" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Email Penerima</label>
							<div class="col-sm-6">
								<select name="email_penerima" id="email_penerima" class="form-control select2" style="width: 100%;">
									<option selected="">-- Pilih --</option>
									<?php
									// ambil data dari database
									$query = "select * from tb_pelanggan where status_plg='Aktif'";
									$hasil = mysqli_query($koneksi, $query);
									while ($row = mysqli_fetch_array($hasil)) {
									?>
									<option value="<?php echo $row['email'] ?>">
										<?php echo $row['id_pelanggan'] ?>
										<?php echo $row['nama'] ?> |
									 	<?php echo $row['email'] ?>

									</option>
									<?php
									}
									?>

								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Subject</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="Subject" name="Subject" autocomplete="off" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Isi Pesan</label>
							<div class="col-sm-6">
								<textarea  class="form-control ckeditor" id="isi_pesan" name="isi_pesan" autocomplete="off" required></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Kirim File</label>
							<div class="col-sm-6">
								<input type="file" class="form-control" id="attachmentFile" name="attachmentFile" autocomplete="off">
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-2 control-label">Tanda Tangan<br>
								<small>Nama Terang saja</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="ttd" name="ttd" autocomplete="off" value="wifi@alimochtar.my.id" required>
							</div>
						</div>

						<!-- /.box-body -->
						<div class="box-footer">
							<a href="?page=admin" class="btn btn-default">Batal</a>
							<input type="submit" name="Send" value="Send" class="btn btn-success">
						</div>
				</form>
				</div>
				<!-- /.box -->
</section>
<?php
  }
 ?>
<script>
function myFunction() {
    var x = document.getElementById("email");
    x.value = x.value.toLowerCase();
}
</script>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

