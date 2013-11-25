<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPropinsi {
    var $CI = null;
    
    function LPropinsi() {
        $this->CI =& get_instance();
    }
    
    function GetArray($K_NEGARA) {
        $Array = array();
        
		$K_NEGARA = (empty($K_NEGARA)) ? 360 : $K_NEGARA;
		$RawQuery = "CALL DB2ADMIN.GETPROPINSI('$K_NEGARA')";
		
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[$Row['K_PROPINSI']]['Singkat'] = $Row['CONTENT'];
            $Array[$Row['K_PROPINSI']]['Content'] = $Row['CONTENT'];
        }
		
        return $Array;
    }
}
?>