<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_controller
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

	}

    //lattidude and longitude saja
    private function get_data()
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('tb_maps');
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_maps = tb_maps.id_maps');
        $this->db->where('status_plg', 'Aktif');
        $this->db->order_by('nama');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $data[] = array(
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'no_hp' => $row->no_hp,
                'latitude' => $row->latitude,
                'longitude' => $row->longitude
            );
        }
        //menjadilan data json
        $data = json_encode($data);
        return $data;
    }

    public function index()
    {
        $view = array('judul'  =>'Data Peta Pelanggan',
	            'data'         => $this->get_data(),);
        $this->load->view('admin/maps/maps', $view);
    }

 }
