<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahInformasi"><i class="fa fa-plus"></i>
    Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Informasi</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $informasi): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $informasi['informasi'] ?></td>
                <td>
                    <a href="<?= base_url('themes/file_informasi/'.$informasi['berkas']) ?>"
                        target="_blank"><?= $informasi['berkas'] ?></a> <br>
                    <a href="" class="btn btn-info" data-toggle="modal"
                        data-target="#editFile<?= $informasi['id_informasi'] ?>"><i class="fa fa-upload"></i></a>
                </td>

                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $informasi['id_informasi'] ?>"><i class="fa fa-edit"></i>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data informasi-->
    <div class="modal fade" id="modalTambahInformasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form action="<?= base_url('admin/informasi/add') ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th>Jenis Informasi</th>
                            </tr>
                            <tr>
                                <td>
                                <textarea class="form-control ckeditor" name="informasi" id="informasi" rows="3"></textarea>
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

    <!-- Modal edit data informasi-->
    <?php foreach($data->result_array() as $informasi): ?>
    <div class="modal fade" id="edit<?= $informasi['id_informasi'] ?>" tabindex="-1" role="dialog"
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
                        <form action="<?= base_url('admin/informasi/edit/'.$informasi['id_informasi']) ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th class="col-md-2">ID Informasi</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_informasi" value="<?= $informasi['id_informasi'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Informasi</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control ckeditor" name="informasi" id="informasi" rows="3"><?= $informasi['informasi'] ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                    <a href="<?= base_url('admin/informasi/hapus/'.$informasi['id_informasi']) ?>"
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

    <!-- Modal edit File informasi-->
    <?php foreach($data->result_array() as $informasi): ?>
    <div class="modal fade" id="editFile<?= $informasi['id_informasi'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload File <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form action="<?= base_url('admin/informasi/file/'.$informasi['id_informasi']) ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th class="col-md-2">ID Informasi</th>
                            </tr>
                            <tr>
                                <td>
                                    <p class="form-control"><?= $informasi['id_informasi'] ?> |
                                        <?= $informasi['informasi'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>Upload file</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="berkas" value="<?= $informasi['berkas'] ?>"
                                        class="form-control" readonly>
                                    <input type="file" name="berkas" value="<?= $informasi['berkas'] ?>"
                                        class="form-control" required="">
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
    <?php endforeach; ?>
    <!-- End Modal -->

<?php $this->load->view('template/footer'); ?>

<script type="text/javascript" src="<?php echo base_url('themes/ckeditor/ckeditor.js')?>"></script>