<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcelController extends BaseController
{
	public function export()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello PhpSpreadsheet');

		$writer = new Xlsx($spreadsheet);
		$filename = 'hello.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename .'"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
}
