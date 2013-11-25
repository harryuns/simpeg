<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPtp {
    var $CI = null;
    
    function LPtp() {
        $this->CI =& get_instance();
    }
    
    function GetArray($Param = array()) {
        $Array = array();
		
		$Param['PTP'] = (isset($Param['PTP'])) ? $Param['PTP'] : 'x';
		$RawQuery = "CALL DB2ADMIN.GET_PTP('".$Param['PTP']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[$Row['K_PTP']] = $Row['NAMA'];
        }
        
        return $Array;
    }
}
?>