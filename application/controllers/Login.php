<?php
/* Halaman login utama 
   Author: Ismarianto Putra Tech Programmer 
*/

   class Login extends CI_controller
   {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_m'); // Memuat model Login_m
        $this->load->library('session'); // Load session library
    }

    public function index()
    {
        if(isset($_POST['login'])) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $admin = $this->Login_m->admin($email, md5($password));
            $ketua_rt = $this->Login_m->ketua_rt($email, $email, md5($password));

            if($admin->num_rows() > 0) {
                $dataAdmin = $admin->row_array();
                $sessionAdmin = array(
                    'admin' => TRUE,
                    'id_admin' => $dataAdmin['id_admin'],
                    'nama' => $dataAdmin['nama'],
                    'level' => $dataAdmin['level']
                );
                $this->session->set_userdata($sessionAdmin);
                $this->session->set_flashdata('pesan','<div class="btn btn-primary">Anda Berhasil Login .....</div>');
                redirect(base_url('admin/home'));
            } elseif($ketua_rt->num_rows() > 0) {
                $dataKetuaRT = $ketua_rt->row_array();
                $sessionKetuaRT = array(
                    'ketua_rt' => TRUE,
                    'id_rt' => $dataKetuaRT['id_rt'],
                    'no_rt' => $dataKetuaRT['no_rt'],
                    'nama' => $dataKetuaRT['nama_rt'],
                    'no_hp' => $dataKetuaRT['no_hp'],
                    'level' => 'ketua_rt'
                );
                $this->session->set_userdata($sessionKetuaRT);
                $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
                redirect(base_url('ketua_rt/home'));
            } else {
                $pesan = '<script>
                swal({
                    title: "Username / Password Salah Atau Akun Anda Tidak Aktif",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>';
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('login'));
                }
            } else {
                $data['judul'] = 'Login Aplikasi';
            $data['pesan'] = $this->session->flashdata('pesan'); // Tambahkan ini
            $this->load->view('login', $data);
        }
    }
}
?>
