<?php

class RiwayatKeluarga extends Controller {
    function RiwayatKeluarga() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $KeluargaID = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $KeluargaID = RestoreLink($KeluargaID);
        
        $Array['Page'] = $this->lriwayat_keluarga->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatKeluarga'] = $this->lriwayat_keluarga->SimpegUpdate($K_PEGAWAI, $KeluargaID);
        $Array['ArrayRiwayatKeluarga'] = $this->lriwayat_keluarga->GetArray($K_PEGAWAI);
        
        $Array['ArrayHubunganKeluarga'] = $this->lhubungan_keluarga->GetArray();
		$Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjangPendidikan();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_keluarga_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $KeluargaID = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $KeluargaID = RestoreLink($KeluargaID);
        
        $Array['Page'] = $this->lriwayat_keluarga->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatKeluarga'] = $this->lriwayat_keluarga->SimpegDelete($K_PEGAWAI, $KeluargaID);
        $Array['ArrayRiwayatKeluarga'] = $this->lriwayat_keluarga->GetArray($K_PEGAWAI);
        
        $Array['ArrayHubunganKeluarga'] = $this->lhubungan_keluarga->GetArray();
		$Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjangPendidikan();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        
        $this->load->view('riwayat_keluarga_ubah', $Array);
    }
}
?>