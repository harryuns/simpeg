<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class Report0206 {
    var $CI = null;
    
    function Report0206() {
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
        array_unshift($objPHPExcel->Report['List'], array(
            'FAKULTAS' => 'Fakultas',
            'JML_III1' => 'III1',
            'JML_IV1' => 'IV1',
            'JML_GOL1' => 'GOL1',
            'JML_III2' => 'III2',
            'JML_IV2' => 'IV2',
            'JML_GOL2' => 'GOL2',
            'JML_III3' => 'III3',
            'JML_IV3' => 'IV3',
            'JML_GOL3' => 'GOL3',
            'JML_III4' => 'III4',
            'JML_IV4' => 'IV4',
            'JML_GOL4' => 'GOL4',
            'JML_III5' => 'III5',
            'JML_IV5' => 'IV5',
            'JML_GOL5' => 'GOL5'
        ));
        
        $Row = 1;
        $Number = 0;
        foreach ($objPHPExcel->Report['List'] as $Key => $Element) {
            $No = ($Row == 1) ? 'No' : $Number;
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $No);
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