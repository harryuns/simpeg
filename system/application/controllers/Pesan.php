<?php

class Pesan extends Controller {
    function Pesan() {
        parent::Controller();
    }
    
    function index() {
        $Array['Page'] = $this->lpesan->GetProperty();
        $Array['ListMessage'] = $this->lpesan->GetArray($_POST);
		
		if (isset($_POST['Action'])) {
			$this->lpesan->Action($_POST);
		}
        
        $this->load->view('pesan', $Array);
    }
    
    function Sender($K_PEGAWAI) {
        if (empty($K_PEGAWAI)) {
            $this->index();
            return;
        }
        
        $_POST['SearchType'] = 'SearchByNip';
        $_POST['K_PEGAWAI'] = RestoreLink($K_PEGAWAI);
        
        $Array['Page'] = $this->lpesan->GetProperty();
        $Array['ListMessage'] = $this->lpesan->GetArray($_POST);
        
        $this->load->view('pesan', $Array);
    }
}