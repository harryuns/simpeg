<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPerubahan_Gaji {
    var $CI = null;
    
    function LPerubahan_Gaji() {
        $this->CI =& get_instance();
    }
    
    function GetArray($Param = array()) {
        $Array = array();
        $RawQuery = "CALL DB2ADMIN.GETMPERUBAHANGAJI('x')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[$Row['K_PERUBAHAN_GAJI']]['Singkat'] = $Row['CONTENT'];
            $Array[$Row['K_PERUBAHAN_GAJI']]['Content'] = $Row['CONTENT'];
        }
        return $Array;
    }
}
?>