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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('m_rt');
	 $this->load->model('M_count');
	}

	public function index()
	{
		$datart = $this->m_rt->view()->row_array();
	 $view = array(
        'judul'             =>'Halaman Administrator',
        'count_rt'          => $this->M_count->count_rt(),
        'count_kk'          => $this->M_count->count_kk(),
        'count_anggota'     => $this->M_count->count_anggota_laki()+$this->M_count->count_anggota_perempuan(),
		'count_kk_laki'     => $this->M_count->count_anggota_laki(),
		'count_kk_perempuan'=> $this->M_count->count_anggota_perempuan(),
		
		'data'        				=>$this->m_rt->view()->result_array(),
		// 'admin_count_kk'          	=> $this->M_count->admin_count_kk_rt($datart['id_rt']),
        // 'admin_count_anggota'     	=> $this->M_count->admin_count_anggota_rt_laki($datart['id_rt'])+$this->M_count->admin_count_anggota_rt_perempuan($datart['id_rt']),
		// 'admin_count_kk_laki'     	=> $this->M_count->admin_count_anggota_rt_laki($datart['id_rt']),
		// 'admin_count_kk_perempuan'	=> $this->M_count->admin_count_anggota_rt_perempuan($datart['id_rt']),

     );
	 $this->load->view('admin/home',$view);
	}

	
}
?>