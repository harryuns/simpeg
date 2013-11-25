<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPenjelasan {
    var $CI = null;
    
    function LPenjelasan() {
        $this->CI =& get_instance();
    }
    
    function GetArrayPenjelasan() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETJELASALL()");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_PENJELASAN']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_PENJELASAN']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
}
?>