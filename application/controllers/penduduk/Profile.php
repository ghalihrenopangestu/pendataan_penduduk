<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Profile extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      
	 // error_reporting(0);
	 if($this->session->userdata('ketua_rt') != TRUE){
     redirect(base_url(''));
     exit;
	};
    $this->load->model('m_rt');
	}

  //rt
  public function index($id='')
  {
    $data=$this->m_rt->view_id_rt($id)->row_array();
  $x = array(
    'aksi'            =>'lihat',
    'judul'           =>'Data Akun Profile',
    'id_rt'           =>$data['id_rt'],
    'no_rt'           =>$data['no_rt'],
    'nama_rt'         =>$data['nama_rt'],
    'alamat'          =>$data['alamat'],
    'no_hp'           =>$data['no_hp'],
    'password'        =>$data['password'],
  );
    $this->load->view('ketua_rt/profile/form',$x);
  }
      
    public function edit($id='') {
      if(isset($_POST['kirim'])){
        $SQLupdate=array(
          'nama_rt'           =>$this->input->post('nama_rt'),
          'alamat'            =>$this->input->post('alamat'),
          'no_hp'             =>$this->input->post('no_hp')

        );
        $cek=$this->m_rt->update($id,$SQLupdate);
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
       redirect(base_url('ketua_rt/profile'));
        }
      }
    }

    public function ganti_password($id='') {
        if (isset($_POST['kirim'])) {
            $SQLinsert=array(
                'password'    =>md5($this->input->post('password'))
        );
        $cek=$this->m_rt->update($id,$SQLinsert);
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
             $this->session->set_flashdata('pesan',$pesan);
          redirect(base_url('ketua_rt/profile'));
        }
      }
  }
  
	
}