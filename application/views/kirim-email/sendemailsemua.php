<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="Layanan hotspot wifi unlimited 24 jam non stop tanpa lemot kecuali saat wifi down">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ALIMOCHTAR

 WIFI</title>
    <link rel="icon" href="../../dist/img/komp.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <link rel="shortcut icon" href="../../dist/img/favicon.ico" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- sweet alert -->
</body>
</html>

<?php
$pinjam          = date("d M Y");
$dua_hari        = mktime(0,0,0,date("n"),date("j")+2,date("Y"));
$deadline        = date("d M Y", $dua_hari);

require '../../email/PHPMailer/src/PHPMailer.php' ;
require '../../email/PHPMailer/src/SMTP.php';
require '../../email/PHPMailer/src/Exception.php';

include "../../inc/koneksi.php"; //memulai koneksi ke database
// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
$result = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan inner join tb_email where status_plg='Aktif'");
// Mengambil semua data email dalam bentuk array
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($result as $key => $data) { //mengirim email untuk setiap baris data
    $mail =  new PHPMailer\PHPMailer\PHPMailer();
    //$mail->IsSMTP();
    $mail->IsHTML(true);
    //$mail->SMTPAuth     = true;
    //$mail->Host         = "smtp.gmail.com";
    //$mail->Port         = 587;
    //$mail->SMTPSecure   = "tls";
    //$mail->Username     = "ALIMOCHTAR

mikrotik@gmail.com";   //username SMTP
    //$mail->Password     = "abzdjiivohwzwieo";              //password SMTP
    $mail->From         = $data['email_pengirim'];  			 //email pengirim
    $mail->FromName     = $data['nama_pengirim'];                   //nama  pengirim
    $mail->AddAddress($data['email'], $data['nama']);//email dan nama penerima
    $mail->Subject  	=  "Yth. " .$data['nama']. " " .$data['subject'] ; //judul email
    $mail->Body     	=  "<table><thead><tr>
                            <td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>  ".
                            "<p style=font-size:18px>" .$data['isi_pesan'].
                            "<br><br></td></tr></thead></table> 
                            <p style=font-size:16px;padding-left:1em;padding-right:1em>
                            
                            <br><img src='https://wifi.alimochtar.my.id/dist/img/wifi.png'>
                            <br><b>~" .$data['tanda_tangan']. "~</b></p>" ; //isi   email
    if(is_array($_FILES)) {
        $mail->AddAttachment($_FILES['attachmentFile']['tmp_name'],$_FILES['attachmentFile']['name']);
        }

    if ($mail->Send()) {
        echo "<script>
        Swal.fire({title: 'Berhasil mengirim email',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '../../index.php?page=kirim-email';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Gagal mengirim email',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '../../index.php?page=kirim-email';
            }
        })</script>";
    }
}
mysqli_close($koneksi);

