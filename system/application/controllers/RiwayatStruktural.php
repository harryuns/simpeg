<?php

class RiwayatStruktural extends Controller {
    function RiwayatStruktural() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_jabatan_struktural->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatStruktural'] = $this->lriwayat_jabatan_struktural->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatStruktural'] = $this->lriwayat_jabatan_struktural->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArray('0', $Array['Pegawai']['IsDosen'], $_SESSION['UserLogin']['Fakultas']['ID']);
        
        $UnitKerjaDefault = $Array['RiwayatStruktural']['K_UNIT_KERJA'];
        $UnitKerjaExisting = $this->lunit_kerja->GetUnitKerjaFromArray($Array['ArrayUnitKerja']);
        $UnitKerja = (isset($Array['ArrayUnitKerja'][$UnitKerjaDefault])) ? $UnitKerjaDefault : $UnitKerjaExisting;
        
        $Array['ArrayJabatanStruktural'] = $this->ljabatan_struktural->GetArrayByUnitKerja($UnitKerja);
        $Array['ArrayBidangKerja'] = $this->lbidang_kerja->GetArray();
        $Array['ArrayJenjang'] = $this->ljenjang->GetJenjangByUnitKerja($UnitKerja);
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang($Array['RiwayatStruktural']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById($Array['RiwayatStruktural']['K_JENJANG'], $Array['RiwayatStruktural']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById($Array['RiwayatStruktural']['K_JENJANG'], $Array['RiwayatStruktural']['K_FAKULTAS'], $Array['RiwayatStruktural']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_struktural_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_jabatan_struktural->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatStruktural'] = $this->lriwayat_jabatan_struktural->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatStruktural'] = $this->lriwayat_jabatan_struktural->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArray('0', $Array['Pegawai']['IsDosen'], $_SESSION['UserLogin']['Fakultas']['ID']);
        $Array['ArrayJabatanStruktural'] = $this->ljabatan_struktural->GetArrayByUnitKerja($Array['RiwayatStruktural']['K_UNIT_KERJA']);
        $Array['ArrayBidangKerja'] = $this->lbidang_kerja->GetArray();
        $Array['ArrayJenjang'] = $this->ljenjang->GetJenjangByUnitKerja($Array['RiwayatStruktural']['K_UNIT_KERJA']);
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang($Array['RiwayatStruktural']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById($Array['RiwayatStruktural']['K_JENJANG'], $Array['RiwayatStruktural']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById($Array['RiwayatStruktural']['K_JENJANG'], $Array['RiwayatStruktural']['K_FAKULTAS'], $Array['RiwayatStruktural']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_struktural_ubah', $Array);
    }
}
?>