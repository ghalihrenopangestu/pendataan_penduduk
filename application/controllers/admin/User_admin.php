<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User_admin extends CI_controller
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
	 $this->load->model('m_admin');
	}

//user_admin
public function index($value='')
{
 $view = array('judul'  =>'Data Admin',
            'data'      =>$this->m_admin->view(),);
  $this->load->view('admin/user/user_admin',$view);
}


public function tambah($value='') {
  if (isset($_POST['kirim'])) {
            
$SQLinsert=array(
'nama'                =>$this->input->post('nama'),
'email'            =>$this->input->post('email'),
'password'            =>md5($this->input->post('password')),
'level'               =>'Administrator'
);

$cek=$this->m_admin->add($SQLinsert);
if($cek){
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
    redirect(base_url('admin/user_admin'));
    }
  }
}

    
  public function edit($id='') {	
    if(isset($_POST['kirim'])){
      $SQLupdate=array(
      	'nama'                      =>$this->input->post('nama'),
        'email'                  =>$this->input->post('email'),
        'password'                  =>md5($this->input->post('password')),
      );
      $cek=$this->m_admin->update($id,$SQLupdate);
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
	 	redirect(base_url('admin/user_admin'));
      }
    }
	}

	
	public function hapus($id='')
	{
    $cek=$this->m_admin->delete($id);
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
	 	redirect(base_url('admin/user_admin'));
	 }
	}

public function keluar($value='')
{

$this->session->sess_destroy();
echo "<script>alert('Anda Telah Keluar Dari Halaman Administrator')</script>";;
redirect(base_url(''));
}

	
}
?>