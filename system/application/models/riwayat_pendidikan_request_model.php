<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_pendidikan_request_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['ID_REQ_PENDIDIKAN'] = (empty($param['ID_REQ_PENDIDIKAN'])) ? 'x' : $param['ID_REQ_PENDIDIKAN'];
		$param['ID_RIWAYAT_PENDIDIKAN'] = (empty($param['ID_RIWAYAT_PENDIDIKAN'])) ? 'x' : $param['ID_RIWAYAT_PENDIDIKAN'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDREQRIWAYATPENDIDIKAN(
				'".$param['ID_REQ_PENDIDIKAN']."', '".$param['JENIS_REQ_PENDIDIKAN']."', '".$param['USERID']."', '".$param['K_PEGAWAI']."',
				'".$param['K_JENJANG']."', '".$param['NO_IJAZAH']."', '".$param['TGL_IJAZAH']."', '".$param['IPK']."',
				'".$param['THN_MASUK']."', '".$param['PT']."', '".$param['K_NEGARA']."', '".$param['PROG_STUDI']."',
				'".$param['BIDANG_ILMU']."', '".$param['KETERANGAN']."', '".$param['USERID']."', '".$param['THN_LULUS']."',
				'".$param['K_STATUS_STUDI']."', '".@$param['FILE_IJAZAH']."', '".@$param['FILE_TRANS']."', '".@$param['PROFESI']."',
				'".@$param['TMT_STUDI']."', '".$param['NO_SK_TUBEL']."', '".$param['TMT_TUBEL']."', '".$param['NO_SK_PEMBEBASAN']."',
				'".$param['TMT_PEMBEBASAN']."', '".$param['TMT_LULUS']."', '".$param['STATUS_PENGAKTIFAN']."', '".$param['NO_SK_PENGAKTIFAN']."',
				'".$param['TMT_PENGAKTIFAN']."', '".@$param['IS_STUDI_LANJUT']."', '".$param['ID_RIWAYAT_PENDIDIKAN']."', '".$param['K_ASAL_PT_S3DIKTI']."'
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
				$result['ID_REQ_PENDIDIKAN'] = $row['ID_REQ_PENDIDIKAN'];
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function validate($param) {
		$result['status'] = false;
		$raw_query = "CALL DB2ADMIN.VALREQRIWAYATPENDIDIKAN( '".$param['ID_REQ_PENDIDIKAN']."', '".$param['USERID']."' )";
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
		$param['ID_REQ_PENDIDIKAN'] = (empty($param['ID_REQ_PENDIDIKAN'])) ? 'x' : $param['ID_REQ_PENDIDIKAN'];
		
		$raw_query = "CALL DB2ADMIN.GETREQRIWAYATPENDIDIKAN(
			'".$param['ID_REQ_PENDIDIKAN']."', '".$param['K_PEGAWAI']."', '".$param['IS_VALIDATE']."'
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
        $raw_query = "CALL DB2ADMIN.DELREQRIWAYATPENDIDIKAN('".$param['ID_REQ_PENDIDIKAN']."')";
		
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
		$row = StripArray($row, array( 'TGL_IJAZAH', 'TMT_STUDI', 'TMT_TUBEL', 'TMT_PEMBEBASAN', 'TMT_LULUS', 'TMT_PENGAKTIFAN' ));
		$row['JML_FILE_IJAZAH_TEXT'] = (@$row['JML_FILE_IJAZAH'] == 0) ? '-' : 'Cek';
		$row['JML_FILE_NON_IJAZAH_TEXT'] = (@$row['JML_FILE_NON_IJAZAH'] == 0) ? '-' : 'Cek';
		
		return $row;
	}
	
	/*	region upload file */
	
	function update_file($param) {
		$result['status'] = false;
		$result['message'] = '';
		
		$param['JENIS_REQ_PENDIDIKAN_FILE'] = (isset($param['JENIS_REQ_PENDIDIKAN_FILE'])) ? $param['JENIS_REQ_PENDIDIKAN_FILE'] : 'I';
		$param['ID_RIWAYAT_PENDIDIKAN_FILE'] = (isset($param['ID_RIWAYAT_PENDIDIKAN_FILE'])) ? $param['ID_RIWAYAT_PENDIDIKAN_FILE'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.INSREQRIWAYATPENDIDIKANFILE(
			'".$param['ID_RIWAYAT_PENDIDIKAN_FILE']."', '".$param['ID_REQ_PENDIDIKAN']."', '".$param['JENIS_REQ_PENDIDIKAN_FILE']."', '".$param['USERID']."',
			'".$param['FILENAME']."', '".$param['IS_IJAZAH']."'
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
		$param['ID_REQ_PENDIDIKAN'] = (empty($param['ID_REQ_PENDIDIKAN'])) ? 'x' : $param['ID_REQ_PENDIDIKAN'];
		$param['IS_VALIDATE'] = (empty($param['IS_VALIDATE'])) ? 'x' : $param['IS_VALIDATE'];
		$param['ID_REQ_PENDIDIKAN_FILE'] = (empty($param['ID_REQ_PENDIDIKAN_FILE'])) ? 'x' : $param['ID_REQ_PENDIDIKAN_FILE'];
		
        $raw_query = "CALL DB2ADMIN.GETREQRIWAYATPENDIDIKANFILE(
			'".$param['ID_REQ_PENDIDIKAN_FILE']."', '".$param['ID_REQ_PENDIDIKAN']."', '".$param['IS_VALIDATE']."'
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
		$raw_query = "CALL DB2ADMIN.DELREQRIWAYATPENDIDIKANFILE( '".$param['ID_REQ_PENDIDIKAN_FILE']."' )";
        
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