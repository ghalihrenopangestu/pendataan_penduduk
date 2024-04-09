</div>


</div>
</div>
</section>
<!-- /.content -->
</div> 
<script>
    //ajax keluar dari halaman admin
    function keluar() {
        swal({
            title: "Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?> ?",
            text: "Anda Akan Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?> ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3CB371",
            confirmButtonText: "Ya, Keluar!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('keluar') ?>",
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Anda Telah Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?>",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Anda Gagal Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?>",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Keluar", "Anda Batal Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?>", "error");
            }
        });
    }
</script>

<i>Access application with <?php echo "". get_client_browser()."";?>. <?php echo "". get_client_ip()."";?></i>
</footer>

  <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->

 </div>
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

//view password
    function viewPassword() {
       var x = document.getElementById("password");
       if (x.type === "password") {
          x.type = "text";
      } else {
          x.type = "password";
      }
  }

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
<!-- Select2 -->
<script src="<?= base_url('themes/admin') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
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
