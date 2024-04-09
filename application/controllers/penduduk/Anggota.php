<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Anggota extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	//  if($this->session->userdata('penduduk') != TRUE){
  //    redirect(base_url(''));
  //    exit;
	// };
    $this->load->model('m_anggota');
    $this->load->model('m_penduduk');
	}

  private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }

  private function datetime()
   {
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    return $date;
   }
  
  //mengambil id anggota urut terakhir
  private function id_anggota_urut($value='')
  {
   $this->m_anggota->id_urut();
   $query    = $this->db->get();
   $data     = $query->row_array();
   $id       = $data['id_anggota'];
   $urut     = substr($id, 1, 3);
   $tambah   = (int) $urut + 1;
   $karakter = $this->acak_id(12);
   
   if (strlen($tambah) == 1){
   $newID = "A"."00".$tambah.$karakter;
      }else if (strlen($tambah) == 2){
      $newID = "A"."0".$tambah.$karakter;
         }else (strlen($tambah) == 3){
         $newID = "A".$tambah.$karakter
           };
    return $newID;
  }

   
  public function add($value='') {
        
   if (isset($_POST['kirim'])) {
    $rules = array(
      array(
          'field' => 'nik',
          'label' => 'NIK',
          'rules' => 'required|numeric|is_unique[tb_anggota.nik]',
          'errors' => array(
              'required' => 'NIK tidak boleh kosong',
              'numeric' => 'NIK harus berupa angka',
              'is_unique' => 'NIK sudah terdaftar',
          ),
      ),
      array(
          'field' => 'nama',
          'label' => 'Nama',
          'rules' => 'required',
          'errors' => array(
              'required' => 'Nama tidak boleh kosong',
          ),
      )
  );
  $this->form_validation->set_rules($rules);
  if ($this->form_validation->run() == FALSE) {
      $pesan='<script>
          swal({
              title: "'.form_error('nik').form_error('nama').'",
              text: "",
              type: "error",
              showConfirmButton: true,
              confirmButtonText: "OKEE"
              });
      </script>';
      $this->session->set_flashdata('pesan',$pesan);
      redirect(base_url('penduduk/kepala_keluarga/detail/'.$this->input->post('id_kk')));
  }else

     $SQLinsert=array(
           'id_anggota'             =>$this->id_anggota_urut(),
           'id_rt'                  =>$this->input->post('id_rt'),
           'id_kk'                  =>$this->input->post('id_kk'),
           'nik'                    =>$this->input->post('nik'),
           'nama'                   =>$this->input->post('nama'),
           'no_hp_anggota'          =>$this->input->post('no_hp_anggota'),
           'jenis_kelamin'          =>$this->input->post('jenis_kelamin'),
           'tgl_lahir'              =>$this->input->post('tgl_lahir'),
           'tempat_lahir'           =>$this->input->post('tempat_lahir'),
           'agama'                  =>$this->input->post('agama'),
           'pendidikan'             =>$this->input->post('pendidikan'),
           'pekerjaan'              =>$this->input->post('pekerjaan'),
           'hubungan'               =>$this->input->post('hubungan'),
           'perkawinan'             =>$this->input->post('perkawinan'),
           'kewarganegaraan'        =>$this->input->post('kewarganegaraan'),
           'nama_ayah'              =>$this->input->post('nama_ayah'),
           'nama_ibu'               =>$this->input->post('nama_ibu')
         );
 
         if ($this->m_anggota->add($SQLinsert)) {

            $SQLUpdate1=array(
                'tgl_update'             =>$this->datetime(),
                );
            $cek=$this->m_penduduk->update($id=$this->input->post('token'),$SQLUpdate1);
 
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
     redirect(base_url('penduduk/kepala_keluarga/detail/'.$this->input->post('token')));
    }
   }
}


public function edit($id='')
{
    
 if (isset($_POST['kirim'])) {     

    $SQLupdate=array(
    'nik'               =>$this->input->post('nik'),
    'nama'              =>$this->input->post('nama'),
    'no_hp_anggota'     =>$this->input->post('no_hp_anggota'),
    'jenis_kelamin'     =>$this->input->post('jenis_kelamin'),
    'tgl_lahir'         =>$this->input->post('tgl_lahir'),
    'tempat_lahir'      =>$this->input->post('tempat_lahir'),
    'agama'             =>$this->input->post('agama'),
    'pendidikan'        =>$this->input->post('pendidikan'),
    'pekerjaan'         =>$this->input->post('pekerjaan'),
    'hubungan'          =>$this->input->post('hubungan'),
    'perkawinan'        =>$this->input->post('perkawinan'),
    'kewarganegaraan'   =>$this->input->post('kewarganegaraan'),
    'nama_ayah'         =>$this->input->post('nama_ayah'),
    'nama_ibu'          =>$this->input->post('nama_ibu'),
    );

  $cek=$this->m_anggota->update($id,$SQLupdate);

  $SQLUpdate1=array(
    'tgl_update'             =>$this->datetime(),
     );
  $cek=$this->m_penduduk->update($id=$this->input->post('token'),$SQLUpdate1);
  if($cek){
    	$pesan='<script>
              swal({
                  title: "Berhasil Perbarui Data '.$this->input->post('nama').'",
                  text: "",
                  type: "success",
                  showConfirmButton: true,
                  confirmButtonText: "OKEE"
                  });
          </script>';
  	 	$this->session->set_flashdata('pesan',$pesan);
  	 	redirect(base_url('penduduk/kepala_keluarga/detail/'.$this->input->post('token')));
  }else{
   echo "QUERY SQL ERROR";
  
       }
      }else{
      	$this->load->view('penduduk/kepala_keluarga/form_detail',$x);
      }
    }

	
}