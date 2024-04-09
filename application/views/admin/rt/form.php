<?php $this->load->view('template/header'); ?>
<head>
    <!-- ... (existing code) ... -->
    <title>Data Ketua RT</title>
    <!-- ... (existing code) ... -->
</head>
<style>
    @media print {
        .btn-tambah, .btn-cetak, .btn-whatsapp, .href, {
            display: none;
        }
    }
</style>

<a href="" class="btn btn-primary no-print" data-toggle="modal" data-target="#modalTambahRT"><i class="fa fa-plus"></i> Tambah</a>
<a href="#" class="btn btn-info no-print" onclick="exportToPDF()"><i class="fa fa-file-pdf-o"></i> PDF</a>
<a href="#" class="btn btn-success no-print" onclick="exportToExcel()"><i class="fa fa-file-excel-o"></i> Excel</a>


<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>No RT</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $rt): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $rt['no_rt'] ?></td>
                <td><?= $rt['nama_rt'] ?></td>
                <td><?= $rt['alamat'] ?></td>
                <td>
                    <?= $rt['no_hp'] ?> &nbsp;
                    <a href="https://api.whatsapp.com/send?phone=62<?= $rt['no_hp'] ?>/&text=Assalamualaikum%20Sdr/i%20<?= $rt['nama_rt'] ?>%20berikut%20kami%20sampaikan%20data%20akun%20RT%20anda%20untuk%20login%20ke%20web%20aplikasi%0ANama%20Pengguna%20%3A%20<?= $rt['nama_rt'] ?>%0ANo%20HP%20%3A%20<?= $rt['no_hp'] ?>%0AEmail%20%3A%20<?= $rt['email'] ?>%0AKetua%20RT%20%3A%20<?= $rt['no_rt'] ?>%0AAlamat%20%3A%20<?= $rt['alamat'] ?>%0A%0A<?= base_url('') ?>"
                        class="btn btn-success" target="_blank"><i class="fa fa-whatsapp"></i></a>
                    </td>
                    <td><?= $rt['email'] ?></td>
                    <td>
                        <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $rt['id_rt'] ?>"><i class="fa fa-edit"></i></a> &nbsp;
                        <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password<?= $rt['id_rt'] ?>"><i class="fa fa-key"></i></a> 
                    </td>
                </tr>
                <?php $no++; endforeach; ?>
            </tbody>
        </table>

        <!-- Modal tambah data RT-->
        <div class="modal fade" id="modalTambahRT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <form action="<?= base_url('admin/ketua_rt/add') ?>" method="post"
                                enctype="multipart/form-data">
                                <tr>
                                    <th>Nama</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="nama_rt" class="form-control"
                                        placeholder="Nama Ketua RT" required="" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th>No RT</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="number" name="no_rt" class="form-control"
                                        placeholder="No RT" required="" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="alamat" class="form-control" placeholder="Alamat" required="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="number" name="no_hp" class="form-control"
                                        placeholder="No HP" required="" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="email" name="email" class="form-control"
                                        placeholder="Email" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="password" name="password" class="form-control"
                                        placeholder="Password" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                        &nbsp;&nbsp;
                                        <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                    </td>
                                </tr>

                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- Modal edit data rt-->
        <?php foreach($data->result_array() as $rt): ?>
            <div class="modal fade" id="edit<?= $rt['id_rt'] ?>" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-green">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                            </div>
                            <div class="modal-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <form action="<?= base_url('admin/ketua_rt/edit/'.$rt['id_rt']) ?>" method="post"
                                        enctype="multipart/form-data">
                                        <tr>
                                            <th>Nama Ketua RT</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="nama_rt" value="<?= $rt['nama_rt'] ?>"
                                                class="form-control" required="" autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>No RT</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="number" name="no_rt" value="<?= $rt['no_rt'] ?>"
                                                class="form-control" required="" autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea name="alamat" class="form-control" required=""autocomplete="off"><?= $rt['alamat'] ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>No HP</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="number" name="no_hp" value="<?= $rt['no_hp'] ?>"
                                                class="form-control" required="" autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="email" name="email" value="<?= $rt['email'] ?>"
                                                class="form-control" required="" autocomplete="off">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                                &nbsp;&nbsp;
                                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                                &nbsp;&nbsp;
                                                <a href="<?= base_url('admin/ketua_rt/hapus/'.$rt['id_rt']) ?>"
                                                    class="btn btn-danger" onclick="return confirm('Yakin Hapus Data Ini ?')"><i
                                                    class="fa fa-trash"></i> Hapus</a>
                                                </td>
                                            </tr>

                                        </form>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- End Modal -->

                <!-- Modal ganti password  -->
                <?php foreach($data->result_array() as $rt): ?>
                    <div class="modal fade" id="ganti_password<?= $rt['id_rt'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-green">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Ganti Password</h4>
                                    </div>
                                    <div class="modal-body table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <form action="<?= base_url('admin/ketua_rt/ganti_password/'.$rt['id_rt']) ?>" method="POST" enctype="multipart/form-data">
                                                <tr>
                                                    <th class="col-md-12">Nama Kepala Keluarga</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class="form-control"><?= $rt['nama_rt'] ?></p>
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
                    <?php endforeach; ?>
                    <!-- End Modal -->
                    <script>

                        function exportToPDF() {
                            window.location.href = "<?= base_url('admin/ketua_rt/export_pdf') ?>";
                        }

                        function exportToExcel() {
                            window.location.href = "<?= base_url('admin/ketua_rt/export_excel') ?>";
                        }

                    </script>


                    <?php $this->load->view('template/footer'); ?>
