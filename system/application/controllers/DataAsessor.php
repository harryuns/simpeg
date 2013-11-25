<?php

class DataAsessor extends Controller {
    function DataAsessor() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $THN_AKADEMIK = '', $IS_GANJIL = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
		
        if (!empty($THN_AKADEMIK) && $THN_AKADEMIK < TAHUN_AKADEMIK) {
            $Link = HOST.'/index.php/DataAsessor/Ubah/'.$K_PEGAWAI;
            header('Location: '.$Link);
            exit;
        }
        
        $Array['Page'] = $this->ldata_asessor->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['DataAsessor'] = $this->ldata_asessor->SimpegUpdate($K_PEGAWAI, $THN_AKADEMIK, $IS_GANJIL);
        
        $Array['ArrayTahunAkademik'] = $this->llaporan_ekd->GetYear(TAHUN_AKADEMIK, date("Y"));
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayPegawaiActive'] = $this->ldata_asessor->GetArray($K_PEGAWAI);
        
        $this->load->view('data_asessor_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $THN_AKADEMIK = '', $IS_GANJIL = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
		
        $Array['Page'] = $this->ldata_asessor->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['DataAsessor'] = $this->ldata_asessor->SimpegDelete($K_PEGAWAI, $THN_AKADEMIK, $IS_GANJIL);
        
        $Array['ArrayTahunAkademik'] = $this->llaporan_ekd->GetYear(TAHUN_AKADEMIK, date("Y"));
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayPegawaiActive'] = $this->ldata_asessor->GetArray($K_PEGAWAI);
        
        $this->load->view('data_asessor_ubah', $Array);
    }
    
    function Ajax() {
        $RequestAjax = (isset($_POST['RequestAjax'])) ? $_POST['RequestAjax'] : '';
        if ($RequestAjax == 'PencarianDosenAsessor') {
            $NamaAsessor = (isset($_POST['NamaAsessor'])) ? $_POST['NamaAsessor'] : '';
            $ArrayPegaway = $this->ldata_asessor->GetArrayDosenAsessor($NamaAsessor);
            $ContentListDosenAsessor = $this->ldata_asessor->GetContentListDosenAsessor($ArrayPegaway);
            echo $ContentListDosenAsessor;
        }
        
    }
}
?>