<?php

class Pesan extends Controller {
    function Pesan() {
        parent::Controller();
    }
    
    function index() {
		// user
		$user_unit_kerja = $this->llogin->get_unit_kerja();
		
		// page info
        $Array['Page'] = $this->lpesan->GetProperty();
		
		// list pesan
		$param_message = $_POST;
		if ($user_unit_kerja['status']) {
			$param_message['K_UNIT_KERJA'] = $user_unit_kerja['unit_kerja']['K_UNIT_KERJA'];
		}
        $Array['ListMessage'] = $this->lpesan->GetArray($param_message);
		
		// action
		if (isset($_POST['Action'])) {
			$this->lpesan->Action($_POST);
		}
        
		// view
        $this->load->view('pesan', $Array);
    }
    
    function Sender($K_PEGAWAI) {
		// check pegawai
        if (empty($K_PEGAWAI)) {
            $this->index();
            return;
        }
        
		// default param
        $_POST['SearchType'] = 'SearchByNip';
        $_POST['K_PEGAWAI'] = RestoreLink($K_PEGAWAI);
        
		// page info
        $Array['Page'] = $this->lpesan->GetProperty();
		
		// list pesan
        $Array['ListMessage'] = $this->lpesan->GetArray($_POST);
        
		// view
        $this->load->view('pesan', $Array);
    }
}