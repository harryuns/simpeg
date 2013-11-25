<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LHukuman {
    var $CI = null;
    
    function LHukuman() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETIDHUKUMAN('x')");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        return $Array;
    }
}
?>