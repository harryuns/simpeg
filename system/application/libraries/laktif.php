<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LAktif {
    var $CI = null;
    
    function LAktif() {
        $this->CI =& get_instance();
    }
    
    function GetArrayAktif() {
        $Array = array();
        
        $Query = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETSTATUSAKTIFALL()");
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[] = $Row;
        }
        
        $ArrayAktif = array();
        foreach ($Array as $Key => $Element) {
            $ArrayAktif[$Element['K_AKTIF']]['Singkat'] = $Element['SINGKAT'];
            $ArrayAktif[$Element['K_AKTIF']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayAktif;
    }
}
?>