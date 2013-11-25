<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LFakultas {
    var $CI = null;
    
    function LFakultas() {
        $this->CI =& get_instance();
    }
    
    function GetArrayFakultas() {
        $Array = array();
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, "SELECT * FROM DB2ADMIN.M_FAKULTAS ORDER BY CONTENT ASC");
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayFakultas = array();
        foreach ($Array as $Key => $Element) {
            $ArrayFakultas[$Element['K_FAKULTAS']]['Singkat'] = $Element['SINGKAT'];
            $ArrayFakultas[$Element['K_FAKULTAS']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayFakultas;
    }
    
    function GetFakultasByID($K_FAKULTAS = 'x') {
        $Array = array();
        $RawQuery = "
            SELECT *
            FROM DB2ADMIN.M_FAKULTAS
            WHERE K_FAKULTAS = '$K_FAKULTAS'
            ORDER BY CONTENT ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array = $Row;
        }
        
        return $Array;
    }
    
    function GetFakultasByJenjang($K_JENJANG, $K_FAKULTAS = 'x', $WithAllFakultas = '0') {
        $Array = array();
        
        if (empty($K_JENJANG)) {
            return $Array;
        }
        
        $RawQuery = "
            SELECT *
            FROM DB2ADMIN.M_FAKULTAS
            WHERE
                (K_JENJANG = '$K_JENJANG' OR '$K_JENJANG' = 'x')
                AND (K_FAKULTAS = '$K_FAKULTAS' OR '$K_FAKULTAS' = 'x')
                AND (
                    ('$WithAllFakultas' = '0')
                    OR ('$WithAllFakultas' = '1' AND K_FAKULTAS != 'x')
                )
            ORDER BY M_FAKULTAS.K_FAKULTAS ASC";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayFakultas = array();
        foreach ($Array as $Key => $Element) {
            $ArrayFakultas[$Element['K_FAKULTAS']]['Singkat'] = $Element['SINGKAT'];
            $ArrayFakultas[$Element['K_FAKULTAS']]['Content'] = $Element['CONTENT'];
        }
        
        $ArrayFakultas['x']['Content'] = 'Semua Fakultas';
        $ArrayFakultas['x']['Singkat'] = 'Semua Fakultas';
        
        return $ArrayFakultas;
    }
    
    function GetFakultasByEkdReport($FakultasID, $WithAllFaculty = true) {
        $Array = array();
        
        $RawQuery = "CALL EKD.GETMFAKLAPORANEKD('$FakultasID')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayFakultas = array();
        foreach ($Array as $Key => $Element) {
            $ArrayFakultas[$Element['K_FAKULTAS'].' - '.$Element['K_UNIT_KERJA']]['Singkat'] = $Element['FAKULTAS'];
            $ArrayFakultas[$Element['K_FAKULTAS'].' - '.$Element['K_UNIT_KERJA']]['Content'] = $Element['FAKULTAS'];
            $ArrayFakultas[$Element['K_FAKULTAS'].' - '.$Element['K_UNIT_KERJA']]['K_UNIT_KERJA'] = $Element['K_UNIT_KERJA'];
        }
        
        if ($FakultasID == 'x' && $WithAllFaculty) {
            $ArrayFakultas['x']['Content'] = 'Semua Fakultas';
            $ArrayFakultas['x']['Singkat'] = 'Semua Fakultas';
        }
        
        return $ArrayFakultas;
    }
    
    function GetJabatan($UnitKerja, $JabatanStruktural) {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETPEJABAT('$UnitKerja', '$JabatanStruktural')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array = $Row;
        }
        
        return $Array;
    }
    
    function GetFakultasByJenjangUnitKerja($K_JENJANG, $K_UNIT_KERJA = '') {
        $Array = array();
        
        if (empty($K_JENJANG)) {
            return $Array;
        }
        
        $UnitKerja = $this->CI->lunit_kerja->GetById($K_UNIT_KERJA);
        $RawQuery = "CALL DB2ADMIN.GETFAKBYJENJ('$K_JENJANG', '".$UnitKerja['K_FAKULTAS']."');";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[] = $Row;
        }
        
        $ArrayFakultas = array();
        foreach ($Array as $Key => $Element) {
            $ArrayFakultas[$Element['K_FAKULTAS']]['Singkat'] = $Element['SINGKAT'];
            $ArrayFakultas[$Element['K_FAKULTAS']]['Content'] = $Element['CONTENT'];
        }
        
        return $ArrayFakultas;
    }
}
?>