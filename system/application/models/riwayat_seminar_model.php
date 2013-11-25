<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_hukuman_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDRIWAYATHUKUMAN(
				'".$param['ID_RIWAYAT_HUKUMAN']."', '".$param['K_PEGAWAI']."', '".$param['NO_SK']."', '".$param['TGL_SK']."',
				'".$param['TMT']."', '".$param['NIP_PEJABAT']."', '".$param['USERID']."', '".$param['NAMA_PEJABAT']."'
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
		$param['ID_RIWAYAT_HUKUMAN'] = (empty($param['ID_RIWAYAT_HUKUMAN'])) ? 'x' : $param['ID_RIWAYAT_HUKUMAN'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATHUKUMAN('".$param['ID_RIWAYAT_HUKUMAN']."', '".$param['K_PEGAWAI']."')";
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
		$param['ID_RIWAYAT_HUKUMAN'] = (empty($param['ID_RIWAYAT_HUKUMAN'])) ? 'x' : $param['ID_RIWAYAT_HUKUMAN'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATHUKUMAN('".$param['ID_RIWAYAT_HUKUMAN']."', '".$param['K_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELRIWAYATHUKUMAN('".$param['ID_RIWAYAT_HUKUMAN']."')";
		
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