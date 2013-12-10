<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class skp_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update_penyusunan($param) {
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
				'".$param['K_PENILAI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."',
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
	
	function get_by_id_kegiatan($param = array()) {
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
	
	function get_by_id_penilai($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI'] = (empty($param['K_PENILAI'])) ? 'x' : $param['K_PENILAI'];
        
		$raw_query = "CALL SKP.GETPENILAI('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync_penilai($row);
        }
		
        return $result;
    }
	
    function get_array_kegiatan($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_NILAI_TUPOKSI'] = (empty($param['ID_NILAI_TUPOKSI'])) ? 'x' : $param['ID_NILAI_TUPOKSI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
        
		$raw_query = "
			CALL SKP.GETNILAITUPOKSI(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."'
			)"
		;
		
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
    function get_array_penilai($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI'] = (empty($param['K_PENILAI'])) ? 'x' : $param['K_PENILAI'];
        
		$raw_query = "CALL SKP.GETPENILAI('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync_penilai($row);
        }
		
        return $result;
    }
	
	function delete_tupoksi($param) {
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
	
	function delete_penilai($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL SKP.DELPENILAI('".$param['K_PENILAI']."')";
		
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
		if (isset($row['PERHITUNGAN']))
			$row['PERHITUNGAN'] = number_format($row['PERHITUNGAN'], 2, '.', '');
		if (isset($row['NILAI_CAPAIAN']))
			$row['NILAI_CAPAIAN'] = number_format($row['NILAI_CAPAIAN'], 2, '.', '');
		
		return $row;
	}
	
	function sync_penilai($row) {
		$row['link_print'] = base_url('/index.php/pegawai_modul/skp/cetak/'.mcrypt_encode($row['K_PENILAI']));
		
		return $row;
	}
}