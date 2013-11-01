<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LStatus_Kerja {
    var $CI = null;
    
    function LStatus_Kerja() {
        $this->CI =& get_instance();
    }
    
    function GetArrayStatusKerja($param = array()) {
        $Array = array();
        
		$RawQuery = "CALL DB2ADMIN.GETSTATUSKERJA()";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_STATUS_KERJA']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_STATUS_KERJA']]['Singkat'] = $Element['SINGKAT'];
        }
		
		if (isset($param['with_all']) && $param['with_all']) {
			$ArrayStatusKerja['x'] = array( 'Content' => 'Semua', 'Singkat' => 'Semua' );
		}
        
        return $ArrayStatusKerja;
    }
}