<?php

class skp_validasi extends Controller {
	function __construct() {
        parent::Controller();
    }
    
    function index() {
        $this->load->view('pegawai_modul/skp_validasi');
    }
    
    function action() {
		$result = array();
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		$reload = (isset($_POST['reload'])) ? $_POST['reload'] : true;
		$reload = ($reload === 'false') ? false : $reload;
		
		// user
		$_POST['USERID'] = $this->session->UserLogin['UserID'];
		
		// kegiatan
		if ($action == 'update_penilaian') {
			$result = $this->skp_model->update_tupoksi($_POST);
		} else if ($action == 'update_validasi') {
			$result = $this->skp_model->update_validasi($_POST);
		}
		
		// keputusan
		else if ($action == 'update_keputusan') {
			$result = $this->skp_model->update_keputusan($_POST);
		}
		
		if ($reload && isset($result['status']) && $result['status']) {
			set_flash_message($result['message']);
		}
		
		echo json_encode($result);
    }
}