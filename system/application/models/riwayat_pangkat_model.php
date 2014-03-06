<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_pangkat_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		$param['GAJI_POKOK'] = (empty($param['GAJI_POKOK'])) ? 0 : $param['GAJI_POKOK'];
		$param['TAHUN_JABATAN_TAMBAHAN'] = (empty($param['TAHUN_JABATAN_TAMBAHAN'])) ? 0 : $param['TAHUN_JABATAN_TAMBAHAN'];
		$param['BULAN_JABATAN_TAMBAHAN'] = (empty($param['BULAN_JABATAN_TAMBAHAN'])) ? 0 : $param['BULAN_JABATAN_TAMBAHAN'];
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDRIWAYATPANGKAT(
				'".$param['ID_RIWAYAT_PANGKAT']."', '".$param['K_PEGAWAI']."', '".$param['NO_SK']."', '".$param['K_ASAL_SK']."',
				'".$param['TGL_SK']."', '".$param['K_PENJELASAN']."', '".$param['TMT']."',  '".$param['K_GOLONGAN']."',
				'".$param['GAJI_POKOK']."', '".$param['KETERANGAN']."', '".$param['USERID']."', '".$param['PENANDATANGAN_SK']."',
				'".$param['TAHUN_JABATAN_TAMBAHAN']."', '".$param['BULAN_JABATAN_TAMBAHAN']."'
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
		$param['ID_RIWAYAT_PANGKAT'] = (empty($param['ID_RIWAYAT_PANGKAT'])) ? 'x' : $param['ID_RIWAYAT_PANGKAT'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATPANGKAT('".$param['ID_RIWAYAT_PANGKAT']."', '".$param['K_PEGAWAI']."')";
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
		$param['ID_RIWAYAT_PANGKAT'] = (empty($param['ID_RIWAYAT_PANGKAT'])) ? 'x' : $param['ID_RIWAYAT_PANGKAT'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATPANGKAT('".$param['ID_RIWAYAT_PANGKAT']."', '".$param['K_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELRIWAYATPANGKAT('".$param['ID_RIWAYAT_PANGKAT']."')";
		
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
		
		$param['ID_RIWAYAT_PANGKAT_FILE'] = (empty($param['ID_RIWAYAT_PANGKAT_FILE'])) ? 'x' : $param['ID_RIWAYAT_PANGKAT_FILE'];
		$raw_query = "CALL DB2ADMIN.INSUPDRIWAYATPANGKATFILE(
			'".$param['ID_RIWAYAT_PANGKAT_FILE']."', '".$param['ID_RIWAYAT_PANGKAT']."', '".$param['FILENAME']."', '".$param['USERID']."'
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
		$param['ID_RIWAYAT_PANGKAT_FILE'] = (empty($param['ID_RIWAYAT_PANGKAT_FILE'])) ? 'x' : $param['ID_RIWAYAT_PANGKAT_FILE'];
        $raw_query = "CALL DB2ADMIN.GETRIWAYATPANGKATFILE('".$param['ID_RIWAYAT_PANGKAT_FILE']."', '".$param['ID_RIWAYAT_PANGKAT']."')";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
        $execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        $execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
        while (false !== $row = db2_fetch_assoc($execute_query)) {
			$counter++;
			$row['name_file'] = @$row['NO_SK'] . ' File ke ' . $counter;
			$row['link_file'] = base_url('images/upload/'. $row['FILENAME']);
			$result[] = $row;
        }
		
		return $result;
	}
	
	function delete_file($param) {
		$result = array();
		$raw_query = "CALL DB2ADMIN.DELRIWAYATPANGKATFILE( '".$param['ID_RIWAYAT_PANGKAT_FILE']."', '".$param['ID_RIWAYAT_PANGKAT']."' )";
		
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