<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_controller
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
	 $this->load->model('M_admin');
	 $this->load->model('M_count');
	 $this->load->model('M_informasi');
	}

	public function index()
	{
		$id  = $this->session->userdata('id_rt');
		$data= $this->db->get_where('tb_rt',array('id_rt'=>$id))->row_array();
	 $view = array(
        'judul'             =>'Halaman Administrator',
        'count_kk'          => $this->M_count->count_kk_rt(),
        'count_anggota'     => $this->M_count->count_anggota_rt_laki()+$this->M_count->count_anggota_rt_perempuan(),
		'count_kk_laki'     => $this->M_count->count_anggota_rt_laki(),
		'count_kk_perempuan'=> $this->M_count->count_anggota_rt_perempuan(),
		'no_rt'             => $data['no_rt'],
		'alamat'            => $data['alamat'],
		'informasi'         => $this->M_informasi->view(),
     );
	 $this->load->view('ketua_rt/home',$view);
	}

	
}