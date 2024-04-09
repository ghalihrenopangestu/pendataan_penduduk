<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahAdmin"><i class="fa fa-plus"></i>
    Tambah Admin</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $admin): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $admin['nama'] ?></td>
                <td><?= $admin['email'] ?></td>
                <td><?= ucfirst($admin['level']) ?></td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $admin['id_admin'] ?>"><i class="fa fa-edit"></i> </a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah Admin-->
    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form action="<?= base_url('admin/user_admin/tambah') ?>" method="post">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nama" class="form-control" required=""></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="email" class="form-control" required=""></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                </tr>
                                <tr>
                                    <td><input type="password" name="password" class="form-control" required=""></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <input type="submit" name="kirim" value="Entri Data" class="btn btn-primary">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal edit admin-->
    <?php foreach($data->result_array() as $admin): ?>
    <div class="modal fade" id="edit<?= $admin['id_admin'] ?>" tabindex="-1" role="dialog"
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
                        <form action="<?= base_url('admin/user_admin/edit/'.$admin['id_admin']) ?>" method="post">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <td><input type="text" name="nama" class="form-control"
                                            value="<?= $admin['nama'] ?>" required=""></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><input type="text" name="email" class="form-control"
                                            value="<?= $admin['email'] ?>" required=""></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td><input type="password" name="password" class="form-control" value="<?= $admin['password'] ?>"
                                            required=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Kembali</button> &nbsp;&nbsp;
                                        <input type="submit" name="kirim" value="Entri Data" class="btn btn-primary"> &nbsp;&nbsp;
                                        <a href="<?= base_url('admin/user_admin/hapus/'.$admin['id_admin']) ?>"
                                        class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->



    <?php $this->load->view('template/footer'); ?>