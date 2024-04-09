<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;



class Kepala_keluarga extends CI_controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');

        if ($this->session->userdata('admin') != TRUE) {
            redirect(base_url(''));
            exit;
        }
        $this->load->model('m_kk');
        $this->load->model('m_anggota');
    }

    public function export_pdf()
    {
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

        $dompdf = new Dompdf();
        $html = '
        <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .center {
            text-align: center;
        }
        </style>
        <h1 class="center">Data Kepala Keluarga</h1>';

        $data = $this->m_kk->view();

        $html .= '
        <table>
        <tr>
        <th>No</th>
        <th>Kepala Keluarga</th>
        <th>No KK</th>
        <th>RT / Alamat</th>
        <th>Jumlah Keluarga</th>
        <th>Foto KK</th>
        <th>Kirim Link Pembaruan Data</th>
        </tr>';

        $no = 1;
        foreach ($data->result_array() as $kk) {
            $html .= '
            <tr>
            <td>' . $no . '</td>
            <td>' . $kk['nama_kk'] . '</td>
            <td>' . $kk['no_kk'] . '</td>
            <td>RT ' . $kk['no_rt'] . ' / ' . $kk['alamat'] . '</td>
            <td>' . $this->m_anggota->count_family_members($kk['id_kk']) . '</td>
            <td>' . ($kk['foto_kk'] ? 'Ada' : 'Belum Upload') . '</td>
            <td>' . $kk['no_hp'] . '</td>
            </tr>';
            $no++;
        }

        $html .= '</table>';

        $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Set the orientation to landscape
    $dompdf->render();
    $dompdf->stream("DataKepalaKeluarga.pdf", array("Attachment" => false));
}

