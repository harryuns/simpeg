<?php

class RiwayatHukuman extends Controller {
    function RiwayatHukuman() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_URUT = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_URUT = RestoreLink($NO_URUT);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_hukuman->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'NO_URUT' => $NO_URUT);
        $Array['RiwayatHukuman'] = $this->lriwayat_hukuman->SimpegUpdate($K_PEGAWAI, $NO_URUT);
        $Array['ArrayRiwayatHukuman'] = $this->lriwayat_hukuman->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_hukuman_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_URUT = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_URUT = RestoreLink($NO_URUT);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_hukuman->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'NO_URUT' => '');
        $Array['RiwayatHukuman'] = $this->lriwayat_hukuman->SimpegDelete($K_PEGAWAI, $NO_URUT);
        $Array['ArrayRiwayatHukuman'] = $this->lriwayat_hukuman->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_hukuman_ubah', $Array);
    }
}
?>