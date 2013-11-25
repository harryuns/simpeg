<?php

class RiwayatPenghargaan extends Controller {
    function RiwayatPenghargaan() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_penghargaan->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatPenghargaan'] = $this->lriwayat_penghargaan->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatPenghargaan'] = $this->lriwayat_penghargaan->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayJenisPenghargaan'] = $this->ljenis_penghargaan->GetArray();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_penghargaan_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_penghargaan->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatPenghargaan'] = $this->lriwayat_penghargaan->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatPenghargaan'] = $this->lriwayat_penghargaan->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayJenisPenghargaan'] = $this->ljenis_penghargaan->GetArray();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_penghargaan_ubah', $Array);
    }
}
?>