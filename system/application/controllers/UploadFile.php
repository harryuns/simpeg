<?php

class UploadFile extends Controller {
    function UploadFile() {
        parent::Controller();
    }
    
    function index() {
		$Upload = (isset($_POST['Upload'])) ? $_POST['Upload'] : '';
		$ArrayParam = $this->GetArrayParam(func_get_args());
		
		// Do Upload
		$ResultUpload = (!empty($Upload) && count($_FILES) > 0) ? $this->UploadFileSubmission($ArrayParam) : array();
		
		// Get Array File
		$ArrayData['ArrayFile'] = $this->GetArrayFile($ArrayParam);
		$ArrayData['ResultUpload'] = $ResultUpload;
		$ArrayData['ArrayParam'] = $ArrayParam;
		
        $this->load->view('upload_file', $ArrayData);
    }
	
	function GetArrayParam($Param) {
		$ParamResult['FormName'] = (isset($Param[0]) && !empty($Param[0])) ? $Param[0] : '';
		
		if ($ParamResult['FormName'] == 'PegawaiAktif') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['K_AKTIF'] = RestoreLink($Param[2]);
			$ParamResult['NO_SK'] = RestoreLink($Param[3]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatDiklat') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SERTIFIKAT'] = RestoreLink($Param[2]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatHonorer') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SK'] = RestoreLink($Param[2]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatJabatanStruktural') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SK'] = RestoreLink($Param[2]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatJabatanFungsional') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SK'] = RestoreLink($Param[2]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatPangkat') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SK'] = RestoreLink($Param[2]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatSertifikasi') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SERTIFIKAT'] = RestoreLink($Param[2]);
			$ParamResult['NO_PESERTA'] = RestoreLink($Param[3]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatPenghargaan') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SK'] = RestoreLink($Param[2]);
			$ParamResult['NO_URUT'] = 'x';
		} else if ($ParamResult['FormName'] == 'RiwayatPendidikan') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['K_JENJANG'] = RestoreLink($Param[2]);
			$ParamResult['NO_IJAZAH'] = RestoreLink($Param[3]);
			$ParamResult['NO_URUT'] = 'x';
			$ParamResult['IS_IJAZAH'] = (isset($_POST['IS_IJAZAH'])) ? $_POST['IS_IJAZAH'] : 0;
		} else if ($ParamResult['FormName'] == 'RiwayatHomeBase') {
			$ParamResult['ID_RIWAYAT_HOMEBASE'] = RestoreLink($Param[1]);
		} else if ($ParamResult['FormName'] == 'KenaikanGaji') {
			$ParamResult['K_PEGAWAI'] = RestoreLink($Param[1]);
			$ParamResult['NO_SK'] = RestoreLink($Param[2]);
			$ParamResult['NO_URUT'] = 'x';
		}
		
		return $ParamResult;
	}
	
	function GetArrayFile($Param) {
		$ArrayFile = array();
		
		if ($Param['FormName'] == 'PegawaiAktif') {
			$ArrayFile = $this->lpegawai_aktif->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatDiklat') {
			$ArrayFile = $this->lriwayat_diklat->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatHonorer') {
			$ArrayFile = $this->lriwayat_honorer->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatJabatanStruktural') {
			$ArrayFile = $this->lriwayat_jabatan_struktural->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatJabatanFungsional') {
			$ArrayFile = $this->lriwayat_jabatan_fungsional->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatPangkat') {
			$ArrayFile = $this->lriwayat_pangkat->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatSertifikasi') {
			$ArrayFile = $this->lriwayat_sertifikasi->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatPenghargaan') {
			$ArrayFile = $this->lriwayat_penghargaan->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatPendidikan') {
			$ArrayFile = $this->lriwayat_pendidikan->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'RiwayatHomeBase') {
			$ArrayFile = $this->lriwayat_home_base->GetArrayFile($Param);
		} else if ($Param['FormName'] == 'KenaikanGaji') {
			$ArrayFile = $this->lkenaikan_gaji->GetArrayFile($Param);
		}
		
		return $ArrayFile;
	}
	
	function UploadFileSubmission($Param) {
		if ($Param['FormName'] == 'PegawaiAktif') {
			$ClassName = 'lpegawai_aktif';
			$PathFile = SFTP_PATH.'/images/PegawaiActive/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['K_AKTIF'] . $Param['NO_SK'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatDiklat') {
			$ClassName = 'lriwayat_diklat';
			$PathFile = SFTP_PATH.'/images/CertificateDiklat/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['NO_SERTIFIKAT'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatHonorer') {
			$ClassName = 'lriwayat_honorer';
			$PathFile = SFTP_PATH.'/images/RiwayatHonorer/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['NO_SK'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatJabatanStruktural') {
			$ClassName = 'lriwayat_jabatan_struktural';
			$PathFile = SFTP_PATH.'/images/CertificateStruktural/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['NO_SK'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatJabatanFungsional') {
			$ClassName = 'lriwayat_jabatan_fungsional';
			$PathFile = SFTP_PATH.'/images/CertificateFungsional/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['NO_SK'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatPangkat') {
			$ClassName = 'lriwayat_pangkat';
			$PathFile = SFTP_PATH.'/images/CertificatePangkat/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['NO_SK'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatSertifikasi') {
			$ClassName = 'lriwayat_sertifikasi';
			$PathFile = SFTP_PATH.'/images/CertificateCertification/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['NO_SERTIFIKAT'] . $Param['NO_PESERTA'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatPenghargaan') {
			$ClassName = 'lriwayat_penghargaan';
			$PathFile = SFTP_PATH.'/images/CertificateAppreciation/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['NO_SK'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatPendidikan') {
			$ClassName = 'lriwayat_pendidikan';
			$PathFile = SFTP_PATH.'/images/CertificateEducation/';
			$NameFile = md5($Param['K_PEGAWAI'] . $Param['K_JENJANG'] . $Param['NO_IJAZAH'] . SALT);
		} else if ($Param['FormName'] == 'RiwayatHomeBase') {
			$ClassName = 'lriwayat_home_base';
			$PathFile = SFTP_PATH.'/images/RiwayatHomeBase/';
		} else if ($Param['FormName'] == 'KenaikanGaji') {
			$ClassName = 'lkenaikan_gaji';
			$PathFile = SFTP_PATH.'/images/SalaryIncrease/';
		}
		
		$ResultQuery = array();
		$File = array(
			'Path' => $PathFile,
			'Name' => date("Ymd_His_") . rand(1000,9999),
			'WithCreateDir' => 1,
			'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
		);
		$ResultUpload = Upload($File);
		if (isset($ResultUpload['Message']) && empty($ResultUpload['Message'])) {
			$Param['USERID'] = $this->llogin->GetUserID();
			$Param['FILENAME'] = $ResultUpload['FileName'];
			$ResultQuery = $this->$ClassName->UpdateFile($Param);
		}
		
		return $ResultQuery;
	}
	
	function Delete() {
		$Param = $_POST;
		$Param['FormName'] = (isset($Param['FormName'])) ? $Param['FormName'] : '';
		
		if ($Param['FormName'] == 'PegawaiAktif') {
			$Result = $this->lpegawai_aktif->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatDiklat') {
			$Result = $this->lriwayat_diklat->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatHonorer') {
			$Result = $this->lriwayat_honorer->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatJabatanStruktural') {
			$Result = $this->lriwayat_jabatan_struktural->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatJabatanFungsional') {
			$Result = $this->lriwayat_jabatan_fungsional->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatPangkat') {
			$Result = $this->lriwayat_pangkat->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatSertifikasi') {
			$Result = $this->lriwayat_sertifikasi->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatPenghargaan') {
			$Result = $this->lriwayat_penghargaan->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatPendidikan') {
			$Result = $this->lriwayat_pendidikan->DeleteFile($Param);
		} else if ($Param['FormName'] == 'RiwayatHomeBase') {
			$Result = $this->lriwayat_home_base->DeleteFile($Param);
		} else if ($Param['FormName'] == 'KenaikanGaji') {
			$Result = $this->lkenaikan_gaji->DeleteFile($Param);
		}
		
		echo json_encode($Result);
	}
}