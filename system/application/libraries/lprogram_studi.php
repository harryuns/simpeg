<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LProgram_Studi {
    var $CI = null;
    
    function LProgram_Studi() {
        $this->CI =& get_instance();
    }
    
    function GetArray() {
        $Array = array();
        
        $RawQuery = "SELECT * FROM DB2ADMIN.M_PROG_STUDI ORDER BY CONTENT ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJurusan = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJurusan[$Element['K_PROG_STUDI']]['Singkat'] = $Element['SINGKAT'];
            $ArrayJurusan[$Element['K_PROG_STUDI']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayJurusan;
    }
    
    function GetById($K_JENJANG, $K_FAKULTAS, $K_JURUSAN) {
        $Array = array();
        
        if (empty($K_JENJANG) || empty($K_FAKULTAS) || empty($K_JURUSAN)) {
            return $Array;
        }
        
        $RawQuery = "
                SELECT *
                FROM DB2ADMIN.M_PROG_STUDI
                WHERE
                    K_JENJANG = '$K_JENJANG'
                    AND K_FAKULTAS = '$K_FAKULTAS'
                    AND K_JURUSAN = '$K_JURUSAN'
                ORDER BY CONTENT ASC
            ";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayJurusan = array();
        foreach ($Array as $Key => $Element) {
            $ArrayJurusan[$Element['K_PROG_STUDI']]['Singkat'] = $Element['SINGKAT'];
            $ArrayJurusan[$Element['K_PROG_STUDI']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayJurusan;
    }
}
?>