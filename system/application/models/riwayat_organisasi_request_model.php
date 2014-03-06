<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_organisasi_request_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['ID_REQ_ORGANISASI'] = (empty($param['ID_REQ_ORGANISASI'])) ? 'x' : $param['ID_REQ_ORGANISASI'];
		$param['ID_RIWAYAT_ORGANISASI'] = (empty($param['ID_RIWAYAT_ORGANISASI'])) ? 'x' : $param['ID_RIWAYAT_ORGANISASI'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDREQRIWAYATORGANISASI(
				'".$param['ID_REQ_ORGANISASI']."', '".$param['JENIS_REQ_ORGANISASI']."', '".$param['USERID']."', '".$param['ID_RIWAYAT_ORGANISASI']."',
				'".$param['K_PEGAWAI']."', '".$param['NAMA']."', '".$param['KEDUDUKAN']."', '".$param['TGL_MULAI']."',
				'".$param['TGL_SELESAI']."', '".$param['NO_SK']."', '".$param['NIP_PEJABAT']."', '".$param['NAMA_PEJABAT']."',
				'".$param['JABATAN_PEJABAT']."'
			)
		";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
		$execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
		$execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		if ($row = db2_fetch_assoc($execute_query)) {
			$query_status = $row['ERROR'];
			if ($query_status == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil disimpan';
				$result['ID_REQ_ORGANISASI'] = $row['ID_REQ_ORGANISASI'];
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function validate($param) {
		$result['status'] = false;
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATORGANISASI( '".$param['ID_REQ_ORGANISASI']."', '".$param['USERID']."' )";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
		$execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
		$execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		if ($row = db2_fetch_assoc($execute_query)) {
			$query_status = $row['ERROR'];
			if ($query_status == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil divalidasi';
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
    function get_array($param = array()) {
        $result = array();
		$param['offset'] = (isset($param['offset'])) ? $param['offset'] : 0;
		$param['limit'] = (isset($param['limit'])) ? $param['limit'] : 50;
		$param['IS_VALIDATE'] = (isset($param['IS_VALIDATE'])) ? $param['IS_VALIDATE'] : 'x';
		$param['ID_REQ_ORGANISASI'] = (empty($param['ID_REQ_ORGANISASI'])) ? 'x' : $param['ID_REQ_ORGANISASI'];
		
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATORGANISASI(
			'".$param['ID_REQ_ORGANISASI']."', '".$param['K_PEGAWAI']."', '".$param['IS_VALIDATE']."'
		)";
		
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
		// paging
		$result = GetPageFromArray($result, $param['offset'], $param['limit']);
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELREQRIWAYATORGANISASI('".$param['ID_REQ_ORGANISASI']."')";
		
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