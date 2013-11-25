<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LKedudukan {
    var $CI = null;
    
    function LKedudukan() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
		$RawQuery = "CALL DB2ADMIN.GETIDKEDSEMNR('x')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
		
        return $Array;
    }
}
?>