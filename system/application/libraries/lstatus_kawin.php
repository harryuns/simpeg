<?php
if ( ! defined('BASEPATH'))
exit('No direct script access allowed');

class LStatus_Kawin {
    var $CI = null;
    
    function LStatus_Kawin() {
        $this->CI =& get_instance();
    }
    
    function GetArrayStatusKawin($AllOption = '0') {
        $Array = array();
        
        $Query = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETSTATUSKAWIN()");
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKawin = array();
        foreach ($Array as $Key => $Element) {
            if ($AllOption == '0' && $Element['K_STATUS_KAWIN'] != '99') {
                $ArrayStatusKawin[$Element['K_STATUS_KAWIN']]['Singkat'] = $Element['SINGKAT'];
                $ArrayStatusKawin[$Element['K_STATUS_KAWIN']]['Content'] = $Element['CONTENT'];
            }
        }
        
        return $ArrayStatusKawin;
    }
}
?>