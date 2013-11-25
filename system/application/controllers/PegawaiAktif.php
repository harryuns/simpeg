<?php

class PegawaiAktif extends Controller {
    function PegawaiAktif() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $K_AKTIF = '', $NO_SK = '') {
		$K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lpegawai_aktif->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['PegawaiAktif'] = $this->lpegawai_aktif->SimpegUpdate($K_PEGAWAI, $K_AKTIF, $NO_SK);
        
        $Array['ArrayAktif'] = $this->laktif->GetArrayAktif();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayPegawaiActive'] = $this->lpegawai_aktif->GetArrayPegawaiActive($K_PEGAWAI);
        
        $this->load->view('pegawai_aktif_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $K_AKTIF = '', $NO_SK = '') {
		$K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lpegawai_aktif->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['PegawaiAktif'] = $this->lpegawai_aktif->SimpegDelete($K_PEGAWAI, $K_AKTIF, $NO_SK);
        
        $Array['ArrayAktif'] = $this->laktif->GetArrayAktif();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayPegawaiActive'] = $this->lpegawai_aktif->GetArrayPegawaiActive($K_PEGAWAI);
        
        $this->load->view('pegawai_aktif_ubah', $Array);
    }
}
?>