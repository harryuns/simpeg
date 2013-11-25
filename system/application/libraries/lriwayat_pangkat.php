<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Pangkat {
    var $CI = null;
    
    function LRiwayat_Pangkat() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/CertificatePangkat/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatPangkat',
            'PageTitle' => 'Riwayat Pangkat'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI) {
        $ArrayRiwayatPangkat = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATPGKTBYID('".$K_PEGAWAI."', 'x')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $ArrayRiwayatPangkat[$Row['NO_SK']] = $Row;
            $ArrayRiwayatPangkat[$Row['NO_SK']]['LinkEdit'] = HOST.'/index.php/RiwayatPangkat/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
            $ArrayRiwayatPangkat[$Row['NO_SK']]['LinkDelete'] = HOST.'/index.php/RiwayatPangkat/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
        }
        
        return $ArrayRiwayatPangkat;
    }
    
    function SimpegUpdate($K_PEGAWAI, $NO_SK) {
        $Data = $this->GetExistRiwayatPangkat($K_PEGAWAI, $NO_SK);
        $Data['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($NO_SK)) ? 'update' : 'insert';
        $Data['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $Data['Certificate'] = $this->GetCertificateByID($K_PEGAWAI, $NO_SK);
        $Data['ShowGrid'] = (!empty($Tambah) || $Data['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $Data['K_PEGAWAI'] = $K_PEGAWAI;
            $Data['NO_SK'] = $this->CI->input->post('NO_SK');
            $Data['K_ASAL_SK'] = $this->CI->input->post('K_ASAL_SK');
            $Data['TGL_SK'] = $this->CI->input->post('TGL_SK');
            $Data['K_PENJELASAN'] = $this->CI->input->post('K_PENJELASAN');
            $Data['TMT'] = $this->CI->input->post('TMT');
            $Data['K_GOLONGAN'] = $this->CI->input->post('K_GOLONGAN');
            $Data['GAJI_POKOK'] = $this->CI->input->post('GAJI_POKOK');
            $Data['PENANDATANGAN_SK'] = $this->CI->input->post('PENANDATANGAN_SK');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['TAHUN_JABATAN_TAMBAHAN'] = $this->CI->input->post('TAHUN_JABATAN_TAMBAHAN');
            $Data['BULAN_JABATAN_TAMBAHAN'] = $this->CI->input->post('BULAN_JABATAN_TAMBAHAN');
            $Data['Error'] = '';
            
            $Data['TGL_SK'] = (empty($Data['TGL_SK'])) ? '' : ChangeFormatDate($Data['TGL_SK']);
            $Data['TMT'] = (empty($Data['TMT'])) ? '' : ChangeFormatDate($Data['TMT']);
            $Data['GAJI_POKOK'] = (empty($Data['GAJI_POKOK'])) ? 0 : $Data['GAJI_POKOK'];
            
            $NO_SK = $this->GetExistRiwayatPangkat($Data['K_PEGAWAI'], $Data['NO_SK']);
            
            // Validation
            $Validation = 'pass';
            if (empty($Data['NO_SK'])) {
                $Validation = 'false';
                $Data['NO_SK'] = '';
                $Data['Error'] = '00001';
                $Data['Message'] = 'No SK belum di isi.';
            } else if (empty($Data['TGL_SK'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Tanggal SK belum di isi.';
            } else if (empty($Data['TMT'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Tanggal TMT belum di isi.';
            } else if ($this->CI->ldb2->InvalidFileUpload == '1') {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Hanya file berekstensi jpg yang bisa diupload ke server.';
            }
            
            if ($Validation == 'false') {
                $Data['ShowGrid'] = '0';
                $Data['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificatePangkat/',
                    'Name' => md5($K_PEGAWAI . $Data['NO_SK'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $Data['Certificate'] = $this->GetCertificateByID($K_PEGAWAI, $Data['NO_SK']);
            }
            
			$ParamCertificate = array('ReturnArray' => true, 'WithRandom' => false);
			$Certificate = $this->GetCertificateByID($Data['K_PEGAWAI'], $Data['NO_SK'], $ParamCertificate);
			
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSRIWAYATPGKT(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['K_ASAL_SK']."',
                        '".$Data['TGL_SK']."', '".$Data['K_PENJELASAN']."', '".$Data['TMT']."', 
                        '".$Data['K_GOLONGAN']."', '".$Data['GAJI_POKOK']."', '".$Data['KETERANGAN']."',
                        '".$this->CI->session->UserLogin['UserID']."',  '".$Data['PENANDATANGAN_SK']."',
						'".$Certificate['FileName']."', '".$Data['TAHUN_JABATAN_TAMBAHAN']."', '".$Data['BULAN_JABATAN_TAMBAHAN']."'
					)
				";
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.UPDRIWAYATPGKT(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['K_ASAL_SK']."',
                        '".$Data['TGL_SK']."', '".$Data['K_PENJELASAN']."', '".$Data['TMT']."', 
                        '".$Data['K_GOLONGAN']."', '".$Data['GAJI_POKOK']."', '".$Data['KETERANGAN']."',
                        '".$this->CI->session->UserLogin['UserID']."',  '".$Data['PENANDATANGAN_SK']."',
						'".$Certificate['FileName']."', '".$Data['TAHUN_JABATAN_TAMBAHAN']."', '".$Data['BULAN_JABATAN_TAMBAHAN']."'
					)
				";
                
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil diperbaharui.';
            }
            
            if (!empty($Message)) {
                if ($Row = db2_fetch_assoc($Query)) {
                    $QueryMessage = $Row['ERROR'];
                    
                    if ($QueryMessage == '00000') {
                        $Data['NO_SK'] = '';
                        $Data['Message'] = $Message;
                    } else if ($QueryMessage == '00001') {
                        $Data['NO_SK'] = '';
                        $Data['ShowGrid'] = '0';
                        $Data['Message'] = 'No SK sudah terpakai.';
                        $Data['ParameterUpdate'] = $ParameterUpdate;
                    }
                }
            }
        }
        
        return $Data;
    }
    
    function GetExistRiwayatPangkat($K_PEGAWAI, $NO_SK) {
        $RiwayatPangkat = array(
            'K_PEGAWAI' => '',
            'NO_SK' => '',
            'K_ASAL_SK' => '',
            'TGL_SK' => '',
            'K_PENJELASAN' => '',
            'TMT' => '',
            'K_GOLONGAN' => '',
            'GAJI_POKOK' => '',
            'PENANDATANGAN_SK' => '',
            'KETERANGAN' => '',
            'TAHUN_JABATAN_TAMBAHAN' => '',
            'BULAN_JABATAN_TAMBAHAN' => ''
        );
        
		$RawQuery = "CALL DB2ADMIN.GETRIWAYATPGKTBYID('".$K_PEGAWAI."', '".$NO_SK."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $RiwayatPangkat = $Row;
        }
        
        return $RiwayatPangkat;
    }
    
    function IsDuplicateNoSk($NO_SK) {
        $IsDuplicateNoSk = false;
        
        $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_PANGKAT WHERE NO_SK = '$NO_SK'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $IsDuplicateNoSk = true;
        }
        
        return $IsDuplicateNoSk;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SK) {
        $RiwayatPangkat = array();
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATPGKT('".$K_PEGAWAI."', '".$NO_SK."')";
        WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $RiwayatPangkat['Error'] = '';
        $RiwayatPangkat['Message'] = 'Data Riwayat Pangkat berhasil dihapus.';
        $RiwayatPangkat['ParameterUpdate'] = 'insert';
        $RiwayatPangkat['ShowGrid'] = '1';
        
        return $RiwayatPangkat;
    }
    
    function GetCertificateByID($K_PEGAWAI, $NO_SK, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificatePangkat/',
            'Link' => HOST.'/images/CertificatePangkat/',
            'Name' => md5($K_PEGAWAI . $NO_SK . SALT)
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
		$Param['NO_URUT'] = ($Param['NO_URUT'] == 'x') ? '0' : $Param['NO_URUT'];
		
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATPANGKATFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."', '".$Param['FILENAME']."',
			'".$Param['USERID']."'
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATPANGKATFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."')";
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
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATPANGKATFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."'
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