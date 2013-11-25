<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0207 {
    var $CI = null;
    
    function Report0207() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
        $ArrayTotal = array();
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $ArrayTotal['UMUR_KRG_20'] = (isset($ArrayTotal['UMUR_KRG_20'])) ? $ArrayTotal['UMUR_KRG_20'] + $Element['UMUR_KRG_20'] : $Element['UMUR_KRG_20'];
            $ArrayTotal['UMUR_KRG_30'] = (isset($ArrayTotal['UMUR_KRG_30'])) ? $ArrayTotal['UMUR_KRG_30'] + $Element['UMUR_KRG_30'] : $Element['UMUR_KRG_30'];
            $ArrayTotal['UMUR_KRG_40'] = (isset($ArrayTotal['UMUR_KRG_40'])) ? $ArrayTotal['UMUR_KRG_40'] + $Element['UMUR_KRG_40'] : $Element['UMUR_KRG_40'];
            $ArrayTotal['UMUR_KRG_50'] = (isset($ArrayTotal['UMUR_KRG_50'])) ? $ArrayTotal['UMUR_KRG_50'] + $Element['UMUR_KRG_50'] : $Element['UMUR_KRG_50'];
            $ArrayTotal['UMUR_KRG_60'] = (isset($ArrayTotal['UMUR_KRG_60'])) ? $ArrayTotal['UMUR_KRG_60'] + $Element['UMUR_KRG_60'] : $Element['UMUR_KRG_60'];
            $ArrayTotal['UMUR_LBH_60'] = (isset($ArrayTotal['UMUR_LBH_60'])) ? $ArrayTotal['UMUR_LBH_60'] + $Element['UMUR_LBH_60'] : $Element['UMUR_LBH_60'];
		}
		
        // Add Header on Excel Document
        array_unshift($objPHPExcel->Report['List'], array(
            'CONTENT1' => 'Jenis Kerja',
            'CONTENT2' => 'Status Kerja',
            'UMUR_KRG_20' => '< 20',
            'UMUR_KRG_30' => '< 30',
            'UMUR_KRG_40' => '< 40',
            'UMUR_KRG_50' => '< 50',
            'UMUR_KRG_60' => '< 60',
            'UMUR_LBH_60' => '> 60'
        ));
        
        $Row = 1;
        $Number = 0;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $No = ($Row == 1) ? 'No' : $Number;
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $No);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['CONTENT1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['CONTENT2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['UMUR_KRG_20']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['UMUR_KRG_30']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['UMUR_KRG_40']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $Element['UMUR_KRG_50']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $Element['UMUR_KRG_60']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$Row, $Element['UMUR_LBH_60']);
            
            $Row++;
            $Number++;
        }
        // Add Total
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$Row.':C'.$Row);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$Row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, 'Jumlah');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $ArrayTotal['UMUR_KRG_20']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $ArrayTotal['UMUR_KRG_30']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $ArrayTotal['UMUR_KRG_40']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $ArrayTotal['UMUR_KRG_50']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $ArrayTotal['UMUR_KRG_60']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$Row, $ArrayTotal['UMUR_LBH_60']);
        
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        return $objPHPExcel;
    }
}
?>