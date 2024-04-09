<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>

<div id="map" style="width: auto; height: 500px;"></div>
    <script type="text/javascript">

        //menampilkan data json dari controller untuk ditampilkan di peta
        var data = <?php echo $data; ?>;
        var locations = [];
        for (var i = 0; i < data.length; i++) {
            locations.push(['<h4>'+data[i].nama+'</h4><p>'+data[i].no_hp+'<br>'+data[i].alamat+'</p>', 
            data[i].latitude, 
            data[i].longitude]);
        }
        
 
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        center: new google.maps.LatLng(-7.95273788368736, 111.42980425660366),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
 
      var infowindow = new google.maps.InfoWindow();
 
      var marker, i;
 
      for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map,
          icon: '<?= base_url('themes/marker.png') ?>',
        });
 
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    </script>

<?php $this->load->view('template/footer'); ?>