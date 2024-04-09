<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends CI_controller
{
	function __construct()
	{
      parent:: __construct();
      $this->load->helper('url');
     // needed ???
      $this->load->database();
      $this->load->library('session');
	 // error_reporting(0);
      if($this->session->userdata('admin') != TRUE){
         redirect(base_url(''));
         exit;
     };
     require APPPATH.'libraries/phpmailer/src/Exception.php';
     require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
     require APPPATH.'libraries/phpmailer/src/SMTP.php';
     
     $this->load->model('M_admin');
     $this->load->model('M_pelanggan');
     $this->load->model('M_tagihan');
     $this->load->model('M_tagihan_lain');
     $this->load->model('M_email');

 }

 public function kirimemail_plg()
 {
    $view = array('judul'       =>'Kirim Email Pelanggan',
        'aksi'          =>'kirimemail_plg',      
        'pelanggan'     => $this->db->get_where('tb_pelanggan',array('status_plg'=>'Aktif'))->result_array(),
    );
    $this->load->view('admin/mailbox/compose',$view);

}

public function sendmail_plg()
{
    $mail = new PHPMailer();
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'ALIMOCHTAR

mikrotik@gmail.com'; // Email gmail anda
        // $mail->Password = 'abzdjiivohwzwieo'; // Password gmail anda
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 587;
        $mail->setFrom($this->input->post('email_pengirim'), $this->input->post('nama_pengirim')); // Email pengirim
        $mail->addAddress($this->input->post('email_penerima')); // Email tujuan
        $mail->Subject = $this->input->post('subject');
        $mail->isHTML(true);
        $content = '</p><table><thead><tr><td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>'.
        $this->input->post('isi_pesan').
        '<br></td></tr></thead></table> 
        <p style=font-size:16px;padding-left:1em;padding-right:1em>
        <i>Pesan ini dikirim otomatis oleh system aplikasi '.$this->input->post('nama_pengirim').'</i>
        <br><img src="https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/wifi.png">
        <br><b>~ ' .$this->input->post('ttd'). ' ~</b>';
        
        $mail->Body = $content;
        if ($mail->send()) {
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Berhasil",
                    text: "Selamat Anda berhasil mengirim email",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>');
            redirect(base_url('email/kirimemail_plg'));
        } else {
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Gagal",
                    text: "Anda gagal mengirim email",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>');
            redirect(base_url('email/kirimemail_plg'));
        }
    }

    public function kirimemail_semua($id)
    {
        $data=$this->M_email->view_id($id)->row_array();
        if (empty($data['id_email'])) {
            $pesan='<script>
            swal({
              title: "Gagal Buka Email !",
              text: "ID Email Tidak Ditemukan",
              type: "error",
              showConfirmButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "OK",
              closeOnConfirm: false
              },
              function(){
                  window.location.href="'.base_url('email/kirimemail_plg').'";
                  });
                  </script>';
                  $this->session->set_flashdata('pesan',$pesan);
                  redirect(base_url('email/kirimemail_plg'));
              }

              $x = array('judul'              =>'Kirim Email Semua' ,
                 'aksi'              =>'kirimemail_semua',
                 'nama_pengirim'     =>$data['nama_pengirim'],
                 'email_pengirim'    =>$data['email_pengirim'],
                 'subject'           =>$data['subject'],
                 'isi_pesan'         =>$data['isi_pesan'],
                 'tanda_tangan'      =>$data['tanda_tangan']);	
              if(isset($_POST['kirim'])){
                  $SQLupdate=array(
                   'nama_pengirim'         =>$this->input->post('nama_pengirim'),
                   'email_pengirim'        =>$this->input->post('email_pengirim'),
                   'subject'               =>$this->input->post('subject'),
                   'isi_pesan'             =>$this->input->post('isi_pesan'),
                   'tanda_tangan'          =>$this->input->post('tanda_tangan'));
                  $cek=$this->M_email->update($id,$SQLupdate);
                  if($cek){
                   $pesan='<script>
                   swal({
                      title: "Berhasil Edit Data",
                      text: "",
                      type: "success",
                      showConfirmButton: true,
                      confirmButtonText: "OKEE"
                      });
                      </script>';
                      $this->session->set_flashdata('pesan',$pesan);
                      redirect(base_url('email/kirimemail_semua/'.$id.''));
                  }else{
                   echo "ERROR input Data";
               }
           }else{
            $this->load->view('admin/mailbox/compose',$x);

        }
    }

    public function sendmail_semua()
    {
        //mengambil data email dari database
        $result = $this->M_email->sendmail_semua();
        $result = $result->result_array();
        foreach ($result as $data) {
            
            $mail = new PHPMailer();
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'ALIMOCHTAR

mikrotik@gmail.com'; // Email gmail anda
        // $mail->Password = 'abzdjiivohwzwieo'; // Password gmail anda
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 587;
        $mail->setFrom($this->input->post('email_pengirim'), $this->input->post('nama_pengirim')); // Email pengirim
        $mail->addAddress($data['email'], $data['nama']); // Email penerima
        $mail->Subject = $data['subject'];
        $mail->isHTML(true);
        $content = '</p><table><thead><tr><td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>'.
        $data['isi_pesan'].
        '<br></td></tr></thead></table> 
        <p style=font-size:16px;padding-left:1em;padding-right:1em>
        <i>Pesan ini dikirim otomatis oleh system aplikasi '.$data['nama_pengirim'].'</i>
        <br><img src="https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/wifi.png">
        <br><b>~ ' .$data['tanda_tangan']. ' ~</b>';
        
        $mail->Body = $content;
        if ($mail->send()) {
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Berhasil",
                    text: "Selamat Anda berhasil mengirim email",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>');
            redirect(base_url('email/kirimemail_semua/E001'));
        } else {
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Gagal",
                    text: "Anda gagal mengirim email",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>');
            redirect(base_url('email/kirimemail_semua/E001'));
        }
    }
}

public function kirimemail_umum()
{
    $view = array('judul'       =>'Kirim Email Umum',
        'aksi'          =>'kirimemail_umum',      
    );
    $this->load->view('admin/mailbox/compose',$view);

}

public function sendmail_umum()
{
    $mail = new PHPMailer();
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'ALIMOCHTAR

mikrotik@gmail.com'; // Email gmail anda
        // $mail->Password = 'abzdjiivohwzwieo'; // Password gmail anda
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 587;
        $mail->setFrom($this->input->post('email_pengirim'), $this->input->post('nama_pengirim')); // Email pengirim
        $mail->addAddress($this->input->post('email_penerima')); // Email tujuan
        $mail->Subject = $this->input->post('subject');
        $mail->isHTML(true);
        $content = '</p><table><thead><tr><td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>'.
        $this->input->post('isi_pesan').
        '<br></td></tr></thead></table> 
        <p style=font-size:16px;padding-left:1em;padding-right:1em>
        <i>Pesan ini dikirim otomatis oleh system aplikasi '.$this->input->post('nama_pengirim').'</i>
        <br><img src="https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/wifi.png">
        <br><b>~ ' .$this->input->post('ttd'). ' ~</b>';
        
        $mail->Body = $content;
        if ($mail->send()) {
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Berhasil",
                    text: "Selamat Anda berhasil mengirim email",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>');
            redirect(base_url('email/kirimemail_umum'));
        } else {
            $this->session->set_flashdata('pesan', '<script>
                swal({
                    title: "Gagal",
                    text: "Anda gagal mengirim email",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>');
            redirect(base_url('email/kirimemail_umum'));
        }
    }


    public function sendmail_bulanan()
    {
        
        //kirim email ke semua pelanggan yang belum bayar
        $result = $this->db->query("SELECT * FROM tb_tagihan join tb_pelanggan on tb_tagihan.id_pelanggan = tb_pelanggan.id_pelanggan where status = 'BL'");
        $result = $result->result_array();
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com';
        $mail->SMTPAuth = true;
            $mail->Username = 'mulwidodo.id@gmail.com'; // Email gmail anda
            $mail->Password = 'evubquxtvgbixsuz'; // Password gmail anda
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('mulwidodo.id@gmail.com' , 'ALIMOCHTAR

 WiFi'); // Email dan nama pengirim

            foreach ($result as $data) {
            $mail->addAddress($data['email'], $data['nama']); // Email dan nama penerima
            $mail->Subject = 'Yth. '.$data['nama'].' Ada Tagihan Baru ALIMOCHTAR

WiFi bulan '.$data['bulan']. ' / ' .$data['tahun']. ' Yang Belum Dibayar'; // Subject email
            $mail->isHTML(true);
            $content = '<table><thead><tr>
            <td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>  '.
            '<p style=font-size:18px>Pelanggan Yth. Sdr/i '.$data['nama']. ' Ada tagihan hotspot
            ALIMOCHTAR

WiFi untuk Bulan '.$data['bulan'] . ' / Tahun ' .$data['tahun']. ' yang belum dibayar.</p>'.
            'Dengan rincian Biaya Tagihan : <br><b>Rp. '.number_format($data['tagihan'], 0, ',', '.') . '</b>'.
            '<br>Pembayaran dapat dilakukan secara Tunai maupun transfer Bank, ShopeePay, LinkAja, Dana, Alfamart atau platform digital lainnya.
            <br><br>Anda dapat melunasi pembayaran sebelum batas akhir pada tanggal 10 - '.$data['bulan'] . ' - ' .$data['tahun'] . 
            '. Mari lunasi tagihan ini segera, demi kenyamanan internet bersama!
            <p align=center colspan=2 style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif>
            <a href="https://wifi.alimochtar.my.id/struk/bayar_tagihan/' .$data['id_tagihan']. '" style=color:rgb(255,255,255);background-color:#589bf2;border-width:initial;border-style:none;border-radius:15px;padding:10px 20px target=_blank >' .
            ' Bayar Sekarang</a></p><br><br>Abaikan pesan jika sudah melakukan pembayaran. Terima kasih.' .
            '<br><br></td></tr></thead></table> 
            <p style=font-size:18px;padding-left:1em;padding-right:1em>
            Bayar lebih mudah melalui merchant ALIMOCHTAR

Wifi berikut ini :
            </p>
            <table><thead>
            <tr>
            <td style=padding-left:1em;padding-right:1em>
            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/transferbank.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/shopeepay.png height=22px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/linkaja.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/dana.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/alfamart.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/indomaret.png height=35px>
            </a>
            </td>
            </tr>
            </thead></table><br>

            <p style=font-size:16px;padding-left:1em;padding-right:1em>
            <i>Pesan ini dikirim otomatis oleh system aplikasi ALIMOCHTAR

WiFi</i>
            <br><img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/wifi.png>
            <br><b>~ wifi@alimochtar.my.id ~</b></p>'
            ;
            
            $mail->Body = $content;
            if ($mail->send()) {
                $this->session->set_flashdata('pesan', '<script>
                    swal({
                        title: "Berhasil",
                        text: "Berhasil mengirim email tagihan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                        </script>');
                redirect(base_url('admin/tagihan'));
            } else {
                $this->session->set_flashdata('pesan', '<script>
                    swal({
                        title: "Gagal",
                        text: "Anda gagal mengirim email tagihan",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                        </script>');
                redirect(base_url('admin/tagihan'));
            }
        }
    }

    public function sendmail_bl_lain()
    {
        $pinjam          = date("d F Y");
        $dua_hari        = mktime(0,0,0,date("n"),date("j")+2,date("Y"));
        $deadline        = date("d F Y", $dua_hari);

        //mengambil data tagihan dari database
        $result = $this->m_tagihan_lain->sendmail();
        $result = $result->result_array();
        foreach ($result as $data) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.googlemail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mulwidodo.id@gmail.com'; // Email gmail anda
            $mail->Password = 'evubquxtvgbixsuz'; // Password gmail anda
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('mulwidodo.id@gmail.com' , 'ALIMOCHTAR

 WiFi'); // Email dan nama pengirim

            $mail->addAddress($data['email'], $data['nama']); // Email dan nama penerima
            $mail->Subject = 'Yth. '.$data['nama'].' Ada Tagihan Baru ALIMOCHTAR

WiFi Yang Belum Dibayar'; // Subject email
            $mail->isHTML(true);
            $content = '<table><thead><tr>
            <td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>  '.
            '<p style=font-size:18px>Pelanggan Yth. Sdr/i '.$data['nama']. ' Terima kasih sudah mempercayai ALIMOCHTAR

WiFi sbg layanan hotspot wifi anda.</p>'.
            "Berikut adalah total biaya ".$data['keterangan'] . " anda :".
            "<br><b>Rp. " . number_format($data['tagihan'], 0, ',', '.') . "</b>".
            '<br><br>Pembayaran dapat dilakukan secara Tunai maupun transfer Bank, ShopeePay, LinkAja, Dana, Alfamart atau platform digital lainnya.
            <br><br>Mohon segera melunasi biaya tersebut <b>sebelum tgl'.$deadline . 
            '</b> demi kenyamanan internet bersama!
            <p align=center colspan=2 style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif>
            <a href="https://wifi.alimochtar.my.id/struk/bayar_tagihan_lain/' .$data['id_tagihan_lain']. '" style=color:rgb(255,255,255);background-color:#589bf2;border-width:initial;border-style:none;border-radius:15px;padding:10px 20px target=_blank >' .
            ' Bayar Sekarang</a></p><br><br>Abaikan pesan jika sudah melakukan pembayaran. Terima kasih.' .
            '<br><br></td></tr></thead></table> 
            <p style=font-size:18px;padding-left:1em;padding-right:1em>
            Bayar lebih mudah melalui merchant ALIMOCHTAR

Wifi berikut ini :
            </p>
            <table><thead>
            <tr>
            <td style=padding-left:1em;padding-right:1em>
            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/transferbank.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/shopeepay.png height=22px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/linkaja.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/dana.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/alfamart.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/indomaret.png height=35px>
            </a>
            </td>
            </tr>
            </thead></table><br>

            <p style=font-size:16px;padding-left:1em;padding-right:1em>
            <i>Pesan ini dikirim otomatis oleh system aplikasi ALIMOCHTAR

WiFi</i>
            <br><img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/wifi.png>
            <br><b>~ wifi@alimochtar.my.id ~</b></p>'
            ;
            
            $mail->Body = $content;
            if ($mail->send()) {
                $this->session->set_flashdata('pesan', '<script>
                    swal({
                        title: "Berhasil",
                        text: "Berhasil mengirim email tagihan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                        </script>');
                redirect(base_url('admin/tagihan_lain'));
            } else {
                $this->session->set_flashdata('pesan', '<script>
                    swal({
                        title: "Gagal",
                        text: "Anda gagal mengirim email tagihan",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                        </script>');
                redirect(base_url('admin/tagihan_lain'));
            }
        }
    }

//kirim email tagihan bulanan berdasarkan id tagihan
    public function kirim_email_tagihan_bulanan($id_tagihan)
    {
        $data = $this->db->query("SELECT * FROM tb_tagihan join tb_pelanggan on tb_tagihan.id_pelanggan = tb_pelanggan.id_pelanggan WHERE id_tagihan = '$id_tagihan'");
        $data = $data->row_array();

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.googlemail.com';
        $mail->SMTPAuth = true;
            $mail->Username = 'mulwidodo.id@gmail.com'; // Email gmail anda
            $mail->Password = 'evubquxtvgbixsuz'; // Password gmail anda
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('mulwidodo.id@gmail.com' , 'ALIMOCHTAR

 WiFi'); // Email dan nama pengirim

            $mail->addAddress($data['email'], $data['nama']); // Email dan nama penerima
            $mail->Subject = 'Yth. '.$data['nama'].' Ada Tagihan Baru ALIMOCHTAR

WiFi bulan '.$data['bulan']. ' / ' .$data['tahun']. ' Yang Belum Dibayar'; // Subject email
            $mail->isHTML(true);
            $content = '<table><thead><tr>
            <td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>  '.
            '<p style=font-size:18px>Pelanggan Yth. Sdr/i '.$data['nama']. ' Ada tagihan hotspot
            ALIMOCHTAR

WiFi untuk Bulan '.$data['bulan'] . ' / Tahun ' .$data['tahun']. ' yang belum dibayar.</p>'.
            'Dengan rincian Biaya Tagihan : <br><b>Rp. '.number_format($data['tagihan'], 0, ',', '.') . '</b>'.
            '<br>Pembayaran dapat dilakukan secara Tunai maupun transfer Bank, ShopeePay, LinkAja, Dana, Alfamart atau platform digital lainnya.
            <br><br>Anda dapat melunasi pembayaran sebelum batas akhir pada tanggal 10 - '.$data['bulan'] . ' - ' .$data['tahun'] . 
            '. Mari lunasi tagihan ini segera, demi kenyamanan internet bersama!
            <p align=center colspan=2 style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif>
            <a href="https://wifi.alimochtar.my.id/struk/bayar_tagihan/' .$data['id_tagihan']. '" style=color:rgb(255,255,255);background-color:#589bf2;border-width:initial;border-style:none;border-radius:15px;padding:10px 20px target=_blank >' .
            ' Bayar Sekarang</a></p><br><br>Abaikan pesan jika sudah melakukan pembayaran. Terima kasih.' .
            '<br><br></td></tr></thead></table> 
            <p style=font-size:18px;padding-left:1em;padding-right:1em>
            Bayar lebih mudah melalui merchant ALIMOCHTAR

Wifi berikut ini :
            </p>
            <table><thead>
            <tr>
            <td style=padding-left:1em;padding-right:1em>
            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/transferbank.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/shopeepay.png height=22px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/linkaja.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/dana.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/alfamart.png height=35px>
            </a>

            <a>
            <img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/indomaret.png height=35px>
            </a>
            </td>
            </tr>
            </thead></table><br>

            <p style=font-size:16px;padding-left:1em;padding-right:1em>
            <i>Pesan ini dikirim otomatis oleh system aplikasi ALIMOCHTAR

WiFi</i>
            <br><img src=https://wifi.alimochtar.my.id/themes/ALIMOCHTAR

-wifi/img/img/wifi.png>
            <br><b>~ wifi@alimochtar.my.id ~</b></p>'
            ;
            
            $mail->Body = $content;
            if ($mail->send()) {
                $this->session->set_flashdata('pesan', '<script>
                    swal({
                        title: "Berhasil",
                        text: "Berhasil mengirim email tagihan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                        </script>');
                redirect(base_url('admin/tagihan'));
            } else {
                $this->session->set_flashdata('pesan', '<script>
                    swal({
                        title: "Gagal",
                        text: "Gagal mengirim email tagihan",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                        </script>');
                redirect(base_url('admin/tagihan'));
            }
        }

    }


