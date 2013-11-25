<?php

class Laporan extends Controller {
    function Laporan() {
        parent::Controller();
    }
    
    function index() {
        $Array['Page'] = $this->llaporan->GetProperty();
        $Array['ArrayJenisLaporan'] = $this->llaporan->GetArrayJenisLaporan();
        $Array['ArrayNamaLaporan'] = $this->llaporan->GetArrayNamaLaporan('00');
        
        $this->load->view('laporan_list', $Array);
    }
}