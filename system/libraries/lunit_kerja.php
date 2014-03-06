<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LUnit_Kerja {
    var $CI = null;
    
    function LUnit_Kerja() {
        $this->CI =& get_instance();
    }
    
    function GetArray($IsFungsional, $IsDosen) {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETUNITKERJAALL('$IsFungsional', '$IsDosen')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
//            if ($IsFungsional && in_array($Row['K_UNIT_KERJA'], array('01', '02', '03'))) {
//                continue;
//            }
            
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_UNIT_KERJA']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_UNIT_KERJA']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
    
    function GetById($K_UNIT_KERJA) {
        if (empty($K_UNIT_KERJA)) {
            return array();
        }
        
        $Array = array();
        $RawQuery = "SELECT * FROM M_UNIT_KERJA WHERE K_UNIT_KERJA = '$K_UNIT_KERJA'";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array = $Row;
        }
        
        return $Array;
    }
}
?>