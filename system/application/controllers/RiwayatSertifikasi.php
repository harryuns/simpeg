<?php

class RiwayatSertifikasi extends Controller {
    function RiwayatSertifikasi() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SERTIFIKAT = '', $NO_PESERTA = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SERTIFIKAT = RestoreLink($NO_SERTIFIKAT);
        $NO_PESERTA = RestoreLink($NO_PESERTA);
        
        $Array['Page'] = $this->lriwayat_sertifikasi->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatSertifikasi'] = $this->lriwayat_sertifikasi->SimpegUpdate($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA);
        $Array['ArrayRiwayatSertifikasi'] = $this->lriwayat_sertifikasi->GetArray($K_PEGAWAI);
        
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayRumpunIlmu'] = $this->lrumpun_ilmu->GetArray();
        $Array['ArrayPtp'] = $this->lptp->GetArray();
        
        $this->load->view('riwayat_sertifikasi_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SERTIFIKAT = '', $NO_PESERTA = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SERTIFIKAT = RestoreLink($NO_SERTIFIKAT);
        $NO_PESERTA = RestoreLink($NO_PESERTA);
        
        $Array['Page'] = $this->lriwayat_sertifikasi->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatSertifikasi'] = $this->lriwayat_sertifikasi->SimpegDelete($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA);
        $Array['ArrayRiwayatSertifikasi'] = $this->lriwayat_sertifikasi->GetArray($K_PEGAWAI);
        
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayRumpunIlmu'] = $this->lrumpun_ilmu->GetArray();
        $Array['ArrayPtp'] = $this->lptp->GetArray();
        
        $this->load->view('riwayat_sertifikasi_ubah', $Array);
    }
}
?>