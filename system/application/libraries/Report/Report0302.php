<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0302 {
    var $CI = null;
    
    function Report0301() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:A2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B1:B2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C1:C2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("P1:P2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("Q1:Q2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("R1:R2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("S1:S2");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("D1:E1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("F1:G1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H1:I1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J1:L1");
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("M1:O1");
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'NO');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'NIP');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'PANGKAT');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', 'GOL');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', 'TMT');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'JABATAN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', 'TMT');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'MASA KERJA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'SEMUA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', 'GOL');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'LATIHAN PRAJABATAN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', 'BLN/TH');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', 'JAM');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'PENDIDIKAN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', 'NAMA');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2', 'TAHUN');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2', 'IJZ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'TANGGAL LAHIR');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'UMUR');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'CATATAN MUTASI KEPEG');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', 'FAK');
		
        $ArrayContent = array();
		foreach ($objPHPExcel->Report['List'] as $Key => $Array) {
			$ArrayContent[] = array(
				'A' => $Array['NAMA_LENGKAP'],
				'B' => ' ' . $Array['K_PEGAWAI'],
				'C' => $Array['GOL'],
				'D' => ExchangeFormatDate($Array['TMT_GOL']),
				'E' => $Array['BAGIAN_JABATAN'],
				'F' => ExchangeFormatDate($Array['TMT_JABATAN']),
				'G' => $Array['MASA_KERJA_SEMUA'],
				'H' => $Array['MASA_KERJA_GOLONGAN'],
				'I' => '',
				'J' => '',
				'K' => '',
				'L' => $Array['JENJANG_PENDIDIKAN'],
				'M' => $Array['THN_LULUS'],
				'N' => $Array['IJZ'],
				'O' => ExchangeFormatDate($Array['TGL_LAHIR']),
				'P' => $Array['UMUR']
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
			
            $Row++;
            $Number++;
        }
		
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        return $objPHPExcel;
    }
}
?>