<?php

class RiwayatBidangKerja extends Controller {
    function RiwayatBidangKerja() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_bidang_kerja->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatBidangKerja'] = $this->lriwayat_bidang_kerja->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatBidangKerja'] = $this->lriwayat_bidang_kerja->GetArray($K_PEGAWAI, 'RiwayatBidangKerja');
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArray('0', $Array['Pegawai']['IsDosen']);
        $Array['ArrayJabatanStruktural'] = $this->ljabatan_struktural->GetArrayByBidangKerja();
        $Array['ArrayBidangKerja'] = $this->lbidang_kerja->GetArray();
        $Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjang();
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang($Array['RiwayatBidangKerja']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById($Array['RiwayatBidangKerja']['K_JENJANG'], $Array['RiwayatBidangKerja']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById($Array['RiwayatBidangKerja']['K_JENJANG'], $Array['RiwayatBidangKerja']['K_FAKULTAS'], $Array['RiwayatBidangKerja']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_bidang_kerja_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_bidang_kerja->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatBidangKerja'] = $this->lriwayat_bidang_kerja->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatBidangKerja'] = $this->lriwayat_bidang_kerja->GetArray($K_PEGAWAI, 'RiwayatBidangKerja');
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArray('0');
        $Array['ArrayJabatanStruktural'] = $this->ljabatan_struktural->GetArrayByBidangKerja();
        $Array['ArrayBidangKerja'] = $this->lbidang_kerja->GetArray();
        $Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjang();
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang($Array['RiwayatBidangKerja']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById($Array['RiwayatBidangKerja']['K_JENJANG'], $Array['RiwayatBidangKerja']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById($Array['RiwayatBidangKerja']['K_JENJANG'], $Array['RiwayatBidangKerja']['K_FAKULTAS'], $Array['RiwayatBidangKerja']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_bidang_kerja_ubah', $Array);
    }
}
?>