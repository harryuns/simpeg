<?php

class RiwayatHonorer extends Controller {
    function RiwayatHonorer() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_honorer->GetProperty($Array['Pegawai']);
        $Array['RiwayatHonorer'] = $this->lriwayat_honorer->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatHonorer'] = $this->lriwayat_honorer->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArray('0');
        $Array['ArrayBidangKerja'] = $this->lbidang_kerja->GetArray($Array['RiwayatHonorer']['K_BIDANG_KERJA']);
        $Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjang();
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang($Array['RiwayatHonorer']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById($Array['RiwayatHonorer']['K_JENJANG'], $Array['RiwayatHonorer']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById($Array['RiwayatHonorer']['K_JENJANG'], $Array['RiwayatHonorer']['K_FAKULTAS'], $Array['RiwayatHonorer']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_honorer_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Page'] = $this->lriwayat_honorer->GetProperty($Array['Pegawai']);
        $Array['RiwayatHonorer'] = $this->lriwayat_honorer->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatHonorer'] = $this->lriwayat_honorer->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArray('0');
        $Array['ArrayBidangKerja'] = $this->lbidang_kerja->GetArray($Array['RiwayatHonorer']['K_BIDANG_KERJA']);
        $Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjang();
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang($Array['RiwayatHonorer']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById($Array['RiwayatHonorer']['K_JENJANG'], $Array['RiwayatHonorer']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById($Array['RiwayatHonorer']['K_JENJANG'], $Array['RiwayatHonorer']['K_FAKULTAS'], $Array['RiwayatHonorer']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_honorer_ubah', $Array);
    }
}
?>