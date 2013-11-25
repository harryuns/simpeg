<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0106 {
    var $CI = null;
    
    function Report0106() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
        $ArrayTotal = array();
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $ArrayTotal['S1'] = (isset($ArrayTotal['S1'])) ? $ArrayTotal['S1'] + $Element['S1'] : $Element['S1'];
            $ArrayTotal['S2'] = (isset($ArrayTotal['S2'])) ? $ArrayTotal['S2'] + $Element['S2'] : $Element['S2'];
            $ArrayTotal['S3'] = (isset($ArrayTotal['S3'])) ? $ArrayTotal['S3'] + $Element['S3'] : $Element['S3'];
            $ArrayTotal['SP1'] = (isset($ArrayTotal['SP1'])) ? $ArrayTotal['SP1'] + $Element['SP1'] : $Element['SP1'];
        }
		
        // Add Header on Excel Document
        array_unshift($objPHPExcel->Report['List'], array(
            'UNIT_KERJA' => 'Fakultas',
            'S1' => 'S1',
            'S2' => 'S2',
            'S3' => 'S2',
            'SP1' => 'Spesialis 1'
        ));
        
        $Row = 1;
        $Number = 0;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
			if (!isset($Element['UNIT_KERJA'])) {
				continue;
			}
			
            $No = ($Row == 1) ? 'No' : $Number;
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $No);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['UNIT_KERJA']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['S1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['S2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['S3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['SP1']);
            
            $Row++;
            $Number++;
        }
        // Add Total
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$Row.':B'.$Row);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$Row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, 'Jumlah');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $ArrayTotal['S1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $ArrayTotal['S2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $ArrayTotal['S3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $ArrayTotal['SP1']);
        
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        return $objPHPExcel;
    }
}
?>