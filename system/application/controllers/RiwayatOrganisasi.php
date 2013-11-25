<?php

class RiwayatOrganisasi extends Controller {
    function RiwayatOrganisasi() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_URUT = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_URUT = RestoreLink($NO_URUT);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_organisasi->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'NO_URUT' => $NO_URUT);
        $Array['RiwayatOrganisasi'] = $this->lriwayat_organisasi->SimpegUpdate($K_PEGAWAI, $NO_URUT);
        $Array['ArrayRiwayatOrganisasi'] = $this->lriwayat_organisasi->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_organisasi_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_URUT = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_URUT = RestoreLink($NO_URUT);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_organisasi->GetProperty($Array['Pegawai']);
		$Array['PageParam'] = array('K_PEGAWAI' => $K_PEGAWAI, 'NO_URUT' => '');
        $Array['RiwayatOrganisasi'] = $this->lriwayat_organisasi->SimpegDelete($K_PEGAWAI, $NO_URUT);
        $Array['ArrayRiwayatOrganisasi'] = $this->lriwayat_organisasi->GetArray($K_PEGAWAI);
		
        $this->load->view('riwayat_organisasi_ubah', $Array);
    }
}
?>