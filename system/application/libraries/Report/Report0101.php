<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0101 {
    var $CI = null;
    
    function Report0101() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
        $ArrayTotal = array();
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $ArrayTotal['2'] = (isset($ArrayTotal['2'])) ? $ArrayTotal['2'] + $Element['2'] : $Element['2'];
            $ArrayTotal['3'] = (isset($ArrayTotal['3'])) ? $ArrayTotal['3'] + $Element['3'] : $Element['3'];
            $ArrayTotal['4'] = (isset($ArrayTotal['4'])) ? $ArrayTotal['4'] + $Element['4'] : $Element['4'];
            $ArrayTotal['5'] = (isset($ArrayTotal['5'])) ? $ArrayTotal['5'] + $Element['5'] : $Element['5'];
            $ArrayTotal['6'] = (isset($ArrayTotal['6'])) ? $ArrayTotal['6'] + $Element['6'] : $Element['6'];
        }
        
        // Add Header on Excel Document
        array_unshift($objPHPExcel->Report['List'], array(
            'FAKULTAS' => 'Fakultas',
            '2' => $objPHPExcel->Report['Year'] - 4,
            '3' => $objPHPExcel->Report['Year'] - 3,
            '4' => $objPHPExcel->Report['Year'] - 2,
            '5' => $objPHPExcel->Report['Year'] - 1,
            '6' => $objPHPExcel->Report['Year']
        ));
        
        $Row = 1;
        $Number = 0;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $No = ($Row == 1) ? 'No' : $Number;
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $No);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['FAKULTAS']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['5']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $Element['6']);
            
            $Row++;
            $Number++;
        }
        // Add Total
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$Row.':B'.$Row);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$Row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, 'Jumlah');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $ArrayTotal['2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $ArrayTotal['3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $ArrayTotal['4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $ArrayTotal['5']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $ArrayTotal['6']);
        
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        
        return $objPHPExcel;
    }
}
?>