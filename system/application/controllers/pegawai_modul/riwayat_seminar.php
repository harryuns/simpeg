<?php

class riwayat_seminar extends Controller {
	function __construct() {
        parent::Controller();
    }
    
    function index() {
        $this->load->view('pegawai_modul/riwayat_seminar_main');
    }
    
    function action() {
		$result = array();
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		$reload = (isset($_POST['reload'])) ? $_POST['reload'] : true;
		$reload = ($reload === 'false') ? false : $reload;
		
		// user
		$_POST['USERID'] = $this->session->UserLogin['UserID'];
		
		// valid
		if ($action == 'update_valid') {
			$result = $this->riwayat_seminar_model->update($_POST);
		} else if ($action == 'delete_valid') {
			$result = $this->riwayat_seminar_model->delete($_POST);
		}
		
		// request
		else if ($action == 'update_request') {
			$result = $this->riwayat_seminar_request_model->update($_POST);
		} else if ($action == 'validation') {
			$result = $this->riwayat_seminar_request_model->validate($_POST);
		} else if ($action == 'delete_request') {
			$result = $this->riwayat_seminar_request_model->delete($_POST);
		}
		
		if ($reload && isset($result['status']) && $result['status']) {
			set_flash_message($result['message']);
		}
		
		echo json_encode($result);
    }
}