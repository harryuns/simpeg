<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LNegara {
    var $CI = null;
    
    function LNegara() {
        $this->CI =& get_instance();
    }
    
    function GetArrayNegara() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETNEGARAALL()");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_NEGARA']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_NEGARA']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
}
?>