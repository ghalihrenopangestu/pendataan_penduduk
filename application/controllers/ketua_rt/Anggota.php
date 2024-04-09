<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    if($this->session->userdata('ketua_rt') != TRUE){
     redirect(base_url(''));
     exit;
   };
   $this->load->model('m_kk');
   $this->load->model('m_anggota');
 }

 public function index($value='')
 { 
   $view = array('judul'    =>'Data Penduduk RT '.$this->session->userdata('no_rt'),
    'data'    =>$this->m_anggota->view_anggota_kk(),
  );
   $this->load->view('ketua_rt/penduduk/form', $view);
 }

 private function datetime()
 {
  date_default_timezone_set('Asia/Jakarta');
  $date = date('Y-m-d H:i:s');
  return $date;
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
  } elseif (strlen($tambah) == 2){
    $newID = "A"."0".$tambah.$karakter;
  } elseif (strlen($tambah) == 3){
    $newID = "A".$tambah.$karakter;
  }
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
      redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$this->input->post('id_kk')));
    }else

    $SQLinsert=array(
     'id_anggota'             =>$this->id_anggota_urut(),
     'id_rt'                  =>$this->session->userdata('id_rt'),
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
      $cek=$this->m_kk->update($id=$this->input->post('id_kk'),$SQLUpdate1);
      
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
       redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$this->input->post('id_kk')));
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
    $cek=$this->m_kk->update($id=$this->input->post('id_kk'),$SQLUpdate1);
    
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
        redirect(base_url('ketua_rt/kepala_keluarga/detail/'.$this->input->post('id_kk')));
      }else{
       echo "QUERY SQL ERROR";
       
     }
   }else{
     $this->load->view('ketua_rt/kepala_keluarga/form_detail',$x);
   }
 }
 
 
 public function hapus($id='')
 {

  $cek=$this->m_anggota->delete($id);
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
    redirect(base_url('ketua_rt/kepala_keluarga'));
  }
  else{
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
      redirect(base_url('ketua_rt/kepala_keluarga'));
    }
  }
  
// Export PDF DataPenduduk RT
  public function export_pdf()
  {
    require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

    // Include helper file
    require_once APPPATH . 'helpers/custom_helper.php';

    $data = $this->m_anggota->view_anggota_kk();

    // Periksa jika data kosong
    if (empty($data)) {
        // Tangani kasus ketika tidak ada data yang ditemukan
        // Misalnya, tampilkan pesan kesalahan atau redirect
        // ...
      return;
    }

    // Lanjutkan dengan pembuatan PDF
    $dompdf = new Dompdf();
    $html = '
    <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 10px;
    }
    .center {
      text-align: center;
    }
    .label {
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
    }
    th, td {
      padding: 8px;
      text-align: left;
    }
    th {
      font-weight: bold;
    }
    </style>

    <div class="center"><h1>Data Penduduk RT ' . $this->session->userdata('no_rt') . '</h1></div>';

    $html .= '
    <table>
    <tr>
    <th>No</th>
    <th>Kepala Keluarga</th>
    <th>No KK</th>
    <th>Nama Anggota</th>
    <th>NIK</th>
    <th>No HP</th>
    <th>Jenis Kelamin</th>
    <th>Tempat Lahir</th>
    <th>Tanggal Lahir</th>
    <th>Usia</th>
    <th>Agama</th>
    <th>Pendidikan</th>
    <th>Pekerjaan</th>
    <th>Hubungan</th>
    </tr>';

    $no = 1;
    foreach ($data->result_array() as $anggota) {
      $html .= '
      <tr>
      <td>' . $no . '</td>
      <td>' . $anggota['nama_kk'] . '</td>
      <td>' . $anggota['no_kk'] . '</td>
      <td>' . $anggota['nama'] . '</td>
      <td>' . $anggota['nik'] . '</td>
      <td>' . $anggota['no_hp_anggota'] . '</td>
      <td>' . $anggota['jenis_kelamin'] . '</td>
      <td>' . $anggota['tempat_lahir'] . '</td>
      <td>' . tgl_indo($anggota['tgl_lahir']) . '</td>
      <td>' . hitung_usia($anggota['tgl_lahir']) . ' tahun</td>
      <td>' . $anggota['agama'] . '</td>
      <td>' . $anggota['pendidikan'] . '</td>
      <td>' . $anggota['pekerjaan'] . '</td>
      <td>' . $anggota['hubungan'] . '</td>
      </tr>';
      $no++;
    }

    $html .= '</table></div>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Atur orientasi ke landscape
    $dompdf->render();
    $dompdf->stream("DataPenduduk RT " . $this->session->userdata('no_rt') . ".pdf", array("Attachment" => false));

  }

// Export Excel DataPenduduk RT
  public function export_excel()
  {
    require_once APPPATH . 'third_party/PhpSpreadsheet/autoload.php';
     // Include helper file
    require_once APPPATH . 'helpers/custom_helper.php';

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $data = $this->m_anggota->view_anggota_kk();

    // Set title and merge cells
    $title = 'Data Penduduk RT ' . $this->session->userdata('no_rt');
    $sheet->setCellValue('A1', $title);
    $sheet->mergeCells('A1:O1');
    $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



    // Set column headers for anggota
    $columnHeaders = [
      'No','Kepala Keluarga', 'No KK','Nama Anggota', 'NIK', 'No HP', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir','Usia',
      'Agama', 'Pendidikan',
      'Pekerjaan', 'Hubungan'
    ];

    // Set headers in row 3
    $row = 3;
    $col = 'A';
    foreach ($columnHeaders as $header) {
      $sheet->setCellValue($col . $row, $header);
      $col++;

    // Apply border style to header cell
      $headerCell = 'A' . $row . ':N' . $row;
      $sheet->getStyle($headerCell)->applyFromArray([
        'borders' => [
          'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
          ],
        ],
        'font' => [
          'bold' => true,
        ],
      ]);
    }

    $data = $this->m_anggota->view_anggota_kk();

    $no = 1;

    foreach ($data->result_array() as $anggota) {
      $row++;
      $sheet->setCellValue('A' . $row, $no);
      $sheet->setCellValue('B' . $row, $anggota['nama_kk']);
      $sheet->setCellValueExplicit('C' . $row, $anggota['no_kk'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('D' . $row, $anggota['nama']);
      $sheet->setCellValueExplicit('E' . $row, $anggota['nik'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('F' . $row, $anggota['no_hp_anggota'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('G' . $row, $anggota['jenis_kelamin']);
      $sheet->setCellValue('H' . $row, $anggota['tempat_lahir']);
      $sheet->setCellValue('I' . $row, tgl_indo($anggota['tgl_lahir']));
        $sheet->setCellValue('J' . $row, hitung_usia($anggota['tgl_lahir']) . ' Tahun'); // usia dalam format "14 Tahun"
        $sheet->setCellValue('K' . $row, $anggota['agama']);
        $sheet->setCellValue('L' . $row, $anggota['pendidikan']);
        $sheet->setCellValue('M' . $row, $anggota['pekerjaan']);
        $sheet->setCellValue('N' . $row, $anggota['hubungan']);

       // Set border style for each cell
        $cellRange = 'A' . $row . ':N' . $row;
        $sheet->getStyle($cellRange)->applyFromArray([
          'borders' => [
            'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
              'color' => ['argb' => '000000'],
            ],
          ],
        ]);

        $no++;
      }

    // Set auto column width for each cell
      foreach (range('A', 'N') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
      }

      $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
      ob_end_clean();
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="DataPenduduk RT ' . $this->session->userdata('no_rt') . '.xlsx"');
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
    }


  }