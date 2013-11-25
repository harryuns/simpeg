<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LAgama {
    var $CI = null;
    
    function LAgama() {
        $this->CI =& get_instance();
    }
    
    function GetArrayAgama($AllOption = '0') {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETAGAMA()");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $Agama = array();
        foreach ($Array as $Key => $Element) {
            if ($AllOption == '0' && $Element['K_AGAMA'] != '99') {
                $Agama[$Element['K_AGAMA']] = $Element['CONTENT'];
            }
        }
        
        return $Agama;
    }
}
?>