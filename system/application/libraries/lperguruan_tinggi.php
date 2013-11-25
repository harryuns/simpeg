<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPerguruan_Tinggi {
    var $CI = null;
    
    function LPerguruan_Tinggi() {
        $this->CI =& get_instance();
    }
    
    function GetArrayAsal($Param = array()) {
        $Array = array();
		
		$RawQuery = "CALL DB2ADMIN.GETMPTS3DIKTI()";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[$Row['K_ASAL_PT_S3DIKTI']] = $Row['CONTENT'];
        }
        
        return $Array;
    }
}
?>