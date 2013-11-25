<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0103 {
    var $CI = null;
    
    function Report0103() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
        $ArrayTotal = array();
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $ArrayTotal['JML_III1'] = (isset($ArrayTotal['JML_III1'])) ? $ArrayTotal['JML_III1'] + $Element['JML_III1'] : $Element['JML_III1'];
            $ArrayTotal['JML_IV1'] = (isset($ArrayTotal['JML_IV1'])) ? $ArrayTotal['JML_IV1'] + $Element['JML_IV1'] : $Element['JML_IV1'];
            $ArrayTotal['JML_GOL1'] = (isset($ArrayTotal['JML_GOL1'])) ? $ArrayTotal['JML_GOL1'] + $Element['JML_GOL1'] : $Element['JML_GOL1'];
            $ArrayTotal['JML_III2'] = (isset($ArrayTotal['JML_III2'])) ? $ArrayTotal['JML_III2'] + $Element['JML_III2'] : $Element['JML_III2'];
            $ArrayTotal['JML_IV2'] = (isset($ArrayTotal['JML_IV2'])) ? $ArrayTotal['JML_IV2'] + $Element['JML_IV2'] : $Element['JML_IV2'];
            $ArrayTotal['JML_GOL2'] = (isset($ArrayTotal['JML_GOL2'])) ? $ArrayTotal['JML_GOL2'] + $Element['JML_GOL2'] : $Element['JML_GOL2'];
            $ArrayTotal['JML_III3'] = (isset($ArrayTotal['JML_III3'])) ? $ArrayTotal['JML_III3'] + $Element['JML_III3'] : $Element['JML_III3'];
            $ArrayTotal['JML_IV3'] = (isset($ArrayTotal['JML_IV3'])) ? $ArrayTotal['JML_IV3'] + $Element['JML_IV3'] : $Element['JML_IV3'];
            $ArrayTotal['JML_GOL3'] = (isset($ArrayTotal['JML_GOL3'])) ? $ArrayTotal['JML_GOL3'] + $Element['JML_GOL3'] : $Element['JML_GOL3'];
            $ArrayTotal['JML_III4'] = (isset($ArrayTotal['JML_III4'])) ? $ArrayTotal['JML_III4'] + $Element['JML_III4'] : $Element['JML_III4'];
            $ArrayTotal['JML_IV4'] = (isset($ArrayTotal['JML_IV4'])) ? $ArrayTotal['JML_IV4'] + $Element['JML_IV4'] : $Element['JML_IV4'];
            $ArrayTotal['JML_GOL4'] = (isset($ArrayTotal['JML_GOL4'])) ? $ArrayTotal['JML_GOL4'] + $Element['JML_GOL4'] : $Element['JML_GOL4'];
            $ArrayTotal['JML_III5'] = (isset($ArrayTotal['JML_III5'])) ? $ArrayTotal['JML_III5'] + $Element['JML_III5'] : $Element['JML_III5'];
            $ArrayTotal['JML_IV5'] = (isset($ArrayTotal['JML_IV5'])) ? $ArrayTotal['JML_IV5'] + $Element['JML_IV5'] : $Element['JML_IV5'];
            $ArrayTotal['JML_GOL5'] = (isset($ArrayTotal['JML_GOL5'])) ? $ArrayTotal['JML_GOL5'] + $Element['JML_GOL5'] : $Element['JML_GOL5'];
        }
        
        // Add Header on Excel Document
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:A2');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:B2');
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'No');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Fakultas');
        
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:E1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F1:H1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I1:K1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('L1:N1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O1:Q1');
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('C1:Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', $objPHPExcel->Report['Year'] - 4);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', $objPHPExcel->Report['Year'] - 3);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', $objPHPExcel->Report['Year'] - 2);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', $objPHPExcel->Report['Year'] - 1);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', $objPHPExcel->Report['Year']);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'III');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', 'IV');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', 'III');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', 'IV');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', 'III');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', 'IV');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', 'III');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', 'IV');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2', 'III');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P2', 'IV');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q2', 'Jml');
        
        $Row = 3;
        $Number = 1;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $Number);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['FAKULTAS']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['JML_III1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['JML_IV1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['JML_GOL1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['JML_III2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $Element['JML_IV2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $Element['JML_GOL2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$Row, $Element['JML_III3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$Row, $Element['JML_IV3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$Row, $Element['JML_GOL3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$Row, $Element['JML_III4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$Row, $Element['JML_IV4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$Row, $Element['JML_GOL4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$Row, $Element['JML_III5']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$Row, $Element['JML_IV5']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$Row, $Element['JML_GOL5']);
            
            $Row++;
            $Number++;
        }
        
        // Add Total
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$Row.':B'.$Row);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$Row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, 'Jumlah');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $ArrayTotal['JML_III1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $ArrayTotal['JML_IV1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $ArrayTotal['JML_GOL1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $ArrayTotal['JML_III2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $ArrayTotal['JML_IV2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $ArrayTotal['JML_GOL2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$Row, $ArrayTotal['JML_III3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$Row, $ArrayTotal['JML_IV3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$Row, $ArrayTotal['JML_GOL3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$Row, $ArrayTotal['JML_III4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$Row, $ArrayTotal['JML_IV4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$Row, $ArrayTotal['JML_GOL4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$Row, $ArrayTotal['JML_III5']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$Row, $ArrayTotal['JML_IV5']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$Row, $ArrayTotal['JML_GOL5']);
        
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        
        return $objPHPExcel;
    }
}
?>