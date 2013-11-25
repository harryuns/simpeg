<?php

class RiwayatPendidikan extends Controller {
    function RiwayatPendidikan() {
        parent::Controller();
    }
    
    function Ubah($K_PEGAWAI = '', $K_JENJANG = '', $NO_IJAZAH = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_IJAZAH = RestoreLink($NO_IJAZAH);
        
        $Array['Page'] = $this->lriwayat_pendidikan->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatPendidikan'] = $this->lriwayat_pendidikan->SimpegUpdate($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH);
        $Array['ArrayRiwayatPendidikan'] = $this->lriwayat_pendidikan->GetArray($K_PEGAWAI);
        
        $Array['ArrayNegara'] = $this->lnegara->GetArrayNegara();
        $Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjangPendidikan();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayStatusStudi'] = $this->lstatus_studi->GetArray();
        $Array['ArrayAsalPerguruanTinggi'] = $this->lperguruan_tinggi->GetArrayAsal();
        
        $this->load->view('riwayat_pendidikan_ubah', $Array);
    }
    
    function Hapus($K_PEGAWAI = '', $K_JENJANG = '', $NO_IJAZAH = '') {
        $K_PEGAWAI = RestoreLink($K_PEGAWAI);
        $NO_IJAZAH = RestoreLink($NO_IJAZAH);
        
        $Array['Page'] = $this->lriwayat_pendidikan->GetProperty();
        $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
        $Array['RiwayatPendidikan'] = $this->lriwayat_pendidikan->SimpegDelete($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH);
        $Array['ArrayRiwayatPendidikan'] = $this->lriwayat_pendidikan->GetArray($K_PEGAWAI);
        
        $Array['ArrayNegara'] = $this->lnegara->GetArrayNegara();
        $Array['ArrayJenjang'] = $this->ljenjang->GetArrayJenjangPendidikan();
        $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
        $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
        $Array['ArrayStatusStudi'] = $this->lstatus_studi->GetArray();
        $Array['ArrayAsalPerguruanTinggi'] = $this->lperguruan_tinggi->GetArrayAsal();
        
        $this->load->view('riwayat_pendidikan_ubah', $Array);
    }
}
?>