<?php
if ( ! defined('BASEPATH'))
	exit('No direct script access allowed');

class LJenjang {
    var $CI = null;
    
    function LJenjang() {
        $this->CI =& get_instance();
    }
    
    function GetArrayAll() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "SELECT * FROM DB2ADMIN.M_JENJANG");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJenjang = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJenjang[$Element['K_JENJANG']]['Singkat'] = $Element['SINGKAT'];
            $ArrayJenjang[$Element['K_JENJANG']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayJenjang;
    }
    
    function GetArrayJenjang() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETMJENJANGUB()");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJenjang = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJenjang[$Element['K_JENJANG']]['Singkat'] = $Element['SINGKAT'];
            $ArrayJenjang[$Element['K_JENJANG']]['Content'] = $Element['CONTENT'];
            $ArrayJenjang[$Element['K_JENJANG']]['K_JENJANG'] = $Element['K_JENJANG'];
        }
        
        return $ArrayJenjang;
    }
    
    function GetArrayJenjangPendidikan() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "CALL DB2ADMIN.GETMJENJANGPENDD()");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJenjang = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJenjang[$Element['K_JENJANG']]['Singkat'] = $Element['SINGKAT'];
            $ArrayJenjang[$Element['K_JENJANG']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayJenjang;
    }
    
    function GetJenjangByUnitKerja($K_UNIT_KERJA) {
        $UnitKerja = $this->CI->lunit_kerja->GetById($K_UNIT_KERJA);
        
        $ArrayJenjang = array();
        if ($UnitKerja['K_FAKULTAS'] == '99') {
            $ArrayJenjang['99']['Singkat'] = '-';
            $ArrayJenjang['99']['Content'] = '-';
        } else {
            $ArrayJenjang = $this->GetArrayJenjang('0');
        }
        
        return $ArrayJenjang;
    }
}
?>