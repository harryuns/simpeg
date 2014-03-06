<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_homebase_request_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['ID_REQ_HOMEBASE'] = (empty($param['ID_REQ_HOMEBASE'])) ? 'x' : $param['ID_REQ_HOMEBASE'];
		$param['ID_RIWAYAT_HOMEBASE'] = (empty($param['ID_RIWAYAT_HOMEBASE'])) ? 'x' : $param['ID_RIWAYAT_HOMEBASE'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDREQRIWAYATHOMEBASE(
				'".$param['ID_REQ_HOMEBASE']."', '".$param['JENIS_REQ_HOMEBASE']."', '".$param['USERID']."', '".$param['ID_RIWAYAT_HOMEBASE']."',
				'".$param['K_PEGAWAI']."', '".$param['NO_SK']."', '".$param['TGL_SK']."', '".$param['K_ASAL_SK']."',
				'".$param['TMT']."', '".$param['K_UNIT_KERJA']."', '".$param['K_PROG_STUDI']."', '".$param['K_JURUSAN']."',
				'".$param['K_FAKULTAS']."', '".$param['K_JENJANG']."', '".$param['IS_PDPT']."', '".$param['IS_SIMPEG']."'
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
				$result['ID_REQ_HOMEBASE'] = $row['ID_REQ_HOMEBASE'];
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function validate($param) {
		$result['status'] = false;
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATHOMEBASE( '".$param['ID_REQ_HOMEBASE']."', '".$param['USERID']."' )";
		
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
		$param['ID_REQ_HOMEBASE'] = (empty($param['ID_REQ_HOMEBASE'])) ? 'x' : $param['ID_REQ_HOMEBASE'];
		
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATHOMEBASE(
			'".$param['ID_REQ_HOMEBASE']."', '".$param['K_PEGAWAI']."', '".$param['IS_VALIDATE']."'
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
        $raw_query = "CALL DB2ADMIN.DELREQRIWAYATHOMEBASE('".$param['ID_REQ_HOMEBASE']."')";
		
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
		$row['IS_PDPT_TEXT'] = ($row['IS_PDPT']) ? 'Ya' : 'Tidak';
		$row['IS_SIMPEG_TEXT'] = ($row['IS_SIMPEG']) ? 'Ya' : 'Tidak';
		$row['JML_FILE_TEXT'] = (@$row['JML_FILE'] == 0) ? '-' : 'Cek';
		
		return $row;
	}
	
	/*	region upload file */
	
	function update_file($param) {
		$result['status'] = false;
		$result['message'] = '';
		
		$param['JENIS_REQ_HOMEBASE_FILE'] = (isset($param['JENIS_REQ_HOMEBASE_FILE'])) ? $param['JENIS_REQ_HOMEBASE_FILE'] : 'I';
		$param['ID_RIWAYAT_HOMEBASE_FILE'] = (isset($param['ID_RIWAYAT_HOMEBASE_FILE'])) ? $param['ID_RIWAYAT_HOMEBASE_FILE'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.INSREQRIWAYATHOMEBASEFILE(
			'".$param['JENIS_REQ_HOMEBASE_FILE']."', '".$param['USERID']."', '".$param['ID_REQ_HOMEBASE']."', '".$param['ID_RIWAYAT_HOMEBASE_FILE']."',
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
		$param['ID_REQ_HOMEBASE'] = (empty($param['ID_REQ_HOMEBASE'])) ? 'x' : $param['ID_REQ_HOMEBASE'];
		$param['IS_VALIDATE'] = (empty($param['IS_VALIDATE'])) ? 'x' : $param['IS_VALIDATE'];
		$param['ID_REQ_HOMEBASE_FILE'] = (empty($param['ID_REQ_HOMEBASE_FILE'])) ? 'x' : $param['ID_REQ_HOMEBASE_FILE'];
		
        $raw_query = "CALL DB2ADMIN.GETREQRIWAYATHOMEBASEFILE(
			'".$param['ID_REQ_HOMEBASE_FILE']."', '".$param['ID_REQ_HOMEBASE']."', '".$param['IS_VALIDATE']."'
		)";
		
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        while (false !== $row = db2_fetch_assoc($execute_query)) {
			$counter++;
			$row['name_file'] = $row['NO_SK'] . ' File ke ' . $counter;
			$row['link_file'] = base_url('images/upload/'. $row['FILENAME']);
			$result[] = $row;
        }
		
		return $result;
	}
	
	function delete_file($param) {
		$result = array();
		$raw_query = "CALL DB2ADMIN.DELREQRIWAYATHOMEBASEFILE( '".$param['ID_REQ_HOMEBASE_FILE']."' )";
        
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