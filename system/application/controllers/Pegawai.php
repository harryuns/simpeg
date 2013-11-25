<?php

class Pegawai extends Controller {
    function Pegawai() {
        parent::Controller();
    }
    
    function index() {
		$_POST['NAMA'] = (isset($_POST['NAMA'])) ? $_POST['NAMA'] : '';
		$_POST['K_AKTIF'] = (isset($_POST['K_AKTIF'])) ? $_POST['K_AKTIF'] : '';
		$_POST['K_UNIT_KERJA'] = (isset($_POST['K_UNIT_KERJA'])) ? $_POST['K_UNIT_KERJA'] : '99';
		$_POST['K_JENIS_KERJA'] = (isset($_POST['K_JENIS_KERJA'])) ? $_POST['K_JENIS_KERJA'] : '01';
		$_POST['K_STATUS_KERJA'] = (isset($_POST['K_STATUS_KERJA'])) ? $_POST['K_STATUS_KERJA'] : '';
		$_POST['PencarianDetail'] = (isset($_POST['PencarianDetail'])) ? $_POST['PencarianDetail'] : '';
		$Param['IS_FAKULTAS'] = (isset($_POST['K_JENIS_KERJA']) && $_POST['K_JENIS_KERJA'] == '02') ? 0 : 1;
		
		$this->llogin->OnlyAccessedBySimpeg();
        $this->lpegawai->Delete();
        
        $Array['Page'] = array('PageName' => 'Pegawai', 'PageTitle' => 'Pencarian Pegawai');
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayFakultas'] = $this->lfakultas->GetArrayFakultas();
        $Array['ArrayStatusDosen'] = $this->lstatus_dosen->GetArray();
        $Array['ArrayStatusPensiun'] = $this->lstatus_pensiun->GetArrayStatusPensiun();
        $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArrayAll($_SESSION['UserLogin']['Fakultas']['ID'], $Param);
        
		$Array['ArrayPegawai'] = ($_POST['PencarianDetail'] == '') ? array() : $this->lpegawai->GetArrayPegawai($_POST);
        
        $this->load->view('pegawai_cari', $Array);
    }
    
    function Tambah($K_PEGAWAI = '', $IsNewPegawai = '') {
		$K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $Array['Page'] = $this->lpegawai->GetProperty();
        $Pegawai = $this->lpegawai->SimpegUpdate($IsNewPegawai);
		
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['Pegawai']['Message'] = $Pegawai['Message'];
		$Array['IsUserFakultas'] = $this->llogin->IsUserFakultas();
        
        $Array['ArrayAgama'] = $this->lagama->GetArrayAgama();
        $Array['ArrayPropinsi'] = $this->lpropinsi->GetArray($Array['Pegawai']['K_NEGARA_ASAL']);
        $Array['ArrayKota'] = $this->lkota->GetArray($Array['Pegawai']['K_NEGARA_ASAL'], $Array['Pegawai']['K_PROPINSI_ASAL']);
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayJenisKelamin'] = $this->ljenis_kelamin->GetArrayJenisKelamin();
        $Array['ArrayStatusKawin'] = $this->lstatus_kawin->GetArrayStatusKawin();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayStatusDosen'] = $this->lstatus_dosen->GetArray();
        $Array['ArrayStatusPensiun'] = $this->lstatus_pensiun->GetArrayStatusPensiun();
        
        $this->load->view('pegawai_ubah', $Array);
    }
    
    function Cetak($K_PEGAWAI = '') {
		$K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $Array['Page'] = $this->lpegawai->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        
        $Array['ArrayAgama'] = $this->lagama->GetArrayAgama();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayJenisKelamin'] = $this->ljenis_kelamin->GetArrayJenisKelamin();
        $Array['ArrayStatusKawin'] = $this->lstatus_kawin->GetArrayStatusKawin();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayStatusDosen'] = $this->lstatus_dosen->GetArray();
        $Array['ArrayStatusPensiun'] = $this->lstatus_pensiun->GetArrayStatusPensiun();
        
        $this->load->view('pegawai_cetak', $Array);
    }
}