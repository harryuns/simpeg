<?php
	// get current module
	preg_match('/index.php\/([a-z0-9]+)\//i', $_SERVER['REQUEST_URI'], $match);
	$current_module = (isset($match[1])) ? $match[1] : '';
	
	// make it exist for sub menu
	if (!isset($Pegawai)) {
		$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
		$Pegawai = $this->lpegawai->GetPegawaiById($k_pegawai);
	}
	
    if (isset($Pegawai) && is_array($Pegawai) && $Pegawai['IsNewPegawai'] == '0') {
		$Pegawai['IsPns'] = (isset($Pegawai['IsPns'])) ? $Pegawai['IsPns'] : '0';
		$Pegawai['IsDosen'] = (isset($Pegawai['IsDosen'])) ? $Pegawai['IsDosen'] : '0';
		
        $ArrayMenu['DataPegawai'] = array( 'link' => $Pegawai['LinkPegawai'], 'title' => 'Data Pegawai' );
        $ArrayMenu['PegawaiAktif'] = array( 'link' => $Pegawai['LinkPegawaiAktif'], 'title' => 'Perubahan / Mutasi Pegawai' );
        $ArrayMenu['RiwayatPendidikan'] = array( 'link' => $Pegawai['LinkRiwayatPendidikan'], 'title' => 'Riwayat Pendidikan' );
        
        if ($Pegawai['IsDosen'] == 1) {
            $ArrayMenu['RiwayatPangkat'] = array( 'link' => $Pegawai['LinkRiwayatPangkat'], 'title' => 'Riwayat Pangkat' );
			$ArrayMenu['RiwayatFungsional'] = array( 'link' => $Pegawai['LinkRiwayatFungsional'], 'title' => 'Riwayat Fungsional' );
            $ArrayMenu['RiwayatStruktural'] = array( 'link' => $Pegawai['LinkRiwayatStruktural'], 'title' => 'Riwayat Struktural' );
        } else if ($Pegawai['IsPns'] == 1) {
            $ArrayMenu['RiwayatPangkat'] = array( 'link' => $Pegawai['LinkRiwayatPangkat'], 'title' => 'Riwayat Pangkat' );
			$ArrayMenu['RiwayatFungsional'] = array( 'link' => $Pegawai['LinkRiwayatFungsional'], 'title' => 'Riwayat Fungsional' );
            $ArrayMenu['RiwayatStruktural'] = array( 'link' => $Pegawai['LinkRiwayatStruktural'], 'title' => 'Riwayat Struktural' );
			$ArrayMenu['RiwayatHonorer'] = array( 'link' => $Pegawai['LinkRiwayatHonorer'], 'title' => 'Riwayat Kepegawaian' );
		} else {
			$ArrayMenu['RiwayatFungsional'] = array( 'link' => $Pegawai['LinkRiwayatFungsional'], 'title' => 'Riwayat Fungsional' );
			$ArrayMenu['RiwayatHonorer'] = array( 'link' => $Pegawai['LinkRiwayatHonorer'], 'title' => 'Riwayat Honorer' );
        }
        
        $ArrayMenu['RiwayatSertifikasi'] = array( 'link' => $Pegawai['LinkRiwayatSertifikasi'], 'title' => 'Riwayat Sertifikasi' );
        $ArrayMenu['Kenaikan Gaji'] = array( 'link' => $Pegawai['LinkKenaikanGaji'], 'title' => 'Kenaikan Gaji' );
        $ArrayMenu['RiwayatHomeBase'] = array( 'link' => $Pegawai['LinkRiwayatHomeBase'], 'title' => 'Riwayat Home Base' );
        $ArrayMenu['RiwayatDiklat'] = array( 'link' => $Pegawai['LinkRiwayatDiklat'], 'title' => 'Riwayat Diklat' );
        $ArrayMenu['RiwayatPenghargaan'] = array( 'link' => $Pegawai['LinkRiwayatPenghargaan'], 'title' => 'Riwayat Penghargaan' );
        $ArrayMenu['RiwayatKeluarga'] = array( 'link' => $Pegawai['LinkRiwayatKeluarga'], 'title' => 'Riwayat Keluarga' );
		
		$ArrayMenu['RiwayatSeminar'] = array( 'link' => $Pegawai['LinkRiwayatSeminar'], 'title' => 'Riwayat Seminar' );
		$ArrayMenu['RiwayatOrganisasi'] = array( 'link' => $Pegawai['LinkRiwayatOrganisasi'], 'title' => 'Riwayat Organisasi' );
		$ArrayMenu['RiwayatHukuman'] = array( 'link' => $Pegawai['LinkRiwayatHukuman'], 'title' => 'Riwayat Hukuman' );
		
		// SKP
		$ArrayMenu['skp'] = array( 'link' => $Pegawai['link_skp'], 'title' => 'SKP' );
        
        if ($Pegawai['IsDosen'] == '1' && $_SESSION['UserLogin']['ApplicationRequest'] == 'Simpeg') {
            $ArrayMenu['DataAsessor'] = array( 'link' => $Pegawai['LinkDataAsessor'], 'title' => 'Data Asessor' );
			
			if (GetUnixTime(date("Y-m-d H:i:s")) > GetUnixTime('2012-10-01 00:00:00')) {
				$ArrayMenu['DataEkd'] = array( 'link' => $Pegawai['LinkDataEkd'], 'title' => 'Data BKD' );
			}
        }
		
        $Content = '';
        foreach ($ArrayMenu as $Key => $Menu) {
            $Class = ($Key == $current_module) ? 'active' : '';
            $Content .= '<a class="menuitem '.$Class.'"  href="'.$Menu['link'].'">'.$Menu['title'].'</a>';
        }
        
        echo $Content;
    }
?>