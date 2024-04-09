<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahDatalain"><i class="fa fa-plus"></i>
Tambah</a>
<a href="#" class="btn btn-info no-print" onclick="exportToPDF()"><i class="fa fa-file-pdf-o"></i> PDF</a>
<a href="#" class="btn btn-success no-print" onclick="exportToExcel()"><i class="fa fa-file-excel-o"></i> Excel</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Ketua RT</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $data_lain): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data_lain['nama'] ?></td>
                <td><?= $data_lain['nik'] ?></td>
                <td><?= $data_lain['jenis_kelamin'] ?></td>
                <td><?= $data_lain['alamat'] ?></td>
                <td><?= $data_lain['keterangan'] ?></td>
                <td><?= tgl_indo($data_lain['tanggal']) ?></td>
                <td><?= $data_lain['nama_rt'] ?></td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                    data-target="#edit<?= $data_lain['id_data_lain'] ?>"><i class="fa fa-edit"></i></a> &nbsp;
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal tambah data lain-->
<div class="modal fade" id="modalTambahDatalain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <p style="color: red;">Yang bertanda * wajib diisi</p>
                    <form action="<?= base_url('admin/data_lain/add') ?>" method="post"
                        enctype="multipart/form-data">
                        <tr>
                            <th>Nama *</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="nama" class="form-control" required placeholder="Nama Lengkap" pattern="[A-Za-z ]+" title="Nama harus berupa huruf" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <th>NIK *</th>
                        </tr>
                        <tr>
                            <td><input type="number" name="nik" class="form-control" required placeholder="NIK" pattern="[0-9]+" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin *</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat *</th>
                        </tr>
                        <tr>
                            <td><input name="alamat" class="form-control" required placeholder="Alamat"></td>
                        </tr>
                        <tr>
                            <th>Tanggal *</th>
                        </tr>
                        <tr>
                            <td><input type="date" name="tanggal" class="form-control" required></td>
                        </tr>
                        <tr>
                            <th>Keterangan *</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="keterangan" class="form-control" required>
                                    <option value="">--Pilih Keterangan--</option>
                                    <option value="Pindah">Pindah</option>
                                    <option value="Pendatang">Pendatang</option>
                                    <option value="Meninggal">Meninggal</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Ketua RT *</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="id_rt" class="form-control" required>
                                    <option value="">--Pilih Ketua RT--</option>
                                    <?php 
                                    $rt = $this->db->get('tb_rt')->result_array();
                                    foreach($rt as $pkt): ?>
                                        <option value="<?= $pkt['id_rt'] ?>"> RT
                                            <?= ucfirst($pkt['no_rt']) ?> |
                                            <?= ucfirst($pkt['nama_rt']) ?> |
                                            <?= ucfirst($pkt['alamat']) ?>
                                        </option>
                                    <?php endforeach; ?>

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
    <?php foreach($data->result_array() as $data_lain): ?>
        <div class="modal fade" id="edit<?= $data_lain['id_data_lain'] ?>" tabindex="-1" role="dialog"
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
                                <form action="<?= base_url('admin/data_lain/edit/'.$data_lain['id_data_lain']) ?>" method="post"
                                    enctype="multipart/form-data">
                                    <tr>
                                        <th>Nama *</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="nama" class="form-control" required placeholder="Nama Lengkap" pattern="[A-Za-z ]+" title="Nama harus berupa huruf" autocomplete="off" value="<?= $data_lain['nama'] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NIK *</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="number" name="nik" class="form-control" required placeholder="NIK" pattern="[0-9]+" autocomplete="off" value="<?= $data_lain['nik'] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin *</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="jenis_kelamin" class="form-control" required>
                                                <option value="">--Pilih Jenis Kelamin--</option>
                                                <option value="Laki-laki" <?php if($data_lain['jenis_kelamin'] == 'Laki-laki'){echo 'selected';} ?>>Laki-laki</option>
                                                <option value="Perempuan" <?php if($data_lain['jenis_kelamin'] == 'Perempuan'){echo 'selected';} ?>>Perempuan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat *</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input name="alamat" class="form-control" required placeholder="Alamat" value="<?= $data_lain['alamat'] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="date" name="tanggal" class="form-control" required value="<?= $data_lain['tanggal'] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="keterangan" class="form-control" required>
                                                <option value="Pindah" <?php if($data_lain['keterangan'] == 'Pindah'){echo 'selected';} ?>>Pindah</option>
                                                <option value="Pendatang" <?php if($data_lain['keterangan'] == 'Pendatang'){echo 'selected';} ?>>Pendatang</option>
                                                <option value="Meninggal" <?php if($data_lain['keterangan'] == 'Meninggal'){echo 'selected';} ?>>Meninggal</option>
                                                <option value="Lainnya" <?php if($data_lain['keterangan'] == 'Lainnya'){echo 'selected';} ?>>Lainnya</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ketua RT *</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="id_rt" class="form-control" required>
                                                <?php 
                                                $rt = $this->db->get('tb_rt')->result_array();
                                                foreach($rt as $pkt): ?>
                                                    <option value="<?= $pkt['id_rt'] ?>" <?php if($data_lain['id_rt'] == $pkt['id_rt']){echo 'selected';} ?>> RT
                                                        <?= ucfirst($pkt['no_rt']) ?> |
                                                        <?= ucfirst($pkt['nama_rt']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                                &nbsp;&nbsp;
                                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                                &nbsp;&nbsp;
                                                <a href="<?= base_url('admin/data_lain/hapus/'.$data_lain['id_data_lain']) ?>"
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

                <script>
                    function exportToPDF() {
                        window.location.href = "<?= base_url('admin/data_lain/export_pdf/') ?>";
                    }

                    function exportToExcel() {
                        window.location.href = "<?= base_url('admin/data_lain/export_excel/') ?>";
                    }
                </script>


                <?php $this->load->view('template/footer'); ?>
                <?php 
//membuat format tanggal indonesia
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
                  'Desember'
              );
                 $pecahkan = explode('-', $tanggal);
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
                 return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
             }
         ?>