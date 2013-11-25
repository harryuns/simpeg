<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LStatus_Dosen {
    var $CI = null;
    
    function LStatus_Dosen() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETSTATUSDOSEN()";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusDosen = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusDosen[$Element['K_STATUS_DOSEN']]['Content'] = $Element['CONTENT'];
            $ArrayStatusDosen[$Element['K_STATUS_DOSEN']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusDosen;
    }
}
?>