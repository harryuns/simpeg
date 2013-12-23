<?php

class RiwayatFungsional extends Controller {
    function RiwayatFungsional() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_jabatan_fungsional->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatFungsional'] = $this->lriwayat_jabatan_fungsional->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatFungsional'] = $this->lriwayat_jabatan_fungsional->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
		
        $Array['ArrayUnitKerja'] = ($Array['Pegawai']['IsDosen'] == 1) ?
			$this->lunit_kerja->GetArray('1', $Array['Pegawai']['IsDosen'], $_SESSION['UserLogin']['Fakultas']['ID']) :
			$this->lunit_kerja->GetArrayAll();
		
        $Array['ArrayJabatanFungsional'] = $this->ljabatan_fungsional->GetArrayByJenisKerja($Array['Pegawai']['IsDosen'], 'x');
        $Array['ArrayJenjang'] = $this->ljenjang->GetJenjangByUnitKerja($Array['RiwayatFungsional']['K_UNIT_KERJA']);
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang(@$Array['RiwayatFungsional']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById(@$Array['RiwayatFungsional']['K_JENJANG'], @$Array['RiwayatFungsional']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById(@$Array['RiwayatFungsional']['K_JENJANG'], @$Array['RiwayatFungsional']['K_FAKULTAS'], @$Array['RiwayatFungsional']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_fungsional_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lriwayat_jabatan_fungsional->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatFungsional'] = $this->lriwayat_jabatan_fungsional->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatFungsional'] = $this->lriwayat_jabatan_fungsional->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
		
        $Array['ArrayUnitKerja'] = ($Array['Pegawai']['IsDosen'] == 1) ?
			$this->lunit_kerja->GetArray('1', $Array['Pegawai']['IsDosen'], $_SESSION['UserLogin']['Fakultas']['ID']) :
			$this->lunit_kerja->GetArrayAll();
		
        $Array['ArrayJabatanFungsional'] = $this->ljabatan_fungsional->GetArrayByJenisKerja($Array['Pegawai']['IsDosen'], 'x');
        $Array['ArrayJenjang'] = $this->ljenjang->GetJenjangByUnitKerja($Array['RiwayatFungsional']['K_UNIT_KERJA']);
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByJenjang($Array['RiwayatFungsional']['K_JENJANG']);
        $Array['ArrayJurusan'] = $this->ljurusan->GetById($Array['RiwayatFungsional']['K_JENJANG'], $Array['RiwayatFungsional']['K_FAKULTAS']);
        $Array['ArrayProgramStudi'] = $this->lprogram_studi->GetById($Array['RiwayatFungsional']['K_JENJANG'], $Array['RiwayatFungsional']['K_FAKULTAS'], $Array['RiwayatFungsional']['K_JURUSAN']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_fungsional_ubah', $Array);
    }
}
?>