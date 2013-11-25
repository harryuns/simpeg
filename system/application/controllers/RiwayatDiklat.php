<?php

class RiwayatDiklat extends Controller {
    function RiwayatDiklat() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_diklat->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatDiklat'] = $this->lriwayat_diklat->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatDiklat'] = $this->lriwayat_diklat->GetArray($K_PEGAWAI);
        
        $Array['ArrayDiklat'] = $this->ldiklat->GetArray();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('pegawai_modul/riwayat_diklat');
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_diklat->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatDiklat'] = $this->lriwayat_diklat->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatDiklat'] = $this->lriwayat_diklat->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayDiklat'] = $this->ldiklat->GetArray();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_diklat_ubah', $Array);
    }
}
?>