<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LBidang_Kerja {
    var $CI = null;
    
    function LBidang_Kerja() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETBIDKERJAALL()";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement) or die(db2_stmt_errormsg($Statement));
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $Result = array();
        foreach ($Array as $Key => $Element) {
            $Result[$Element['K_BIDANG_KERJA']]['Content'] = $Element['CONTENT'];
            $Result[$Element['K_BIDANG_KERJA']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $Result;
    }
}
?>