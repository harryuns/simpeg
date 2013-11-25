<?php

class Riwayat extends Controller {
    function Riwayat() {
        parent::Controller();
    }
    
    function index() {
        echo 'Not Avaliable';
        exit;
    }
    
    function Dosen() {
        $Array['ArrayJurusan'] = $this->ljurusan->GetArrayJurusan();
        $Array['ArrayFakultas'] = $this->lfakultas->GetArrayFakultas();
        $Array['ArrayJenjang'] = $this->lfakultas->GetArrayFakultas();
        $Array['ArrayProgramStudy'] = $this->lfakultas->GetArrayFakultas();
        
        $this->load->view('dosen_entry', $Array);
    }
}