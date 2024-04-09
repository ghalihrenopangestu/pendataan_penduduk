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
    if($this->session->userdata('ketua_rt') != TRUE){
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
  $this->load->view('ketua_rt/informasi/form',$view);
}

}

