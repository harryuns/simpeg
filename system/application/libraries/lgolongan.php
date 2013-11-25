<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LGolongan {
    var $CI = null;
    
    function LGolongan() {
        $this->CI =& get_instance();
    }
    
    function GetArrayGolongan($Param = array()) {
        $Array = array();
		
		if (isset($Param['IsPns']) && $Param['IsPns'] == '1') {
			$RawQuery = "CALL DB2ADMIN.GETGOLONGANALL()";
		} else {
			$RawQuery = "CALL DB2ADMIN.GETGOLONGANCPNS()";
			$RawQuery = "CALL DB2ADMIN.GETGOLONGANALL()";
		}
		
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_GOLONGAN']] = $Element['PANGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
}
?>