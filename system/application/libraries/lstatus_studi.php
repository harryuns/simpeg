<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LStatus_Studi {
    var $CI = null;
    
    function LStatus_Studi() {
        $this->CI =& get_instance();
		
		$this->StudiLanjut = array('05', '06');
    }
    
    function GetArray() {
        $Array = array();
        
		$RawQuery = "CALL DB2ADMIN.GETMSTATSTUDI()";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[$Row['K_STATUS_STUDI']]['Singkat'] = $Row['CONTENT'];
            $Array[$Row['K_STATUS_STUDI']]['Content'] = $Row['CONTENT'];
        }
		
        return $Array;
    }
	
	function IsStudiLanjut($Value) {
		return (in_array($Value, $this->StudiLanjut)) ? 1 : 0;
	}
}
?>