<?php

class SendToEkd extends Controller {
    var $Action = null;
    
    function SendToEkd() {
        parent::Controller();
		
		$this->load->helper('cookie');
    }
	
	function index($K_PEGAWAI) {
		$K_PEGAWAI = RestoreLink($K_PEGAWAI);
		$SiadoLink = SIADO_REDIRECT;
		$UserLogin = $_SESSION['UserLogin'];
		
		$ArrayParam = array(
			'Nip' => $K_PEGAWAI,
			'ApplicationRequest' => 'Simpeg',
			'UserID' => $UserLogin['UserID'],
			'FakultasID' => $UserLogin['Fakultas']['ID'],
			'ReturnLink' => HOST.'/index.php/Pegawai/Tambah/'.ConvertLink($K_PEGAWAI)
		);
		$DataCookie = base64_encode(gzcompress(json_encode($ArrayParam)));
		
		$cookie = array(
			'name'   => 'Application',
			'value'  => $DataCookie,
			'expire' => '3600',
			'domain' => '.ub.ac.id',
			'path'   => '/',
			'prefix' => 'External_',
			'secure' => TRUE
		);
		set_cookie($cookie); 
		
		header("Location: $SiadoLink");
		exit;
	}
	
	function JsonRequest() {
		$Action = (isset($_POST['Action'])) ? $_POST['Action'] : '';
		if (empty($Action)) {
			echo 'No Request exist.';
			exit;
		}
		
		if ($Action == 'RequestArrayRiwayatHidup') {
			$ArrayRequest = $this->lriwayat_hidup->GetArrayLink($_POST['K_PEGAWAI']);
		}
		
		echo json_encode($ArrayRequest);
		exit;
	}
	
	function Logout() {
		$ReturnLink = $_SESSION['UserLogin']['ReturnLink'];
		$_SESSION['UserLogin'] = array();
		
		header("Location: ".$ReturnLink);
		exit;
	}
}	