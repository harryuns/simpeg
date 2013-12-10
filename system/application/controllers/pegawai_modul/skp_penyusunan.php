<?php

class skp_penyusunan extends Controller {
	function __construct() {
        parent::Controller();
    }
    
    function index() {
        $this->load->view('pegawai_modul/skp_penyusunan');
    }
    
    function action() {
		$result = array();
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		$reload = (isset($_POST['reload'])) ? $_POST['reload'] : true;
		$reload = ($reload === 'false') ? false : $reload;
		
		// user
		$_POST['USERID'] = $this->session->UserLogin['UserID'];
		
		if ($action == 'update_penyusunan') {
			$result = $this->skp_model->update_penyusunan($_POST);
		} else if ($action == 'delete_penyusunan') {
			$result = $this->skp_model->delete_tupoksi($_POST);
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