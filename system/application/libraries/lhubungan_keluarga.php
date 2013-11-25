<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LHubungan_Keluarga {
    var $CI = null;
    
    function LHubungan_Keluarga() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_KELUARGA ORDER BY CONTENT ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_KELUARGA']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_KELUARGA']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
}
?>