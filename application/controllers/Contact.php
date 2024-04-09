<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // needed ???
        $this->load->database();
    }  
        
    public function index()
    {
     $view = array('judul'  =>'Contact');
     $this->load->view('other/contact',$view);
    }

}