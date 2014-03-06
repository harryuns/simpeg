<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_keluarga_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDRIWAYATKELUARGA(
				'".$param['ID_RIWAYAT_KELUARGA']."', '".$param['K_PEGAWAI']."', '".$param['NAMA']."', '".$param['K_KELUARGA']."',
				'".$param['KARTU_NIKAH']."', '".$param['TGL_NIKAH']."', '".$param['TGL_LAHIR']."', '".$param['TMP_LAHIR']."',
				'".$param['ALAMAT']."', '".$param['K_JENJANG']."', '".$param['PENDIDIKAN_AKHIR']."', '".$param['PEKERJAAN']."',
				'".$param['KETERANGAN']."', '".$param['KELAMIN']."', '".$param['IS_ALM']."', '".$param['IS_CERAI']."',
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
		$param['ID_RIWAYAT_KELUARGA'] = (empty($param['ID_RIWAYAT_KELUARGA'])) ? 'x' : $param['ID_RIWAYAT_KELUARGA'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATKELUARGA('".$param['ID_RIWAYAT_KELUARGA']."', '".$param['K_PEGAWAI']."')";
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
		$param['ID_RIWAYAT_KELUARGA'] = (empty($param['ID_RIWAYAT_KELUARGA'])) ? 'x' : $param['ID_RIWAYAT_KELUARGA'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATKELUARGA('".$param['ID_RIWAYAT_KELUARGA']."', '".$param['K_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELRIWAYATKELUARGA('".$param['ID_RIWAYAT_KELUARGA']."')";
		
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