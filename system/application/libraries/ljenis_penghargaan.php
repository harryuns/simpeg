<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LJenis_Penghargaan {
    var $CI = null;
    
    function LJenis_Penghargaan() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_JENIS_PENGHARGAAN ORDER BY CONTENT ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_JENIS_PENGHARGAAN']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_JENIS_PENGHARGAAN']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
}
?>