<?php

class KenaikanGaji extends Controller {
    function KenaikanGaji() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lkenaikan_gaji->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['KenaikanGaji'] = $this->lkenaikan_gaji->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayKenaikanGaji'] = $this->lkenaikan_gaji->GetArray(array('K_PEGAWAI' => $K_PEGAWAI));
        
        $Array['ArrayPerubahanGaji'] = $this->lperubahan_gaji->GetArray();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('kenaikan_gaji_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        
        $Array['Page'] = $this->lkenaikan_gaji->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['KenaikanGaji'] = $this->lkenaikan_gaji->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayKenaikanGaji'] = $this->lkenaikan_gaji->GetArray(array('K_PEGAWAI' => $K_PEGAWAI));
        
        $Array['ArrayPerubahanGaji'] = $this->lperubahan_gaji->GetArray();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
		
        $this->load->view('kenaikan_gaji_ubah', $Array);
    }
}
?>