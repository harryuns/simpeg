<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LJabatan_Struktural {
    var $CI = null;
    
    function LJabatan_Struktural() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_JABATAN_STRUKTURAL";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayResult = array();
        foreach ($Array as $Key => $Element) {
            $ArrayResult[$Element['K_JABATAN_STRUKTURAL']]['Content'] = $Element['CONTENT'];
            $ArrayResult[$Element['K_JABATAN_STRUKTURAL']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayResult;
    }
    
    function GetArrayByUnitKerja($K_UNIT_KERJA) {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_JABATAN_STRUKTURAL WHERE K_UNIT_KERJA = '$K_UNIT_KERJA'";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayResult = array();
        foreach ($Array as $Key => $Element) {
            $ArrayResult[$Element['K_JABATAN_STRUKTURAL']]['Content'] = $Element['CONTENT'];
            $ArrayResult[$Element['K_JABATAN_STRUKTURAL']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayResult;
    }
    
    function GetArrayByBidangKerja() {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_JABATAN_STRUKTURAL WHERE K_JABATAN_STRUKTURAL = '99'";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayResult = array();
        foreach ($Array as $Key => $Element) {
            $ArrayResult[$Element['K_JABATAN_STRUKTURAL']]['Content'] = $Element['CONTENT'];
            $ArrayResult[$Element['K_JABATAN_STRUKTURAL']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayResult;
    }
}
?>