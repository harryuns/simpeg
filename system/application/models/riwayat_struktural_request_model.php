<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_struktural_request_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['ID_REQ_JABATAN_STRUKTURAL'] = (empty($param['ID_REQ_JABATAN_STRUKTURAL'])) ? 'x' : $param['ID_REQ_JABATAN_STRUKTURAL'];
		$param['ID_RIWAYAT_JABATAN_STRUKTURAL'] = (empty($param['ID_RIWAYAT_JABATAN_STRUKTURAL'])) ? 'x' : $param['ID_RIWAYAT_JABATAN_STRUKTURAL'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDREQRIWAYATJABATANSTRUKTURAL(
				'".$param['ID_REQ_JABATAN_STRUKTURAL']."', '".$param['JENIS_REQ_JABATAN_STRUKTURAL']."', '".$param['USERID']."', '".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."',
				'".$param['K_PEGAWAI']."', '".$param['NO_SK']."', '".$param['TGL_SK']."', '".$param['K_ASAL_SK']."',
				'".$param['TMT']."', '".$param['K_UNIT_KERJA']."', '".$param['K_JABATAN_STRUKTURAL']."',
				'".$param['K_BIDANG_KERJA']."', '".@$param['K_JENJANG']."', '".@$param['K_FAKULTAS']."', '".@$param['K_JURUSAN']."',
				'".@$param['K_PROG_STUDI']."', '".$param['TUNJANGAN_STRUKTURAL']."', '".$param['KETERANGAN']."', '".@$param['FILE']."'
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
				$result['ID_REQ_JABATAN_STRUKTURAL'] = $row['ID_REQ_JABATAN_STRUKTURAL'];
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function validate($param) {
		$result['status'] = false;
		
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATJABATANSTRUKTURAL( '".$param['ID_REQ_JABATAN_STRUKTURAL']."', '".$param['USERID']."' )";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
		$execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
		$execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		if ($row = db2_fetch_assoc($execute_query)) {
			$query_status = $row['ERROR'];
			if ($query_status == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil divalidasi';
				
				// bais sync
				$param_bais = $this->get_by_id(array( 'ID_REQ_JABATAN_STRUKTURAL' => $param['ID_REQ_JABATAN_STRUKTURAL'] ));
				if (in_array($param_bais['JENIS_REQ_JABATAN_STRUKTURAL'], array( 'I', 'U' ))) {
					$result_bais = $this->riwayat_struktural_model->bais_sync($param_bais);
				}
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function get_by_id($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['IS_VALIDATE'] = (empty($param['IS_VALIDATE'])) ? 'x' : $param['IS_VALIDATE'];
        
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATJABATANSTRUKTURAL(
			'".$param['ID_REQ_JABATAN_STRUKTURAL']."', '".$param['K_PEGAWAI']."', '".$param['IS_VALIDATE']."'
		)";
		
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync($row);
        }
		
        return $result;
    }
	
    function get_array($param = array()) {
        $result = array();
		$param['ID_REQ_JABATAN_STRUKTURAL'] = (empty($param['ID_REQ_JABATAN_STRUKTURAL'])) ? 'x' : $param['ID_REQ_JABATAN_STRUKTURAL'];
		$param['IS_VALIDATE'] = (isset($param['IS_VALIDATE'])) ? $param['IS_VALIDATE'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATJABATANSTRUKTURAL(
			'".$param['ID_REQ_JABATAN_STRUKTURAL']."', '".$param['K_PEGAWAI']."', '".$param['IS_VALIDATE']."'
		)";
		
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELREQRIWAYATJABATANSTRUKTURAL('".$param['ID_REQ_JABATAN_STRUKTURAL']."')";
		
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
		
		$param['JENIS_REQ_JABATAN_STRUKTURAL_FILE'] = (isset($param['JENIS_REQ_JABATAN_STRUKTURAL_FILE'])) ? $param['JENIS_REQ_JABATAN_STRUKTURAL_FILE'] : 'I';
		$param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'] = (isset($param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'])) ? $param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.INSREQRIWAYATJABATANSTRUKTURALFILE(
			'".$param['JENIS_REQ_JABATAN_STRUKTURAL_FILE']."',  '".$param['USERID']."', '".$param['ID_REQ_JABATAN_STRUKTURAL']."', '".$param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE']."',
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
		$param['ID_REQ_JABATAN_STRUKTURAL'] = (empty($param['ID_REQ_JABATAN_STRUKTURAL'])) ? 'x' : $param['ID_REQ_JABATAN_STRUKTURAL'];
		$param['IS_VALIDATE'] = (empty($param['IS_VALIDATE'])) ? 'x' : $param['IS_VALIDATE'];
		$param['ID_REQ_JABATAN_STRUKTURAL_FILE'] = (empty($param['ID_REQ_JABATAN_STRUKTURAL_FILE'])) ? 'x' : $param['ID_REQ_JABATAN_STRUKTURAL_FILE'];
		
        $raw_query = "CALL DB2ADMIN.GETREQRIWAYATJABATANSTRUKTURALFILE(
			'".$param['ID_REQ_JABATAN_STRUKTURAL_FILE']."', '".$param['ID_REQ_JABATAN_STRUKTURAL']."', '".$param['IS_VALIDATE']."'
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
		$raw_query = "CALL DB2ADMIN.DELREQRIWAYATJABATANSTRUKTURALFILE( '".$param['ID_REQ_JABATAN_STRUKTURAL_FILE']."' )";
        
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