<?php $this->load->view('template/header'); ?>


<?php 
if($aksi == "detail"):
    ?>
    <?= $this->session->flashdata('pesan') ?>

    <!-- menampilkan setengah halaman -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="col-lg-3">Nama KK</th>
                        <td><?= $nama_kk ?></td>
                    </tr>
                    <tr>
                        <th>No KK</th>
                        <td><?= $no_kk ?></td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>
                            <?= $no_hp ?>
                            <a href="https://api.whatsapp.com/send?phone=<?= $no_hp ?>" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-whatsapp"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $alamat ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- menampilkan setengah halaman -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Foto KK</th>
                        <td><?php if($foto_kk == ''): ?>
                        <img src="<?= base_url('themes/admin/no_images.png') ?>" width="50px">
                        <a href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#uploadKK<?= $id_kk ?>" title="Upload Foto KK"><i class="fa fa-upload"></i></a>
                    <?php else: ?>
                        <a href="<?= base_url('themes/foto_kk/'.$foto_kk) ?>" target="_blank">
                            <img src="<?= base_url('themes/foto_kk/'.$foto_kk) ?>" width="50%">
                            <a href="<?= base_url('admin/kepala_keluarga/hapusimage/'.$id_kk) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus foto ini?')" title="Hapus Foto KK untuk memperbarui"><i class="fa fa-trash"></i></a>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php if($level == 'kepala_kk'): ?>
                <span>Kepala Keluarga</span>
            <?php endif; ?>
        </tr>
        <tr>
            <th>Aksi</th>
            <td>
                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editKK<?= $id_kk ?>"><i class="fa fa-edit"></i></a> &nbsp;
                <a href="<?= base_url('admin/kepala_keluarga/hapus/'.$id_kk) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    </table>
</div>
</div>
</div>

