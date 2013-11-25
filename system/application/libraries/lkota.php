<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LKota {
    var $CI = null;
    
    function LKota() {
        $this->CI =& get_instance();
    }
    
    function GetArray($K_NEGARA, $K_PROPINSI) {
        $Array = array();
        
		$RawQuery = "CALL DB2ADMIN.GETKOTA('$K_NEGARA','$K_PROPINSI')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[$Row['K_KOTA']]['Singkat'] = $Row['CONTENT'];
            $Array[$Row['K_KOTA']]['Content'] = $Row['CONTENT'];
        }
		
        return $Array;
    }
}
?>