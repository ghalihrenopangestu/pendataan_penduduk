<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ketua_rt extends CI_controller
{
  function __construct()
  {
    parent:: __construct();
    $this->load->helper('url');
    $this->load->database();
    $this->load->library('session');
    $this->load->library('form_validation');
    if($this->session->userdata('admin') != TRUE){
      redirect(base_url(''));
      exit;
    };
    $this->load->model('m_rt');
  }


// Di dalam kontroler Ketua_rt.php
  public function export_pdf()
  {
    // Load library Dompdf
    require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

    $dompdf = new Dompdf();
    $html = '<h1 style="text-align: center;">Data Ketua RT</h1>'; // Title centered

    // Mendapatkan data dari model atau sumber data lainnya
    $data = $this->m_rt->view();

    // Use CSS for table styling
    $html .= '<style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    </style>';

    $html .= '<table>
    <tr>
    <th>No</th>
    <th>No RT</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>No HP</th>
    <th>Email</th>
    </tr>';

    $no = 1; // Inisialisasi nomor urut
    foreach ($data->result_array() as $rt) {
      $html .= '<tr>';
      $html .= '<td>' . $no . '</td>';
      $html .= '<td>' . $rt['no_rt'] . '</td>';
      $html .= '<td>' . $rt['nama_rt'] . '</td>';
      $html .= '<td>' . $rt['alamat'] . '</td>';
      $html .= '<td>' . $rt['no_hp'] . '</td>';
      $html .= '<td>' . $rt['email'] . '</td>';
      $html .= '</tr>';
      $no++;
    }

    $html .= '</table>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("DataKetuaRT.pdf", array("Attachment" => false));
  }



  public function export_excel()
  {
    require_once APPPATH . 'third_party/PhpSpreadsheet/autoload.php';

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add title
    $title = 'Data Ketua RT';
    $sheet->setCellValue('A1', $title);
    $sheet->mergeCells('A1:F1');
    $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Add table headers
    $sheet->setCellValue('A2', 'No');
    $sheet->setCellValue('B2', 'No RT');
    $sheet->setCellValue('C2', 'Nama');
    $sheet->setCellValue('D2', 'Alamat');
    $sheet->setCellValue('E2', 'No HP');
    $sheet->setCellValue('F2', 'Email');

    // Style table headers
    $headerStyle = [
      'font' => ['bold' => true],
      'alignment' => ['horizontal' => PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
      'borders' => ['allBorders' => ['borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
    ];
    $sheet->getStyle('A2:F2')->applyFromArray($headerStyle);

    // Mendapatkan data dari model atau sumber data lainnya
    $data = $this->m_rt->view();
    $no = 1;
    $row = 3; // Start from the next row

    foreach ($data->result_array() as $rt) {
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $rt['no_rt']);
      $sheet->setCellValue('C' . $row, $rt['nama_rt']);
      $sheet->setCellValue('D' . $row, $rt['alamat']);
      $sheet->setCellValue('E' . $row, $rt['no_hp']);
      $sheet->setCellValue('F' . $row, $rt['email']);

        // Set auto column width for each cell
      foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
      }

      $row++;
      $no++;
    }

    // Apply border to the table cells
    $tableStyle = [
      'borders' => ['allBorders' => ['borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
    ];
    $sheet->getStyle('A2:F' . ($row - 1))->applyFromArray($tableStyle);

    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DataKetuaRT.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }



  //rt
  public function index($value='')
  {
    $kode_tahun = date('Y');
    $view = array('judul'   =>'Data Ketua RT',
      'data'        =>$this->m_rt->view(),);
    $this->load->view('admin/rt/form',$view);
  }

  private function acak_id($panjang)
  {
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter) - 1);
      $string .= $karakter[$pos];
    }
    return $string;
  }

   //mengambil id rt urut terakhir
  private function id_rt_urut($value='')
  {
    $this->m_rt->id_urut();
    $query = $this->db->get();
    $data = $query->row_array();
    $id = $data['id_rt'];
    $urut = substr($id, 1, 3);
    $tambah = (int) $urut + 1;
    $karakter = $this->acak_id(12);

    if (strlen($tambah) == 1) {
      $newID = "RT"."00".$tambah.$karakter;
    } elseif (strlen($tambah) == 2) {
      $newID = "RT"."0".$tambah.$karakter;
    } elseif (strlen($tambah) == 3) {
      $newID = "RT".$tambah.$karakter;
    } // <-- Tambahkan kurung kurawal ini
    return $newID;
  }



  public function add($value='') {    
    if (isset($_POST['kirim'])) {
      $this->load->library('form_validation');
      $rules = array(
        array(
          'field' => 'nama_rt',
          'label' => 'Nama RT',
          'rules' => 'required'
        ),
        array(
          'field' => 'no_rt',
          'label' => 'No RT',
          'rules' => 'required'
        ),
        array(
          'field' => 'alamat',
          'label' => 'Alamat',
          'rules' => 'required'
        ),
        array(
          'field' => 'password',
          'label' => 'Password'
        ),
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('pesan', '<script>
          swal({
            text: "Data tidak boleh kosong",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE"
            });
            </script>');
        redirect('admin/ketua_rt');
      }
      else


      //cek nomor hp sudah pernah terdaftar
        $proses_cek=$this->db->get_where('tb_rt',array('no_hp'=>$this->input->post('no_hp')))->num_rows();
      if ($proses_cek > 0) {
        $this->session->set_flashdata('pesan', '<script>
          swal({
            text: "Nomor HP sudah pernah digunakan mendaftar, silakan menggunakan nomor HP yang lain",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE"
            });
            </script>');
        redirect('admin/ketua_rt');
      }
      else
      //cek alamat sudah pernah terdaftar
        $proses_cek=$this->db->get_where('tb_rt',array('alamat'=>$this->input->post('alamat')))->num_rows();
      if ($proses_cek > 0) {
        $this->session->set_flashdata('pesan', '<script>
          swal({
            text: "Alamat sudah terdaftar",
            type: "error",
            showConfirmButton: true,
            confirmButtonText: "OKEE"
            });
            </script>');
        redirect('admin/ketua_rt');
      }
      else

        $SQLinsert=array(
          'id_rt'             =>$this->id_rt_urut(),
          'no_rt'             =>$this->input->post('no_rt'),
          'nama_rt'           =>$this->input->post('nama_rt'),
          'alamat'            =>$this->input->post('alamat'),
          'no_hp'             =>$this->input->post('no_hp'),
          'email'             =>$this->input->post('email'),
          'password'          =>md5($this->input->post('password'))
        );

      if ($this->m_rt->add($SQLinsert)) {

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
        redirect(base_url('admin/ketua_rt'));
      }
    }

  }

  public function edit($id='') {
    if(isset($_POST['kirim'])){
      $SQLupdate=array(
        'no_rt'             =>$this->input->post('no_rt'),
        'nama_rt'              =>$this->input->post('nama_rt'),
        'alamat'            =>$this->input->post('alamat'),
        'no_hp'             =>$this->input->post('no_hp'),
        'email'             =>$this->input->post('email')

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
        redirect(base_url('admin/ketua_rt'));
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
          redirect(base_url('admin/ketua_rt'));
        }
      }
    }


    public function hapus($id='')
    {

      $cek=$this->m_rt->delete($id);
      if ($cek) {
       $pesan='<script>
       swal({
        title: "Berhasil Hapus Data",
        text: "",
        type: "success",
        showConfirmButton: true,
        confirmButtonText: "OKEE"
        });
        </script>';
        $this->session->set_flashdata('pesan',$pesan);
        redirect(base_url('admin/ketua_rt'));
      }else{
        $pesan='<script>
        swal({
          title: "Gagal Hapus Data",
          text: "",
          type: "error",
          showConfirmButton: true,
          confirmButtonText: "OKEE"
          });
          </script>';
          $this->session->set_flashdata('pesan',$pesan);
          redirect(base_url('admin/ketua_rt'));
        }
      }
    }
    ?>

