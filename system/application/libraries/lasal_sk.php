<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LAsal_Sk {
    var $CI = null;
    
    function LAsal_Sk() {
        $this->CI =& get_instance();
    }
    
    function GetArrayAsalSk() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETASALSKALL()");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_ASAL_SK']]['id'] = $Element['K_ASAL_SK'];
            $ArrayStatusKerja[$Element['K_ASAL_SK']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_ASAL_SK']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
}
?>