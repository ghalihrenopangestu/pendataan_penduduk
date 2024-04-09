<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_controller
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
        $this->load->model('m_email');
        $this->load->model('m_tagihan');
    }

    public function view_email($value='')
    {
        //untuk API view data pelanggan
        $data = $this->m_email->sendmail_semua();
        $data = $data->result_array();
        echo json_encode($data);
    }

    public function send_mail_all($value='')
    {
        //untuk API send email ke semua pelanggan
        $data = $this->m_tagihan->sendmail_bl();
        $data = $data->result_array();
        echo json_encode($data);
    }

}