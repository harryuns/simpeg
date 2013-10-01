<?php

class pegawai extends Controller {
    function __construct() {
		$_SERVER['no_login'] = true;
        parent::Controller();
    }
    
    function index() {
		$action = (!empty($_REQUEST['ACTION'])) ? $_REQUEST['ACTION'] : '';
		$action = strtolower($action);
		unset($_REQUEST['ACTION']);
		
		// clean request
		$param_clean = array( 'PHPSESSID', '__utma', '__utmc', '__utmz', '_ga', 'submenuheader', 'ci_session' );
		foreach ($param_clean as $value) {
			if (isset($_REQUEST[$value])) {
				unset($_REQUEST[$value]);
			}
		}
		
		// set param
		$param = $_REQUEST;
		if (method_exists($this, $action)) {
			$result = $this->$action($param);
		} else {
			$result['status'] = false;
			$result['message'] = 'error';
		}
		
		echo json_encode($result);
		exit;
    }
	
	function get_array($param) {
		$param_pegawai['SORTING'] = 1;
		$param_pegawai['PencarianDetail'] = 0;
		$param_pegawai['NAMA'] = (!empty($param['NAMA'])) ? $param['NAMA'] : '';
		$param_pegawai['K_JENIS_KERJA'] = (!empty($param['K_JENIS_KERJA'])) ? $param['K_JENIS_KERJA'] : '01';
		$param_pegawai['K_UNIT_KERJA'] = (!empty($param['K_UNIT_KERJA'])) ? $param['K_UNIT_KERJA'] : 'x';
		$param_pegawai['PageOffset'] = (!empty($param['PageOffset'])) ? $param['PageOffset'] : 1000;
		$array_pegawai = $this->lpegawai->GetArrayPegawai($param_pegawai);
		
		$result = array();
		foreach ($array_pegawai['Pegawai'] as $row) {
			$temp = array(
				'K_PEGAWAI' => $row['K_PEGAWAI'],
				'NAMA' => $row['NAMA'],
				'GLR_DPN' => $row['GLR_DPN'],
				'GLR_BLKG' => $row['GLR_BLKG'],
				'NAMA_LENGKAP' => @$row['NAMA_LENGKAP']
			);
			$result[] = $temp;
		}
		
		return $result;
	}
}