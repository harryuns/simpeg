<?php

class Panduan extends Controller {
    function Panduan() {
        parent::Controller();
    }
    
    function index() {
        $Array['Page'] = $this->llaporan->GetProperty();
        $Array['ArrayJenisLaporan'] = $this->llaporan->GetArrayJenisLaporan();
        $Array['ArrayNamaLaporan'] = $this->llaporan->GetArrayNamaLaporan('01');
		
		if (isset($_SESSION['UserLogin']) && isset($_SESSION['UserLogin']['ApplicationRequest']) && $_SESSION['UserLogin']['ApplicationRequest'] == 'Siado') {
			$Array['Pegawai']['IsNewPegawai'] = 0;
			$Array['Pegawai'] = $this->lpegawai->GetPegawaiById($_SESSION['UserLogin']['Nip']);
		}
        
        $this->load->view('panduan', $Array);
    }
}