<?php

class skp_penilaian extends Controller {
	function __construct() {
        parent::Controller();
    }
    
    function index() {
        $this->load->view('pegawai_modul/skp_penilaian');
    }
    
    function action() {
		$result = array();
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		$reload = (isset($_POST['reload'])) ? $_POST['reload'] : true;
		$reload = ($reload === 'false') ? false : $reload;
		
		// user
		$_POST['USERID'] = $this->session->UserLogin['UserID'];
		
		// riwayat
		if ($action == 'update_tupoksi') {
			$result = $this->skp_model->update_tupoksi($_POST);
		} else if ($action == 'delete') {
			$result = $this->skp_model->delete_tupoksi($_POST);
		}
		
		// penilai
		else if ($action == 'update_penilai') {
			$result = $this->skp_model->update_penilai($_POST);
		} else if ($action == 'delete_penilai') {
			$result = $this->skp_model->delete_penilai($_POST);
		}
		
		if ($reload && isset($result['status']) && $result['status']) {
			set_flash_message($result['message']);
		}
		
		echo json_encode($result);
    }
	
	function cetak($raw_data = '') {
		$K_PENILAI = mcrypt_decode($raw_data);
		
		// load library
		ini_set("memory_limit", "124M");
		$pdf = $this->lpdf->load();
		
		$template = $this->load->view( 'pegawai_modul/skp_pdf_sasaran_kerja', array( 'K_PENILAI' => $K_PENILAI ), true );
		$pdf->WriteHTML($template);
		
		$pdf->AddPage('L');
		$template = $this->load->view( 'pegawai_modul/skp_pdf_capaian_sasaran', array( 'K_PENILAI' => $K_PENILAI ), true );
		$pdf->WriteHTML($template);
		
		$pdf->Output();
	}
}