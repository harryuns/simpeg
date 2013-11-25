<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0204 {
    var $CI = null;
    
    function Report0204() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
        $ArrayTotal = array();
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $ArrayTotal['JUMLAH'] = (isset($ArrayTotal['JUMLAH'])) ? $ArrayTotal['JUMLAH'] + $Element['JUMLAH'] : $Element['JUMLAH'];
		}
		
        // Add Header on Excel Document
        array_unshift($objPHPExcel->Report['List'], array(
            'CONTENT' => 'Content',
            'NO_URUT' => 'No Urut',
            'SINGKAT' => 'Singkat',
            'SEKOLAH' => 'Sekolah',
            'JUMLAH' => 'Jumlah'
        ));
        
        $Row = 1;
        $Number = 0;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $No = ($Row == 1) ? 'No' : $Number;
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $No);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['CONTENT']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['NO_URUT']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['SINGKAT']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['SEKOLAH']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['JUMLAH']);
            
            $Row++;
            $Number++;
        }
        // Add Total
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$Row.':E'.$Row);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$Row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, 'Jumlah');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $ArrayTotal['JUMLAH']);
        
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        return $objPHPExcel;
    }
}
?>