public function export_excel()
{
    require_once APPPATH . 'third_party/PhpSpreadsheet/autoload.php';

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $titleStyle = [
        'font' => [
            'bold' => true,
            'size' => 16,
        ],
        'alignment' => [
            'horizontal' => PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
    ];

    $headerStyle = [
        'font' => [
            'bold' => true,
        ],
        'borders' => [
            'bottom' => [
                'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    
    $cellStyle = [
        'borders' => [
            'outline' => [
                'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'allBorders' => [
                'borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    
    // Set the title
    $sheet->setCellValue('A1', 'Data Kepala Keluarga');
    $sheet->mergeCells('A1:G1');
    $sheet->getStyle('A1')->applyFromArray($titleStyle);

    // Add the header row with specified text and style
    $headerRow = ['No', 'Kepala Keluarga', 'No KK', 'RT / Alamat', 'Jumlah Keluarga', 'Foto KK', 'Kirim Link Pembaruan Data'];
    $sheet->fromArray([$headerRow], null, 'A2');
    $sheet->getStyle('A2:G2')->applyFromArray($headerStyle);
    $sheet->getStyle('A2:G2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    $data = $this->m_kk->view();
    $no = 1;
    $row = 3;

    foreach ($data->result_array() as $kk) {
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $kk['nama_kk']);
        
        // Use setCellValueExplicit to ensure data is treated as text
        $sheet->setCellValueExplicit('C' . $row, $kk['no_kk'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        
        $sheet->setCellValue('D' . $row, 'RT ' . $kk['no_rt'] . ' / ' . $kk['alamat']);
        $sheet->setCellValue('E' . $row, $this->m_anggota->count_family_members($kk['id_kk']));
        $sheet->setCellValue('F' . $row, $kk['foto_kk'] ? 'Ada' : 'Belum Upload');
        
        // Use setCellValueExplicit to ensure data is treated as text
        $sheet->setCellValueExplicit('G' . $row, $kk['no_hp'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

        // Apply the cell style with borders to the entire row
        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray($cellStyle);

        $no++;
        $row++;
    }

    $autoWidthColumns = ['B', 'C', 'D', 'E', 'F', 'G'];
    foreach ($autoWidthColumns as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }
    
    // Adjust the row height to make space for larger images
    for ($r = 3; $r < $row; $r++) {
        $sheet->getRowDimension($r)->setRowHeight(-1); // Auto height
    }

    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DataKepalaKeluarga.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
}

    //Tampilkan Kepala Keluarga
public function index($value = '')
{
    $kode_tahun = date('Y');
    $view = array('judul' => 'Data Kepala Keluarga', 'data' => $this->m_kk->view());
    $this->load->view('admin/kepala_keluarga/form', $view);
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

public function generate_token($id='')
{
    $token = $this->acak_id(20);

    $SQLupdate=array(
        'uuid'             =>$token,
    );

    $cek=$this->m_kk->update($id,$SQLupdate);
    if($cek){
        $pesan='<script>
        swal({
          title: "Berhasil Perbarui Token",
          text: "",
          type: "success",
          showConfirmButton: true,
          confirmButtonText: "OKEE"
          });
          </script>';
          $this->session->set_flashdata('pesan',$pesan);
          redirect(base_url('admin/kepala_keluarga'));
      }    
  }
  
   // Mengambil id kk urut terakhir
  private function id_kk_urut($value = '')
  {
    $this->m_kk->id_urut();
    $query = $this->db->get();
    $data = $query->row_array();
    $id = $data['id_kk'];
    $urut = substr($id, 1, 3);
    $tambah = (int) $urut + 1;
    $karakter = $this->acak_id(12);

    if (strlen($tambah) == 1) {
        $newID = "K" . "00" . $tambah . $karakter;
    } elseif (strlen($tambah) == 2) {
        $newID = "K" . "0" . $tambah . $karakter;
    } elseif (strlen($tambah) == 3) {
        $newID = "K" . $tambah . $karakter;
    }

    return $newID;
}


public function add($value='') {    
    if (isset($_POST['kirim'])) {
        $rules = array(
            array(
                'field' => 'no_kk',
                'label' => 'Nomor KK',
                'rules' => 'required|numeric|is_unique[tb_kk.no_kk]',
                'errors' => array(
                    'required' => 'Nomor KK tidak boleh kosong',
                    'numeric' => 'Nomor KK harus berupa angka',
                    'is_unique' => 'Nomor KK sudah terdaftar',
                ),
            ),
            array(
                'field' => 'nama_kk',
                'label' => 'Nama Kepala Keluarga',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Nama Kepala Keluarga tidak boleh kosong',
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
                title: "'.form_error('no_kk').form_error('nama_kk').form_error('alamat').form_error('no_hp').form_error('password').'",
                text: "",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
                </script>';
                $this->session->set_flashdata('pesan',$pesan);
                redirect(base_url('admin/kepala_keluarga'));
            }
            else

              $SQLinsert=array(
                  'id_kk'             =>$this->id_kk_urut(),
                  'no_kk'             =>$this->input->post('no_kk'),
                  'nama_kk'           =>$this->input->post('nama_kk'),
                  'alamat'            =>$this->input->post('alamat'),
                  'no_hp'             =>$this->input->post('no_hp'),
                  'id_rt'             =>$this->input->post('id_rt'),
                  'tgl_update'        =>$this->datetime(),
              );
          
          if ($this->m_kk->add($SQLinsert)) {

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
                redirect(base_url('admin/kepala_keluarga'));
            }
        }
    }



// Data Detail
    public function detail($id='')
    {
      $data=$this->m_kk->view_id($id)->row_array();

      if (empty($data['id_kk'])) {
        $pesan='<script>
        swal({
          title: "Gagal Lihat Data",
          text: "ID Kepala Keluarga Tidak Ditemukan",
          type: "error",
          showConfirmButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          closeOnConfirm: false
          },
          function(){
              window.location.href="'.base_url('admin/kepala_keluarga').'";
              });
              </script>';
              $this->session->set_flashdata('pesan',$pesan);
              redirect(base_url('admin/kepala_keluarga'));
          }

          $x = array(
            'aksi'              =>'detail',
            'judul'             =>'Data Keluarga',
            'id_kk'             =>$data['id_kk'],
            'no_kk'             =>$data['no_kk'],
            'nama_kk'           =>$data['nama_kk'],
            'alamat'            =>$data['alamat'],
            'no_hp'             =>$data['no_hp'],
            'foto_kk'           =>$data['foto_kk'],
            'id_rt'             =>$data['id_rt'],
            'rt'                =>$this->db->get('tb_rt')->result_array(),
            'ukk'               =>$this->db->get('tb_kk')->result_array(),
            'level'             =>$data['level'],
            'data'              =>$this->m_kk->view_anggota($id),
        );

          $this->load->view('admin/kepala_keluarga/form_detail',$x);
      }


      public function edit($id = '')
      {
        $data = $this->m_kk->view_id($id)->row_array();

        if (isset($_POST['kirim'])) {
            $SQLupdate = array(
                'no_kk' => $this->input->post('no_kk'),
                'nama_kk' => $this->input->post('nama_kk'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'id_rt' => $this->input->post('id_rt'),
                'tgl_update' => $this->datetime(),
            );

            $cek = $this->m_kk->update($id, $SQLupdate);
            if ($cek) {
                $pesan = '<script>
                swal({
                    title: "Berhasil Edit Data",
                    text: "",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>';
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect(base_url('admin/kepala_keluarga/detail/' . $id));
                } else {
                    echo "QUERY SQL ERROR";
                }
            } else {
                $x = array(
                    'aksi' => 'detail',
                    'judul' => 'Data Keluarga',
                    'id_kk' => $data['id_kk'],
                    'no_kk' => $data['no_kk'],
                    'nama_kk' => $data['nama_kk'],
                    'alamat' => $data['alamat'],
                    'no_hp' => $data['no_hp'],
                    'foto_kk' => $data['foto_kk'],
                    'id_rt' => $data['id_rt'],
                    'rt' => $this->db->get('tb_rt')->result_array(),
                    'ukk' => $this->db->get('tb_kk')->result_array(),
                    'level' => $data['level'],
                    'data' => $this->m_kk->view_anggota($id),
                );

                $this->load->view('admin/kepala_keluarga/form_detail', $x);
            }
        }

//mengompres ukuran gambar
        private function compress($source, $destination, $quality) 
        {
            $info = getimagesize($source);
            if ($info['mime'] == 'image/jpeg') 
                $image = imagecreatefromjpeg($source);
            elseif ($info['mime'] == 'image/gif') 
                $image = imagecreatefromgif($source);
            elseif ($info['mime'] == 'image/png') 
                $image = imagecreatefrompng($source);
            imagejpeg($image, $destination, $quality);
            return $destination;
        }

//menyimpan gambar foto_kk ke dalam folder
//upload file ke server
        private function upload_bukti_kk($value='')
        {
            $ekstensi_diperbolehkan = array('png','jpg','jpeg','pdf','doc', 'docx');
            $nama = $_FILES['foto_kk']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['foto_kk']['size'];
            $file_tmp = $_FILES['foto_kk']['tmp_name'];
            $folderPath = "./themes/foto_kk/";
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 10044070){      
                    $fileName = $this->input->post('nama_kk').'_'.uniqid() . '.' . $ekstensi;
                    $file = $folderPath . $fileName;
                    move_uploaded_file($file_tmp, $file);
                    $this->compress($file, $file, 40);
                    return $fileName;
                }else{
                    $this->session->set_flashdata('pesan', '<script>
                        swal({
                            title: "Gagal",
                            text: "Ukuran File Terlalu Besar",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: true,,
                            confirmButtonText: "OKEE"
                            });
                            </script>');
                    redirect('promo');
                }
            }else{
                $this->session->set_flashdata('pesan', '<script>
                    swal({
                        title: "Gagal",
                        text: "Ekstensi File Tidak Diperbolehkan",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: true,,
                        confirmButtonText: "OKEE"
                        });
                        </script>');
                redirect('promo');
            }
        }

        public function upload_fotoKK($id='')
        {
            if(isset($_POST['kirim'])){
                $SQLupdate=array(
                  'foto_kk'               =>$this->upload_bukti_kk(),
                  'tgl_update'            =>$this->datetime(),
              );
                $cek=$this->m_kk->update($id,$SQLupdate);
                if($cek){
                 $pesan='<script>
                 swal({
                    title: "Berhasil Upload Foto KK",
                    text: "",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                    });
                    </script>';
                    $this->session->set_flashdata('pesan',$pesan);
                    redirect(base_url('admin/kepala_keluarga/detail/'.$id));
                }
            }
        }

        public function hapus($id='')
        {
      //hapus file di folder berdasarkan id
          $data=$this->m_kk->view_id($id)->row_array();
          $file=$data['foto_kk'];
          unlink('./themes/foto_kk/'.$file);
      //hapus data di database
          $cek=$this->m_kk->delete($id);
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
            redirect(base_url('admin/kepala_keluarga'));
        }
    }

    public function hapusimage($id = '')
    {
        $data = $this->m_kk->view_id($id)->row_array();
        $file = $data['foto_kk'];
        unlink('./themes/foto_kk/' . $file);

        $SQLupdate = array(
            'foto_kk' => '',
        );

        $cek = $this->m_kk->update($id, $SQLupdate);
        if ($cek) {
            $pesan = '<script>
            swal({
                title: "Berhasil Hapus Foto KK",
                text: "",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE"
                });
                </script>';
                $this->session->set_flashdata('pesan', $pesan);
                redirect(base_url('admin/kepala_keluarga/detail/' . $id));
            }
        }





        public function export_pdf_kk($id)
        {
            require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

    // Dapatkan data dari model
            $data = $this->m_kk->view_id($id)->row_array();

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
            .info {
                font-size: 16px;
                margin-bottom: 10px;
                text-align: left;
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
            <div class="center">
            <h1>Kartu Keluarga</h1>
            <div class="info"><span class="label">No KK :</span> ' . $data['no_kk'] . '</div>
            <div class="info"><span class="label">Nama Kepala Keluarga :</span> ' . $data['nama_kk'] . '</div>
            <div class="info"><span class="label">Alamat :</span> ' . $data['alamat'] . '</div>
            

            <table>
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>No HP</th>
            <th>Tanggal Lahir</th>

            <th>Tempat Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Pendidikan</th>
            <th>Pekerjaan</th>
            <th>Hubungan</th>
            <th>Status Perkawinan</th>
            <th>Kewarganegaraan</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            </tr>';

            $anggota = $this->m_kk->view_anggota($id);
            $no = 1;
            foreach ($anggota->result_array() as $kk) {
                $html .= '
                <tr>
                <td>' . $no . '</td>
                <td>' . $kk['nama'] . '</td>
                <td>' . $kk['nik'] . '</td>
                <td>' . $kk['no_hp_anggota'] . '</td>
                <td>' . $kk['tgl_lahir'] . '</td> 
                <td>' . $kk['tempat_lahir'] . '</td>
                <td>' . $kk['jenis_kelamin'] . '</td>
                <td>' . $kk['agama'] . '</td>
                <td>' . $kk['pendidikan'] . '</td>
                <td>' . $kk['pekerjaan'] . '</td>
                <td>' . $kk['hubungan'] . '</td>
                <td>' . $kk['perkawinan'] . '</td> 
                <td>' . $kk['kewarganegaraan'] . '</td> 
                <td>' . $kk['nama_ayah'] . '</td> 
                <td>' . $kk['nama_ibu'] . '</td> 
                </tr>';
                $no++;
            }

            $html .= '</table></div>';

            $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Atur orientasi ke landscape
    $dompdf->render();
    $dompdf->stream("KartuKeluarga.pdf", array("Attachment" => false));
}


// Export Excel Kartu Keluarga
public function export_excel_kk($id)
{
    require_once APPPATH . 'third_party/PhpSpreadsheet/autoload.php';

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $data = $this->m_kk->view_id($id)->row_array();

    // Set title and merge cells
    $title = 'Kartu Keluarga';
    $sheet->setCellValue('A1', $title);
    $sheet->mergeCells('A1:O1');
    $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $row = 3;
    $sheet->setCellValue('B' . $row, 'No KK');
    $sheet->setCellValueExplicit('C' . $row, $data['no_kk'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    $row++;
    $sheet->setCellValue('B' . $row, 'Nama Kepala Keluarga');
    $sheet->setCellValue('C' . $row, $data['nama_kk']);
    $row++;
    $sheet->setCellValue('B' . $row, 'Alamat');
    $sheet->setCellValue('C' . $row, $data['alamat']);

    // Set column headers for anggota
    $columnHeaders = [
        'No', 'Nama', 'NIK', 'No HP', 'Tanggal Lahir',
        'Tempat Lahir', 'Jenis Kelamin', 'Agama', 'Pendidikan',
        'Pekerjaan', 'Hubungan', 'Status Perkawinan', 'Kewarganegaraan',
        'Nama Ayah', 'Nama Ibu'
    ];

    // Set headers in row 7
    $row = 7;
    $col = 'A';
    foreach ($columnHeaders as $header) {
        $sheet->setCellValue($col . $row, $header);
        $col++;

    // Apply border style to header cell
        $headerCell = 'A' . $row . ':O' . $row;
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

    $anggota = $this->m_kk->view_anggota($id);
    $no = 1;

    foreach ($anggota->result_array() as $kk) {
        $row++;
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $kk['nama']);
        $sheet->setCellValueExplicit('C' . $row, $kk['nik'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('D' . $row, $kk['no_hp_anggota'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('E' . $row, $kk['tgl_lahir']);
        $sheet->setCellValue('F' . $row, $kk['tempat_lahir']);
        $sheet->setCellValue('G' . $row, $kk['jenis_kelamin']);
        $sheet->setCellValue('H' . $row, $kk['agama']);
        $sheet->setCellValue('I' . $row, $kk['pendidikan']);
        $sheet->setCellValue('J' . $row, $kk['pekerjaan']);
        $sheet->setCellValue('K' . $row, $kk['hubungan']);
        $sheet->setCellValue('L' . $row, $kk['perkawinan']);
        $sheet->setCellValue('M' . $row, $kk['kewarganegaraan']);
        $sheet->setCellValue('N' . $row, $kk['nama_ayah']);
        $sheet->setCellValue('O' . $row, $kk['nama_ibu']);

       // Set border style for each cell
        $cellRange = 'A' . $row . ':O' . $row;
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
    foreach (range('A', 'O') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DataKartuKeluarga.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
}


}
?>