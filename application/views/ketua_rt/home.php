<?php $this->load->view('template/header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
 if($this->session->userdata('level') == "ketua_rt" ){

  $kode_tahun = date('Y');
 ?>
<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $count_kk;?></h3>

              <p>Data Kepala Keluarga RT <?= $no_rt;?> <?= $alamat;?></p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $count_kk_laki;?> </h3>
              <p>Data Anggota KK Laki-laki RT <?= $no_rt;?> <?= $alamat;?></p>
            </div>
            <div class="icon">
             <i class="fa fa-male"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $count_kk_perempuan;?> </h3>
              <p>Data Anggota KK Perempuan RT <?= $no_rt;?> <?= $alamat;?></p>
            </div>
            <div class="icon">
             <i class="fa fa-female"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?= $count_anggota;?> </h3>

              <p>Data Jumlah KK Laki-laki Dan Perempuan RT <?= $no_rt;?> <?= $alamat;?></p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </div>

        
    <div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border"> 
        <div class="col-lg-6 col-md-12">
          <!-- small box -->
        <canvas id="barChart"></canvas>
        </div>

        <script>
        // Data diagram batang
        var data = {
          labels: ['Kepala Keluarga', 'Anggota KK Laki-laki', 'Anggota KK Perempuan', 'Jumlah KK Laki-laki Dan Perempuan'],
          datasets: [{
            label: 'Data RT <?= $no_rt;?>',
            data: [<?= $count_kk;?>, <?= $count_kk_laki;?>, <?= $count_kk_perempuan;?>, <?= $count_anggota;?>],
            backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(192, 75, 192, 0.6)', 'rgba(192, 192, 75, 0.6)', 'rgba(75, 75, 192, 0.6)'],
            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(192, 75, 192, 1)', 'rgba(192, 192, 75, 1)', 'rgba(75, 75, 192, 1)'],
            borderWidth: 1
          }]
        };

        // Opsi diagram batang
        var options = {
          scales: {
            x: {
              barPercentage: 1, // Mengatur lebar batang (dalam persen dari lebar kategori)
              categoryPercentage: 0.6 // Mengatur lebar kategori (dalam persen dari lebar kategori)
            },
            y: {
              beginAtZero: true
            }
          }
        };

        // Membuat diagram batang
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: options
        });
      </script>
        </div>
        


    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Informasi</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered  table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Informasi</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($informasi->result_array() as $informasi): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $informasi['informasi'] ?></td>
                                    <td>
                                        <a href="<?= base_url('template/file_informasi/'.$informasi['berkas']) ?>"
                                            target="_blank"><?= $informasi['berkas'] ?></a>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php 
} 

?>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/akses'); ?>