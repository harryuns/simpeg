<?php

class RiwayatHomeBase extends Controller {
    function RiwayatHomeBase() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $ID_RIWAYAT_HOMEBASE = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $ID_RIWAYAT_HOMEBASE = RestoreLink($ID_RIWAYAT_HOMEBASE);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_home_base->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'ID_RIWAYAT_HOMEBASE' => $ID_RIWAYAT_HOMEBASE);
        $Array['RiwayatHomeBase'] = $this->lriwayat_home_base->SimpegUpdate($K_PEGAWAI, $ID_RIWAYAT_HOMEBASE);
        $Array['ArrayRiwayatHomeBase'] = $this->lriwayat_home_base->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_home_base_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $ID_RIWAYAT_HOMEBASE = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $ID_RIWAYAT_HOMEBASE = RestoreLink($ID_RIWAYAT_HOMEBASE);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_home_base->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'ID_RIWAYAT_HOMEBASE' => '');
        $Array['RiwayatHomeBase'] = $this->lriwayat_home_base->SimpegDelete($ID_RIWAYAT_HOMEBASE);
        $Array['ArrayRiwayatHomeBase'] = $this->lriwayat_home_base->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_home_base_ubah', $Array);
    }
}
?>