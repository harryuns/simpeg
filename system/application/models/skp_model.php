<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class skp_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function update_penyusunan($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDTARGET(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."',
				'".$param['AK_TARGET']."', '".$param['KUAN_TARGET']."', '".$param['KUAL_TARGET']."', '".$param['WAKTU_TARGET']."',
				'".$param['BIAYA_TARGET']."', '".$param['USERID']."'
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
	
	function update_tupoksi($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDNILAITUPOKSI(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."',
				'".$param['AK_TARGET']."', '".$param['KUAN_TARGET']."', '".$param['KUAL_TARGET']."', '".$param['WAKTU_TARGET']."',
				'".$param['BIAYA_TARGET']."', '".$param['AK_REAL']."', '".$param['KUAN_REAL']."', '".$param['KUAL_REAL']."',
				'".$param['WAKTU_REAL']."', '".$param['BIAYA_REAL']."', '".$param['USERID']."'
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
	
	function update_penilai($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDPENILAI(
				'".$param['K_PENILAI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."',
				'".$param['K_PEJABAT']."', '".$param['USERID']."'
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
	
	function update_realisasi($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.UPDREALISASI(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['AK_REAL']."', '".$param['KUAN_REAL']."', '".$param['KUAL_REAL']."',
				'".$param['WAKTU_REAL']."', '".$param['BIAYA_REAL']."', '".$param['USERID']."'
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
	
	function update_validasi($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.SETVALIDATION(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['IS_VALID']."', '".$param['USERID']."'
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
	
	function get_by_id_kegiatan($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_NILAI_TUPOKSI'] = (empty($param['ID_NILAI_TUPOKSI'])) ? 'x' : $param['ID_NILAI_TUPOKSI'];
        
		$raw_query = "CALL SKP.GETNILAITUPOKSI('".$param['ID_NILAI_TUPOKSI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync($row);
        }
		
        return $result;
    }
	
	function get_by_id_penilai($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI'] = (empty($param['K_PENILAI'])) ? 'x' : $param['K_PENILAI'];
        
		$raw_query = "CALL SKP.GETPENILAI('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync_penilai($row);
        }
		
        return $result;
    }
	
    function get_array_validasi($param = array()) {
        $result = array();
		$param['IS_VALID'] = (empty($param['IS_VALID'])) ? 'x' : $param['IS_VALID'];
		$param['K_PEJABAT'] = (empty($param['K_PEJABAT'])) ? 'x' : $param['K_PEJABAT'];
		$param['K_PENILAI_PEGAWAI'] = (empty($param['K_PENILAI_PEGAWAI'])) ? 'x' : $param['K_PENILAI_PEGAWAI'];
		
		$raw_query = "CALL SKP.GETVALIDASI('".$param['K_PEJABAT']."', '".$param['IS_VALID']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."')";
		
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
    function get_array_kegiatan($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_NILAI_TUPOKSI'] = (empty($param['ID_NILAI_TUPOKSI'])) ? 'x' : $param['ID_NILAI_TUPOKSI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
        
		$raw_query = "
			CALL SKP.GETNILAITUPOKSI(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."'
			)"
		;
		
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync($row);
        }
		
        return $result;
    }
	
    function get_array_penilai($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI'] = (empty($param['K_PENILAI'])) ? 'x' : $param['K_PENILAI'];
        
		$raw_query = "CALL SKP.GETPENILAI('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync_penilai($row);
        }
		
        return $result;
    }
	
	function get_pejabat_penilai($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI'] = (empty($param['K_PENILAI'])) ? 'x' : $param['K_PENILAI'];
        
		$raw_query = "CALL SKP.GETPENILAI('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync_penilai($row);
        }
		
        return $result;
    }
	
    function get_rate_kegiatan($param = array()) {
        $array = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_NILAI_TUPOKSI'] = (empty($param['ID_NILAI_TUPOKSI'])) ? 'x' : $param['ID_NILAI_TUPOKSI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
        
		$raw_query = "
			CALL SKP.GETNILAITUPOKSI(
				'".$param['ID_NILAI_TUPOKSI']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."'
			)"
		;
		
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$array[] = $this->sync($row);
        }
		
		// score
		$total = 0;
		foreach ($array as $row) {
			$total += $row['NILAI_CAPAIAN'];
		}
		$result['score'] = (count($array) > 0) ? $total / count($array) : 0;
		$result['score'] = number_format($result['score'], 2);
		$result['score_percent'] = $result['score'] * 0.6;
		
		// label
		$result['label'] = show_skp_score($result['score']);
		
        return $result;
    }
	
	function get_group_validasi($param = array()) {
		$array_validasi_skp = $this->skp_model->get_array_validasi($param);
		
		// order array validasi by nip
		$array_pegawai = array();
		foreach ($array_validasi_skp as $key => $row) {
			$array_pegawai[$row['K_PEGAWAI']]['k_pegawai'] = $row['K_PEGAWAI'];
			$array_pegawai[$row['K_PEGAWAI']]['nama_pegawai'] = $row['NAMA_PEGAWAI'];
			$array_pegawai[$row['K_PEGAWAI']]['array_kegiatan'][] = $row;
			
			// komentar
			if (!isset($array_pegawai[$row['K_PEGAWAI']]['keberatan'])) {
				$param_komentar = array(
					'K_PEGAWAI' => $row['K_PEGAWAI'],
					'TAHUN' => $param['TAHUN'],
					'K_PENILAI_PEGAWAI' => $row['K_PENILAI_PEGAWAI']
				);
				
				// keberatan
				$array_pegawai[$row['K_PEGAWAI']]['keberatan'] = $this->skp_model->get_keberatan($param_komentar);
				
				// keputusan
				$array_pegawai[$row['K_PEGAWAI']]['keputusan'] = $this->skp_model->get_keputusan($param_komentar);
				
				// tanggapan
				$array_pegawai[$row['K_PEGAWAI']]['tanggapan'] = $this->skp_model->get_tanggapan($param_komentar);
			}
		}
		
		return $array_pegawai;
	}
	
	function delete_tupoksi($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL SKP.DELNILAITUPOKSI('".$param['ID_NILAI_TUPOKSI']."')";
		
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
	
	function delete_penilai($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL SKP.DELPENILAI('".$param['K_PENILAI']."')";
		
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
		if (isset($row['PERHITUNGAN']))
			$row['PERHITUNGAN'] = number_format($row['PERHITUNGAN'], 2, '.', '');
		if (isset($row['NILAI_CAPAIAN']))
			$row['NILAI_CAPAIAN'] = number_format($row['NILAI_CAPAIAN'], 2, '.', '');
		if (isset($row['IS_VALID']))
			$row['VALID_TEXT'] = ($row['IS_VALID'] == 1) ? 'Sudah' : 'Belum';
		
		return $row;
	}
	
	function sync_penilai($row) {
		if (isset($row['K_PENILAI'])) {
			$row['link_print_sasaran_kerja'] = base_url('/index.php/pegawai_modul/skp_penyusunan/cetak/'.mcrypt_encode($row['K_PENILAI']));
			$row['link_print_capaian_kerja'] = base_url('/index.php/pegawai_modul/skp_penilaian/cetak/'.mcrypt_encode($row['K_PENILAI']));
		}
		
		return $row;
	}
	
	/*	region summary */
	
	function get_score_prestasi($param) {
		$rate_kegiatan = $this->get_rate_kegiatan(array( 'K_PEGAWAI' => $param['K_PEGAWAI'], 'TAHUN' => $param['TAHUN'] ));
		$rate_perilaku = $this->get_rate_perilaku_pegawai(array( 'K_PEGAWAI' => $param['K_PEGAWAI'], 'TAHUN' => $param['TAHUN'] ));
		
		$result['score'] = $rate_kegiatan['score_percent'] + $rate_perilaku['rate_percent'];
		$result['label'] = show_skp_score($result['score']);
		
		return $result;
	}
	
	/*	end region summary */
	
	/*	region perilaku */
	
	function update_perilaku_pegawai($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDNILAIPERILAKU(
				'".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PERILAKU']."', '".$param['NILAI']."',
				'".$param['USERID']."'
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
	
    function get_array_perilaku($param = array()) {
        $result = array();
		
		$param['K_PERILAKU'] = (empty($param['K_PERILAKU'])) ? 'x' : $param['K_PERILAKU'];
		
		$raw_query = "CALL SKP.GETMPERILAKU('".$param['K_PERILAKU']."')";
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $row;
        }
		
        return $result;
    }
	
    function get_array_perilaku_pegawai($param = array()) {
        $result = array();
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['K_PERILAKU'] = (empty($param['K_PERILAKU'])) ? 'x' : $param['K_PERILAKU'];
		
		$raw_query = "CALL SKP.GETNILAIPERILAKU('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PERILAKU']."')";
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync_perilaku($row);
        }
		
        return $result;
    }
	
    function get_rate_perilaku_pegawai($param = array()) {
        $array = array();
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_NILAI_TUPOKSI'] = (empty($param['ID_NILAI_TUPOKSI'])) ? 'x' : $param['ID_NILAI_TUPOKSI'];
        
		$raw_query = "CALL SKP.GETNILAIPERILAKU('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PERILAKU']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$array[] = $this->sync_perilaku($row);
        }
		
		// score
		$total = 0;
		foreach ($array as $row) {
			$total += $row['NILAI'];
		}
		$result['total'] = $total;
		$result['rate'] = (count($array) > 0) ? $total / count($array) : 0;
		$result['rate'] = number_format($result['rate'], 2);
		$result['rate_percent'] = $result['rate'] * 0.4;
		
		// label
		$result['label'] = show_skp_score($result['rate']);
		
        return $result;
    }
	
	function delete_perilaku_pegawai($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL SKP.DELNILAIPERILAKU('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PERILAKU']."')";
		
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
	
	function sync_perilaku($row) {
		$row['NILAI_TEXT'] = show_skp_score($row['NILAI']);
		
		return $row;
	}
	
	/*	end region perilaku */
	
	/*	region kreativitas */
	
	function update_kreativitas_pegawai($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDKREATIFITAS(
				'".$param['ID_KREATIFITAS']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."',
				'".$param['NILAI']."', '".$param['USERID']."'
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
	
    function get_array_kreativitas_pegawai($param = array()) {
        $result = array();
		
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['KEGIATAN'] = (empty($param['KEGIATAN'])) ? 'x' : $param['KEGIATAN'];
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_KREATIFITAS'] = (empty($param['ID_KREATIFITAS'])) ? 'x' : $param['ID_KREATIFITAS'];
		
		$raw_query = "CALL SKP.GETKREATIFITAS('".$param['ID_KREATIFITAS']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."')";
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync_kreativitas($row);
        }
		
        return $result;
    }
	
	function delete_kreativitas_pegawai($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL SKP.DELKREATIFITAS('".$param['ID_KREATIFITAS']."')";
		
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
	
	function sync_kreativitas($row) {
		return $row;
	}
	
	/*	end region kreativitas */
	
	/*	region tugas tambahan */
	
	function update_tugas_tambahan_pegawai($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.INSUPDTUGASTAMBAHAN(
				'".$param['ID_TUGAS_TAMBAHAN']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."',
				'".$param['NILAI']."', '".$param['USERID']."'
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
	
    function get_array_tugas_tambahan_pegawai($param = array()) {
        $result = array();
		
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['KEGIATAN'] = (empty($param['KEGIATAN'])) ? 'x' : $param['KEGIATAN'];
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['ID_TUGAS_TAMBAHAN'] = (empty($param['ID_TUGAS_TAMBAHAN'])) ? 'x' : $param['ID_TUGAS_TAMBAHAN'];
		
		$raw_query = "CALL SKP.GETTUGASTAMBAHAN('".$param['ID_TUGAS_TAMBAHAN']."', '".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['KEGIATAN']."')";
		
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result[] = $this->sync_perilaku($row);
        }
		
        return $result;
    }
	
	function delete_tugas_tambahan_pegawai($param) {
		$result = array( 'status' => false, 'message' => 'Error.') ;
        $raw_query = "CALL SKP.DELTUGASTAMBAHAN('".$param['ID_TUGAS_TAMBAHAN']."')";
		
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
	
	function sync_tugas_tambahan($row) {
		$row['NILAI_TEXT'] = show_skp_score($row['NILAI']);
		
		return $row;
	}
	
	/*	end region tugas tambahan */
	
	/*	region komentar */
	
	function update_keberatan($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.SETKEBERATAN(
				'".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."', '".$param['KEBERATAN']."'
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
	
	function update_keputusan($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.SETKEPUTUSAN(
				'".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."', '".$param['KEPUTUSAN']."'
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
	
	function update_tanggapan($param) {
		$result['status'] = false;
		
		$raw_query = "
			CALL SKP.SETTANGGAPAN(
				'".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."', '".$param['TANGGAPAN']."'
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
	
	function get_keberatan($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI_PEGAWAI'] = (empty($param['K_PENILAI_PEGAWAI'])) ? 'x' : $param['K_PENILAI_PEGAWAI'];
        
		$raw_query = "CALL SKP.GETKEBERATAN('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync($row);
        }
		
        return $result;
    }
	
	function get_keputusan($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI_PEGAWAI'] = (empty($param['K_PENILAI_PEGAWAI'])) ? 'x' : $param['K_PENILAI_PEGAWAI'];
        
		$raw_query = "CALL SKP.GETKEPUTUSAN('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync($row);
        }
		
        return $result;
    }
	
	function get_tanggapan($param = array()) {
        $result = array();
		$param['K_PEGAWAI'] = (empty($param['K_PEGAWAI'])) ? 'x' : $param['K_PEGAWAI'];
		$param['TAHUN'] = (empty($param['TAHUN'])) ? 'x' : $param['TAHUN'];
		$param['K_PENILAI_PEGAWAI'] = (empty($param['K_PENILAI_PEGAWAI'])) ? 'x' : $param['K_PENILAI_PEGAWAI'];
        
		$raw_query = "CALL SKP.GETTANGGAPAN('".$param['K_PEGAWAI']."', '".$param['TAHUN']."', '".$param['K_PENILAI_PEGAWAI']."')";
        $statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
			$result = $this->sync($row);
        }
		
        return $result;
    }
	
	/*	end region komentar */
}