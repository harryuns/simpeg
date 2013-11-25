<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0301 {
    var $CI = null;
    
    function Report0301() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:A2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B1:B2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C1:C2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("D1:D2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("Q1:Q2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("R1:R2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("S1:S2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("T1:T2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("E1:F1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("G1:H1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("I1:J1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("K1:M1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("N1:P1");
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'NO');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'NIDN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'NIP');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'PANGKAT');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', 'GOL');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', 'TMT');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'JABATAN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'TMT');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'MASA KERJA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', 'SEMUA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', 'GOL');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'LATIHAN PRAJABATAN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', 'BLN/TH');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', 'JAM');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'PENDIDIKAN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2', 'TAHUN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P2', 'IJZ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'TANGGAL LAHIR');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'UMUR');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', 'CATATAN MUTASI KEPEG');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1', 'FAK');
		
        $ArrayContent = array();
		foreach ($objPHPExcel->Report['List'] as $Key => $Array) {
			$ArrayContent[] = array(
				'A' => $Array['NAMA_LENGKAP'],
				'B' => ' ' . $Array['NIDN'],
				'C' => ' ' . $Array['K_PEGAWAI'],
				'D' => $Array['GOL'],
				'E' => ExchangeFormatDate($Array['TMT_GOL']),
				'F' => $Array['BAGIAN_JABATAN'],
				'G' => ExchangeFormatDate($Array['TMT_JABATAN']),
				'H' => $Array['MASA_KERJA_SEMUA'],
				'I' => $Array['MASA_KERJA_GOLONGAN'],
				'J' => '',
				'K' => '',
				'L' => '',
				'M' => $Array['JENJANG_PENDIDIKAN'],
				'N' => $Array['THN_LULUS'],
				'O' => $Array['IJZ'],
				'P' => ExchangeFormatDate($Array['TGL_LAHIR']),
				'Q' => $Array['UMUR']
			);
		}
		
        $Row = 3;
        $Number = 1;
        foreach ($ArrayContent as $Key => $Element) {
            $No = $Number;
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $No);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['A']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['B']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['C']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['D']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['E']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $Element['F']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $Element['G']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$Row, $Element['H']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$Row, $Element['I']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$Row, $Element['J']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$Row, $Element['K']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$Row, $Element['L']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$Row, $Element['M']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$Row, $Element['N']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$Row, $Element['O']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$Row, $Element['P']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$Row, $Element['Q']);
			
            $Row++;
            $Number++;
        }
		
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        return $objPHPExcel;
    }
}
?>