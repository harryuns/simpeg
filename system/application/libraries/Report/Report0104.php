<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0104 {
    var $CI = null;
    
    function Report0104() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
        $ArrayTotal = array();
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $ArrayTotal['JML_0'] = (isset($ArrayTotal['JML_0'])) ? $ArrayTotal['JML_0'] + $Element['JML_0'] : $Element['JML_0'];
            $ArrayTotal['JML_1'] = (isset($ArrayTotal['JML_1'])) ? $ArrayTotal['JML_1'] + $Element['JML_1'] : $Element['JML_1'];
            $ArrayTotal['JML_2'] = (isset($ArrayTotal['JML_2'])) ? $ArrayTotal['JML_2'] + $Element['JML_2'] : $Element['JML_2'];
            $ArrayTotal['JML_3'] = (isset($ArrayTotal['JML_3'])) ? $ArrayTotal['JML_3'] + $Element['JML_3'] : $Element['JML_3'];
            $ArrayTotal['JML_4'] = (isset($ArrayTotal['JML_4'])) ? $ArrayTotal['JML_4'] + $Element['JML_4'] : $Element['JML_4'];
        }
		
        // Add Header on Excel Document
        array_unshift($objPHPExcel->Report['List'], array(
            'JURUSAN' => 'Jurusan',
            'JABATAN_FUNGSIONAL' => 'Jabatan Fungsional',
            'JML_0' => $objPHPExcel->Report['Year'] - 0,
            'JML_1' => $objPHPExcel->Report['Year'] - 1,
            'JML_2' => $objPHPExcel->Report['Year'] - 2,
            'JML_3' => $objPHPExcel->Report['Year'] - 3,
            'JML_4' => $objPHPExcel->Report['Year'] - 4
        ));
        
        $Row = 1;
        $Number = 0;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $No = ($Row == 1) ? 'No' : $Number;
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $No);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['JURUSAN']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['JABATAN_FUNGSIONAL']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['JML_4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['JML_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['JML_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $Element['JML_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $Element['JML_0']);
            
            $Row++;
            $Number++;
        }
        // Add Total
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$Row.':C'.$Row);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$Row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, 'Jumlah');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $ArrayTotal['JML_4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $ArrayTotal['JML_3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $ArrayTotal['JML_2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $ArrayTotal['JML_1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $ArrayTotal['JML_0']);
        
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        return $objPHPExcel;
    }
}
?>