<?php
// application/helpers/custom_helper.php

if (!function_exists('hitung_usia')) {
	function hitung_usia($tanggal_lahir){
		list($year,$month,$day) = explode("-",$tanggal_lahir);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($month_diff < 0) {
			$year_diff--;
		} elseif (($month_diff==0) && ($day_diff < 0)) {
			$year_diff--;
		}
		return $year_diff;
	}
}

if (!function_exists('tgl_indo')) {
	function tgl_indo($tanggal){
		$bulan = array (
			1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
			'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		);
		$pecahkan = explode('-', $tanggal);

		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}
}
?>