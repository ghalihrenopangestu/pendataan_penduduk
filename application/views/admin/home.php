<?php $this->load->view('template/header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
 if($this->session->userdata('level') == "Administrator" ){

  $kode_tahun = date('Y');
 ?>
<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $count_rt;?></h3>

              <p>Data RT</p>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $count_kk;?></h3>

              <p>Data Kepala Keluarga</p>
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
              <p>Data Anggota KK Laki-laki</p>
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
              <p>Data Anggota KK Perempuan</p>
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

              <p>Data Jumlah KK Laki-laki Dan Perempuan</p>
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
        <?php foreach($data as $rt): ?>
        <div class="col-lg-6 col-md-12">
          <!-- small box -->
        <canvas id="barChart<?= $rt['id_rt'];?>"></canvas>
        </div>
        <?php endforeach; ?>

        <script>
        <?php foreach($data as $rt): ?>
          <?php
          $admin_count_kk = $this->M_count->admin_count_kk_rt($rt['id_rt']);
          $admin_count_anggota = $this->M_count->admin_count_anggota_rt_laki($rt['id_rt']) + $this->M_count->admin_count_anggota_rt_perempuan($rt['id_rt']);
          $admin_count_kk_laki = $this->M_count->admin_count_anggota_rt_laki($rt['id_rt']);
          $admin_count_kk_perempuan = $this->M_count->admin_count_anggota_rt_perempuan($rt['id_rt']);
          ?>
        // Data diagram batang
        var data = {
          labels: ['Kepala Keluarga', 'Anggota KK Laki-laki', 'Anggota KK Perempuan', 'Jumlah KK Laki-laki Dan Perempuan'],
          datasets: [{
            label: 'Data RT <?= $rt['no_rt'];?>',
            data: [<?= $admin_count_kk;?>, <?= $admin_count_kk_laki;?>, <?= $admin_count_kk_perempuan;?>, <?= $admin_count_anggota;?>],
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
        var ctx = document.getElementById('barChart<?= $rt['id_rt'];?>').getContext('2d');
        var barChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: options
        });
        <?php endforeach; ?>
      </script>



<?php 
} 

?>

<?php $this->load->view('template/footer'); ?>