<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_diklat_request_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['ID_REQUEST'] = (empty($param['ID_REQUEST'])) ? 'x' : $param['ID_REQUEST'];
		$param['ID_RIWAYAT_DIKLAT'] = (empty($param['ID_RIWAYAT_DIKLAT'])) ? 'x' : $param['ID_RIWAYAT_DIKLAT'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDREQRIWAYATDIKLAT(
				'".$param['ID_REQUEST']."',
				'".$param['JENIS_REQUEST']."', '".$param['USERID']."', '".$param['ID_RIWAYAT_DIKLAT']."', '".$param['K_PEGAWAI']."',
				'".$param['NO_SERTIFIKAT']."', '".$param['TGL_SERTIFIKAT']."', '".$param['PENYELENGGARA']."',
				'".$param['K_DIKLAT']."', '', '".$param['ANGKATAN']."',
				'".$param['TGL_MULAI']."', '".$param['TGL_LULUS']."', '".$param['KETERANGAN']."',
				'".$param['TMP_DIKLAT']."', '', '".$param['IS_LUARNEGERI']."',
				'".$param['JML_JAM']."', '".$param['PREDIKAT']."', '".$param['NAMA_DIKLAT']."'
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
				$result['ID_REQUEST'] = $row['ID_REQUEST'];
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function validate($param) {
		$result['status'] = false;
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATDIKLAT( '".$param['ID_REQUEST']."', '".$param['USERID']."' )";
		
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
		$param['id_request'] = (empty($param['id_request'])) ? 'x' : $param['id_request'];
		$param['IS_VALIDATE'] = (isset($param['IS_VALIDATE'])) ? $param['IS_VALIDATE'] : 'x';
		$param['no_sertifikat'] = (empty($param['no_sertifikat'])) ? 'x' : $param['no_sertifikat'];
		
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATDIKLAT(
			'".$param['id_request']."', '".$param['k_pegawai']."', '".$param['no_sertifikat']."', '".$param['IS_VALIDATE']."'
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
        $raw_query = "CALL DB2ADMIN.DELREQRIWAYATDIKLAT('".$param['ID_REQUEST']."')";
		
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
		$row['JML_FILE_TEXT'] = ($row['JML_FILE'] == 0) ? '-' : 'Cek';
		
		return $row;
	}
	
	/*	region upload file */
	
	function update_file($param) {
		$result['status'] = false;
		$result['message'] = '';
		
		$param['JENIS_REQUEST'] = (isset($param['JENIS_REQUEST'])) ? $param['JENIS_REQUEST'] : 'I';
		$param['ID_RIWAYAT_DIKLAT_FILE'] = (isset($param['ID_RIWAYAT_DIKLAT_FILE'])) ? $param['ID_RIWAYAT_DIKLAT_FILE'] : 'x';
		
        $raw_query = "CALL DB2ADMIN.INSREQRIWAYATDIKLATFILE(
			'".$param['JENIS_REQUEST']."', '".$param['USERID']."', '".$param['ID_REQUEST']."', '".$param['ID_RIWAYAT_DIKLAT_FILE']."',
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
	
	function validate_file($param) {
		$result['status'] = false;
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATDIKLATFILE( '".$param['ID_REQUEST']."', '".$param['USERID']."' )";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
		$execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
		$execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		if ($row = db2_fetch_assoc($execute_query)) {
			print_r($row); exit;
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
	
	function get_array_file($param) {
		$result = array();
		
		$counter = 0;
		$param['ID_REQUEST'] = (empty($param['ID_REQUEST'])) ? 'x' : $param['ID_REQUEST'];
		$param['IS_VALIDATE'] = (empty($param['IS_VALIDATE'])) ? 'x' : $param['IS_VALIDATE'];
		$param['ID_RIWAYAT_DIKLAT_FILE'] = (empty($param['ID_RIWAYAT_DIKLAT_FILE'])) ? 'x' : $param['ID_RIWAYAT_DIKLAT_FILE'];
		
        $raw_query = "CALL DB2ADMIN.GETREQRIWAYATDIKLATFILE(
			'".$param['ID_RIWAYAT_DIKLAT_FILE']."', '".$param['ID_REQUEST']."', '".$param['IS_VALIDATE']."'
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
		$raw_query = "CALL DB2ADMIN.DELREQRIWAYATDIKLATFILE( '".$param['ID_REQUEST']."' )";
        
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