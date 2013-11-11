<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPegawai extends Controller {
    var $CI = null;
    
    function LPegawai() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'DataPegawai',
            'PageTitle' => 'Data Pegawai'
        );
        return $Array;
    }
    
    function GetPegawaiById($K_PEGAWAI) {
        $Pegawai = array(
            'K_PEGAWAI' => '',
            'NAMA' => '',
            'TMP_LAHIR' => '',
            'TGL_LAHIR' => '',
            'GLR_DPN' => '',
            'GLR_BLKG' => '',
            'BIDANG_ILMU' => '',
            'JENIS_KELAMIN' => 'L',
            'ALAMAT' => '',
            'K_AGAMA' => '',
            'K_STATUS_KAWIN' => '',
            'TLP_RMH' => '',
            'NO_HP' => '',
            'TMT_CPNS' => '',
            'SK_CPNS' => '',
            'TMT_PNS' => '',
            'SK_PNS' => '',
            'NIK' => '',
            'EMAIL' => '',
            'KARPEG' => '',
            'NIRA' => '',
            'K_STATUS_KERJA' => '',
            'K_STATUS_DOSEN' => '',
            'K_JENIS_KERJA' => '',
            'NIDN' => '',
            'THN_MASUK' => '',
            'GAJI' => '',
            'K_STATUS_DOSEN' => '99',
            'MASA_KERJA_KESELURUHAN' => '',
            'MASA_KERJA_GOLONGAN' => '',
            'K_PROPINSI_ASAL' => '',
            'K_KOTA_ASAL' => '',
            'ALAMAT_ASAL' => '',
            'K_NEGARA_ASAL' => '360',
            'IsPns' => false,
            'FILEKTP' => '',
            'FILEKARPEG' => ''
        );
        
        $RawQuery = "CALL DB2ADMIN.GETPEGBYID('".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        if ($Row = db2_fetch_assoc($Query)) {
            $Pegawai = $Row;
			$Pegawai['FILEKTP'] = $Pegawai['FILE_KTP'];
			$Pegawai['FILEKARPEG'] = $Pegawai['FILE_KARPEG'];
			unset($Pegawai['FILE_KTP']);
			unset($Pegawai['FILE_KARPEG']);
			
            $Pegawai['IsPns'] = $this->IsPns($Pegawai);
            $Pegawai['IsDosen'] = $this->IsDosen($Pegawai);
			
			$Pegawai['NAMA_GELAR'] = $Pegawai['NAMA'];
			if (!empty($Pegawai['GLR_DPN']))
				$Pegawai['NAMA_GELAR'] = $Pegawai['GLR_DPN'] . ' ' . $Pegawai['NAMA_GELAR'];
			if (!empty($Pegawai['GLR_BLKG']))
				$Pegawai['NAMA_GELAR'] = $Pegawai['NAMA_GELAR'] . ' ' . $Pegawai['GLR_BLKG'];
        }
        
        $Pegawai['K_STATUS_KAWIN'] = (isset($Pegawai['K_STATUS_KAWIN'])) ? $Pegawai['K_STATUS_KAWIN'] : '';
        $Pegawai['KTP'] = (isset($Pegawai['KTP'])) ? $Pegawai['KTP'] : '';
        $Pegawai['NO_ODNER'] = (isset($Pegawai['NO_ODNER'])) ? $Pegawai['NO_ODNER'] : '';
		$Pegawai['K_NEGARA_ASAL'] = (empty($Pegawai['K_NEGARA_ASAL'])) ? 360 : $Pegawai['K_NEGARA_ASAL'];
		$Pegawai['K_PROPINSI_ASAL'] = (empty($Pegawai['K_PROPINSI_ASAL'])) ? 11 : $Pegawai['K_PROPINSI_ASAL'];
		$Pegawai['Foto'] = $this->GetPhotoByID($K_PEGAWAI);
		$Pegawai['LINK_FILEKTP'] = (empty($Pegawai['FILEKTP'])) ? '' : HOST . '/images/Foto/' .  $Pegawai['FILEKTP'];
		$Pegawai['LINK_FILEKARPEG'] = (empty($Pegawai['FILEKARPEG'])) ? '' : HOST . '/images/Foto/' .  $Pegawai['FILEKARPEG'];
		
		$Pegawai['LinkCetak'] = HOST.'/index.php/Pegawai/Cetak/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkPegawai'] = HOST.'/index.php/Pegawai/Tambah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkPegawaiAktif'] = HOST.'/index.php/PegawaiAktif/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatHidup'] = HOST.'/index.php/RiwayatHidup/index/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatPendidikan'] = HOST.'/index.php/RiwayatPendidikan/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatDiklat'] = HOST.'/index.php/RiwayatDiklat/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatPangkat'] = HOST.'/index.php/RiwayatPangkat/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatFungsional'] = HOST.'/index.php/RiwayatFungsional/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatStruktural'] = HOST.'/index.php/RiwayatStruktural/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatHonorer'] = HOST.'/index.php/RiwayatHonorer/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatPenghargaan'] = HOST.'/index.php/RiwayatPenghargaan/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatSertifikasi'] = HOST.'/index.php/RiwayatSertifikasi/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatKeluarga'] = HOST.'/index.php/RiwayatKeluarga/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkKenaikanGaji'] = HOST.'/index.php/KenaikanGaji/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkDataAsessor'] = HOST.'/index.php/DataAsessor/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatHomeBase'] = HOST.'/index.php/RiwayatHomeBase/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatSeminar'] = HOST.'/index.php/RiwayatSeminar/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatOrganisasi'] = HOST.'/index.php/RiwayatOrganisasi/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkRiwayatHukuman'] = HOST.'/index.php/RiwayatHukuman/Ubah/'.ConvertLink($Pegawai['K_PEGAWAI']);
		$Pegawai['LinkDataEkd'] = HOST.'/index.php/SendToEkd/index/'.ConvertLink($Pegawai['K_PEGAWAI']);
		
        // Add Parameter
        $Pegawai['IsNewPegawai'] = (empty($K_PEGAWAI)) ? 1 : 0;
        
        return $Pegawai;
    }
    
    function IsPns($Pegawai) {
        $Pegawai['K_STATUS_KERJA'] = (isset($Pegawai['K_STATUS_KERJA'])) ? $Pegawai['K_STATUS_KERJA'] : 0;
        return ($Pegawai['K_STATUS_KERJA'] == '01' || $Pegawai['K_STATUS_KERJA'] == '03') ? '1' : '0';
    }
    
    function IsDosen($Pegawai) {
        $Pegawai['K_JENIS_KERJA'] = (isset($Pegawai['K_JENIS_KERJA'])) ? $Pegawai['K_JENIS_KERJA'] : 0;
        return ($Pegawai['K_JENIS_KERJA'] == '01') ? '1' : '0';
    }
    
    function GetArrayPegawai($Search) {
        $ArrayPegawai = array();
        $PageActive = 1;
        $PageCount = 1;
        
        $Search['NAMA'] = (isset($Search['NAMA'])) ? $Search['NAMA'] : '';
        $Search['K_STATUS_PEGAWAI'] = (isset($Search['K_STATUS_PEGAWAI'])) ? $Search['K_STATUS_PEGAWAI'] : 'x';
        $Search['Export'] = (isset($Search['Export'])) ? $Search['Export'] : '';
        $Search['PageActive'] = (empty($Search['PageActive'])) ? 1 : $Search['PageActive'];
        $Search['PageOffset'] = (empty($Search['PageOffset'])) ? 50 : $Search['PageOffset'];
        $Search['SORTING'] = (isset($_POST['SORTING'])) ? $_POST['SORTING'] : $Search['SORTING'];
        
        // Validation Keyword
        $Search['NAMA'] = str_replace("'", "`", $Search['NAMA']);
        
		if ($Search['SORTING'] == 1) {
			if ($Search['PencarianDetail'] == '0' || $Search['PencarianDetail'] == '1') {
				$RawQuery = "CALL DB2ADMIN.GETPEGBYJENISKERJA('".$Search['NAMA']."', '".$Search['K_JENIS_KERJA']."', '".$Search['K_UNIT_KERJA']."')";
			} else if ($Search['PencarianDetail'] == '2') {
				$RawQuery = "CALL DB2ADMIN.GETPEGBYSTATUSKERJ('".$Search['NAMA']."', '".$Search['K_STATUS_KERJA']."', '".$Search['K_UNIT_KERJA']."')";
			} else if ($Search['PencarianDetail'] == '3') {
				$RawQuery = "CALL DB2ADMIN.GETPEGBYUNITJENIS('".$Search['NAMA']."', '".$Search['K_JENIS_KERJA']."', '".$Search['K_UNIT_KERJA']."')";
			} else {
				$RawQuery = "CALL DB2ADMIN.GETPEGBYSTATUSAKTF('".$Search['NAMA']."', '".$Search['K_AKTIF']."')";
			}
		} else if ($Search['SORTING'] == 2) {
			if ($Search['K_JENIS_KERJA'] == '01') {
				$RawQuery = "CALL DB2ADMIN.LAPDUKALL('".$Search['K_UNIT_KERJA']."', 'x', 'x', 'x', 'x', '".date("Y-m-d")."', '1', '".$Search['K_STATUS_PEGAWAI']."')";
			} else if ($Search['K_JENIS_KERJA'] == '02') {
				$RawQuery = "CALL DB2ADMIN.LAPDUKALL('".$Search['K_UNIT_KERJA']."', 'x', 'x', 'x', 'x', '".date("Y-m-d")."', '0', '".$Search['K_STATUS_PEGAWAI']."')";
			}
		}
		
		$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
		db2_execute($Query);
		while ($Row = db2_fetch_assoc($Query)) {
			// sync
			if (!isset($Row['K_PEGAWAI']) && isset($Row['NIP'])) {
				$Row['K_PEGAWAI'] = $Row['NIP'];
			}
			
			$Row['IsPns'] = $this->IsPns($Row);
			$Row['LinkEdit'] = HOST.'/index.php/Pegawai/Tambah/'.ConvertLink($Row['K_PEGAWAI']);
			
			// masa kerja total
			$Row['MASA_KERJA_GOLONGAN'] = (empty($Row['MASA_KERJA_GOLONGAN'])) ? 0 : $Row['MASA_KERJA_GOLONGAN'];
			$Row['MASA_JABATAN_TAMBAHAN'] = (empty($Row['MASA_JABATAN_TAMBAHAN'])) ? 0 : $Row['MASA_JABATAN_TAMBAHAN'];
			$Row['MASA_KERJA_SEMUA'] = GetSummaryYearMonth($Row['MASA_KERJA_GOLONGAN'] + $Row['MASA_JABATAN_TAMBAHAN']);
			
			if (isset($Row['GLR_DPN']) && isset($Row['GLR_BLKG'])) {
				$Row['NAMA_LENGKAP'] = $Row['GLR_DPN'].' '.$Row['NAMA'].' '.$Row['GLR_BLKG'];
			}
			
			// link download excel
			if ($Row['IsPns'] == 1) {
				$Row['link_download_excel'] = HOST . '/Document/download/' . $Row['K_PEGAWAI'] . '.xlsx';
			}
			
			$ArrayPegawai[] = $Row;
		}
		$PegawaiTotal = count($ArrayPegawai);
		$PageActive = $Search['PageActive'];
		$PageCount = ceil($PegawaiTotal / $Search['PageOffset']);
		
		if ($Search['Export'] != '1') {
			// Calculate Page
			$PageStart = ($Search['PageActive'] - 1) * $Search['PageOffset'];
			$PageEnd = $PageStart + $Search['PageOffset'];
			$ArrayPegawai = GetPageFromArray($ArrayPegawai, $PageStart, $PageEnd);
		}
        
        $Array = array(
            'Pegawai' =>$ArrayPegawai,
            'PageActive' => $PageActive,
            'PageCount' => $PageCount
        );
        
        return $Array;
    }
    
    function SimpegUpdate($IsNewPegawai = '') {
        $Pegawai['Error'] = '00000';
        $Pegawai['Message'] = (empty($IsNewPegawai)) ? '' : 'Data pegawai berhasil ditambahkan.';
        
        $Submit = $this->CI->input->post('Submit');
        if (!empty($Submit)) {
            $Pegawai['IsNewPegawai'] = $this->CI->input->post('IsNewPegawai');
            $Pegawai['K_PEGAWAI'] = $this->CI->input->post('K_PEGAWAI');
            $Pegawai['NAMA'] = $this->CI->input->post('NAMA');
            $Pegawai['TMP_LAHIR'] = $this->CI->input->post('TMP_LAHIR');
            $Pegawai['TGL_LAHIR'] = $this->CI->input->post('TGL_LAHIR');
            $Pegawai['KTP'] = $this->CI->input->post('KTP');
            $Pegawai['NO_ODNER'] = $this->CI->input->post('NO_ODNER');
            $Pegawai['JENIS_KELAMIN'] = $this->CI->input->post('JENIS_KELAMIN');
            $Pegawai['GLR_DPN'] = $this->CI->input->post('GLR_DPN');
            $Pegawai['GLR_BLKG'] = $this->CI->input->post('GLR_BLKG');
            $Pegawai['BIDANG_ILMU'] = $this->CI->input->post('BIDANG_ILMU');
            $Pegawai['ALAMAT'] = $this->CI->input->post('ALAMAT');
            $Pegawai['K_AGAMA'] = $this->CI->input->post('K_AGAMA');
            $Pegawai['K_STATUS_KAWIN'] = $this->CI->input->post('K_STATUS_KAWIN');
            $Pegawai['TLP_RMH'] = $this->CI->input->post('TLP_RMH');
            $Pegawai['NO_HP'] = $this->CI->input->post('NO_HP');
            $Pegawai['TMT_CPNS'] = $this->CI->input->post('TMT_CPNS');
            $Pegawai['SK_CPNS'] = $this->CI->input->post('SK_CPNS');
            $Pegawai['TMT_PNS'] = $this->CI->input->post('TMT_PNS');
            $Pegawai['SK_PNS'] = $this->CI->input->post('SK_PNS');
            $Pegawai['NIK'] = $this->CI->input->post('NIK');
            $Pegawai['EMAIL'] = $this->CI->input->post('EMAIL');
            $Pegawai['K_STATUS_KERJA'] = $this->CI->input->post('K_STATUS_KERJA');
            $Pegawai['K_JENIS_KERJA'] = $this->CI->input->post('K_JENIS_KERJA');
            $Pegawai['K_STATUS_DOSEN'] = $this->CI->input->post('K_STATUS_DOSEN');
            $Pegawai['NIDN'] = $this->CI->input->post('NIDN');
            $Pegawai['THN_MASUK'] = $this->CI->input->post('THN_MASUK');
            $Pegawai['KARPEG'] = $this->CI->input->post('KARPEG');
            $Pegawai['NIRA'] = $this->CI->input->post('NIRA');
            $Pegawai['K_NEGARA_ASAL'] = $this->CI->input->post('K_NEGARA_ASAL');
            $Pegawai['K_PROPINSI_ASAL'] = $this->CI->input->post('K_PROPINSI_ASAL');
            $Pegawai['K_KOTA_ASAL'] = $this->CI->input->post('K_KOTA_ASAL');
            $Pegawai['ALAMAT_ASAL'] = $this->CI->input->post('ALAMAT_ASAL');
            $Pegawai['Foto'] = $this->GetPhotoByID($Pegawai['K_PEGAWAI']);
            $Pegawai['FILEKTP_BACKUP'] = $this->CI->input->post('FILEKTP_BACKUP');
            $Pegawai['FILEKARPEG_BACKUP'] = $this->CI->input->post('FILEKARPEG_BACKUP');
			$Pegawai['NIPLAMA'] = $this->CI->input->post('NIPLAMA');
            $Pegawai['ISTASPEN'] = $this->CI->input->post('ISTASPEN');
            $Pegawai['INSTASIASAL'] = $this->CI->input->post('INSTASIASAL');
            $Pegawai['NPWP'] = $this->CI->input->post('NPWP');
			
            // Add Parameter Information
            $Pegawai['GAJI'] = $this->CI->input->post('GAJI');
            $Pegawai['MASA_KERJA_KESELURUHAN'] = $this->CI->input->post('MASA_KERJA_KESELURUHAN');
            $Pegawai['MASA_KERJA_GOLONGAN'] = $this->CI->input->post('MASA_KERJA_GOLONGAN');
            
            // Validation Data
            $Pegawai['KARPEG'] = ($this->IsPns($Pegawai)) ? $Pegawai['KARPEG'] : '';
            $Pegawai['TGL_LAHIR'] = (empty($Pegawai['TGL_LAHIR'])) ? '' : ChangeFormatDate($Pegawai['TGL_LAHIR']);
            $Pegawai['TMT_CPNS'] = (empty($Pegawai['TMT_CPNS'])) ? 'x' : ChangeFormatDate($Pegawai['TMT_CPNS']);
            $Pegawai['TMT_PNS'] = (empty($Pegawai['TMT_PNS'])) ? 'x' : ChangeFormatDate($Pegawai['TMT_PNS']);
            $Pegawai['NIRA'] = (empty($Pegawai['NIRA'])) ? 'x' : $Pegawai['NIRA'];
            $CheckPegawaiNip = preg_replace('/[^0-9]+/i', '', $Pegawai['K_PEGAWAI']);
            $CheckNoTelepon = preg_replace('/[^0-9]+/i', '', $Pegawai['TLP_RMH']);
            $CheckTahunMasuk = preg_replace('/[^0-9]+/i', '', $Pegawai['THN_MASUK']);
            
            $Pegawai['K_STATUS_DOSEN'] = ($Pegawai['K_JENIS_KERJA'] != '01') ? '99' : $Pegawai['K_STATUS_DOSEN'];
            $Pegawai['NIDN'] = ($Pegawai['K_JENIS_KERJA'] != '01') ? 'x' : $Pegawai['NIDN'];
            
            if ($Pegawai['K_PEGAWAI'] != $CheckPegawaiNip) {
                $Pegawai['Error'] = '00003';
                $Pegawai['Message'] = 'Maaf, NIP hanya berisi angka.';
            } else if (empty($Pegawai['K_PEGAWAI']) || empty($Pegawai['NAMA']) || empty($Pegawai['TMP_LAHIR']) || empty($Pegawai['TGL_LAHIR'])) {
                $Pegawai['Error'] = '00003';
                $Pegawai['Message'] = 'Maaf, tolong isikan semua data.';
            } else if ($this->CI->ldb2->InvalidFileUpload == '1' || (isset($_FILES['Image']) && $_FILES['Image']['name'] && GetExtention($_FILES['Image']['name']) == 'pdf')) {
                $Pegawai['Error'] = '00001';
                $Pegawai['Message'] = 'Hanya file berekstensi jpg yang bisa diupload ke server.';
            } else if ($Pegawai['TLP_RMH'] != $CheckNoTelepon) {
                $Pegawai['Error'] = '00003';
                $Pegawai['Message'] = 'Maaf, No Telepon hanya boleh angka.';
            } else if ($Pegawai['THN_MASUK'] != $CheckTahunMasuk || strlen($Pegawai['THN_MASUK']) != 4) {
                $Pegawai['Error'] = '00003';
                $Pegawai['Message'] = 'Maaf, Tahun masuk tidak sesuai.';
            } else if ($Pegawai['EMAIL'] != '' && ! IsValidEmail($Pegawai['EMAIL'])) {
                $Pegawai['Error'] = '00003';
                $Pegawai['Message'] = 'Maaf, alamat email tidak berlaku.';
            } else if (empty($Pegawai['THN_MASUK'])) {
                $Pegawai['Error'] = '00003';
                $Pegawai['Message'] = 'Maaf, tolong isikan Tahun Masuk.';
            } else {
                $Pegawai = $this->Update($Pegawai);
            }
            
            if (isset($Pegawai['IsNewPegawai']) && $Pegawai['IsNewPegawai'] == '1' && $Pegawai['Error'] == '00000') {
                header('Location: '.HOST.'/index.php/Pegawai/Tambah/'.ConvertLink($Pegawai['K_PEGAWAI']).'/New');
                exit;
            }
        }
        
        return $Pegawai;
    }
    
    function Update($Pegawai) {
        $Pegawai['Error'] = '';
        $Pegawai['Message'] = '';
		$Pegawai['K_NEGARA_ASAL'] = (empty($Pegawai['K_NEGARA_ASAL'])) ? '360' : $Pegawai['K_NEGARA_ASAL'];
        
		// Foto
        if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
            $File = array(
                'Path' => SFTP_PATH.'/images/Foto/',
                'Name' => md5($Pegawai['K_PEGAWAI'] . SALT),
                'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
            );
            $ResultUpdate = Upload($File);
            $Pegawai['Foto'] = $this->GetPhotoByID($Pegawai['K_PEGAWAI']);
        }
        
		// Karpeg
		$FileKarpeg = 'FILEKARPEG';
		if (isset($_FILES) && isset($_FILES[$FileKarpeg]) && isset($_FILES[$FileKarpeg]['name']) && !empty($_FILES[$FileKarpeg]['name'])) {
			$ResultQuery = array();
			$File = array(
				'Path' => SFTP_PATH.'/images/Foto/',
				'Name' => date("Ymd_His_") . rand(1000,9999),
				'WithCreateDir' => 1,
				'Extention' => strtolower(GetExtention($_FILES[$FileKarpeg]['name']))
			);
			$ResultUpload = Upload($File, $FileKarpeg);
			if (isset($ResultUpload['Message']) && empty($ResultUpload['Message'])) {
				$Pegawai[$FileKarpeg] = $ResultUpload['FileName'];
			}
        }
		
		// KTP
		$FileKtp = 'FILEKTP';
		if (isset($_FILES) && isset($_FILES[$FileKtp]) && isset($_FILES[$FileKtp]['name']) && !empty($_FILES[$FileKtp]['name'])) {
			$ResultQuery = array();
			$File = array(
				'Path' => SFTP_PATH.'/images/Foto/',
				'Name' => date("Ymd_His_") . rand(1000,9999),
				'WithCreateDir' => 1,
				'Extention' => strtolower(GetExtention($_FILES[$FileKtp]['name']))
			);
			$ResultUpload = Upload($File, $FileKtp);
			if (isset($ResultUpload['Message']) && empty($ResultUpload['Message'])) {
				$Pegawai[$FileKtp] = $ResultUpload['FileName'];
			}
        }
        
		$ParamPhoto = array('ReturnArray' => true, 'WithRandom' => false);
		$Photo = $this->GetPhotoByID($Pegawai['K_PEGAWAI'], $ParamPhoto);
		$Pegawai['FILEKTP'] = (empty($Pegawai['FILEKTP'])) ? $Pegawai['FILEKTP_BACKUP'] : $Pegawai['FILEKTP'];
		$Pegawai['FILEKARPEG'] = (empty($Pegawai['FILEKARPEG'])) ? $Pegawai['FILEKARPEG_BACKUP'] : $Pegawai['FILEKARPEG'];
		
        if ($Pegawai['IsNewPegawai'] == '1') {
            $RawQuery = "
                CALL DB2ADMIN.INSUPDPEGAWAI(
                    '".$Pegawai['K_PEGAWAI']."', '".$Pegawai['NAMA']."', '".$Pegawai['TMP_LAHIR']."', '".$Pegawai['TGL_LAHIR']."',
                    '".$Pegawai['JENIS_KELAMIN']."', '".$Pegawai['GLR_DPN']."', '".$Pegawai['GLR_BLKG']."', '".$Pegawai['ALAMAT']."',
                    '".$Pegawai['K_AGAMA']."', '".$Pegawai['K_STATUS_KAWIN']."', '".$Pegawai['TLP_RMH']."', '".$Pegawai['NO_HP']."',
                    '".$Pegawai['EMAIL']."', '".$Pegawai['K_STATUS_KERJA']."', '".$Pegawai['K_JENIS_KERJA']."', '".$Pegawai['KARPEG']."',
                    '".$this->CI->session->UserLogin['UserID']."', '".$Pegawai['THN_MASUK']."',
                    '".$Pegawai['SK_CPNS']."', '".$Pegawai['TMT_CPNS']."', '".$Pegawai['SK_PNS']."', '".$Pegawai['TMT_PNS']."',
                    '".$Pegawai['NIK']."', '".$Pegawai['K_STATUS_DOSEN']."', '".$Pegawai['NIDN']."', '".$Pegawai['NIRA']."',
                    '".$Pegawai['KTP']."', '".$Pegawai['NO_ODNER']."', '".$Pegawai['K_KOTA_ASAL']."', '".$Pegawai['K_PROPINSI_ASAL']."',
					'".$Pegawai['K_NEGARA_ASAL']."', '".$Pegawai['ALAMAT_ASAL']."', '".$Photo['FileName']."', '".$Pegawai['BIDANG_ILMU']."',
					'".$Pegawai['FILEKARPEG']."', '".$Pegawai['FILEKTP']."', '".$Pegawai['NIPLAMA']."', '".$Pegawai['ISTASPEN']."',
					'".$Pegawai['INSTASIASAL']."', '".$Pegawai['NPWP']."'
				)";
			
			WriteLog($Pegawai['K_PEGAWAI'], $RawQuery);
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            
            if ($Row = db2_fetch_assoc($Query)) {
                $Pegawai['Error'] = $Row['ERROR'];
            }
            
            if ($Pegawai['Error'] == '00000') {
                $Pegawai['Message'] = 'Data pegawai berhasil disimpan.';
            } else if ($Pegawai['Error'] == '00001') {
                $Pegawai['K_PEGAWAI'] = '';
                $Pegawai['Message'] = 'Maaf, NIP '.$_POST['K_PEGAWAI'].' sudah terpakai.';
            } else if ($Pegawai['Error'] == '00002') {
                $Pegawai['KARPEG'] = '';
                $Pegawai['Message'] = 'Maaf, Karpeg '.$_POST['KARPEG'].' sudah terpakai.';
            } else {
				$Pegawai['Message'] = 'Error.';
            }
        } else {
            $RawQuery = "
                CALL DB2ADMIN.INSUPDPEGAWAI(
                    '".$Pegawai['K_PEGAWAI']."', '".$Pegawai['NAMA']."', '".$Pegawai['TMP_LAHIR']."', '".$Pegawai['TGL_LAHIR']."',
                    '".$Pegawai['JENIS_KELAMIN']."', '".$Pegawai['GLR_DPN']."', '".$Pegawai['GLR_BLKG']."', '".$Pegawai['ALAMAT']."',
                    '".$Pegawai['K_AGAMA']."', '".$Pegawai['K_STATUS_KAWIN']."', '".$Pegawai['TLP_RMH']."', '".$Pegawai['NO_HP']."',
                    '".$Pegawai['EMAIL']."', '".$Pegawai['K_STATUS_KERJA']."', '".$Pegawai['K_JENIS_KERJA']."', '".$Pegawai['KARPEG']."',
                    '".$this->CI->session->UserLogin['UserID']."', '".$Pegawai['THN_MASUK']."',
                    '".$Pegawai['SK_CPNS']."', '".$Pegawai['TMT_CPNS']."', '".$Pegawai['SK_PNS']."', '".$Pegawai['TMT_PNS']."',
                    '".$Pegawai['NIK']."', '".$Pegawai['K_STATUS_DOSEN']."', '".$Pegawai['NIDN']."', '".$Pegawai['NIRA']."',
                    '".$Pegawai['KTP']."', '".$Pegawai['NO_ODNER']."', '".$Pegawai['K_KOTA_ASAL']."', '".$Pegawai['K_PROPINSI_ASAL']."',
					'".$Pegawai['K_NEGARA_ASAL']."', '".$Pegawai['ALAMAT_ASAL']."', '".$Photo['FileName']."', '".$Pegawai['BIDANG_ILMU']."',
					'".$Pegawai['FILEKARPEG']."', '".$Pegawai['FILEKTP']."', '".$Pegawai['NIPLAMA']."', '".$Pegawai['ISTASPEN']."',
					'".$Pegawai['INSTASIASAL']."', '".$Pegawai['NPWP']."'
				)";
			WriteLog($Pegawai['K_PEGAWAI'], $RawQuery);
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
                $Pegawai['Error'] = $Row['ERROR'];
            }
            
            if ($Pegawai['Error'] == '00000') {
                $Pegawai['Message'] = 'Data pegawai berhasil diperbaharui.';
            } else if ($Pegawai['Error'] == '00001') {
                $Pegawai['KARPEG'] = '';
                $Pegawai['Message'] = 'Maaf, Karpeg '.$_POST['KARPEG'].' sudah terpakai.';
            } else {
				$Pegawai['Message'] = 'Error.';
			}
        }
        
        return $Pegawai;
    }
    
    function Delete() {
        $DeletePegawai = $this->CI->input->post('DeletePegawai');
        if (!empty($DeletePegawai)) {
            $RawQuery = "CALL DB2ADMIN.DELPEGAWAI('".$DeletePegawai."')";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query);
            if ($Row = db2_fetch_assoc($Query)) {
            }
        }
    }
    
    function GetPhotoByID($K_PEGAWAI, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/Foto/',
            'Link' => HOST.'/images/Foto/',
            'Name' => md5($K_PEGAWAI . SALT)
        );
        
        $FileLink = $FileNameExtention = '';
        $FileName = $File['Path'].$File['Name'];
        
		// Cheking File Extention
        if (file_exists($FileName.'.jpg')) {
            $FileNameExtention = $File['Name'].'.jpg';
        } else if (file_exists($FileName.'.jpeg')) {
            $FileNameExtention = $File['Name'].'.jpeg';
        } else if (file_exists($FileName.'.pdf')) {
            $FileNameExtention = $File['Name'].'.pdf';
        }
		
		// With Random Parameter
		if (!empty($FileNameExtention) && $Param['WithRandom']) {
			$FileNameExtention = $FileNameExtention.'?'.rand(1000,9999);
		}
		
		if (!empty($FileNameExtention)) {
			$FileLink = $File['Link'].$FileNameExtention;
		}
        
		if (! $Param['ReturnArray']) {
			return $FileLink;
		}
		
		$Array = array(
			'FileLink' => $FileLink,
			'FileName' => $FileNameExtention
		);
		return $Array;
    }
    
    function ExportSearch($objPHPExcel) {
        $Array['ArrayPegawai'] = $this->GetArrayPegawai($_SESSION['Export']['Excel']);
        $ArrayPegawai = $Array['ArrayPegawai']['Pegawai'];
        
        // Add Header on Excel Document
        array_unshift($ArrayPegawai, array(
            'K_PEGAWAI' => 'NIP',
            'NAMA' => 'Nama Pegawai',
            'UNIT_KERJA' => 'Unit Kerja',
            'FAKULTAS' => 'Fakultas',
            'JENJANG' => 'Jenjang',
            'JURUSAN' => 'Jurusan',
            'PRODI' => 'Prodi',
            'GOLONGAN' => 'Golongan'
        ));
        
        $Row = 1;
        foreach ($ArrayPegawai as $Key => $Element) {
            $Strip = ($Key == 0) ? '' : "'";
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$Row, $Strip.$Element['K_PEGAWAI']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$Row, $Element['NAMA']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$Row, $Element['UNIT_KERJA']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$Row, $Element['FAKULTAS']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$Row, $Element['JENJANG']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$Row, $Element['JURUSAN']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$Row, $Element['PRODI']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$Row, $Element['GOLONGAN']);
            $Row++;
        }
        
        $objPHPExcel->getActiveSheet()->setTitle('Daftar Pegawai');
        
        return $objPHPExcel;
    }
}
?>