<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Penghargaan {
    var $CI = null;
    
    function LRiwayat_Penghargaan() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/CertificateAppreciation/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatPenghargaan',
            'PageTitle' => 'Riwayat Penghargaan'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $Path = 'RiwayatPenghargaan') {
        $Array = array();
        
        $Counter = 0;
        $RawQuery = "CALL DB2ADMIN.GETRWYTPENGHRGBYID('".$K_PEGAWAI."', '')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Counter] = $Row;
            $Array[$Counter]['LinkEdit'] = HOST.'/index.php/'.$Path.'/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
            $Array[$Counter]['LinkDelete'] = HOST.'/index.php/'.$Path.'/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
            $Counter++;
        }
        
        return $Array;
    }
    
    function SimpegUpdate($K_PEGAWAI, $NO_SK) {
        $Data = $this->GetExist($K_PEGAWAI, $NO_SK);
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
            $Data['TGL_SK'] = $this->CI->input->post('TGL_SK');
            $Data['K_ASAL_SK'] = $this->CI->input->post('K_ASAL_SK');
            $Data['JENIS_PENGHARGAAN'] = $this->CI->input->post('JENIS_PENGHARGAAN');
            $Data['NAMA_PENGHARGAAN'] = $this->CI->input->post('NAMA_PENGHARGAAN');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['PEMBERI'] = $this->CI->input->post('PEMBERI');
            $Data['JABATAN_PEMBERI'] = $this->CI->input->post('JABATAN_PEMBERI');
            $Data['Error'] = '';
            
            $Data['TGL_SK'] = (empty($Data['TGL_SK'])) ? '' : ChangeFormatDate($Data['TGL_SK']);
            
            // Validation
            $Validation = 'pass';
            if (empty($Data['NO_SK'])) {
                $Validation = 'false';
                $Data['NO_SK'] = '';
                $Data['Error'] = '00001';
                $Data['Message'] = 'No SK belum di isi.';
            }
            
            if ($Validation == 'false') {
                $Data['ShowGrid'] = '0';
                $Data['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateAppreciation/',
                    'Name' => md5($Data['K_PEGAWAI'] . $Data['NO_SK'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $Data['Certificate'] = $this->GetCertificateByID($Data['K_PEGAWAI'], $Data['NO_SK']);
            }
            
			$ParamCertificate = array('ReturnArray' => true, 'WithRandom' => false);
			$Certificate = $this->GetCertificateByID($Data['K_PEGAWAI'], $Data['NO_SK'], $ParamCertificate);
			
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRWYTPENGHRG(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['JENIS_PENGHARGAAN']."', '".$Data['NAMA_PENGHARGAAN']."', 
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$Certificate['FileName']."',
						'".$Data['PEMBERI']."', '".$Data['JABATAN_PEMBERI']."'
					)
				";
				
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
				$Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRWYTPENGHRG(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['JENIS_PENGHARGAAN']."', '".$Data['NAMA_PENGHARGAAN']."', 
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$Certificate['FileName']."',
						'".$Data['PEMBERI']."', '".$Data['JABATAN_PEMBERI']."'
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
                        $Data['Error'] = '00001';
                        $Data['ShowGrid'] = '0';
                        $Data['Message'] = 'No SK sudah terpakai.';
                        $Data['ParameterUpdate'] = $ParameterUpdate;
                    } else {
                        $Data['Error'] = '00001';
                        $Data['ShowGrid'] = '0';
                        $Data['Message'] = 'Error.';
                        $Data['ParameterUpdate'] = $ParameterUpdate;
                        
                        WriteLogErrorQuery($RawQuery.' - '.$QueryMessage);
                    }
                }
            }
        }
        
        return $Data;
    }
    
    function GetExist($K_PEGAWAI, $NO_SK) {
        $Data = array(
            'K_PEGAWAI' => '',
            'NO_SK' => '',
            'TGL_SK' => '',
            'K_ASAL_SK' => '',
            'JENIS_PENGHARGAAN' => '',
            'NAMA_PENGHARGAAN' => '',
            'PEMBERI' => '',
            'JABATAN_PEMBERI' => '',
            'KETERANGAN' => ''
        );
        
        if (!empty($K_PEGAWAI) && !empty($NO_SK)) {
            $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_PENGHARGAAN WHERE K_PEGAWAI = '$K_PEGAWAI' AND NO_SK = '$NO_SK'";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
                $Data = $Row;
            }
        }
        
        return $Data;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SK) {
        $Data = $this->GetExist('', '');
        
        $RawQuery = "CALL DB2ADMIN.DELRWYTPENGHRG('".$K_PEGAWAI."', '".$NO_SK."')";
		WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Error'] = '';
        $Data['Message'] = 'Data Riwayat Penghargaan berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
    
    function GetCertificateByID($K_PEGAWAI, $NO_SK, $Param = array()) {
        if (empty($NO_SK)) {
            return '';
        }
		
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificateAppreciation/',
            'Link' => HOST.'/images/CertificateAppreciation/',
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
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATPENGHARGAANFILE(
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATPENGHARGAANFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."')";
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
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATPENGHARGAANFILE(
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