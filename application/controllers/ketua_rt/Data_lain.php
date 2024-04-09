<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Data_lain extends CI_controller
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
     $this->load->model('m_data_lain');
     $this->load->model('m_rt');
 }

  //kk
 public function index($id='')
 {
    $kode_tahun = date('Y');
    $view = array('judul'   =>'Data Lainnya RT '.$this->session->userdata('no_rt'),
      'data'        =>$this->m_data_lain->view_id_data_lain($id),
  );
    $this->load->view('ketua_rt/data_lain/form',$view);
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

   //mengambil id_data_lain urut terakhir
private function id_data_lain_urut($value='')
{
    $this->m_data_lain->id_urut();
    $query    = $this->db->get();
    $data     = $query->row_array();
    $id       = $data['id_data_lain'];
    $urut     = substr($id, 1, 3);
    $tambah   = (int) $urut + 1;
    $karakter = $this->acak_id(12);
    
    if (strlen($tambah) == 1){
        $newID = "D"."00".$tambah.$karakter;
    } elseif (strlen($tambah) == 2){
        $newID = "D"."0".$tambah.$karakter;
    } elseif (strlen($tambah) == 3){
        $newID = "D".$tambah.$karakter;
    }
    return $newID;
}



public function add($value='') {    
    if (isset($_POST['kirim'])) {
        $rules = array(
            array(
                'field' => 'nik',
                'label' => 'Nomor NIK',
                'rules' => 'required|numeric|is_unique[tb_data_lain.nik]',
                'errors' => array(
                    'required' => 'Nomor NIK tidak boleh kosong',
                    'numeric' => 'Nomor NIK harus berupa angka',
                    'is_unique' => 'Nomor NIK sudah terdaftar',
                ),
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama tidak boleh kosong',
                ),
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Alamat tidak boleh kosong',
                ),
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            $pesan='<script>
            swal({
                title: "'.form_error('nik').form_error('nama').form_error('alamat').'",
                text: "",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
                </script>';
                $this->session->set_flashdata('pesan',$pesan);
                redirect(base_url('ketua_rt/data_lain'));
            }
            else

              $SQLinsert=array(
                  'id_data_lain'      =>$this->id_data_lain_urut(),
                  'nama'              =>$this->input->post('nama'),
                  'nik'               =>$this->input->post('nik'),
                  'jenis_kelamin'     =>$this->input->post('jenis_kelamin'),
                  'alamat'            =>$this->input->post('alamat'),
                  'tanggal'           =>$this->input->post('tanggal'),
                  'keterangan'        =>$this->input->post('keterangan'),
                  'id_rt'             =>$this->session->userdata('id_rt'),
              );
          
          if ($this->m_data_lain->add($SQLinsert)) {

             $pesan='<script>
             swal({
                title: "Berhasil Menambahkan Data '.$this->input->post('nama').'",
                text: "",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
                </script>';
                $this->session->set_flashdata('pesan',$pesan);
                redirect(base_url('ketua_rt/data_lain'));
            }
        }
    }


    public function edit($id='')
    {
        $data=$this->m_data_lain->view_id($id)->row_array();

        if (isset($_POST['kirim'])) {     

            $SQLupdate=array(
                'nama'              =>$this->input->post('nama'),
                'nik'               =>$this->input->post('nik'),
                'jenis_kelamin'     =>$this->input->post('jenis_kelamin'),
                'alamat'            =>$this->input->post('alamat'),
                'tanggal'           =>$this->input->post('tanggal'),
                'keterangan'        =>$this->input->post('keterangan'),
                'id_rt'             =>$this->session->userdata('id_rt'),

            );

            $cek=$this->m_data_lain->update($id,$SQLupdate);
            if($cek){
             $pesan='<script>
             swal({
              title: "Berhasil Edit Data '.$this->input->post('nama').'",
              text: "",
              type: "success",
              showConfirmButton: true,
              confirmButtonText: "OKEE"
              });
              </script>';
              $this->session->set_flashdata('pesan',$pesan);
              redirect(base_url('ketua_rt/data_lain'));
          }else{
           echo "QUERY SQL ERROR";

       }
   }else{
       $this->load->view('ketua_rt/data_lain/form',$x);
   }
}



public function hapus($id='')
{

  $cek=$this->m_data_lain->delete($id);
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
    redirect(base_url('ketua_rt/data_lain'));
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
        redirect(base_url('ketua_rt/data_lain'));
    }
}

// Export PDF Data Lain
public function export_pdf()
{
    require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
    require_once APPPATH . 'helpers/custom_helper.php';

    $data = $this->m_data_lain->view_id_data_lain(); // Mengambil data dari model

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
  <div class="center"><h1>Data lainnya RT ' . $this->session->userdata('no_rt') . '</h1></div>';

  $html .= '

  <table>
  <tr>
  <th>No</th>
  <th>Nama</th>
  <th>NIK</th>
  <th>Jenis Kelamin</th>
  <th>Alamat</th>
  <th>Keterangan</th>
  <th>Tanggal</th>
  <th>Ketua RT</th>
  </tr>';

    $no = 1; // Inisialisasi nomor urut
    foreach ($data->result_array() as $data_lain) {
        $html .= ' 
        <tr>
        <td>' . $no . '</td>
        <td>' . $data_lain['nama'] . '</td>
        <td>' . $data_lain['nik'] . '</td>
        <td>' . $data_lain['jenis_kelamin'] . '</td>
        <td>' . $data_lain['alamat'] . '</td>
        <td>' . tgl_indo($data_lain['tanggal']) . '</td>
        <td>' . $data_lain['keterangan'] . '</td>
        <td>' . $data_lain['nama_rt'] . '</td>
        </tr>';
        $no++;
    }


    $html .= '</table></div>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Set the orientation to landscape
    $dompdf->render();
    $dompdf->stream("DataLain RT " . $this->session->userdata('no_rt') . ".pdf", array("Attachment" => false));
}


// Export Excel Data Lain
public function export_excel()
{
    require_once APPPATH . 'third_party/PhpSpreadsheet/autoload.php';
    require_once APPPATH . 'helpers/custom_helper.php';
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $data = $this->m_data_lain->view_id_data_lain(); // Ganti dengan nama model dan method yang sesuai

    // Set title and merge cells
    $title = 'Data Lain RT ' . $this->session->userdata('no_rt');
    $sheet->setCellValue('A1', $title);
    $sheet->mergeCells('A1:H1');
    $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Set column headers
    $columnHeaders = ['No', 'Nama', 'NIK', 'Jenis Kelamin', 'Alamat', 'Keterangan', 'Tanggal', 'Ketua RT'];

    $row = 3;
    $col = 'A';
    foreach ($columnHeaders as $header) {
        $sheet->setCellValue($col . $row, $header);
        $col++;

        // Apply border style to header cell
        $headerCell = 'A' . $row . ':H' . $row;
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

    $no = 1;
    foreach ($data->result_array() as $data_lain) {
        $row++;
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $data_lain['nama']);
        $sheet->setCellValueExplicit('C' . $row, $data_lain['nik'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('D' . $row, $data_lain['jenis_kelamin']);
        $sheet->setCellValue('E' . $row, $data_lain['alamat']);
        $sheet->setCellValue('F' . $row, $data_lain['keterangan']);
        $sheet->setCellValue('G' . $row, tgl_indo($data_lain['tanggal']));
        $sheet->setCellValue('H' . $row, $data_lain['nama_rt']);
        
        // Set border style for each cell
        $cellRange = 'A' . $row . ':H' . $row;
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
    foreach (range('A', 'I') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DataLain RT '. $this->session->userdata('no_rt') . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
}

}
?>