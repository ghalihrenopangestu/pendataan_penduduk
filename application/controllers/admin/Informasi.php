<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Informasi extends CI_controller
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
     $this->load->model('m_informasi');
 }

      //informasi
 public function index($value='')
 {
    $kode_tahun = date('Y');
    $view = array('judul'   =>'Data Informasi',
      'data'        =>$this->m_informasi->view(),);
    $this->load->view('admin/informasi/form',$view);
}

private function acak_id($panjang)
{
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter[$pos];
    }
    return $string;
}

   //mengambil id informasi urut terakhir
private function id_informasi_urut($value='')
{
    $this->m_informasi->id_urut();
    $query    = $this->db->get();
    $data     = $query->row_array();
    $id       = $data['id_informasi'];
    $urut     = substr($id, 1, 3);
    $tambah   = (int) $urut + 1;
    $karakter = $this->acak_id(6);
    
    if (strlen($tambah) == 1){
        $newID = "I"."00".$tambah.$karakter;
    }else if (strlen($tambah) == 2){
       $newID = "I"."0".$tambah.$karakter;
   } elseif (strlen($tambah) == 3) {
      $newID = "I".$tambah.$karakter;
  }

  return $newID;
}


public function add($value='') {    
  $this->load->library('form_validation');
  
  if (isset($_POST['kirim'])) {
    $this->form_validation->set_rules('informasi', 'Informasi', 'required'); 
    
    if ($this->form_validation->run()) {
      $SQLinsert = [
        'id_informasi'  => $this->id_informasi_urut(),
        'informasi'     => $this->input->post('informasi'),
    ];
    
    if ($this->m_informasi->add($SQLinsert)) {
      
     $pesan='<script>
     swal({
        title: "Berhasil Menambahkan Data",
        text: "",
        type: "success",
        showConfirmButton: true,
        confirmButtonText: "OKEE"
        });
        </script>';
        $this->session->set_flashdata('pesan',$pesan);
        redirect(base_url('admin/informasi'));
    }
}
}
}

public function edit($id='') {
  if(isset($_POST['kirim'])){
    $SQLupdate=array(
      'informasi'               =>$this->input->post('informasi'),
  );
    $cek=$this->m_informasi->update($id,$SQLupdate);
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
        redirect(base_url('admin/informasi'));
    }
}
}

private function berkas($value='')
{
  $config['upload_path']          = './themes/file_informasi/';
  $config['allowed_types']        = 'pdf|doc|docx|xls|xlsx|ppt|pptx|jpg|png|jpeg|txt';
  $config['max_size']             = 10000;
  $config['max_width']            = 10000;
  $config['max_height']           = 10000;
  $config['encrypt_name']         = FALSE;
  $this->load->library('upload', $config);
  if ( ! $this->upload->do_upload('berkas')){
    $pesan='<script>
    swal({
        title: "Ekstensi File Tidak Sesuai",
        text: "",
        type: "error",
        showConfirmButton: true,
        confirmButtonText: "OKEE"
        });
        </script>';
        $this->session->set_flashdata('pesan',$pesan);
        redirect(base_url('admin/informasi'));
    }else{
        $data = array('upload_data' => $this->upload->data());
        return $data['upload_data']['file_name'];
    }
}

public function file($id='') {	
  if(isset($_POST['kirim'])){
    $SQLupdate=array(
      'berkas'               =>$this->berkas(),
  );
    $cek=$this->m_informasi->update($id,$SQLupdate);
    if($cek){
     $pesan='<script>
     swal({
        title: "Berhasil Upload file informasi",
        text: "",
        type: "success",
        showConfirmButton: true,
        confirmButtonText: "OKEE"
        });
        </script>';
        $this->session->set_flashdata('pesan',$pesan);
        redirect(base_url('admin/informasi'));
    }
}
}


public function hapus($id='')
{
      //hapus file di folder berdasarkan id
  $data=$this->m_informasi->view_id($id)->row_array();
  $file=$data['berkas'];
  unlink('./themes/file_informasi/'.$file);
      //hapus data di database
  $cek=$this->m_informasi->delete($id);
  if ($cek) {
   $pesan='<script>
   swal({
    title: "Berhasil Hapus Data",
    text: "",
    type: "success",
    showConfirmButton: true,
    confirmButtonText: "OKEE"
    });
    </script>';
    $this->session->set_flashdata('pesan',$pesan);
    redirect(base_url('admin/informasi'));
}
}


}
?>