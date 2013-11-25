<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_homebase_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDRIWAYATHOMEBASE(
				'".$param['ID_RIWAYAT_HOMEBASE']."', '".$param['K_PEGAWAI']."', '".$param['NO_SK']."', '".$param['TGL_SK']."',
				'".$param['K_ASAL_SK']."', '".$param['TMT']."', '".$param['K_UNIT_KERJA']."', 
				'".$param['K_JENJANG']."', '".$param['K_FAKULTAS']."', '".$param['K_JURUSAN']."',
				'".$param['K_PROG_STUDI']."', '".$param['USERID']."', '".$param['IS_PDPT']."',
				'".$param['IS_SIMPEG']."'
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
		$param['ID_RIWAYAT_HOMEBASE'] = (empty($param['ID_RIWAYAT_HOMEBASE'])) ? 'x' : $param['ID_RIWAYAT_HOMEBASE'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATHOMEBASE('".$param['ID_RIWAYAT_HOMEBASE']."', '".$param['K_PEGAWAI']."')";
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
		$param['ID_RIWAYAT_HOMEBASE'] = (empty($param['ID_RIWAYAT_HOMEBASE'])) ? 'x' : $param['ID_RIWAYAT_HOMEBASE'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATHOMEBASE('".$param['ID_RIWAYAT_HOMEBASE']."', '".$param['K_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELRIWAYATHOMEBASE('".$param['ID_RIWAYAT_HOMEBASE']."')";
		
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
		
		$param['ID_RIWAYAT_HOMEBASE_FILE'] = (empty($param['ID_RIWAYAT_HOMEBASE_FILE'])) ? 'x' : $param['ID_RIWAYAT_HOMEBASE_FILE'];
		$raw_query = "CALL DB2ADMIN.INSUPDRIWAYATHOMEBASEFILE(
			'".$param['ID_RIWAYAT_HOMEBASE_FILE']."', '".$param['ID_RIWAYAT_HOMEBASE']."', '".$param['FILENAME']."', '".$param['USERID']."'
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
		$param['ID_RIWAYAT_HOMEBASE_FILE'] = (empty($param['ID_RIWAYAT_HOMEBASE_FILE'])) ? 'x' : $param['ID_RIWAYAT_HOMEBASE_FILE'];
        $raw_query = "CALL DB2ADMIN.GETRIWAYATHOMEBASEFILE('".$param['ID_RIWAYAT_HOMEBASE_FILE']."', '".$param['ID_RIWAYAT_HOMEBASE']."')";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        while (false !== $row = db2_fetch_assoc($execute_query)) {
			$counter++;
			$row['name_file'] = @$row['NO_SERTIFIKAT'] . ' File ke ' . $counter;
			$row['link_file'] = base_url('images/upload/'. $row['FILENAME']);
			$result[] = $row;
        }
		
		return $result;
	}
	
	function delete_file($param) {
		$result = array();
		$raw_query = "CALL DB2ADMIN.DELRIWAYATHOMEBASEFILE( '".$param['ID_RIWAYAT_HOMEBASE_FILE']."', '".$param['ID_RIWAYAT_HOMEBASE']."' )";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        if ($row = db2_fetch_assoc($execute_query)) {
			$result = $row;
			$result['message'] = (isset($row['MSG'])) ? $row['MSG'] : '';
			
			if ($result['ERROR'] == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'File berhasil dihapus.';
			}
        }
		
		return $result;
	}
	
	/*	end region upload file */
}