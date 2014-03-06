<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_penghargaan_request_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['ID_REQ_PENGHARGAAN'] = (empty($param['ID_REQ_PENGHARGAAN'])) ? 'x' : $param['ID_REQ_PENGHARGAAN'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDREQRIWAYATPENGHARGAAN(
				'".$param['ID_REQ_PENGHARGAAN']."', '".$param['JENIS_REQ_PENGHARGAAN']."', '".$param['USERID']."', '".$param['ID_RIWAYAT_PENGHARGAAN']."',
				'".$param['K_PEGAWAI']."', '".$param['NO_SK']."', '".$param['TGL_SK']."', '".@$param['K_ASAL_SK']."',
				'".@$param['JENIS_PENGHARGAAN']."', '".$param['NAMA_PENGHARGAAN']."', '".$param['JABATAN_PEMBERI']."', '".$param['PEMBERI']."',
				'".$param['KETERANGAN']."', '".$param['USERID']."'
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
				$result['ID_REQ_PENGHARGAAN'] = $row['ID_REQ_PENGHARGAAN'];
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function validate($param) {
		$result['status'] = false;
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATPENGHARGAAN( '".$param['ID_REQ_PENGHARGAAN']."', '".$param['USERID']."' )";
		
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
		$param['ID_REQ_PENGHARGAAN'] = (empty($param['ID_REQ_PENGHARGAAN'])) ? 'x' : $param['ID_REQ_PENGHARGAAN'];
		
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATPENGHARGAAN(
			'".$param['ID_REQ_PENGHARGAAN']."', '".$param['K_PEGAWAI']."', '".$param['IS_VALIDATE']."'
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
        $raw_query = "CALL DB2ADMIN.DELREQRIWAYATPENGHARGAAN('".$param['ID_REQ_PENGHARGAAN']."')";
		
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
		$row = StripArray($row, array( 'TMT' ));
		$row['JML_FILE_TEXT'] = (@$row['JML_FILE'] == 0) ? '-' : 'Cek';
		
		return $row;
	}
	
	/*	region upload file */
	
	function update_file($param) {
		$result['status'] = false;
		$result['message'] = '';
		
		$param['JENIS_REQ_PENGHARGAAN_FILE'] = (isset($param['JENIS_REQ_PENGHARGAAN_FILE'])) ? $param['JENIS_REQ_PENGHARGAAN_FILE'] : 'I';
		$param['ID_RIWAYAT_PENGHARGAAN_FILE'] = (isset($param['ID_RIWAYAT_PENGHARGAAN_FILE'])) ? $param['ID_RIWAYAT_PENGHARGAAN_FILE'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.INSREQRIWAYATPENGHARGAANFILE(
			'".$param['ID_RIWAYAT_PENGHARGAAN_FILE']."', '".$param['ID_REQ_PENGHARGAAN']."', '".$param['JENIS_REQ_PENGHARGAAN_FILE']."', '".$param['USERID']."',
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
		$param['ID_REQ_PENGHARGAAN'] = (empty($param['ID_REQ_PENGHARGAAN'])) ? 'x' : $param['ID_REQ_PENGHARGAAN'];
		$param['ID_REQ_PENGHARGAAN_FILE'] = (empty($param['ID_REQ_PENGHARGAAN_FILE'])) ? 'x' : $param['ID_REQ_PENGHARGAAN_FILE'];
		
        $raw_query = "CALL DB2ADMIN.GETREQRIWAYATPENGHARGAANFILE(
			'".$param['ID_REQ_PENGHARGAAN_FILE']."', '".$param['ID_REQ_PENGHARGAAN']."', '".$param['IS_VALIDATE']."'
		)";
		
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        while (false !== $row = db2_fetch_assoc($execute_query)) {
			$counter++;
			$row['name_file'] = ' File ke ' . $counter;
			$row['link_file'] = base_url('images/upload/'. $row['FILENAME']);
			$result[] = $row;
        }
		
		return $result;
	}
	
	function delete_file($param) {
		$result = array();
		$raw_query = "CALL DB2ADMIN.DELREQRIWAYATPENGHARGAANFILE( '".$param['ID_REQ_PENGHARGAAN_FILE']."' )";
        
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