<!-- Modal Edit KK -->
<div class="modal fade" id="editKK<?= $id_kk ?>" tabindex="-1" role="dialog"
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
                        <form action="<?= base_url('admin/kepala_keluarga/edit/'.$id_kk) ?>" method="post" enctype="multipart/form-data">
                            <tr>
                                <th>Nama Kepala Keluarga</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_kk" value="<?= $nama_kk ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <th>No KK</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_kk" value="<?= $no_kk ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <th>No HP
                                    <small>(awali 62)</small> *
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp" value="<?= $no_hp ?>" class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="alamat" value="<?= $alamat ?>" class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Ketua RT</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_rt" class="form-control" required="">
                                        <?php foreach($rt as $pkt): ?>
                                            <option value="<?= $pkt['id_rt'] ?>"
                                                <?php if($pkt['id_rt'] == $id_rt){echo "selected";} ?>> RT
                                                <?= ucfirst($pkt['no_rt']) ?> |
                                                <?= ucfirst($pkt['nama_rt']) ?> |
                                                <?= ucfirst($pkt['alamat']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="" class="btn btn-default" data-dismiss="modal">Kembali</a> &nbsp; &nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload Foto KK -->
    <div class="modal fade" id="uploadKK<?= $id_kk ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Upload KK <?= $judul ?></h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <form action="<?= base_url('admin/kepala_keluarga/upload_fotoKK/'.$id_kk) ?>" method="post" enctype="multipart/form-data">
                                <tr>
                                    <th>Kepala Keluarga</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="nama_kk" class="form-control" value="<?= $nama_kk ?>" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto KK</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="file" name="foto_kk" class="form-control" onchange="previewKK()" id="kk">
                                        <img id="preview_kk" alt="image preview" width="50%" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="" class="btn btn-default" data-dismiss="modal">Kembali</a> &nbsp; &nbsp;
                                        <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- anggota keluarga -->
        <div class="col-lg-12">
          <h4 class="text-bold">Anggota Keluarga
            <a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalTambahAnggota"><i class="fa fa-plus"></i> Tambah</a>
            <a href="<?= base_url('kepala_keluarga/export_pdf_kk/') . $id_kk ?>" class="btn btn-info btn-xs export-pdf-btn"><i class="fa fa-file-pdf"></i> PDF</a>
            <!-- Tombol Excel -->
            <a href="<?= base_url('kepala_keluarga/export_excel_kk/') . $id_kk ?>" class="btn btn-success btn-xs"><i class="fa fa-file-excel"></i> Excel</a>
        </h4>
        <div class="table-responsive">
            <table class="table table-bordered  table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No HP</th>
                        <th>Tanggal Lahir</th>
                        <th>Usia</th>
                        <th>Tempat Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Hubungan</th>
                        <th>Status Perkawinan</th>
                        <th>Kewarganegaraan</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data->result_array() as $kk): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $kk['nama'] ?></td>
                        <td><?= $kk['nik'] ?></td>
                        <td>
                            <?php if (isset($kk['no_hp_anggota'])) {
                                echo $kk['no_hp_anggota'];
                            } else {
                                echo "Tidak ada nomor HP anggota.";
                            } ?>
                        </td>

                        <td><?= tgl_indo($kk['tgl_lahir']) ?></td>
                        <td><?= hitung_usia($kk['tgl_lahir']) ?></td>
                        <td>
                            <?php if (isset($kk['tempat_lahir'])) {
                                echo $kk['tempat_lahir'];
                            } else {
                                echo "Tempat lahir tidak tersedia.";
                            } ?>
                        </td>

                        <td><?= $kk['jenis_kelamin'] ?></td>
                        <td><?= $kk['agama'] ?></td>
                        <td><?= $kk['pendidikan'] ?></td>
                        <td><?= $kk['pekerjaan'] ?></td>
                        <td><?= $kk['hubungan'] ?></td>
                        <td>
                            <?php if (isset($kk['perkawinan'])) {
                                echo $kk['perkawinan'];
                            } else {
                                echo "Status perkawinan tidak tersedia.";
                            } ?>
                        </td>

                        <td>
                            <?php if (isset($kk['kewarganegaraan'])) {
                                echo $kk['kewarganegaraan'];
                            } else {
                                echo "Kewarganegaraan tidak tersedia.";
                            } ?>
                        </td>

                        <td>
                            <?php if (isset($kk['nama_ayah'])) {
                                echo $kk['nama_ayah'];
                            } else {
                                echo "Nama Ayah tidak tersedia.";
                            } ?>
                        </td>

                        <td>
                            <?php if (isset($kk['nama_ibu'])) {
                                echo $kk['nama_ibu'];
                            } else {
                                echo "Nama Ibu tidak tersedia.";
                            } ?>
                        </td>

                        <td>
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editAnggotaKK<?= $kk['id_anggota'] ?>"><i class="fa fa-edit"></i></a> &nbsp;
                            <a href="<?= base_url('admin/anggota/hapus/'.$kk['id_anggota']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php $no++; endforeach; ?> 
                </tbody>
            </table>
        </div>
        <a href="<?= base_url('admin/kepala_keluarga') ?>" class="btn btn-default">Kembali</a>
    </div>

    <!-- Modal Tambah Anggota -->
    <div class="modal fade" id="modalTambahAnggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <p style="color: red;">Yang bertanda * wajib diisi</p>
                        <form action="<?= base_url('admin/anggota/add') ?>" method="post" enctype="multipart/form-data">
                            <tr>
                                <th>No KK *</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" name="id_rt" value="<?= $id_rt ?>">
                                    <input type="hidden" name="id_kk" value="<?= $id_kk ?>">
                                    <p class="form-control"> <?= $no_kk ?> </p>
                                </td>
                            </tr>
                            <tr>
                                <th>NIK *</th>
                            </tr>
                            <tr>
                                <td><input type="number" name="nik" class="form-control" required placeholder="NIK" pattern="[0-9]+" maxlength="16" minlength="16" oninvalid="this.setCustomValidity('NIK harus 16 digit angka')" oninput="setCustomValidity('')" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Nama *</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="nama" class="form-control" required placeholder="Nama Lengkap" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp_anggota" id="no_hp_anggota" class="form-control" placeholder="No HP" pattern="[0-9]+" maxlength="13" minlength="10" oninvalid="this.setCustomValidity('No HP harus 10-13 digit angka')" oninput="setCustomValidity('')" autocomplete="off">
                                    <!-- mengambil no hp dari tb_kk jika nomor ingin sama menggunakan script button dibawah -->
                                    <small>boleh kosong atau jika ingin sama dengan no hp KK klik tombol dibawah</small><br>
                                    <button type="button" class="btn btn-info btn-xs" onclick="copyNoHP()">Copy No HP KK</button>
                                </td>
                                <script>
                                    function copyNoHP() {
                                        var copyText = document.getElementById("no_hp_anggota");
                                        copyText.value = "<?= $no_hp ?>";
                                    }
                                </script>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir *</th>
                            </tr>
                            <tr>
                                <td><input type="date" name="tgl_lahir" class="form-control" value="<?= date('Y-m-d') ?>" required></td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir *</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="tempat_lahir" class="form-control" required placeholder="Tempat Lahir" pattern="[A-Za-z !@#$%^&*()_+]{3,}" oninvalid="this.setCustomValidity('Tempat Lahir minimal 3 huruf')" oninput="setCustomValidity('')" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin *</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Agama *</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="agama" class="form-control" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Pendidikan *</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="pendidikan" class="form-control" required>
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Pekerjaan *</th>
                            </tr>
                            <tr>
                                <td>
                                    <div id="modal-default">
                                        <select name="pekerjaan" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih Pekerjaan --</option>
                                            <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                            <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                            <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                            <option value="Pensiunan">Pensiunan</option>
                                            <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                            <option value="Tentara Nasional Indonesia">Tentara Nasional Indonesia</option>
                                            <option value="Kepolisian RI">Kepolisian RI</option>
                                            <option value="Perdagangan">Perdagangan</option>
                                            <option value="Petani/Pekebun">Petani/Pekebun</option>
                                            <option value="Peternak">Peternak</option>
                                            <option value="Nelayan/Perikanan">Nelayan/Perikanan</option>
                                            <option value="Industri">Industri</option>
                                            <option value="Konstruksi">Konstruksi</option>
                                            <option value="Transportasi">Transportasi</option>
                                            <option value="Karyawan Swasta">Karyawan Swasta</option>
                                            <option value="Karyawan BUMN">Karyawan BUMN</option>
                                            <option value="Karyawan BUMD">Karyawan BUMD</option>
                                            <option value="Karyawan Honorer">Karyawan Honorer</option>
                                            <option value="Buruh Harian Lepas">Buruh Harian Lepas</option>
                                            <option value="Buruh Tani/Perkebunan">Buruh Tani/Perkebunan</option>
                                            <option value="Buruh Nelayan/Perikanan">Buruh Nelayan/Perikanan</option>
                                            <option value="Buruh Peternakan">Buruh Peternakan</option>
                                            <option value="Pembantu Rumah Tangga">Pembantu Rumah Tangga</option>
                                            <option value="Tukang Cukur">Tukang Cukur</option>
                                            <option value="Tukang Listrik">Tukang Listrik</option>
                                            <option value="Tukang Batu">Tukang Batu</option>
                                            <option value="Tukang Kayu">Tukang Kayu</option>
                                            <option value="Tukang Sol Sepatu">Tukang Sol Sepatu</option>
                                            <option value="Tukang Las/Pandai Besi">Tukang Las/Pandai Besi</option>
                                            <option value="Tukang Jahit">Tukang Jahit</option>
                                            <option value="Tukang Gigi">Tukang Gigi</option>
                                            <option value="Penata Rambut">Penata Rambut</option>
                                            <option value="Penata Rias">Penata Rias</option>
                                            <option value="Penata Busana">Penata Busana</option>
                                            <option value="Mekanik">Mekanik</option>
                                            <option value="Seniman">Seniman</option>
                                            <option value="Tabib">Tabib</option>
                                            <option value="Paraji">Paraji</option>
                                            <option value="Perancang Busana">Perancang Busana</option>
                                            <option value="Penterjemah">Penterjemah</option>
                                            <option value="Imam Masjid">Imam Masjid</option>
                                            <option value="Pendeta">Pendeta</option>
                                            <option value="Pastur">Pastur</option>
                                            <option value="Wartawan">Wartawan</option>
                                            <option value="Ustadz/Mubaligh">Ustadz/Mubaligh</option>
                                            <option value="Juru Masak">Juru Masak</option>
                                            <option value="Promotor Acara">Promotor Acara</option>
                                            <option value="Anggota DPR-RI">Anggota DPR-RI</option>
                                            <option value="Anggota DPD">Anggota DPD</option>
                                            <option value="Anggota BPK">Anggota BPK</option>
                                            <option value="Presiden">Presiden</option>
                                            <option value="Wakil Presiden">Wakil Presiden</option>
                                            <option value="Anggota Mahkamah Konstitusi">Anggota Mahkamah Konstitusi</option>
                                            <option value="Anggota Kabinet/Kementerian">Anggota Kabinet/Kementerian</option>
                                            <option value="Duta Besar">Duta Besar</option>
                                            <option value="Gubernur">Gubernur</option>
                                            <option value="Wakil Gubernur">Wakil Gubernur</option>
                                            <option value="Bupati">Bupati</option>
                                            <option value="Wakil Bupati">Wakil Bupati</option>
                                            <option value="Walikota">Walikota</option>
                                            <option value="Wakil Walikota">Wakil Walikota</option>
                                            <option value="Anggota DPRD Propinsi">Anggota DPRD Propinsi</option>
                                            <option value="Anggota DPRD Kabupaten/Kota">Anggota DPRD Kabupaten/Kota</option>
                                            <option value="Dosen">Dosen</option>
                                            <option value="Guru">Guru</option>
                                            <option value="Pilot">Pilot</option>
                                            <option value="Pengacara">Pengacara</option>
                                            <option value="Notaris">Notaris</option>
                                            <option value="Arsitek">Arsitek</option>
                                            <option value="Akuntan">Akuntan</option>
                                            <option value="Konsultan">Konsultan</option>
                                            <option value="Dokter">Dokter</option>
                                            <option value="Bidan">Bidan</option>
                                            <option value="Perawat">Perawat</option>
                                            <option value="Apoteker">Apoteker</option>
                                            <option value="Psikiater/Psikolog">Psikiater/Psikolog</option>
                                            <option value="Penyiar Televisi">Penyiar Televisi</option>
                                            <option value="Penyiar Radio">Penyiar Radio</option>
                                            <option value="Pelaut">Pelaut</option>
                                            <option value="Peneliti">Peneliti</option>
                                            <option value="Sopir">Sopir</option>
                                            <option value="Pialang">Pialang</option>
                                            <option value="Paranormal">Paranormal</option>
                                            <option value="Pedagang">Pedagang</option>
                                            <option value="Perangkat Desa">Perangkat Desa</option>
                                            <option value="Kepala Desa">Kepala Desa</option>
                                            <option value="Biarawati">Biarawati</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Hubungan Keluarga *</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="hubungan" class="form-control" required>
                                        <option value="">-- Pilih Hubungan Keluarga --</option>
                                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Kakak">Kakak</option>
                                        <option value="Adik">Adik</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan *</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="perkawinan" class="form-control" required>
                                        <option value="">-- Pilih Status Perkawinan --</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan *</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="kewarganegaraan" class="form-control" required>
                                        <option value="">-- Pilih Kewarganegaraan --</option>
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama ayah</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="nama_ayah" class="form-control" placeholder="Nama ayah" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Nama ibu</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="nama_ibu" class="form-control" placeholder="Nama ibu" autocomplete="off"></td>
                            </tr>
                        </table>
                        <a href="" class="btn btn-default" data-dismiss="modal">Kembali</a> &nbsp; &nbsp;
                        <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Anggota KK -->
