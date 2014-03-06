<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_sertifikasi_request_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['ID_REQ_SERTIFIKASI'] = (empty($param['ID_REQ_SERTIFIKASI'])) ? 'x' : $param['ID_REQ_SERTIFIKASI'];
		$param['ID_RIWAYAT_SERTIFIKASI'] = (empty($param['ID_RIWAYAT_SERTIFIKASI'])) ? 'x' : $param['ID_RIWAYAT_SERTIFIKASI'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDREQRIWAYATSERTIFIKASI(
				'".$param['ID_REQ_SERTIFIKASI']."', '".$param['JENIS_REQ_SERTIFIKASI']."', '".$param['USERID']."', '".$param['ID_RIWAYAT_SERTIFIKASI']."',
				'".$param['K_PEGAWAI']."', '".$param['NO_SERTIFIKAT']."', '".$param['NO_PESERTA']."', '".$param['TGL_SERTIFIKAT']."',
				'".$param['PEJABAT_TT']."', '".$param['K_PTP']."', '".$param['K_RUMPUN_ILMU']."', '".$param['TUNJANGAN_SERTIFIKASI']."',
				'".$param['TGL_AKHIR']."', '".$param['KETERANGAN']."', '".$param['USERID']."'
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
				$result['ID_REQ_SERTIFIKASI'] = $row['ID_REQ_SERTIFIKASI'];
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function validate($param) {
		$result['status'] = false;
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATSERTIFIKASI( '".$param['ID_REQ_SERTIFIKASI']."', '".$param['USERID']."' )";
		
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
		$param['ID_REQ_SERTIFIKASI'] = (empty($param['ID_REQ_SERTIFIKASI'])) ? 'x' : $param['ID_REQ_SERTIFIKASI'];
		
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATSERTIFIKASI(
			'".$param['ID_REQ_SERTIFIKASI']."', '".$param['K_PEGAWAI']."', '".$param['IS_VALIDATE']."'
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
        $raw_query = "CALL DB2ADMIN.DELREQRIWAYATSERTIFIKASI('".$param['ID_REQ_SERTIFIKASI']."')";
		
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
		$row['JML_FILE_TEXT'] = (@$row['JML_FILE'] == 0) ? '-' : 'Cek';
		
		return $row;
	}
	
	/*	region upload file */
	
	function update_file($param) {
		$result['status'] = false;
		$result['message'] = '';
		
		$param['JENIS_REQ_SERTIFIKASI_FILE'] = (isset($param['JENIS_REQ_SERTIFIKASI_FILE'])) ? $param['JENIS_REQ_SERTIFIKASI_FILE'] : 'I';
		$param['ID_RIWAYAT_SERTIFIKASI_FILE'] = (isset($param['ID_RIWAYAT_SERTIFIKASI_FILE'])) ? $param['ID_RIWAYAT_SERTIFIKASI_FILE'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.INSREQRIWAYATSERTIFIKASIFILE(
			'".$param['ID_RIWAYAT_SERTIFIKASI_FILE']."', '".$param['ID_REQ_SERTIFIKASI']."', '".$param['JENIS_REQ_SERTIFIKASI_FILE']."', '".$param['USERID']."',
			'".$param['FILENAME']."'
		)";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		
        if ($row = db2_fetch_assoc($execute_query)) {
			$result = $row;
			$result['message'] = (isset($row['MSG'])) ? $row['MSG'] : '';
			
			if ($result['ERROR'] == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				
				// upload file
				$ftp_param['file_path'] = $this->config->item('base_path').'/images/_Temp/'.$param['FILENAME'];
				$ftp_param['ftp_upload_path'] = $this->config->item('base_path').'/images/upload';
				$result = ftp_move_file($ftp_param);
			}
        }
		
		return $result;
	}
	
	function get_array_file($param) {
		$result = array();
		
		$counter = 0;
		$param['IS_VALIDATE'] = (empty($param['IS_VALIDATE'])) ? 'x' : $param['IS_VALIDATE'];
		$param['ID_REQ_SERTIFIKASI'] = (empty($param['ID_REQ_SERTIFIKASI'])) ? 'x' : $param['ID_REQ_SERTIFIKASI'];
		$param['ID_REQ_SERTIFIKASI_FILE'] = (empty($param['ID_REQ_SERTIFIKASI_FILE'])) ? 'x' : $param['ID_REQ_SERTIFIKASI_FILE'];
		
        $raw_query = "CALL DB2ADMIN.GETREQRIWAYATSERTIFIKASIFILE(
			'".$param['ID_REQ_SERTIFIKASI_FILE']."', '".$param['ID_REQ_SERTIFIKASI']."', '".$param['IS_VALIDATE']."'
		)";
		
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        while (false !== $row = db2_fetch_assoc($execute_query)) {
			$counter++;
			$row['name_file'] = $row['NO_SERTIFIKAT'] . ' File ke ' . $counter;
			$row['link_file'] = base_url('images/upload/'. $row['FILENAME']);
			$result[] = $row;
        }
		
		return $result;
	}
	
	function delete_file($param) {
		$result = array();
		$raw_query = "CALL DB2ADMIN.DELREQRIWAYATSERTIFIKASIFILE( '".$param['ID_REQ_SERTIFIKASI_FILE']."' )";
        
		WriteLog($param['K_PEGAWAI'], $raw_query);
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        if ($row = db2_fetch_assoc($execute_query)) {
			$result = $row;
			
			if ($result['ERROR'] == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil dihapus';
			}
        }
		
		return $result;
	}
	
	/*	end region upload file */
}