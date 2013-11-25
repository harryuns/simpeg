<?php

class RiwayatPangkat extends Controller {
    function RiwayatPangkat() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
		$Pegawai = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        
        $Array['Page'] = $this->lriwayat_pangkat->GetProperty();
        $Array['Pegawai'] = $Pegawai;
        $Array['RiwayatPangkat'] = $this->lriwayat_pangkat->SimpegUpdate($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatPangkat'] = $this->lriwayat_pangkat->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayPenjelasan'] = $this->lpenjelasan->GetArrayPenjelasan();
        $Array['ArrayGolongan'] = $this->lgolongan->GetArrayGolongan(array('IsPns' => $Pegawai['IsPns']));
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_pangkat_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $NO_SK = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_SK = RestoreLink($NO_SK);
        $Pegawai = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
		
        $Array['Page'] = $this->lriwayat_pangkat->GetProperty();
        $Array['Pegawai'] = $Pegawai;
        $Array['RiwayatPangkat'] = $this->lriwayat_pangkat->SimpegDelete($K_PEGAWAI, $NO_SK);
        $Array['ArrayRiwayatPangkat'] = $this->lriwayat_pangkat->GetArray($K_PEGAWAI);
        
        $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
        $Array['ArrayPenjelasan'] = $this->lpenjelasan->GetArrayPenjelasan();
        $Array['ArrayGolongan'] = $this->lgolongan->GetArrayGolongan(array('IsPns' => $Pegawai['IsPns']));
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_pangkat_ubah', $Array);
    }
}
?>