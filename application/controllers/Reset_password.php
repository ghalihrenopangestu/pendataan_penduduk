<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Reset_password extends CI_controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
        // needed ???
    $this->load->database();
    $this->load->library('session');

    $this->load->model('m_resetpassword');
  }

  public function id_token()
  {
    $this->m_resetpassword->token_id_urut();
    $query   = $this->db->get();
    $data    = $query->row_array();
    $id      = $data['id_token'];
    $urut    = substr($id, 1, 3);
    $tambah  = (int) $urut + 1;

    if (strlen($tambah) == 1){
      $newID = "T"."00".$tambah;
    } elseif (strlen($tambah) == 2){
      $newID = "T"."0".$tambah;
    } else {
      $newID = "T".$tambah;
    }

    return $newID;
  }


  private function acak_token($panjang)
  {
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter) - 1);
      $string .= $karakter[$pos];
    }
    return $string;
  }

    //menginputkan tanggal dan waktu 10 menit expired
  public function waktu_10menit()
  {
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    $date = strtotime($date);
    $date = strtotime("+10 minutes", $date);
    return date('Y-m-d H:i:s', $date);
  }

  public function kirim_email($email='') 
  {
    $data=$this->m_resetpassword->view_id_byemail($email)->row_array();
    $x = array(
      'aksi'            =>'Kirim Email',
      'judul'           =>'Reset Password',
      'id_token'        =>$this->id_token(),
      'token'           =>$this->acak_token(25),
    );
    if (isset($_POST['kirim'])) {
      $this->load->library('form_validation');
      $rules = array(
        array(
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'required|valid_email'
        )
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('pesan', '<script>
          swal({
            text: "Email yang anda masukkan tidak terdaftar, silakan ulangi lagi atau hubungi admin",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE"
            });
            </script>');
        redirect('reset_password');
      } else 

        //cek apakah email tersebut sudah terdaftar atau belum
      $proses_cek=$this->m_resetpassword->view_id_byemail($this->input->post('email'))->num_rows();
      if ($proses_cek == 0) {
        $this->session->set_flashdata('pesan', '<script>
          swal({
            text: "Email yang anda masukkan tidak terdaftar, silakan ulangi lagi atau hubungi admin",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE"
            });
            </script>');
        redirect('reset_password');
      }
      else

        //update token di tabel pelanggan
        $SQLinsert=array(
          'id_token'        =>$this->id_token(),
        );
      $cek=$this->m_resetpassword->update_by_email($this->input->post('email'),$SQLinsert);

        //add token ke tabel token
      $SQLinsert2=array(
        'id_token'        =>$this->id_token(),
        'token'           =>$x['token'],
        'expired'         =>$this->waktu_10menit(),
      );
      $cek=$this->m_resetpassword->token_add($SQLinsert2);

      if($cek){
        $pesan='<script>
        swal({
          title: "Silakan cek email anda, bila belum masuk bisa hubungi admin",
          text: "",
          type: "success",
          showConfirmButton: true,
          confirmButtonText: "OKEE"
          });
          </script>';
            //mengirim email ke pelanggan dengan phpmailer
          require_once(APPPATH.'libraries/phpmailer/Exception.php');
          require_once(APPPATH.'libraries/phpmailer/PHPMailer.php');
          require_once(APPPATH.'libraries/phpmailer/SMTP.php');

          $mail = new PHPMailer();
          $mail->isSMTP();
          $mail->Host = 'smtp.googlemail.com';
          $mail->SMTPAuth = true;
            $mail->Username = 'mulwidodo.id@gmail.com'; // Email gmail anda
            $mail->Password = 'evubquxtvgbixsuz'; // Password gmail anda
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('mulwidodo.id@gmail.com' , 'ALIMOCHTAR
 Development'); // Email dan nama pengirim

            $mail->addAddress($this->input->post('email')); // Email dan nama penerima
            $mail->Subject = 'Selamat '.$this->input->post('nama').' Token Untuk Reset Password Berhasil Terkirim'; // Subject email
            $mail->isHTML(true);
            $content = '</p><table><thead><tr><td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>'.
            '<br>Berikut token untuk reset password anda silakan klik tombol dibawah, token hanya berlaku 10 menit :'.
            '<br><br><p align=center colspan=2 style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif>
            <a href=' . base_url() . 'password_baru/'.$x['token'].' style=color:rgb(255,255,255);background-color:#589bf2;border-width:initial;border-style:none;border-radius:15px;padding:10px 20px target=_blank >' .
            '<b>Klik disini..</b></a></p>' .
            '<br></td></tr></thead></table>
            <table><thead>
            <tr><td></td></tr>
            <tr>
            <td style=padding-left:1em;padding-right:1em>
            <a>
            <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEj9P6_1rH4mL3IjXxJOmoTKWJ8I6UX5I-mHA8A4dBwMSxyYuPzUqBA-YsTRkimTdQh0BR2WBFSxajwJmDoRq7ac0HnM_4J75oY_rw-NGu99XQybl_11Xar3uAczezbYTGuOZKiJOHkIbdvFTTg9qg5U_7ngrJhzuPKWlj44SW63A5rnNnFaygl5tQTEL2b5/s320/1.png width=35%>
            </a>

            <a>
            <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjC5Mp5v38mR-nYiS9p_PFv6BBI5Ith_M6uDS7eHvV9bkJrJ7AGFYD0YpgeUPi4RL3jtn7e_EGILxgZJlEyzCR17NlcteDFANGns6GU-pGx02zGoODn3z-7fa53b_R232pQSeonBKCGy1dQ54Y4ZwP7brKNM8cZjPDqHrAxCYbjgS8IC4F4ARvsT0OfA2BI/s1080/ALI%20MOCHTAR%20PRODUCTIONS%20new.png width=35%>
            </a>

            <br>

            <a>
            <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhTPrj6pqnRpOJYS3mE1uHuklZOjrAiAntzsoUs6tS82q5SvjOzp2twSbHXVXfHyDT6T9h_wTPiDwr8gXM32EBYOoAaaZRkXWZ0-AiyIBjMucOyM5LhxNs685WWl4jMpLk04uG-zuicmjZENILYz84lPBfZDPtsXEvqOgMCLxKBBSKARc3i8s2U3F_A7Nwe/s320/ALIMOCHTAR.png width=35%>
            </a>

            <a>
            <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEju-tIQXsJdkzqY57uxOHH6vv2gl_vypaXn7MQpKMBG8f4byI-K3SVe791130gClSEsdnnNm_dur1mbPeBSVA-L4_osdeOpubrJN0Ppy3Y530VdFAWkwR5WL2Hdnso_Nu02GFthc7DnTaXyRwLWiQqlgfSyF7k1s4ssOHCRkwTMIjr7LGyTnC9cDc__cMPF/s320/WhatsApp%20Image%202023-08-26%20at%2006.16.57.jpeg width=35%>
            </a>

            </td>
            </tr>
            </thead></table>
            <p style=font-size:16px>
            <i>Pesan ini dikirim otomatis oleh system aplikasi Data Penduduk</i>
            <br><img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjC5Mp5v38mR-nYiS9p_PFv6BBI5Ith_M6uDS7eHvV9bkJrJ7AGFYD0YpgeUPi4RL3jtn7e_EGILxgZJlEyzCR17NlcteDFANGns6GU-pGx02zGoODn3z-7fa53b_R232pQSeonBKCGy1dQ54Y4ZwP7brKNM8cZjPDqHrAxCYbjgS8IC4F4ARvsT0OfA2BI/s320/ALI%20MOCHTAR%20PRODUCTIONS%20new.png">
            <br><b>~ cs@alimochtar.my.id ~</b></p>' ;

            $mail->Body = $content;
            if ($mail->send());
            $this->session->set_flashdata('pesan', '<script>
              swal({
                title: "Berhasil",
                text: "Silakan buka email anda untuk melihat token reset password, token hanya berlaku 10 menit dari sekarang",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
                </script>');
            redirect(base_url('reset_password'));
          }else{
            echo $this->upload->display_errors();
          }
        }else{
          $this->load->view('other/reset_password',$x);
        }
      }


      public function reset($token='') 
      {
       $data=$this->m_resetpassword->view_id_bytoken($token)->row_array();
    //jika id token tidak ada dan token tidak ada
       if (empty($data['id_token']) AND empty($data['token'])) {
        $this->session->set_flashdata('pesan', '<script>
          swal({
            title: "Gagal",
            text: "Token tidak ditemukan, silakan melakukan reset password kembali",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE"
            });
            </script>');
        redirect(base_url('reset_password'));
      }

      $x = array(
        'aksi'            =>'ganti_pswd',
        'judul'           =>'Password Baru',
        'id_token'        =>$data['id_token'],
        'expired'         =>$data['expired'],
        'id_rt'           =>$data['id_rt'],
        'nama_rt'         =>$data['nama_rt'],
        'email'           =>$data['email'],
        'password'        =>$data['password'],
      );
      if (isset($_POST['kirim'])) {
        $this->load->library('form_validation');
        $rules = array(
          array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
          )
        );
        $this->form_validation->set_rules($rules);

        $SQLinsert=array(
         'password'    =>md5($this->input->post('password'))
       );
        $cek=$this->m_resetpassword->update_by_token($data['id_token'],$SQLinsert);
        if($cek){
         $pesan='<script>
         swal({
          title: "Berhasil Ganti Password",
          text: "",
          type: "success",
          showConfirmButton: true,
          confirmButtonText: "OKEE"
          });
          </script>';
          //mengirim email ke pelanggan dengan phpmailer
          require_once(APPPATH.'libraries/phpmailer/Exception.php');
          require_once(APPPATH.'libraries/phpmailer/PHPMailer.php');
          require_once(APPPATH.'libraries/phpmailer/SMTP.php');

          $mail = new PHPMailer();
          $mail->isSMTP();
          $mail->Host = 'smtp.googlemail.com';
          $mail->SMTPAuth = true;
            $mail->Username = 'mulwidodo.id@gmail.com'; // Email gmail anda
            $mail->Password = 'evubquxtvgbixsuz'; // Password gmail anda
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('mulwidodo.id@gmail.com' , 'ALIMOCHTAR
 Development'); // Email dan nama pengirim
          $mail->addAddress($data['email']); // Email dan nama penerima
          $mail->Subject = 'Selamat '.$data['nama_rt'].' Password anda berhasil di ganti'; // Subject email
          $mail->isHTML(true);
          $content = '</p><table><thead><tr><td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>'.
          '<br>Berhasil mengganti password, berikut data akun anda :'.
          '<br><br>Nama : '.$this->input->post('nama_rt') .
          '<br>Password : '.$this->input->post('password') .
          '<br><br><p align=center colspan=2 style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif>
          <a href="https://wifi.alimochtar.my.id" style=color:rgb(255,255,255);background-color:#589bf2;border-width:initial;border-style:none;border-radius:15px;padding:10px 20px target=_blank >' .
          '<b>Login Aplikasi Data Penduduk</b></a></p>' .
          '<br></td></tr></thead></table>
          <table><thead>
          <tr><td></td></tr>
          <tr>
          <td style=padding-left:1em;padding-right:1em>
          <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEj9P6_1rH4mL3IjXxJOmoTKWJ8I6UX5I-mHA8A4dBwMSxyYuPzUqBA-YsTRkimTdQh0BR2WBFSxajwJmDoRq7ac0HnM_4J75oY_rw-NGu99XQybl_11Xar3uAczezbYTGuOZKiJOHkIbdvFTTg9qg5U_7ngrJhzuPKWlj44SW63A5rnNnFaygl5tQTEL2b5/s320/1.png width=35%>
          </a>

          <a>
          <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjC5Mp5v38mR-nYiS9p_PFv6BBI5Ith_M6uDS7eHvV9bkJrJ7AGFYD0YpgeUPi4RL3jtn7e_EGILxgZJlEyzCR17NlcteDFANGns6GU-pGx02zGoODn3z-7fa53b_R232pQSeonBKCGy1dQ54Y4ZwP7brKNM8cZjPDqHrAxCYbjgS8IC4F4ARvsT0OfA2BI/s1080/ALI%20MOCHTAR%20PRODUCTIONS%20new.png width=35%>
          </a>

          <br>

          <a>
          <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhTPrj6pqnRpOJYS3mE1uHuklZOjrAiAntzsoUs6tS82q5SvjOzp2twSbHXVXfHyDT6T9h_wTPiDwr8gXM32EBYOoAaaZRkXWZ0-AiyIBjMucOyM5LhxNs685WWl4jMpLk04uG-zuicmjZENILYz84lPBfZDPtsXEvqOgMCLxKBBSKARc3i8s2U3F_A7Nwe/s320/ALIMOCHTAR.png width=35%>
          </a>

          <a>
          <img src=https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEju-tIQXsJdkzqY57uxOHH6vv2gl_vypaXn7MQpKMBG8f4byI-K3SVe791130gClSEsdnnNm_dur1mbPeBSVA-L4_osdeOpubrJN0Ppy3Y530VdFAWkwR5WL2Hdnso_Nu02GFthc7DnTaXyRwLWiQqlgfSyF7k1s4ssOHCRkwTMIjr7LGyTnC9cDc__cMPF/s320/WhatsApp%20Image%202023-08-26%20at%2006.16.57.jpeg width=35%>
          </a>

          </td>
          </tr>
          </thead></table>
          <p style=font-size:16px>
          <i>Pesan ini dikirim otomatis oleh system aplikasi Data Penduduk</i>
          <br><img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjC5Mp5v38mR-nYiS9p_PFv6BBI5Ith_M6uDS7eHvV9bkJrJ7AGFYD0YpgeUPi4RL3jtn7e_EGILxgZJlEyzCR17NlcteDFANGns6GU-pGx02zGoODn3z-7fa53b_R232pQSeonBKCGy1dQ54Y4ZwP7brKNM8cZjPDqHrAxCYbjgS8IC4F4ARvsT0OfA2BI/s320/ALI%20MOCHTAR%20PRODUCTIONS%20new.png">
          <br><b>~ cs@alimochtar.my.id ~</b></p>' ;

          $mail->Body = $content;
          if ($mail->send());
          $this->session->set_flashdata('pesan', '<script>
            swal({
              title: "Berhasil",
              text: "Selamat Password anda berhasil di perbaharui",
              type: "success",
              showConfirmButton: true,
              confirmButtonText: "OKEE"
              });
              </script>');
          redirect(base_url('login'));
        }else{
          echo $this->upload->display_errors();
        }
      }else{
        $this->load->view('other/password_baru',$x);
      }
    }



  }