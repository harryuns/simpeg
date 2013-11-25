<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class skp_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update_target($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDTARGET(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."',
				'".$param['AK_TARGET']."', '".$param['KUAN_TARGET']."', '".$param['KUAL_TARGET']."', '".$param['WAKTU_TARGET']."',
				'".$param['BIAYA_TARGET']."', '".$param['USERID']."'
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
	
	function update_tupoksi($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDNILAITUPOKSI(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."',
				'".$param['AK_TARGET']."', '".$param['KUAN_TARGET']."', '".$param['KUAL_TARGET']."', '".$param['WAKTU_TARGET']."',
				'".$param['BIAYA_TARGET']."', '".$param['AK_REAL']."', '".$param['KUAN_REAL']."', '".$param['KUAL_REAL']."',
				'".$param['WAKTU_REAL']."', '".$param['BIAYA_REAL']."', '".$param['USERID']."'
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
	
	function update_penilai($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDPENILAI(
				'".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI']."', '".$param['USERID']."'
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
	
	function update_realisasi($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.UPDREALISASI(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['AK_REAL']."', '".$param['KUAN_REAL']."', '".$param['KUAL_REAL']."',
				'".$param['WAKTU_REAL']."', '".$param['BIAYA_REAL']."', '".$param['USERID']."'
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
		$param['ID_NILAI_TUPOKSI'] = (empty($param['ID_NILAI_TUPOKSI'])) ? 'x' : $param['ID_NILAI_TUPOKSI'];
        
		$raw_query = "CALL SKP.GETNILAITUPOKSI('".$param['ID_NILAI_TUPOKSI']."')";
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
		$param['ID_NILAI_TUPOKSI'] = (empty($param['ID_NILAI_TUPOKSI'])) ? 'x' : $param['ID_NILAI_TUPOKSI'];
        
		$raw_query = "CALL SKP.GETNILAITUPOKSI('".$param['ID_NILAI_TUPOKSI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        @db2_execute($statement);
        while ($row = @db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL SKP.DELNILAITUPOKSI('".$param['ID_NILAI_TUPOKSI']."')";
		
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