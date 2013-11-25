<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LDiklat {
    var $CI = null;
    
    function LDiklat() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
		$RawQuery = "CALL DB2ADMIN.GETDIKLATALL()";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        @db2_execute($Statement);
        while ($Row = @db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayDiklat = array();
        foreach ($Array as $Key => $Element) {
            $ArrayDiklat[$Element['K_DIKLAT']]['Content'] = $Element['CONTENT'];
            $ArrayDiklat[$Element['K_DIKLAT']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayDiklat;
    }
}
?>