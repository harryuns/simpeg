<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LJenis_Kerja {
    var $CI = null;
    
    function LJenis_Kerja() {
        $this->CI =& get_instance();
    }
    
    function GetArrayJenisKerja() {
        $Array = array();
        
		$RawQuery = "SELECT * FROM DB2ADMIN.M_JENIS_KERJA ORDER BY CONTENT ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJenisKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJenisKerja[$Element['K_JENIS_KERJA']]['Content'] = $Element['CONTENT'];
            $ArrayJenisKerja[$Element['K_JENIS_KERJA']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayJenisKerja;
    }
}
?>