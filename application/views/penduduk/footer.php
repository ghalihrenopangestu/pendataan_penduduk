</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<!-- ./wrapper -->
<script>
    //preview gambar
    function previewKK() {
    document.getElementById("preview_kk").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("kk").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("preview_kk").src = oFREvent.target.result;
    };

};
</script>
<!-- jQuery 3 -->
<script src="<?= base_url('themes/admin') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('themes/admin') ?>/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('themes/admin') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 
<script src="<?= base_url('themes/admin') ?>/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url('themes/admin') ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url('themes/admin') ?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('themes/admin') ?>/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('themes/admin') ?>/bower_components/moment/min/moment.min.js"></script>
<!-- <script src="<?= base_url('themes/admin') ?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- datepicker -->
<script src="<?= base_url('themes/admin') ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('themes/admin') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('themes/admin') ?>/bower_components/chart.js/Chart.js"></script>
<!-- Select2 -->
<script src="<?= base_url('themes/admin') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        //modal
        dropdownParent: $('#modal-default'),
    })
    
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<?php

 //menampilkan ip address menggunakan function getenv()
 function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}

	 //menampilkan jenis web browser pengunjung
function get_client_browser() {
    $browser = '';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
  	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Browser'))
        $browser = 'Browser';
    else
        $browser = 'Other';
    return $browser;
}

?> 


<script src="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url('themes/admin') ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?= base_url('themes/admin') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('themes/admin') ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('themes/admin') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('themes/admin') ?>/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('themes/admin') ?>/dist/js/demo.js"></script>
</body>
</html>
