<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class riwayat_struktural_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL DB2ADMIN.INSUPDRIWAYATJABATANSTRUKTURAL(
				'".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."', '".$param['K_PEGAWAI']."', '".$param['NO_SK']."', '".$param['TGL_SK']."',
				'".$param['K_ASAL_SK']."', '".$param['TMT']."', '".$param['K_UNIT_KERJA']."', '".$param['K_JABATAN_STRUKTURAL']."',
				'".$param['K_BIDANG_KERJA']."', '".@$param['K_JENJANG']."', '".@$param['K_FAKULTAS']."', '".@$param['K_JURUSAN']."',
				'".@$param['K_PROG_STUDI']."', '".$param['KETERANGAN']."', '".$param['USERID']."', '".$param['TUNJANGAN_STRUKTURAL']."',
				'".@$param['TMT_SELESAI']."', '".@$param['FILE']."'
			)
		";
		
		WriteLog($param['K_PEGAWAI'], $raw_query);
		$execute_query = db2_prepare($this->CI->ldb2->Handle, $raw_query);
		$execute_result = db2_execute($execute_query) or die(db2_stmt_errormsg($execute_query));
		if ($row = db2_fetch_assoc($execute_query)) {
			if ($row['ERROR'] == QUERY_STATUS_SUCCESS) {
				$result['status'] = true;
				$result['message'] = 'Data berhasil disimpan';
				
				// bais sync
				$this->bais_sync($param);
			} else {
				$result['message'] = 'Error.';
			}
		}
		
		return $result;
	}
	
	function get_by_id($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_RIWAYAT_JABATAN_STRUKTURAL'] = (empty($param['ID_RIWAYAT_JABATAN_STRUKTURAL'])) ? 'x' : $param['ID_RIWAYAT_JABATAN_STRUKTURAL'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATJABATANSTRUKTURAL('".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."', '".$param['K_PEGAWAI']."')";
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
		$param['ID_RIWAYAT_JABATAN_STRUKTURAL'] = (empty($param['ID_RIWAYAT_JABATAN_STRUKTURAL'])) ? 'x' : $param['ID_RIWAYAT_JABATAN_STRUKTURAL'];
        
		$raw_query = "CALL DB2ADMIN.GETRIWAYATJABATANSTRUKTURAL('".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."', '".$param['K_PEGAWAI']."')";
		
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
	function delete($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL DB2ADMIN.DELRIWAYATJABATANSTRUKTURAL('".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."')";
		
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
		
		$param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'] = (empty($param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'])) ? 'x' : $param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'];
		$raw_query = "CALL DB2ADMIN.INSUPDRIWAYATJABATANSTRUKTURALFILE(
			'".$param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE']."', '".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."', '".$param['FILENAME']."', '".$param['USERID']."'
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
		$param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'] = (empty($param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'])) ? 'x' : $param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE'];
        $raw_query = "
			CALL DB2ADMIN.GETRIWAYATJABATANSTRUKTURALFILE(
				'".$param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE']."', '".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."'
			)
		";
		
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
		$raw_query = "
			CALL DB2ADMIN.DELRIWAYATJABATANSTRUKTURALFILE(
				'".$param['ID_RIWAYAT_JABATAN_STRUKTURAL_FILE']."', '".$param['ID_RIWAYAT_JABATAN_STRUKTURAL']."'
			)
		";
		
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
	
	/*	region sync bais */
	
	function bais_sync($param) {
		$param_bais['IN_NIP'] = $param['K_PEGAWAI'];
		$param_bais['IN_K_UNIT_KERJA'] = $param['K_UNIT_KERJA'];
		$param_bais['IN_K_JABATAN_STRUKTURAL'] = $param['K_JABATAN_STRUKTURAL'];
		$param_bais['IN_K_FAKULTAS'] = $param['K_FAKULTAS'];
		$param_bais['IN_K_JENJANG'] = $param['K_JENJANG'];
		$param_bais['IN_K_JURUSAN'] = $param['K_JURUSAN'];
		$param_bais['IN_K_PROG_STUDI'] = $param['K_PROG_STUDI'];
		$param_bais['DBFAK'] = $param_bais['IN_K_FAKULTAS'];							// sesuai fakultas user login bais
		$param_bais['IN_USERID'] = 'rizalespe';											// sesuai user login bais
		$param_bais['IN_KEY'] = crypt($param_bais['IN_USERID'], 'UB-S14K4D-2013');
		$param_encode = rawurlencode(base64_encode(json_encode($param_bais)));
		
		$ch = curl_init();
		$curl_config = array( 
			CURLOPT_POST => true,
			CURLOPT_TIMEOUT => 20,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => array( 'p' => $param_encode ),
			CURLOPT_URL => 'http://devel184.ub.ac.id/siakad_api/api/pegawai/CallInsPejabatSimpeg',
		);
		curl_setopt_array($ch, $curl_config);
		$result = curl_exec($ch);
		$result	= json_decode(base64_decode(gzuncompress(trim($result))));
		curl_close($ch);
		
		return $result;
	}
	
	/*	end region sync bais */
}