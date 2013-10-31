<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_diklat_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDRIWAYATDIKLAT(
				'".$param['ID_RIWAYAT_DIKLAT']."', '".$param['K_PEGAWAI']."', '".$param['NO_SERTIFIKAT']."', '".$param['TGL_SERTIFIKAT']."',
				'".$param['PENYELENGGARA']."', '".$param['K_DIKLAT']."', '', 
				'".$param['ANGKATAN']."', '".$param['TGL_MULAI']."', '".$param['TGL_LULUS']."',
				'".$param['KETERANGAN']."', '".$param['USERID']."', '".$param['TMP_DIKLAT']."',
				'', '".$param['JML_JAM']."', '".$param['PREDIKAT']."',
				'".$param['IS_LUARNEGERI']."', '".$param['NAMA_DIKLAT']."'
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
		$param['NO_SERTIFIKAT'] = (empty($param['NO_SERTIFIKAT'])) ? 'x' : $param['NO_SERTIFIKAT'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATDIKLAT('".$param['ID_RIWAYAT_DIKLAT']."', '".$param['K_PEGAWAI']."', '".$param['NO_SERTIFIKAT']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync($row);
        }
		
        return $result;
    }
	
    function get_array($param = array()) {
        $result = array();
		$param['id_riwayat_diklat'] = (empty($param['id_riwayat_diklat'])) ? 'x' : $param['id_riwayat_diklat'];
		$param['no_sertifikat'] = (empty($param['no_sertifikat'])) ? 'x' : $param['no_sertifikat'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATDIKLAT('".$param['id_riwayat_diklat']."', '".$param['k_pegawai']."', '".$param['no_sertifikat']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
        $raw_query = "CALL DB2ADMIN.DELRIWAYATDIKLAT('".$param['ID_RIWAYAT_DIKLAT']."')";
		WriteLog($param['K_PEGAWAI'], $raw_query);
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        
        $result['status'] = true;
        $result['message'] = 'Data berhasil dihapus.';
		
        return $result;
	}
	
	function sync($row) {
		$row['K_PEGAWAI_ENCRYPT'] = ConvertLink($row['K_PEGAWAI']);
		$row['NO_SERTIFIKAT_ENCRYPT'] = ConvertLink($row['NO_SERTIFIKAT']);
		
		return $row;
	}
	
	/*	region upload file */
	
	function update_file($param) {
		$result['status'] = false;
		$result['message'] = '';
		$param['ID_RIWAYAT_DIKLAT_FILE'] = (empty($param['ID_RIWAYAT_DIKLAT_FILE'])) ? 'x' : $param['ID_RIWAYAT_DIKLAT_FILE'];
		$raw_query = "CALL DB2ADMIN.INSUPDRIWAYATDIKLATFILE(
			'".$param['ID_RIWAYAT_DIKLAT_FILE']."', '".$param['ID_RIWAYAT_DIKLAT']."', '".$param['FILENAME']."', '".$param['USERID']."'
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
		$counter = 0;
		$result = array();
		$param['ID_RIWAYAT_DIKLAT_FILE'] = (empty($param['ID_RIWAYAT_DIKLAT_FILE'])) ? 'x' : $param['ID_RIWAYAT_DIKLAT_FILE'];
        $raw_query = "CALL DB2ADMIN.GETRIWAYATDIKLATFILE('".$param['ID_RIWAYAT_DIKLAT_FILE']."', '".$param['ID_RIWAYAT_DIKLAT']."')";
		
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
		$raw_query = "CALL DB2ADMIN.DELRIWAYATDIKLATFILE( '".$param['ID_RIWAYAT_DIKLAT_FILE']."', '".$param['ID_RIWAYAT_DIKLAT']."' )";
		
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