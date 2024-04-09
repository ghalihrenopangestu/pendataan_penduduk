<section class="content-header">
	<h1 class="fa fa-users">
		Kirim Email |
		<small>
			<a href="?page=admin">Beranda</a> >
			<a href="?page=kirim-email">Email untuk users</a> >  
			<a href="">Kirim Email Untuk Umum</a>
		</small>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Kirim Email Untuk Umum</h3>
					<div class="box-tools pull-right">
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
								<input type="email" class="form-control" id="email_penerima" name="email_penerima" autocomplete="off" required>
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

<script>
function myFunction() {
    var x = document.getElementById("email");
    x.value = x.value.toLowerCase();
}
</script>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

