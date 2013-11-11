<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LJabatan_Fungsional {
    var $CI = null;
    
    function LJabatan_Fungsional() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_JABATAN_FUNGSIONAL";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJabatanFungsional = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJabatanFungsional[$Element['K_JABATAN_FUNGSIONAL']]['Content'] = $Element['CONTENT'];
            $ArrayJabatanFungsional[$Element['K_JABATAN_FUNGSIONAL']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayJabatanFungsional;
    }
    
    function GetArrayByJenisKerja($IsDosen, $is_active = 1) {
        $Array = array();
        
//        $RawQuery = "CALL DB2ADMIN.GETJABFUNGALL('$IsDosen')";
        $RawQuery = "CALL DB2ADMIN.GETMJABATANFUNGSIONAL('$IsDosen', '$is_active')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJabatanFungsional = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJabatanFungsional[$Element['K_JABATAN_FUNGSIONAL']]['Content'] = $Element['CONTENT'];
            $ArrayJabatanFungsional[$Element['K_JABATAN_FUNGSIONAL']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayJabatanFungsional;
    }
}
?>