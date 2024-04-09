<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_controller
{
    public function __construct()
    {
        parent:: __construct();
        // error_reporting(0);
    //     if($this->session->userdata('admin') != TRUE){
    //     redirect(base_url(''));
    //     exit;
    //    };
        $this->load->model('m_pelanggan');
        $this->load->model('m_paket');
        $this->load->model('m_promo');
    }

    public function view($value='')
	{
        //untuk API view data pelanggan
        $data = $this->m_pelanggan->view();
        $data = $data->result_array();
        echo json_encode($data);
	}

    public function promo_view($value='')
    {
        //untuk API view data promo
        $data = $this->m_promo->promo_view();
        $data = $data->result_array();
        echo json_encode($data);
    }

}