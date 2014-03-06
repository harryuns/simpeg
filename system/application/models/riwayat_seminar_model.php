<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_seminar_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDRIWAYATSEMINAR(
				'".$param['ID_RIWAYAT_SEMINAR']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['NAMA']."',
				'".$param['LOKASI']."', '".$param['TINGKAT']."', '".$param['PENYELENGGARA']."', '".$param['ID_KEDUDUKAN']."',
				'".$param['USERID']."'
			)
		";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
		$execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
		$execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		if ($row = db2_fetch_assoc($execute_query)) {
			if ($row['ERROR'] == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil disimpan';
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function get_by_id($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_RIWAYAT_SEMINAR'] = (empty($param['ID_RIWAYAT_SEMINAR'])) ? 'x' : $param['ID_RIWAYAT_SEMINAR'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATSEMINAR('".$param['ID_RIWAYAT_SEMINAR']."', '".$param['K_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync($row);
        }
		
        return $result;
    }
	
    function get_array($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_RIWAYAT_SEMINAR'] = (empty($param['ID_RIWAYAT_SEMINAR'])) ? 'x' : $param['ID_RIWAYAT_SEMINAR'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATSEMINAR('".$param['ID_RIWAYAT_SEMINAR']."', '".$param['K_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELRIWAYATSEMINAR('".$param['ID_RIWAYAT_SEMINAR']."')";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		if ($row = db2_fetch_assoc($execute_query)) {
			$query_status = $row['ERROR'];
			if ($query_status == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil dihapus.';
			}
		}
		
        return $result;
	}
	
	function sync($row) {
		return $row;
	}
}