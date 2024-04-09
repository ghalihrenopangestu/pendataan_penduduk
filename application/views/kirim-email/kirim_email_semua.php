<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_email WHERE id_email='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<section class="content-header">
	<h1 class="fa fa-users">
		Kirim Email |
		<small>
			<a href="?page=admin">Beranda</a> >
			<a href="?page=kirim-email">Email untuk users</a> >  
			<a href="">Kirim Email Untuk Semua</a>
		</small>
	</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Kirim Email</h3>
					<div class="box-footer pull-right">
				<a href="../admin/kirim-email/sendemailsemua.php" class="btn btn-warning">
				<i class="fa fa-envelope"></i> Kirim Email Sekarang</a>
			</div>
				</div>
				<!-- /.box-header -->
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Email Pengirim</label>
							<div class="col-sm-6">
								<select class="form-control select2" style="width: 100%;" name="email_pengirim" id="email_pengirim">
									<option value="<?php echo $data_cek['email_pengirim']; ?>"><?php echo $data_cek['email_pengirim']; ?></option>
									<option value="cs@alimochtar.my.id">cs@alimochtar.my.id</option>
									<option value="wifi@alimochtar.my.id">wifi@alimochtar.my.id</option>
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
								<input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" autocomplete="off" required value="<?php echo $data_cek['nama_pengirim']; ?>"
							/>
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-2 control-label">Subject</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="subject" name="subject" autocomplete="off" required value="<?php echo $data_cek['subject']; ?>"
							/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Isi Pesan</label>
							<div class="col-sm-6">
							<textarea  class="form-control ckeditor" id="isi_pesan" name="isi_pesan" required value=<?php echo $data_cek['isi_pesan']; ?></textarea>
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
								<input type="text" class="form-control" id="tanda_tangan" name="tanda_tangan" autocomplete="off" required value="<?php echo $data_cek['tanda_tangan']; ?>"
							/>
							</div>
						</div>

						<!-- /.box-body -->
						<div class="box-footer">
							<a href="?page=kirim-email" class="btn btn-default">Batal</a>
							<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
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

<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
		$sql_ubah = "UPDATE tb_email SET
		nama_pengirim 			='".$_POST['nama_pengirim']."',
		email_pengirim 			='".$_POST['email_pengirim']."',
		subject 				='".$_POST['subject']."',
        isi_pesan 				='".$_POST['isi_pesan']."',
		tanda_tangan 			='".$_POST['tanda_tangan']."'
        WHERE id_email			='".$data_cek['id_email']."'";

    // Masukkan informasi file ke database
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=kirim-email-semua&kode=E001';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=kirim-email-semua&kode=E001';
          }
      })</script>";
    }

    //selesai proses ubah
}



?>

