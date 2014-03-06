<?php

class riwayat_sertifikasi extends Controller {
	function __construct() {
        parent::Controller();
    }
    
    function index() {
        $this->load->view('pegawai_modul/riwayat_sertifikasi_main');
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
			$result = $this->riwayat_sertifikasi_model->update($_POST);
		} else if ($action == 'delete_valid') {
			$result = $this->riwayat_sertifikasi_model->delete($_POST);
		} else if ($action == 'update_upload_valid') {
			$result = $this->riwayat_sertifikasi_model->update_file($_POST);
		} else if ($action == 'delete_upload_valid') {
			$result = $this->riwayat_sertifikasi_model->delete_file($_POST);
		}
		
		// request
		else if ($action == 'update_request') {
			$result = $this->riwayat_sertifikasi_request_model->update($_POST);
		} else if ($action == 'update_request_with_update_file') {
			$riwayat_sertifikasi_valid = $this->riwayat_sertifikasi_model->get_by_id(array( 'ID_RIWAYAT_SERTIFIKASI' => $_POST['ID_RIWAYAT_SERTIFIKASI']));
			$riwayat_sertifikasi_file_valid = $_POST;
			
			// insert riwayat diklat
			$param_request = $riwayat_sertifikasi_valid;
			$param_request['JENIS_REQ_SERTIFIKASI'] = 'U';
			$riwayat_sertifikasi_request = $this->riwayat_sertifikasi_request_model->update($param_request);
			
			// insert riwayat diklat file
			$param_request_file['USERID'] = $_POST['USERID'];
			$param_request_file['JENIS_REQ_SERTIFIKASI_FILE'] = 'I';
			$param_request_file['ID_REQ_SERTIFIKASI'] = $riwayat_sertifikasi_request['ID_REQ_SERTIFIKASI'];
			$param_request_file['FILENAME'] = $_POST['FILENAME'];
			$param_request_file['K_PEGAWAI'] = $riwayat_sertifikasi_valid['K_PEGAWAI'];
			$result = $this->riwayat_sertifikasi_request_model->update_file($param_request_file);
			
			// set message
			if ($result['status']) {
				$result['message'] = 'Request penambahan file anda berhasil disimpan.';
			}
		} else if ($action == 'update_request_with_delete_file') {
			$riwayat_sertifikasi_valid = $this->riwayat_sertifikasi_model->get_by_id(array( 'ID_RIWAYAT_SERTIFIKASI' => $_POST['ID_RIWAYAT_SERTIFIKASI']));
			$riwayat_sertifikasi_file_valid = $_POST;
			
			// insert riwayat diklat
			$param_request = $riwayat_sertifikasi_valid;
			$param_request['JENIS_REQ_SERTIFIKASI'] = 'U';
			$riwayat_sertifikasi_request = $this->riwayat_sertifikasi_request_model->update($param_request);
			
			// insert riwayat diklat file
			$param_request_file['USERID'] = $_POST['USERID'];
			$param_request_file['JENIS_REQ_SERTIFIKASI_FILE'] = 'D';
			$param_request_file['ID_REQ_SERTIFIKASI'] = $riwayat_sertifikasi_request['ID_REQ_SERTIFIKASI'];
			$param_request_file['ID_RIWAYAT_SERTIFIKASI_FILE'] = $_POST['ID_RIWAYAT_SERTIFIKASI_FILE'];
			$param_request_file['FILENAME'] = '';
			$param_request_file['K_PEGAWAI'] = $riwayat_sertifikasi_valid['K_PEGAWAI'];
			$result = $this->riwayat_sertifikasi_request_model->update_file($param_request_file);
			
			// set message
			if ($result['status']) {
				$result['message'] = 'Request penghapusan file anda berhasil disimpan.';
			}
		} else if ($action == 'validation') {
			$result = $this->riwayat_sertifikasi_request_model->validate($_POST);
		} else if ($action == 'delete_request') {
			$result = $this->riwayat_sertifikasi_request_model->delete($_POST);
		} else if ($action == 'update_upload_request') {
			$result = $this->riwayat_sertifikasi_request_model->update_file($_POST);
		} else if ($action == 'validate_upload_request') {
			$result = $this->riwayat_sertifikasi_request_model->validate_file($_POST);
		} else if ($action == 'delete_upload_request') {
			$result = $this->riwayat_sertifikasi_request_model->delete_file($_POST);
		}
		
		if ($reload && isset($result['status']) && $result['status']) {
			set_flash_message($result['message']);
		}
		
		echo json_encode($result);
    }
	
	function view() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		$_POST['IS_VALIDATE'] = 'x';
		
		if ($action == 'get_upload_valid') {
			$array = $this->riwayat_sertifikasi_model->get_array_file($_POST);
			$this->load->view('pegawai_modul/riwayat_sertifikasi_upload', array( 'array' => $array ));
		} else if ($action == 'get_upload_request') {
			$array = $this->riwayat_sertifikasi_request_model->get_array_file($_POST);
			$this->load->view('pegawai_modul/riwayat_sertifikasi_upload', array( 'array' => $array ));
		}
	}
}