<?php $no=1; foreach($data->result_array() as $kk): ?>
<div class="modal fade" id="editAnggotaKK<?= $kk['id_anggota'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form action="<?= base_url('admin/anggota/edit/'.$kk['id_anggota']) ?>" method="post" enctype="multipart/form-data">
                            <tr>
                                <th>Anggota RT</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_rt" class="form-control" required="">
                                        <?php foreach($rt as $pkt): ?>
                                            <option value="<?= $pkt['id_rt'] ?>"
                                                <?php if($pkt['id_rt'] == $id_rt){echo "selected";} ?>> RT
                                                <?= ucfirst($pkt['no_rt']) ?> |
                                                <?= ucfirst($pkt['nama_rt']) ?> |
                                                <?= ucfirst($pkt['alamat']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Kepala Keluarga</th>
                            </tr>
                            <tr>
                                <td>
                                 <select name="id_kk" class="form-control" required="">
                                    <?php foreach($ukk as $pkt): ?>
                                        <option value="<?= $pkt['id_kk'] ?>"
                                            <?php if($pkt['id_kk'] == $id_kk){echo "selected";} ?>>
                                            <?= ucfirst($pkt['no_kk']) ?> |
                                            <?= ucfirst($pkt['nama_kk']) ?> |
                                            <?= ucfirst($pkt['alamat']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <th>Nama Anggota Keluarga</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nama" value="<?= $kk['nama'] ?>" class="form-control" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="nik" value="<?= $kk['nik'] ?>" class="form-control" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <th>No HP
                                <small>(awali 62)</small>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="no_hp_anggota" value="<?= $kk['no_hp_anggota'] ?>" class="form-control" onclick="copyNoHP()" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="jenis_kelamin" class="form-control" required="">
                                    <option value="Laki-laki" <?php if($kk['jenis_kelamin'] == 'Laki-laki'){echo "selected";} ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if($kk['jenis_kelamin'] == 'Perempuan'){echo "selected";} ?>>Perempuan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Tgl Lahir</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" name="tgl_lahir" value="<?= $kk['tgl_lahir'] ?>" class="form-control" required="">
                            </td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="tempat_lahir" value="<?= $kk['tempat_lahir'] ?>" class="form-control" autocomplete="off" required="">
                            </td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="agama" class="form-control" required="">
                                    <option value="Islam" <?php if($kk['agama'] == 'Islam'){echo "selected";} ?>>Islam</option>
                                    <option value="Kristen" <?php if($kk['agama'] == 'Kristen'){echo "selected";} ?>>Kristen</option>
                                    <option value="Katholik" <?php if($kk['agama'] == 'Katholik'){echo "selected";} ?>>Katholik</option>
                                    <option value="Hindu" <?php if($kk['agama'] == 'Hindu'){echo "selected";} ?>>Hindu</option>
                                    <option value="Budha" <?php if($kk['agama'] == 'Budha'){echo "selected";} ?>>Budha</option>
                                    <option value="Konghucu" <?php if($kk['agama'] == 'Konghucu'){echo "selected";} ?>>Konghucu</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Pendidikan</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="pendidikan" class="form-control" required="">
                                    <option value="Tidak Sekolah" <?php if($kk['pendidikan'] == 'Tidak Sekolah'){echo "selected";} ?>>Tidak Sekolah</option>
                                    <option value="SD" <?php if($kk['pendidikan'] == 'SD'){echo "selected";} ?>>SD</option>
                                    <option value="SMP" <?php if($kk['pendidikan'] == 'SMP'){echo "selected";} ?>>SMP</option>
                                    <option value="SMA" <?php if($kk['pendidikan'] == 'SMA'){echo "selected";} ?>>SMA</option>
                                    <option value="D1" <?php if($kk['pendidikan'] == 'D1'){echo "selected";} ?>>D1</option>
                                    <option value="D2" <?php if($kk['pendidikan'] == 'D2'){echo "selected";} ?>>D2</option>
                                    <option value="D3" <?php if($kk['pendidikan'] == 'D3'){echo "selected";} ?>>D3</option>
                                    <option value="D4" <?php if($kk['pendidikan'] == 'D4'){echo "selected";} ?>>D4</option>
                                    <option value="S1" <?php if($kk['pendidikan'] == 'S1'){echo "selected";} ?>>S1</option>
                                    <option value="S2" <?php if($kk['pendidikan'] == 'S2'){echo "selected";} ?>>S2</option>
                                    <option value="S3" <?php if($kk['pendidikan'] == 'S3'){echo "selected";} ?>>S3</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="pekerjaan" class="form-control" required="">
                                    <option value="Belum/Tidak Bekerja" <?php if($kk['pekerjaan'] == 'Belum/Tidak Bekerja'){echo "selected";} ?>>Belum/Tidak Bekerja</option>
                                    <option value="Pelajar/Mahasiswa" <?php if($kk['pekerjaan'] == 'Pelajar/Mahasiswa'){echo "selected";} ?>>Pelajar/Mahasiswa</option>
                                    <option value="Mengurus Rumah Tangga" <?php if($kk['pekerjaan'] == 'Mengurus Rumah Tangga'){echo "selected";} ?>>Mengurus Rumah Tangga</option>
                                    <option value="Pensiunan" <?php if($kk['pekerjaan'] == 'Pensiunan'){echo "selected";} ?>>Pensiunan</option>
                                    <option value="Pegawai Negeri Sipil" <?php if($kk['pekerjaan'] == 'Pegawai Negeri Sipil'){echo "selected";} ?>>Pegawai Negeri Sipil</option>
                                    <option value="Tentara Nasional Indonesia" <?php if($kk['pekerjaan'] == 'Tentara Nasional Indonesia'){echo "selected";} ?>>Tentara Nasional Indonesia</option>
                                    <option value="Kepolisian RI" <?php if($kk['pekerjaan'] == 'Kepolisian RI'){echo "selected";} ?>>Kepolisian RI</option>
                                    <option value="Perdagangan" <?php if($kk['pekerjaan'] == 'Perdagangan'){echo "selected";} ?>>Perdagangan</option>
                                    <option value="Petani/Pekebun" <?php if($kk['pekerjaan'] == 'Petani/Pekebun'){echo "selected";} ?>>Petani/Pekebun</option>
                                    <option value="Peternak" <?php if($kk['pekerjaan'] == 'Peternak'){echo "selected";} ?>>Peternak</option>
                                    <option value="Nelayan/Perikanan" <?php if($kk['pekerjaan'] == 'Nelayan/Perikanan'){echo "selected";} ?>>Nelayan/Perikanan</option>
                                    <option value="Industri" <?php if($kk['pekerjaan'] == 'Industri'){echo "selected";} ?>>Industri</option>
                                    <option value="Konstruksi" <?php if($kk['pekerjaan'] == 'Konstruksi'){echo "selected";} ?>>Konstruksi</option>
                                    <option value="Transportasi" <?php if($kk['pekerjaan'] == 'Transportasi'){echo "selected";} ?>>Transportasi</option>
                                    <option value="Karyawan Swasta" <?php if($kk['pekerjaan'] == 'Karyawan Swasta'){echo "selected";} ?>>Karyawan Swasta</option>
                                    <option value="Karyawan BUMN" <?php if($kk['pekerjaan'] == 'Karyawan BUMN'){echo "selected";} ?>>Karyawan BUMN</option>
                                    <option value="Karyawan BUMD" <?php if($kk['pekerjaan'] == 'Karyawan BUMD'){echo "selected";} ?>>Karyawan BUMD</option>
                                    <option value="Karyawan Honorer" <?php if($kk['pekerjaan'] == 'Karyawan Honorer'){echo "selected";} ?>>Karyawan Honorer</option>
                                    <option value="Buruh Harian Lepas" <?php if($kk['pekerjaan'] == 'Buruh Harian Lepas'){echo "selected";} ?>>Buruh Harian Lepas</option>
                                    <option value="Buruh Tani/Perkebunan" <?php if($kk['pekerjaan'] == 'Buruh Tani/Perkebunan'){echo "selected";} ?>>Buruh Tani/Perkebunan</option>
                                    <option value="Buruh Nelayan/Perikanan" <?php if($kk['pekerjaan'] == 'Buruh Nelayan/Perikanan'){echo "selected";} ?>>Buruh Nelayan/Perikanan</option>
                                    <option value="Buruh Peternakan" <?php if($kk['pekerjaan'] == 'Buruh Peternakan'){echo "selected";} ?>>Buruh Peternakan</option>
                                    <option value="Pembantu Rumah Tangga" <?php if($kk['pekerjaan'] == 'Pembantu Rumah Tangga'){echo "selected";} ?>>Pembantu Rumah Tangga</option>
                                    <option value="Tukang Cukur" <?php if($kk['pekerjaan'] == 'Tukang Cukur'){echo "selected";} ?>>Tukang Cukur</option>
                                    <option value="Tukang Listrik" <?php if($kk['pekerjaan'] == 'Tukang Listrik'){echo "selected";} ?>>Tukang Listrik</option>
                                    <option value="Tukang Batu" <?php if($kk['pekerjaan'] == 'Tukang Batu'){echo "selected";} ?>>Tukang Batu</option>
                                    <option value="Tukang Kayu" <?php if($kk['pekerjaan'] == 'Tukang Kayu'){echo "selected";} ?>>Tukang Kayu</option>
                                    <option value="Tukang Sol Sepatu" <?php if($kk['pekerjaan'] == 'Tukang Sol Sepatu'){echo "selected";} ?>>Tukang Sol Sepatu</option>
                                    <option value="Tukang Las/Pandai Besi" <?php if($kk['pekerjaan'] == 'Tukang Las/Pandai Besi'){echo "selected";} ?>>Tukang Las/Pandai Besi</option>
                                    <option value="Tukang Jahit" <?php if($kk['pekerjaan'] == 'Tukang Jahit'){echo "selected";} ?>>Tukang Jahit</option>
                                    <option value="Tukang Gigi" <?php if($kk['pekerjaan'] == 'Tukang Gigi'){echo "selected";} ?>>Tukang Gigi</option>
                                    <option value="Penata Rambut" <?php if($kk['pekerjaan'] == 'Penata Rambut'){echo "selected";} ?>>Penata Rambut</option>
                                    <option value="Penata Rias" <?php if($kk['pekerjaan'] == 'Penata Rias'){echo "selected";} ?>>Penata Rias</option>
                                    <option value="Penata Busana" <?php if($kk['pekerjaan'] == 'Penata Busana'){echo "selected";} ?>>Penata Busana</option>
                                    <option value="Mekanik" <?php if($kk['pekerjaan'] == 'Mekanik'){echo "selected";} ?>>Mekanik</option>
                                    <option value="Seniman" <?php if($kk['pekerjaan'] == 'Seniman'){echo "selected";} ?>>Seniman</option>
                                    <option value="Tabib" <?php if($kk['pekerjaan'] == 'Tabib'){echo "selected";} ?>>Tabib</option>
                                    <option value="Paraji" <?php if($kk['pekerjaan'] == 'Paraji'){echo "selected";} ?>>Paraji</option>
                                    <option value="Perancang Busana" <?php if($kk['pekerjaan'] == 'Perancang Busana'){echo "selected";} ?>>Perancang Busana</option>
                                    <option value="Penterjemah" <?php if($kk['pekerjaan'] == 'Penterjemah'){echo "selected";} ?>>Penterjemah</option>
                                    <option value="Imam Masjid" <?php if($kk['pekerjaan'] == 'Imam Masjid'){echo "selected";} ?>>Imam Masjid</option>
                                    <option value="Pendeta" <?php if($kk['pekerjaan'] == 'Pendeta'){echo "selected";} ?>>Pendeta</option>
                                    <option value="Pastur" <?php if($kk['pekerjaan'] == 'Pastur'){echo "selected";} ?>>Pastur</option>
                                    <option value="Wartawan" <?php if($kk['pekerjaan'] == 'Wartawan'){echo "selected";} ?>>Wartawan</option>
                                    <option value="Ustadz/Mubaligh" <?php if($kk['pekerjaan'] == 'Ustadz/Mubaligh'){echo "selected";} ?>>Ustadz/Mubaligh</option>
                                    <option value="Juru Masak" <?php if($kk['pekerjaan'] == 'Juru Masak'){echo "selected";} ?>>Juru Masak</option>
                                    <option value="Promotor Acara" <?php if($kk['pekerjaan'] == 'Promotor Acara'){echo "selected";} ?>>Promotor Acara</option>
                                    <option value="Anggota DPR-RI" <?php if($kk['pekerjaan'] == 'Anggota DPR-RI'){echo "selected";} ?>>Anggota DPR-RI</option>
                                    <option value="Anggota DPD" <?php if($kk['pekerjaan'] == 'Anggota DPD'){echo "selected";} ?>>Anggota DPD</option>
                                    <option value="Anggota BPK" <?php if($kk['pekerjaan'] == 'Anggota BPK'){echo "selected";} ?>>Anggota BPK</option>
                                    <option value="Presiden" <?php if($kk['pekerjaan'] == 'Presiden'){echo "selected";} ?>>Presiden</option>
                                    <option value="Wakil Presiden" <?php if($kk['pekerjaan'] == 'Wakil Presiden'){echo "selected";} ?>>Wakil Presiden</option>
                                    <option value="Anggota Mahkamah Konstitusi" <?php if($kk['pekerjaan'] == 'Anggota Mahkamah Konstitusi'){echo "selected";} ?>>Anggota Mahkamah Konstitusi</option>
                                    <option value="Anggota Kabinet/Kementerian" <?php if($kk['pekerjaan'] == 'Anggota Kabinet/Kementerian'){echo "selected";} ?>>Anggota Kabinet/Kementerian</option>
                                    <option value="Duta Besar" <?php if($kk['pekerjaan'] == 'Duta Besar'){echo "selected";} ?>>Duta Besar</option>
                                    <option value="Gubernur" <?php if($kk['pekerjaan'] == 'Gubernur'){echo "selected";} ?>>Gubernur</option>
                                    <option value="Wakil Gubernur" <?php if($kk['pekerjaan'] == 'Wakil Gubernur'){echo "selected";} ?>>Wakil Gubernur</option>
                                    <option value="Bupati" <?php if($kk['pekerjaan'] == 'Bupati'){echo "selected";} ?>>Bupati</option>
                                    <option value="Wakil Bupati" <?php if($kk['pekerjaan'] == 'Wakil Bupati'){echo "selected";} ?>>Wakil Bupati</option>
                                    <option value="Walikota" <?php if($kk['pekerjaan'] == 'Walikota'){echo "selected";} ?>>Walikota</option>
                                    <option value="Wakil Walikota" <?php if($kk['pekerjaan'] == 'Wakil Walikota'){echo "selected";} ?>>Wakil Walikota</option>
                                    <option value="Anggota DPRD Propinsi" <?php if($kk['pekerjaan'] == 'Anggota DPRD Propinsi'){echo "selected";} ?>>Anggota DPRD Propinsi</option>
                                    <option value="Anggota DPRD Kabupaten/Kota" <?php if($kk['pekerjaan'] == 'Anggota DPRD Kabupaten/Kota'){echo "selected";} ?>>Anggota DPRD Kabupaten/Kota</option>
                                    <option value="Dosen" <?php if($kk['pekerjaan'] == 'Dosen'){echo "selected";} ?>>Dosen</option>
                                    <option value="Guru" <?php if($kk['pekerjaan'] == 'Guru'){echo "selected";} ?>>Guru</option>
                                    <option value="Pilot" <?php if($kk['pekerjaan'] == 'Pilot'){echo "selected";} ?>>Pilot</option>
                                    <option value="Pengacara" <?php if($kk['pekerjaan'] == 'Pengacara'){echo "selected";} ?>>Pengacara</option>
                                    <option value="Notaris" <?php if($kk['pekerjaan'] == 'Notaris'){echo "selected";} ?>>Notaris</option>
                                    <option value="Arsitek" <?php if($kk['pekerjaan'] == 'Arsitek'){echo "selected";} ?>>Arsitek</option>
                                    <option value="Akuntan" <?php if($kk['pekerjaan'] == 'Akuntan'){echo "selected";} ?>>Akuntan</option>
                                    <option value="Konsultan" <?php if($kk['pekerjaan'] == 'Konsultan'){echo "selected";} ?>>Konsultan</option>
                                    <option value="Dokter" <?php if($kk['pekerjaan'] == 'Dokter'){echo "selected";} ?>>Dokter</option>
                                    <option value="Bidan" <?php if($kk['pekerjaan'] == 'Bidan'){echo "selected";} ?>>Bidan</option>
                                    <option value="Perawat" <?php if($kk['pekerjaan'] == 'Perawat'){echo "selected";} ?>>Perawat</option>
                                    <option value="Apoteker" <?php if($kk['pekerjaan'] == 'Apoteker'){echo "selected";} ?>>Apoteker</option>
                                    <option value="Psikiater/Psikolog" <?php if($kk['pekerjaan'] == 'Psikiater/Psikolog'){echo "selected";} ?>>Psikiater/Psikolog</option>
                                    <option value="Penyiar Televisi" <?php if($kk['pekerjaan'] == 'Penyiar Televisi'){echo "selected";} ?>>Penyiar Televisi</option>
                                    <option value="Penyiar Radio" <?php if($kk['pekerjaan'] == 'Penyiar Radio'){echo "selected";} ?>>Penyiar Radio</option>
                                    <option value="Pelaut" <?php if($kk['pekerjaan'] == 'Pelaut'){echo "selected";} ?>>Pelaut</option>
                                    <option value="Peneliti" <?php if($kk['pekerjaan'] == 'Peneliti'){echo "selected";} ?>>Peneliti</option>
                                    <option value="Sopir" <?php if($kk['pekerjaan'] == 'Sopir'){echo "selected";} ?>>Sopir</option>
                                    <option value="Pialang" <?php if($kk['pekerjaan'] == 'Pialang'){echo "selected";} ?>>Pialang</option>
                                    <option value="Paranormal" <?php if($kk['pekerjaan'] == 'Paranormal'){echo "selected";} ?>>Paranormal</option>
                                    <option value="Pedagang" <?php if($kk['pekerjaan'] == 'Pedagang'){echo "selected";} ?>>Pedagang</option>
                                    <option value="Perangkat Desa" <?php if($kk['pekerjaan'] == 'Perangkat Desa'){echo "selected";} ?>>Perangkat Desa</option>
                                    <option value="Kepala Desa" <?php if($kk['pekerjaan'] == 'Kepala Desa'){echo "selected";} ?>>Kepala Desa</option>
                                    <option value="Biarawati" <?php if($kk['pekerjaan'] == 'Biarawati'){echo "selected";} ?>>Biarawati</option>
                                    <option value="Wiraswasta" <?php if($kk['pekerjaan'] == 'Wiraswasta'){echo "selected";} ?>>Wiraswasta</option>
                                    <option value="Lainnya" <?php if($kk['pekerjaan'] == 'Lainnya'){echo "selected";} ?>>Lainnya</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Hubungan Keluarga</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="hubungan" class="form-control" required>
                                    <option value="Kepala Keluarga" <?php if($kk['hubungan'] == 'Kepala Keluarga'){echo "selected";} ?>>Kepala Keluarga</option>
                                    <option value="Istri" <?php if($kk['hubungan'] == 'Istri'){echo "selected";} ?>>Istri</option>
                                    <option value="Kakak" <?php if($kk['hubungan'] == 'Kakak'){echo "selected";} ?>>Kakak</option>
                                    <option value="Adik" <?php if($kk['hubungan'] == 'Adik'){echo "selected";} ?>>Adik</option>
                                    <option value="Anak" <?php if($kk['hubungan'] == 'Anak'){echo "selected";} ?>>Anak</option>
                                    <option value="Lainnya" <?php if($kk['hubungan'] == 'Lainnya'){echo "selected";} ?>>Lainnya</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Status Perkawinan</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="perkawinan" class="form-control" required>
                                    <option value="Kawin" <?php if($kk['perkawinan'] == 'Kawin'){echo "selected";} ?>>Kawin</option>
                                    <option value="Belum Kawin" <?php if($kk['perkawinan'] == 'Belum Kawin'){echo "selected";} ?>>Belum Kawin</option>
                                    <option value="Cerai Hidup" <?php if($kk['perkawinan'] == 'Cerai Hidup'){echo "selected";} ?>>Cerai Hidup</option>
                                    <option value="Cerai Mati" <?php if($kk['perkawinan'] == 'Cerai Mati'){echo "selected";} ?>>Cerai Mati</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Kewarganegaraan</th>
                        </tr>
                        <tr>
                            <td>
                                <select name="kewarganegaraan" class="form-control" required>
                                    <option value="WNI" <?php if($kk['kewarganegaraan'] == 'WNI'){echo "selected";} ?>>WNI</option>
                                    <option value="WNA" <?php if($kk['kewarganegaraan'] == 'WNA'){echo "selected";} ?>>WNA</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama ayah</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="nama_ayah" value="<?php echo $kk['nama_ayah']; ?>" class="form-control" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <th>Nama ibu</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="nama_ibu" value="<?php echo $kk['nama_ibu']; ?>" class="form-control" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-default" data-dismiss="modal">Kembali</a> &nbsp; &nbsp;
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


<?php endif; ?>

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