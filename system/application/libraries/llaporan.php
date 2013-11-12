<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LLaporan {
    var $CI = null;
    
    function LLaporan() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array('PageName' => 'Laporan', 'PageTitle' => 'Laporan');
        return $Array;
    }
    
    function GetArrayJenisLaporan() {
        $Array['00'] = '-';
        $Array['01'] = 'Rekap Dosen';
        $Array['02'] = 'Rekap Tenaga Kependidikan';
        $Array['03'] = 'Daftar Urut Kepangkatan';
        
        return $Array;
    }
    
    function GetArrayNamaLaporan($JenisLaporan) {
        $Array['00']['00'] = '-';
        $Array['01']['01'] = 'Jumlah Dosen';
        $Array['01']['02'] = 'Berdasarkan Gender';
        $Array['01']['03'] = 'Berdasarkan Golongan';
        $Array['01']['05'] = 'Berdasarkan Fungsional';
        $Array['01']['06'] = 'Berdasarkan Pendidikan';
		
		$Array['02']['09'] = 'Jumlah Tenaga Pendidikan';
        $Array['02']['02'] = 'Berdasarkan Gender';
        $Array['02']['07'] = 'Berdasarkan Umur';
        $Array['02']['08'] = 'Berdasarkan Pendidikan';
        $Array['02']['10'] = 'Berdasarkan Golongan';
		$Array['02']['11'] = 'Berdasarkan Fungsional';
		
        $Array['03']['01'] = 'Dosen';
        $Array['03']['02'] = 'Tenaga Kependidikan';
/*
        $Array['01']['04'] = 'Berdasarkan Fungsional Tiap Fakultas';
        $Array['01']['05'] = 'Berdasarkan Jabatan Fungsional';
        $Array['01']['06'] = 'Sedang Studi Program S2 dan S3 Dalam Negeri';
        $Array['01']['07'] = 'Sedang Studi Program S2 dan S3 Luar Negeri';
        $Array['01']['08'] = 'Selesai Studi Program S2 dan S3 Dalam Negeri';
        $Array['01']['09'] = 'Selesai Studi Program S2 dan S3 Luar Negeri';
        $Array['01']['10'] = 'Jumlah Guru Besar';
		
        $Array['02']['01'] = 'Berdasarkan Gender & Status Kerja';
        $Array['02']['03'] = 'Berdasarkan Riwayat Administrasi';
        $Array['02']['04'] = 'Berdasarkan Riwayat Studi Dosen';
        $Array['02']['05'] = 'Berdasarkan Riwayat Studi Honorer';
        $Array['02']['06'] = 'Berdasarkan Jumlah Administrasi Per Golongan';
*/
        
        $ArrayResult = (isset($Array[$JenisLaporan])) ? $Array[$JenisLaporan] : array();
        return $ArrayResult;
    }
    
    function GetLaporanFilter($JenisLaporan, $NamaLaporan) {
        $FileFilter = PATH.'/system/application/views/Laporan/Filter/'.$JenisLaporan.$NamaLaporan.'.php';
        
        if (file_exists($FileFilter)) {
            include($FileFilter);
        }
		
        exit;
    }
    
	function GetArrayMethodName() {
		$Array = array(
			// Jenis Laporan
			'01' => array(
				// Nama Laporan
				'01' => 'GetArrayJumlahDosen',
				'02' => 'GetArrayJumlahDosenByGender',
				'03' => 'GetArrayJumlahDosenByGolongan',
				'04' => 'GetArrayJumlahDosenByFungsional',
				'05' => 'GetArrayJumlahDosenByFungsionalTahun',
				'06' => 'GetArrayJumlahDosenByPendidikan'
			),
			'02' => array(
				// Nama Laporan
				'01' => 'GetArrayJumlahPegawaiByGenderStatusKerja',
				'02' => 'GetArrayJumlahPegawaiByGender',
				'03' => 'GetArrayJumlahPegawaiByRiwayatAdministrasi',
				'04' => 'GetArrayJumlahPegawaiByRiwayatStudiDosen',
				'05' => 'GetArrayJumlahPegawaiByRiwayatStudiHonorer',
				'06' => 'GetArrayJumlahPegawaiByJumlahAdministrasiPerGolongan',
				'07' => 'GetArrayJumlahPegawaiByUmur',
				'08' => 'GetArrayJumlahPegawaiByPendidikan',
				'09' => 'GetArrayJumlahDosen',
				'10' => 'GetArrayJumlahDosenByGolongan',
				'11' => 'GetArrayJumlahDosenByFungsionalTahun'
			),
			'03' => array(
				// Nama Laporan
				'01' => 'GetArrayDaftarUrutKepangkatanAkademik',
				'02' => 'GetArrayDaftarUrutKepangkatanAdministrasi'
			)
		);
		
		return $Array;
	}
	
    function GetResultLaporan($JenisLaporan, $NamaLaporan) {
		if (isset($_POST['Tahun']))
			$Param['TAHUN'] = $this->CI->input->post('Tahun');
		if (isset($_POST['TGL_BATAS']))
			$Param['TGL_BATAS'] = $this->CI->input->post('TGL_BATAS');
		if (isset($_POST['IS_DOSEN']))
			$Param['IS_DOSEN'] = $this->CI->input->post('IS_DOSEN');
		$Param['K_JURUSAN'] = $this->CI->input->post('K_JURUSAN');
        $Param['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
        $Param['K_FAKULTAS'] = $this->CI->input->post('K_FAKULTAS');
        $Param['K_UNIT_KERJA'] = $this->CI->input->post('K_UNIT_KERJA');
        $Param['K_PROG_STUDI'] = $this->CI->input->post('K_PROG_STUDI');
        $Param['K_JENIS_KERJA'] = $this->CI->input->post('K_JENIS_KERJA');
        $Param['K_STATUS_KERJA'] = $this->CI->input->post('K_STATUS_KERJA');
		
		$ArrayReportMethod = $this->GetArrayMethodName();
        $MethodName = (isset($ArrayReportMethod[$JenisLaporan][$NamaLaporan])) ? $ArrayReportMethod[$JenisLaporan][$NamaLaporan] : '';
		if (empty($MethodName)) {
			echo $JenisLaporan. ' - ' .$NamaLaporan;
			exit;
		}
		
		$Laporan = $this->$MethodName($Param);
        $FileTemplate = PATH.'/system/application/views/Laporan/Template/'.$JenisLaporan.$NamaLaporan.'.php';
        
        if (file_exists($FileTemplate)) {
            include $FileTemplate;
        } else {
            echo "File template cannot be found.";
        }
    }
    
    function ExportExcel($Param) {
		$ArrayReportMethod = $this->GetArrayMethodName();
        $MethodName = (isset($ArrayReportMethod[$Param['JenisLaporan']][$Param['NamaLaporan']])) ? $ArrayReportMethod[$Param['JenisLaporan']][$Param['NamaLaporan']] : '';
		if (empty($MethodName)) {
			echo $Param['JenisLaporan']. ' - ' .$Param['NamaLaporan'];
			exit;
		}
		
		$Laporan = $this->$MethodName($Param);
        return $Laporan;
    }
    
    function GetArrayJumlahDosen($Param) {
		$Param['IS_DOSEN'] = (isset($Param['IS_DOSEN'])) ? $Param['IS_DOSEN'] : 'x';
        $TahunMin = $Param['TAHUN'] - 4;
        
        $Laporan['Year'] = $Param['TAHUN'];
		$Laporan['List'] = array();
		
		if ($Param['IS_DOSEN'] == 1) {
			$Laporan['Title'] = 'Perkembangan Jumlah Dosen Tahun '.$TahunMin.' - '.$Param['TAHUN'];
		} else if ($Param['IS_DOSEN'] == 0) {
			$Laporan['Title'] = 'Perkembangan Jumlah Tenaga Pendidikan Tahun '.$TahunMin.' - '.$Param['TAHUN'];
		} else {
			$Laporan['Title'] = 'Perkembangan Jumlah Pegawai Tahun '.$TahunMin.' - '.$Param['TAHUN'];
		}
		
		$RawQuery = "CALL DB2ADMIN.LAPJUMDOS('".$Param['TAHUN']."', '".$Param['IS_DOSEN']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
			$Counter = 1;
			foreach ($Row as $Key => $Value) {
				$Row[$Counter] = $Value;
				$Counter++;
			}
			
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
    
    function GetArrayJumlahDosenByGender($Param) {
        $TahunMin = $Param['TAHUN'] - 4;
		$Param['K_STATUS_KERJA'] = (empty($Param['K_STATUS_KERJA'])) ? 'x' : $Param['K_STATUS_KERJA'];
        
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Dosen Berdasarkan Gender Tahun '.$TahunMin.' - '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPJUMDOSBYGENDER('".$Param['TAHUN']."', '".$Param['K_STATUS_KERJA']."', '".$Param['K_JENIS_KERJA']."')";
		$Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
    
    function GetArrayJumlahDosenByGolongan($Param) {
        $TahunMin = $Param['TAHUN'] - 4;
		$Param['IS_DOSEN'] = (isset($Param['IS_DOSEN'])) ? $Param['IS_DOSEN'] : '1';
		$Param['K_STATUS_KERJA'] = (isset($Param['K_STATUS_KERJA'])) ? $Param['K_STATUS_KERJA'] : 'x';
        
        $Laporan['List'] = array();
        $Laporan['Year'] = $Param['TAHUN'];
		
		if ($Param['IS_DOSEN'] == 1) {
			$Laporan['Title'] = 'Perkembangan Jumlah Dosen Berdasarkan Golongan Tahun '.$TahunMin.' - '.$Param['TAHUN'];
		} else if ($Param['IS_DOSEN'] == 0) {
			$Laporan['Title'] = 'Perkembangan Jumlah Tenaga Pendidikan Berdasarkan Golongan Tahun '.$TahunMin.' - '.$Param['TAHUN'];
		} else {
			$Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Golongan Tahun '.$TahunMin.' - '.$Param['TAHUN'];
		}
		
		$RawQuery = "CALL DB2ADMIN.LAPJUMDOSBYGOL('".$Param['TAHUN']."', '".$Param['IS_DOSEN']."', '".$Param['K_STATUS_KERJA']."')";
		$Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
		
        return $Laporan;
    }
	
	function GetArrayJumlahDosenByFungsional($Param) {
		$TahunMin = $Param['TAHUN'] - 4;
		
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Dosen Berdasarkan Fungsional Tiap Fakultas Tahun '.$TahunMin.' - '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.JMLDOSENFUNGSIONALPERJUR('".$Param['TAHUN']."', '".$Param['K_FAKULTAS']."', '".$Param['K_JENJANG']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahDosenByFungsionalTahun($Param) {
		$Param['IS_DOSEN'] = (isset($Param['IS_DOSEN'])) ? $Param['IS_DOSEN'] : '1';
		$Param['K_STATUS_KERJA'] = (isset($Param['K_STATUS_KERJA'])) ? $Param['K_STATUS_KERJA'] : 'x';
		
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Dosen Berdasarkan Fungsional Tahun '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPPEGFUNGSIONAL('".$Param['TAHUN']."', '".$Param['IS_DOSEN']."', '".$Param['K_STATUS_KERJA']."')";
		$Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahDosenByPendidikan($Param) {
		$Param['K_STATUS_KERJA'] = (isset($Param['K_STATUS_KERJA'])) ? $Param['K_STATUS_KERJA'] : 'x';
		
        $Laporan['Title'] = 'Perkembangan Jumlah Dosen Berdasarkan Pendidikan';
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPREKPENDD('1', '".$Param['K_STATUS_KERJA']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByGenderStatusKerja($Param) {
		$TahunMin = $Param['TAHUN'] - 4;
		
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Jenis Kelamin & Status Kerja Tahun '.$TahunMin.' - '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.JMLADMBYKELAMIN('".$Param['TAHUN']."', '".$Param['K_FAKULTAS']."', '".$Param['K_JENJANG']."', '".$Param['K_STATUS_KERJA']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByGender($Param) {
		$TahunMin = $Param['TAHUN'] - 4;
		$Param['K_STATUS_KERJA'] = (empty($Param['K_STATUS_KERJA'])) ? 'x' : $Param['K_STATUS_KERJA'];
		
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Jenis Kelamin Tahun '.$TahunMin.' - '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPJUMDOSBYGENDER('".$Param['TAHUN']."', '".$Param['K_STATUS_KERJA']."', '".$Param['K_JENIS_KERJA']."')";
		$Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByRiwayatAdministrasi($Param) {
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Riwayat Administrasi Tahun '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPADMRIWAYATSTUDI('".$Param['TAHUN']."', '".$Param['K_FAKULTAS']."', '".$Param['K_JENJANG']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByRiwayatStudiDosen($Param) {
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Riwayat Studi Dosen Tahun '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPDOSRIWAYATSTUDI('".$Param['TAHUN']."', '".$Param['K_FAKULTAS']."', '".$Param['K_JENJANG']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByRiwayatStudiHonorer($Param) {
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Studi Honorer Tahun '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPHONRIWAYATSTUDI('".$Param['TAHUN']."', '".$Param['K_FAKULTAS']."', '".$Param['K_JENJANG']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByJumlahAdministrasiPerGolongan($Param) {
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Jumlah Administrasi Per Golongan Tahun '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPJUMADMBYGOL('".$Param['TAHUN']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByUmur($Param) {
        $Laporan['Year'] = $Param['TAHUN'];
        $Laporan['Title'] = 'Perkembangan Jumlah Pegawai Berdasarkan Umur Tahun '.$Param['TAHUN'];
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPUMURPEGAWAI('".$Param['TAHUN']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayJumlahPegawaiByPendidikan($Param) {
		$Param['K_STATUS_KERJA'] = (isset($Param['K_STATUS_KERJA'])) ? $Param['K_STATUS_KERJA'] : 'x';
		
        $Laporan['Title'] = 'Perkembangan Jumlah Tenaga Kepedidikan Berdasarkan Pendidikan';
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPREKPENDD('0', '".$Param['K_STATUS_KERJA']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayDaftarUrutKepangkatanAkademik($Param) {
		$Param['K_STATUS_KERJA'] = (empty($Param['K_STATUS_KERJA'])) ? 'x' : $Param['K_STATUS_KERJA'];
		
        $Laporan['Title']  = 'DAFTAR PEGAWAI NEGERI SIPIL DOSEN<br />DI LINGKUNGAN UNIVERSITAS BRAWIJAYA<br />KEADAAN : ';
		$Laporan['Title'] .= GetFormatDate(ExchangeFormatDate($Param['TGL_BATAS']), array('FormatDate' => 'd F Y'));
		$Laporan['UnitKerja'] = $this->CI->lunit_kerja->GetById($Param['K_UNIT_KERJA']);
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPDUKALL(
			'".$Param['K_UNIT_KERJA']."', '".$Param['K_FAKULTAS']."', '".$Param['K_JENJANG']."', '".$Param['K_JURUSAN']."',
			'".$Param['K_PROG_STUDI']."', '".ExchangeFormatDate($Param['TGL_BATAS'])."', '1', '".$Param['K_STATUS_KERJA']."'
		)";
		
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
			$Row['MASA_KERJA_SEMUA'] = GetSummaryYearMonth($Row['MASA_KERJA_GOLONGAN'] + $Row['MASA_JABATAN_TAMBAHAN']);
			
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
	
	function GetArrayDaftarUrutKepangkatanAdministrasi($Param) {
		$Param['K_STATUS_KERJA'] = (empty($Param['K_STATUS_KERJA'])) ? 'x' : $Param['K_STATUS_KERJA'];
		
        $Laporan['Title']  = 'DAFTAR PEGAWAI NEGERI SIPIL TENAGA KEPENDIDIKAN<br />DI LINGKUNGAN UNIVERSITAS BRAWIJAYA<br />KEADAAN : ';
		$Laporan['Title'] .= GetFormatDate(ExchangeFormatDate($Param['TGL_BATAS']), array('FormatDate' => 'd F Y'));
		$Laporan['UnitKerja'] = $this->CI->lunit_kerja->GetById($Param['K_UNIT_KERJA']);
        $Laporan['List'] = array();
		
		$RawQuery = "CALL DB2ADMIN.LAPDUKALL(
			'".$Param['K_UNIT_KERJA']."', '".$Param['K_FAKULTAS']."', '".$Param['K_JENJANG']."', '".$Param['K_JURUSAN']."',
			'".$Param['K_PROG_STUDI']."', '".ExchangeFormatDate($Param['TGL_BATAS'])."', '0', '".$Param['K_STATUS_KERJA']."'
		)";
		
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
			$Row['K_PEGAWAI'] = (!isset($Row['K_PEGAWAI'])) ? $Row['NIP'] : $Row['K_PEGAWAI'];
			$Row['MASA_KERJA_SEMUA'] = GetSummaryYearMonth($Row['MASA_KERJA_GOLONGAN'] + $Row['MASA_JABATAN_TAMBAHAN']);
			
            $Laporan['List'][] = $Row;
        }
        
        return $Laporan;
    }
}
?>