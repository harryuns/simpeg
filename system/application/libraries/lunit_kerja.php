<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LUnit_Kerja {
    var $CI = null;
    
    function LUnit_Kerja() {
        $this->CI =& get_instance();
    }
    
    function GetArrayAll($K_FAKULTAS = 'x', $Param = array()) {
        $Param['IS_FAKULTAS'] = (isset($Param['IS_FAKULTAS'])) ? $Param['IS_FAKULTAS'] : 'x'; 
		if ($Param['IS_FAKULTAS'] == 0 && $K_FAKULTAS != 'x') {
			$Param['IS_FAKULTAS'] = 'x';
		}
		
        $Array = array();
        $RawQuery = "CALL DB2ADMIN.GETMUNITKERJA('x', '$K_FAKULTAS', '".$Param['IS_FAKULTAS']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_UNIT_KERJA']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_UNIT_KERJA']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
    
    function GetArray($IsFungsional = '1', $IsDosen = '0', $K_FAKULTAS = 'x') {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETUNITKERJAALL('$IsFungsional', '$IsDosen', '$K_FAKULTAS')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array[] = $Row;
        }
        
        $ArrayStatusKerja = array();
        foreach ($Array as $Key => $Element) {
            $ArrayStatusKerja[$Element['K_UNIT_KERJA']]['Content'] = $Element['CONTENT'];
            $ArrayStatusKerja[$Element['K_UNIT_KERJA']]['Singkat'] = $Element['SINGKAT'];
        }
        
        return $ArrayStatusKerja;
    }
    
	function get_tree($param) {
        $array = array();
		$param['K_UNIT_KERJA'] = (isset($param['K_UNIT_KERJA'])) ? $param['K_UNIT_KERJA'] : 'x';
		$param['K_FAKULTAS'] = (isset($param['K_FAKULTAS'])) ? $param['K_FAKULTAS'] : 'x';
		$param['IS_FAKULTAS'] = (isset($param['IS_FAKULTAS'])) ? $param['IS_FAKULTAS'] : 'x';
		$param['K_PARENT'] = (isset($param['K_PARENT'])) ? $param['K_PARENT'] : '0';  
        
        $RawQuery = "
			CALL DB2ADMIN.GETMUNITKERJA(
				'".$param['K_UNIT_KERJA']."', '".$param['K_FAKULTAS']."', '".$param['IS_FAKULTAS']."', '".$param['K_PARENT']."'
			)
		";
		$Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($row = db2_fetch_assoc($Statement)) { 
            $array[] = $row;
        }
		
		// get child
		foreach ($array as $key => $row) { 
			// get children
			$param_child = $param;
			$param_child['K_PARENT'] = $row['K_UNIT_KERJA'];
			$array[$key]['CHILDREN'] = $this->get_tree($param_child);
		}
			
		
        return $array;
	}
	
    function GetById($K_UNIT_KERJA) {
        if (empty($K_UNIT_KERJA)) {
            return array();
        }
        
        $Array = array();
        $RawQuery = "SELECT * FROM DB2ADMIN.M_UNIT_KERJA WHERE K_UNIT_KERJA = '$K_UNIT_KERJA'";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array = $Row;
        }
        
        return $Array;
    }
    
    function GetUnitKerjaFromArray($ArrayUnitKerja) {
        $UnitKerjaExisting = '';
        foreach ($ArrayUnitKerja as $Key => $Element) {
            $UnitKerjaExisting = $Key;
        }
        
        return $UnitKerjaExisting;
    }
	
    function get_by_id($param) {
        $array = array();
		
		if (isset($param['K_FAKULTAS'])) {
			$raw_query = "SELECT * FROM DB2ADMIN.M_UNIT_KERJA WHERE K_FAKULTAS = '".$param['K_FAKULTAS']."'";
		} else if (isset($param['K_UNIT_KERJA'])) {
			$raw_query = "SELECT * FROM DB2ADMIN.M_UNIT_KERJA WHERE K_UNIT_KERJA = '".$param['K_UNIT_KERJA']."'";
		}
		
        $Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $array = $Row;
        }
		
        return $array;
    }
    
}
?>