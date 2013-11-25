<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRumpun_Ilmu {
    var $CI = null;
    
    function LRumpun_Ilmu() {
        $this->CI =& get_instance();
    }
    
    function GetArray($Param = array()) {
        $Array = array();
		
		$Param['RUMPUN_ILMU'] = (isset($Param['RUMPUN_ILMU'])) ? $Param['RUMPUN_ILMU'] : 'x';
		$RawQuery = "CALL DB2ADMIN.GETRUMPUNILMU('".$Param['RUMPUN_ILMU']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[$Row['K_RUMPUN_ILMU']]['Singkat'] = $Row['SINGKAT'];
            $Array[$Row['K_RUMPUN_ILMU']]['Content'] = $Row['CONTENT'];
        }
        
        return $Array;
    }
}
?>