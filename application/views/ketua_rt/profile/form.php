<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "lihat"):
?>
<?= $this->session->flashdata('pesan') ?>

<table class="table table-striped">
    <form action="" method="POST" enctype="multipart/form-data">
        <tr>
            <th class="col-md-2">Nama</th>
            <td>
                : <?= htmlentities($nama_rt) ?>
            </td>
        </tr>
        <tr>
            <th>No HP</th>
            <td>
                : <?= $no_hp ?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                : <?= $email ?>
            </td>
        </tr>
        <tr>
            <th>No RT</th>
            <td>
                : <?= $no_rt ?>
            </td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>
                : <?= htmlentities($alamat) ?>
            </td>
        </tr>
        <tr>
            <th>Password</th>
            <td>
                : <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password"><i
                        class="fa fa-key"></i> Ganti Password</a>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <a href="../ketua_rt/home" class="btn btn-primary">Kembali</a> &nbsp;&nbsp;
                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editAkun"><i
                        class="fa fa-edit"></i> Perbarui Data</a>
            </td>
        </tr>

    </form>
</table>

<!-- Modal edit data akun -->
<div class="modal fade" id="editAkun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped">
                    <form action="<?= base_url('ketua_rt/profile/edit/'.$id_rt) ?>" method="POST" enctype="multipart/form-data">
                        <tr>
                            <th>Nama Lengkap</th>
						</tr>
						<tr>
                            <td>
                                <input type="text" name="nama_rt" value="<?= $nama_rt ?>" class="form-control" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
						</tr>
						<tr>
                            <td>
                                <input type="text" name="alamat" value="<?= $alamat ?>" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>No HP</th>
						</tr>
						<tr>
                            <td>
                                <input type="text" name="no_hp" value="<?= $no_hp ?>" class="form-control"
                                    placeholder="penulisan nomor 6281123xxxxxx" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" name="email" value="<?= $email ?>" class="form-control"
                                    autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Ganti Password</th>
						</tr>
						<tr>
                            <td>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password"><i
                                        class="fa fa-key"></i> Ganti Password</a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                &nbsp;&nbsp;
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                            </td>
                        </tr>

                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<!-- Modal ganti password  -->
<div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ganti Password</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped">
                    <form action="<?= base_url('ketua_rt/profile/ganti_password/'.$id_rt) ?>" method="POST" enctype="multipart/form-data">
                        <tr>
                            <th class="col-md-12">Nama Ketua RT</th>
                        </tr>
                        <tr>
                            <td>
                                <p class="form-control"><?= $nama_rt ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th>Masukkan Password Baru</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password" name="password" class="form-control" required=""> 
								<input type="checkbox" onclick="viewPassword()"> Lihat Password
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                &nbsp;&nbsp;
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                            </th>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<?php endif; ?>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/akses'); ?>