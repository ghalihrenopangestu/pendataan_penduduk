<?php $this->load->view('template/header'); ?>
<a href="#" class="btn btn-info no-print" onclick="exportToPDF()"><i class="fa fa-file-pdf-o"></i> PDF</a>
<a href="#" class="btn btn-success no-print" onclick="exportToExcel()"><i class="fa fa-file-excel-o"></i> Excel</a>
<br /><br /><br />


<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kepala Keluarga</th>
                <th>No KK</th>
                <th>Nama Anggota</th>
                <th>NIK</th>
                <th>No HP</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal lahir</th>
                <th>Usia</th>
                <th>Tempat Lahir</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Hubungan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $anggota): ?>
            <tr>
                <td>
                    <?= $no ?>
                    <a href="<?= base_url('admin/kepala_keluarga/detail/'.$anggota['id_kk']) ?>" class="btn-sm btn-info"><i class="fa fa-eye"></i></a>
                </td>
                <td>
                    <?= $anggota['nama_kk'] ?>
                </td>
                <td><?= $anggota['no_kk'] ?></td>
                <td><?= $anggota['nama'] ?></td>
                <td><?= $anggota['nik'] ?></td>
                <td><?= $anggota['no_hp_anggota'] ?></td>
                <td><?= $anggota['jenis_kelamin'] ?></td>
                <td><?= tgl_indo($anggota['tgl_lahir']) ?></td>
                <td><?= hitung_usia($anggota['tgl_lahir']) ?> Tahun</td>
                <td><?= $anggota['tempat_lahir'] ?></td>
                <td><?= $anggota['agama'] ?></td>
                <td><?= $anggota['pendidikan'] ?></td>
                <td><?= $anggota['pekerjaan'] ?></td>
                <td><?= $anggota['hubungan'] ?></td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    function exportToPDF() {
        window.location.href = "<?= base_url('admin/anggota/export_pdf/') ?>";
    }

    function exportToExcel() {
        window.location.href = "<?= base_url('admin/anggota/export_excel/') ?>";
    }
</script>


<?php $this->load->view('template/footer'); ?>
<?php 

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

//format tanggal indonesia
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

