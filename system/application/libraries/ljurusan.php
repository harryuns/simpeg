<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LJurusan {
    var $CI = null;
    
    function LJurusan() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_JURUSAN ORDER BY CONTENT ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJurusan = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJurusan[$Element['K_JURUSAN']]['Singkat'] = $Element['SINGKAT'];
            $ArrayJurusan[$Element['K_JURUSAN']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayJurusan;
    }
    
    function GetById($K_JENJANG, $K_FAKULTAS) {
        $Array = array();
        
        if (empty($K_JENJANG) || empty($K_FAKULTAS)) {
            return $Array;
        }
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_JURUSAN WHERE K_JENJANG = '$K_JENJANG' AND K_FAKULTAS = '$K_FAKULTAS' ORDER BY CONTENT ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJurusan = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJurusan[$Element['K_JURUSAN']]['Singkat'] = $Element['SINGKAT'];
            $ArrayJurusan[$Element['K_JURUSAN']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayJurusan;
    }
}
?>