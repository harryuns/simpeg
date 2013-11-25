<?php

class RiwayatSeminar extends Controller {
    function RiwayatSeminar() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_URUT = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_URUT = RestoreLink($NO_URUT);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_seminar->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'NO_URUT' => $NO_URUT);
        $Array['RiwayatSeminar'] = $this->lriwayat_seminar->SimpegUpdate($K_PEGAWAI, $NO_URUT);
        $Array['ArrayRiwayatSeminar'] = $this->lriwayat_seminar->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_seminar_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_URUT = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_URUT = RestoreLink($NO_URUT);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_seminar->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'NO_URUT' => '');
        $Array['RiwayatSeminar'] = $this->lriwayat_seminar->SimpegDelete($K_PEGAWAI, $NO_URUT);
        $Array['ArrayRiwayatSeminar'] = $this->lriwayat_seminar->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_seminar_ubah', $Array);
    }
}
?>