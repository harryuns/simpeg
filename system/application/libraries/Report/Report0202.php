<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0202 {
    var $CI = null;
    
    function Report0202() {
        $this->CI =& get_instance();
    }
    
    function BuildExcel($objPHPExcel) {
        $ArrayTotal = array( 'JML_LP_0' => 0, 'JML_LP_1' => 0, 'JML_LP_2' => 0, 'JML_LP_3' => 0, 'JML_LP_4' => 0 );
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
			$objPHPExcel->Report['List'][$Key]['JML_LP_0'] = $Element['JML_L_0'] + $Element['JML_P_0'];
			$objPHPExcel->Report['List'][$Key]['JML_LP_1'] = $Element['JML_L_1'] + $Element['JML_P_1'];
			$objPHPExcel->Report['List'][$Key]['JML_LP_2'] = $Element['JML_L_2'] + $Element['JML_P_2'];
			$objPHPExcel->Report['List'][$Key]['JML_LP_3'] = $Element['JML_L_3'] + $Element['JML_P_3'];
			$objPHPExcel->Report['List'][$Key]['JML_LP_4'] = $Element['JML_L_4'] + $Element['JML_P_4'];
			
            $ArrayTotal['JML_L_0'] = (isset($ArrayTotal['JML_L_0'])) ? $ArrayTotal['JML_L_0'] + $Element['JML_L_0'] : $Element['JML_L_0'];
            $ArrayTotal['JML_P_0'] = (isset($ArrayTotal['JML_P_0'])) ? $ArrayTotal['JML_P_0'] + $Element['JML_P_0'] : $Element['JML_P_0'];
            $ArrayTotal['JML_LP_0'] = $ArrayTotal['JML_L_0'] + $ArrayTotal['JML_P_0'];
            $ArrayTotal['JML_L_1'] = (isset($ArrayTotal['JML_L_1'])) ? $ArrayTotal['JML_L_1'] + $Element['JML_L_1'] : $Element['JML_L_1'];
            $ArrayTotal['JML_P_1'] = (isset($ArrayTotal['JML_P_1'])) ? $ArrayTotal['JML_P_1'] + $Element['JML_P_1'] : $Element['JML_P_1'];
            $ArrayTotal['JML_LP_1'] = $ArrayTotal['JML_L_1'] + $ArrayTotal['JML_P_1'];
            $ArrayTotal['JML_L_2'] = (isset($ArrayTotal['JML_L_2'])) ? $ArrayTotal['JML_L_2'] + $Element['JML_L_2'] : $Element['JML_L_2'];
            $ArrayTotal['JML_P_2'] = (isset($ArrayTotal['JML_P_2'])) ? $ArrayTotal['JML_P_2'] + $Element['JML_P_2'] : $Element['JML_P_2'];
            $ArrayTotal['JML_LP_2'] = $ArrayTotal['JML_L_2'] + $ArrayTotal['JML_P_2'];
            $ArrayTotal['JML_L_3'] = (isset($ArrayTotal['JML_L_3'])) ? $ArrayTotal['JML_L_3'] + $Element['JML_L_3'] : $Element['JML_L_3'];
            $ArrayTotal['JML_P_3'] = (isset($ArrayTotal['JML_P_3'])) ? $ArrayTotal['JML_P_3'] + $Element['JML_P_3'] : $Element['JML_P_3'];
            $ArrayTotal['JML_LP_3'] = $ArrayTotal['JML_L_3'] + $ArrayTotal['JML_P_3'];
            $ArrayTotal['JML_L_4'] = (isset($ArrayTotal['JML_L_4'])) ? $ArrayTotal['JML_L_4'] + $Element['JML_L_4'] : $Element['JML_L_4'];
            $ArrayTotal['JML_P_4'] = (isset($ArrayTotal['JML_P_4'])) ? $ArrayTotal['JML_P_4'] + $Element['JML_P_4'] : $Element['JML_P_4'];
            $ArrayTotal['JML_LP_4'] = $ArrayTotal['JML_L_4'] + $ArrayTotal['JML_P_4'];
        }
        
        // Add Header on Excel Document
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:A2');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:B2');
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'No');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Jurusan');
        
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:E1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F1:H1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I1:K1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('L1:N1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O1:Q1');
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('C1:Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', $objPHPExcel->Report['Year'] - 0);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', $objPHPExcel->Report['Year'] - 1);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', $objPHPExcel->Report['Year'] - 2);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', $objPHPExcel->Report['Year'] - 3);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', $objPHPExcel->Report['Year'] - 4);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'L');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', 'P');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', 'L');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', 'P');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', 'L');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', 'P');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', 'L');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', 'P');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2', 'Jml');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2', 'L');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P2', 'P');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q2', 'Jml');
        
        $Row = 3;
        $Number = 1;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $Number);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['CONTENT']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['JML_L_4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['JML_P_4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['JML_LP_4']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['JML_L_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $Element['JML_P_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $Element['JML_LP_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$Row, $Element['JML_L_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$Row, $Element['JML_P_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$Row, $Element['JML_LP_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$Row, $Element['JML_L_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$Row, $Element['JML_P_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$Row, $Element['JML_LP_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$Row, $Element['JML_L_0']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$Row, $Element['JML_P_0']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$Row, $Element['JML_LP_0']);
            
            $Row++;
            $Number++;
        }
        // Add Total
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$Row.':B'.$Row);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$Row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, 'Jumlah');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $ArrayTotal['JML_L_4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $ArrayTotal['JML_P_4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $ArrayTotal['JML_LP_4']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $ArrayTotal['JML_L_3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $ArrayTotal['JML_P_3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $ArrayTotal['JML_LP_3']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$Row, $ArrayTotal['JML_L_2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$Row, $ArrayTotal['JML_P_2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$Row, $ArrayTotal['JML_LP_2']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$Row, $ArrayTotal['JML_L_1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$Row, $ArrayTotal['JML_P_1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$Row, $ArrayTotal['JML_LP_1']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$Row, $ArrayTotal['JML_L_0']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$Row, $ArrayTotal['JML_P_0']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$Row, $ArrayTotal['JML_LP_0']);
        
        $objPHPExcel->getActiveSheet()->setTitle('Laporan');
        return $objPHPExcel;
    }
}
?>