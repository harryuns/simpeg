<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Bidang_Kerja extends LRiwayat_Jabatan_Struktural {
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatBidangKerja',
            'PageTitle' => 'Riwayat Bidang Kerja'
        );
        return $Array;
    }
}
?>