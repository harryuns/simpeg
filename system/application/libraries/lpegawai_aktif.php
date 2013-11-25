<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPegawai_Aktif {
    var $CI = null;
    
    function LPegawai_Aktif() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/PegawaiActive/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'PegawaiAktif',
            'PageTitle' => 'Perubahan / Mutasi Pegawai'
        );
        return $Array;
    }
    
    function GetArrayPegawaiActive($K_PEGAWAI) {
        $ArrayPegawaiAktif = array();
        
        $RawQuery = "CALL DB2ADMIN.GETPEGAKTIFBYID('".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        while ($Row = db2_fetch_assoc($Query)) {
            $ArrayPegawaiAktif[$Row['NO_SK']] = $Row;
            $ArrayPegawaiAktif[$Row['NO_SK']]['LinkEdit'] = HOST.'/index.php/PegawaiAktif/Ubah/'.ConvertLink($K_PEGAWAI).'/'.$Row['K_AKTIF'].'/'.ConvertLink($Row['NO_SK']);
            $ArrayPegawaiAktif[$Row['NO_SK']]['LinkDelete'] = HOST.'/index.php/PegawaiAktif/Hapus/'.ConvertLink($K_PEGAWAI).'/'.$Row['K_AKTIF'].'/'.ConvertLink($Row['NO_SK']);
        }
        
        return $ArrayPegawaiAktif;
    }
    
    function SimpegUpdate($K_PEGAWAI, $K_AKTIF, $NO_SK) {
        $PegawaiAktif = $this->GetExistPegawaiActive($K_PEGAWAI, $K_AKTIF, $NO_SK);
        $PegawaiAktif['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($K_AKTIF) && !empty($NO_SK)) ? 'update' : 'insert';
        $PegawaiAktif['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $PegawaiAktif['Certificate'] = $this->GetCertificateByID($K_PEGAWAI, $K_AKTIF, $NO_SK);
        $PegawaiAktif['ShowGrid'] = (!empty($Tambah) || $PegawaiAktif['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $PegawaiAktif['K_PEGAWAI'] = $K_PEGAWAI;
            $PegawaiAktif['K_AKTIF'] = $this->CI->input->post('K_AKTIF');
            $PegawaiAktif['NO_SK'] = $this->CI->input->post('NO_SK');
            $PegawaiAktif['TGL_MULAI'] = $this->CI->input->post('TGL_MULAI');
            $PegawaiAktif['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $PegawaiAktif['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
            $PegawaiAktif['PT'] = $this->CI->input->post('PT');
            $PegawaiAktif['Error'] = '';
            
            $PegawaiAktif['TGL_MULAI'] = (empty($PegawaiAktif['TGL_MULAI'])) ? '' : ChangeFormatDate($PegawaiAktif['TGL_MULAI']);
            
            $NO_SK = $this->GetExistPegawaiActive($PegawaiAktif['K_PEGAWAI'], $PegawaiAktif['K_AKTIF'], $PegawaiAktif['NO_SK']);
            
            // Validation
            $Validation = 'pass';
            if (empty($PegawaiAktif['NO_SK'])) {
                $Validation = 'false';
                $PegawaiAktif['NO_SK'] = '';
                $PegawaiAktif['Error'] = '00001';
                $PegawaiAktif['Message'] = 'No SK belum di isi.';
            } else if ($this->CI->ldb2->InvalidFileUpload == '1') {
                $Validation = 'false';
                $PegawaiAktif['Error'] = '00001';
                $PegawaiAktif['Message'] = 'Hanya file berekstensi jpg yang bisa diupload ke server.';
            }
            
            if ($Validation == 'false') {
                $PegawaiAktif['ShowGrid'] = '0';
                $PegawaiAktif['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/PegawaiActive/',
                    'Name' => md5($PegawaiAktif['K_PEGAWAI'] . $PegawaiAktif['K_AKTIF'] . $PegawaiAktif['NO_SK'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $PegawaiAktif['Certificate'] = $this->GetCertificateByID($PegawaiAktif['K_PEGAWAI'], $PegawaiAktif['K_AKTIF'], $PegawaiAktif['NO_SK']);
            }
            
			$ParamCertificate = array('ReturnArray' => true, 'WithRandom' => false);
			$Certificate = $this->GetCertificateByID($PegawaiAktif['K_PEGAWAI'], $PegawaiAktif['K_AKTIF'], $PegawaiAktif['NO_SK'], $ParamCertificate);
			
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSPEGAKTIF(
                        '".$PegawaiAktif['K_PEGAWAI']."', '".$PegawaiAktif['K_AKTIF']."', '".$PegawaiAktif['NO_SK']."',
                        '".$PegawaiAktif['TGL_MULAI']."', 'x', '".$PegawaiAktif['KETERANGAN']."', 
                        '".$this->CI->session->UserLogin['UserID']."', '".$Certificate['FileName']."',
						'".$PegawaiAktif['K_JENJANG']."', '".$PegawaiAktif['PT']."'
					)";
                
				WriteLog($PegawaiAktif['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.UPDPEGAKTIF(
                        '".$PegawaiAktif['K_PEGAWAI']."', '".$PegawaiAktif['K_AKTIF']."', '".$PegawaiAktif['NO_SK']."',
                        '".$PegawaiAktif['TGL_MULAI']."', 'x', '".$PegawaiAktif['KETERANGAN']."', 
                        '".$this->CI->session->UserLogin['UserID']."', '".$Certificate['FileName']."',
						'".$PegawaiAktif['K_JENJANG']."', '".$PegawaiAktif['PT']."'
					)";
				
				WriteLog($PegawaiAktif['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil diperbaharui.';
            }
            
            if (!empty($Message)) {
                if ($Row = db2_fetch_assoc($Query)) {
                    $QueryMessage = $Row['ERROR'];
                    
                    if ($QueryMessage == '00000') {
                        $PegawaiAktif['NO_SK'] = '';
                        $PegawaiAktif['Message'] = $Message;
                    } else if ($QueryMessage == '00001') {
                        $PegawaiAktif['NO_SK'] = '';
                        $PegawaiAktif['ShowGrid'] = '0';
                        $PegawaiAktif['Message'] = 'No SK sudah terpakai.';
                        $PegawaiAktif['ParameterUpdate'] = $ParameterUpdate;
                        
                        WriteLogErrorQuery($RawQuery.' - '.$QueryMessage);
                    } else {
                        $PegawaiAktif['ShowGrid'] = '0';
                        $PegawaiAktif['Message'] = 'Error.';
                        $PegawaiAktif['ParameterUpdate'] = $ParameterUpdate;
                        
                        WriteLogErrorQuery($RawQuery.' - '.$QueryMessage);
                    }
                }
            }
        }
        
        return $PegawaiAktif;
    }
    
    function SimpegDelete($K_PEGAWAI, $K_AKTIF, $NO_SK) {
        $RawQuery = "CALL DB2ADMIN.DELPEGAKTIF('".$K_PEGAWAI."', '".$K_AKTIF."', '".$NO_SK."')";
		WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $PegawaiAktif['Error'] = 'Data Pegawai Aktif berhasil dihapus.';
        $PegawaiAktif['Message'] = 'Data Pegawai Aktif berhasil dihapus.';
        $PegawaiAktif['ParameterUpdate'] = 'insert';
        $PegawaiAktif['ShowGrid'] = '1';
        
        return $PegawaiAktif;
    }
    
    function GetExistPegawaiActive($K_PEGAWAI, $K_AKTIF, $NO_SK) {
        $NoSk = array(
            'K_PEGAWAI' => '',
            'K_AKTIF' => '',
            'NO_SK' => '',
            'TGL_MULAI' => '',
            'KETERANGAN' => '',
            'K_JENJANG' => '',
            'PT' => ''
        );
        
        $RawQuery = "SELECT * FROM DB2ADMIN.PEGAWAI_AKTIF WHERE K_PEGAWAI = '$K_PEGAWAI' AND NO_SK = '$NO_SK' AND K_AKTIF = '$K_AKTIF'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $NoSk = $Row;
        }
        
        return $NoSk;
    }
    
    function IsDuplicateNoSk($NO_SK) {
        $IsDuplicateNoSk = false;
        
        $RawQuery = "SELECT * FROM DB2ADMIN.PEGAWAI_AKTIF WHERE NO_SK = '$NO_SK'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $IsDuplicateNoSk = true;
        }
        
        return $IsDuplicateNoSk;
    }
    
	function GetCertificateByID($K_PEGAWAI, $K_AKTIF, $NO_SK, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/PegawaiActive/',
            'Link' => HOST.'/images/PegawaiActive/',
            'Name' => md5($K_PEGAWAI . $K_AKTIF . $NO_SK . SALT)
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
	
	/* Region File */
	
	function UpdateFile($Param) {
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.INSUPDPEGAWAIAKTIFFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['K_AKTIF']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."',
			'".$Param['FILENAME']."', '".$Param['USERID']."'
		)";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
			$Result = $Row;
        }
		return $Result;
	}
	
	function GetArrayFile($Param) {
		$ArrayFile = array();
		$Counter = 0;
        $RawQuery = "CALL DB2ADMIN.GETPEGAWAIAKTIFFILE('".$Param['K_PEGAWAI']."', '".$Param['K_AKTIF']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        while (false !== $Row = db2_fetch_assoc($Query)) {
			$Counter++;
			$Row['NameFile'] = $Row['NO_SK'] . ' File ke ' . $Counter;
			$Row['LinkFile'] = HOST . $this->PathName . $Row['FILENAME'];
			$ArrayFile[] = $Row;
        }
		
		return $ArrayFile;
	}
	
	function DeleteFile($Param) {
		$FilePath = PATH . $this->PathName . $Param['FILENAME'];
		@unlink($FilePath);
		
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.DELPEGAWAIAKTIFFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['K_AKTIF']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."'
		)";
		
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
			$Result = $Row;
        }
		
		return $Result;
	}
	
	/* Region End File */
}
?>