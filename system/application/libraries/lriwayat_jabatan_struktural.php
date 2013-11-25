<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Jabatan_Struktural {
    var $CI = null;
    
    function LRiwayat_Jabatan_Struktural() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/CertificateStruktural/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatStruktural',
            'PageTitle' => 'Riwayat Struktural'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $Path = 'RiwayatStruktural') {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRWYTJABSTRBYID('".$K_PEGAWAI."', '')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Row['NO_SK']] = $Row;
            $Array[$Row['NO_SK']]['LinkEdit'] = HOST.'/index.php/'.$Path.'/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
            $Array[$Row['NO_SK']]['LinkDelete'] = HOST.'/index.php/'.$Path.'/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
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
            $Data['TMT'] = $this->CI->input->post('TMT');
            $Data['TMT_SELESAI'] = $this->CI->input->post('TMT_SELESAI');
            $Data['K_UNIT_KERJA'] = $this->CI->input->post('K_UNIT_KERJA');
            $Data['K_JABATAN_STRUKTURAL'] = $this->CI->input->post('K_JABATAN_STRUKTURAL');
            $Data['K_BIDANG_KERJA'] = $this->CI->input->post('K_BIDANG_KERJA');
            $Data['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
            $Data['K_FAKULTAS'] = $this->CI->input->post('K_FAKULTAS');
            $Data['K_JURUSAN'] = $this->CI->input->post('K_JURUSAN');
            $Data['K_PROG_STUDI'] = $this->CI->input->post('K_PROG_STUDI');
            $Data['TUNJANGAN_STRUKTURAL'] = $this->CI->input->post('TUNJANGAN_STRUKTURAL');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['Error'] = '';
            
            $Data['K_BIDANG_KERJA'] = ($Data['K_JABATAN_STRUKTURAL'] != '99' || empty($Data['K_BIDANG_KERJA'])) ? '99' : $Data['K_BIDANG_KERJA'];
            $Data['TGL_SK'] = (empty($Data['TGL_SK'])) ? '' : ChangeFormatDate($Data['TGL_SK']);
            $Data['TMT'] = (empty($Data['TMT'])) ? '' : ChangeFormatDate($Data['TMT']);
            $Data['TMT_SELESAI'] = (empty($Data['TMT_SELESAI'])) ? '' : ChangeFormatDate($Data['TMT_SELESAI']);
            
            $NO_SK = $this->GetExist($Data['K_PEGAWAI'], $Data['NO_SK']);
            
            // Validation
            $Validation = 'pass';
            if (empty($Data['NO_SK'])) {
                $Validation = 'false';
                $Data['NO_SK'] = '';
                $Data['Error'] = '00001';
                $Data['Message'] = 'No SK belum di isi.';
            } else if (empty($Data['K_FAKULTAS'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Data Fakultas belum di isi.';
            } else if (empty($Data['K_JURUSAN'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Data Jurusan belum di isi.';
            } else if (empty($Data['K_PROG_STUDI'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Data Program Studi belum di isi.';
            } else if (empty($Data['TGL_SK'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Tanggal SK belum di isi.';
            } else if (empty($Data['TMT'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'TMT belum di isi.';
            }
            
            if ($Validation == 'false') {
                $Data['ShowGrid'] = '0';
                $Data['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateStruktural/',
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
                    CALL DB2ADMIN.INSRWYTJABSTRUK(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['TMT']."', '".$Data['K_UNIT_KERJA']."', 
                        '".$Data['K_JABATAN_STRUKTURAL']."', '".$Data['K_BIDANG_KERJA']."', '".$Data['K_JENJANG']."', '".$Data['K_FAKULTAS']."', 
                        '".$Data['K_JURUSAN']."', '".$Data['K_PROG_STUDI']."', '".$Data['KETERANGAN']."',
                        '".$this->CI->session->UserLogin['UserID']."', '".$Data['TUNJANGAN_STRUKTURAL']."', '".$Data['TMT_SELESAI']."',
						'".$Certificate['FileName']."')
                    ";
                
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.UPDRWYTJABSTRUK(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['TMT']."', '".$Data['K_UNIT_KERJA']."', 
                        '".$Data['K_JABATAN_STRUKTURAL']."', '".$Data['K_BIDANG_KERJA']."', '".$Data['K_JENJANG']."', '".$Data['K_FAKULTAS']."', 
                        '".$Data['K_JURUSAN']."', '".$Data['K_PROG_STUDI']."', '".$Data['KETERANGAN']."',
                        '".$this->CI->session->UserLogin['UserID']."', '".$Data['TUNJANGAN_STRUKTURAL']."', '".$Data['TMT_SELESAI']."',
						'".$Certificate['FileName']."')
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
            'TMT' => '',
            'TMT_SELESAI' => '',
            'K_UNIT_KERJA' => '01',
            'K_JABATAN_STRUKTURAL' => '',
            'K_BIDANG_KERJA' => '99',
            'K_JENJANG' => '99',
            'K_FAKULTAS' => '99',
            'K_JURUSAN' => '99',
            'K_PROG_STUDI' => '96',
            'TUNJANGAN_STRUKTURAL' => '',
            'KETERANGAN' => ''
        );
        
        if (!empty($K_PEGAWAI) && !empty($NO_SK)) {
			$RawQuery = "CALL DB2ADMIN.GETRWYTJABSTRBYID('".$K_PEGAWAI."', '".$NO_SK."')";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
                $Data = $Row;
            }
        }
        
        return $Data;
    }
    
    function IsDuplicateNoSk($NO_SK) {
        $IsDuplicateNoSk = false;
        
        $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_JABATAN_STRUKTURAL WHERE NO_SK = '$NO_SK'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $IsDuplicateNoSk = true;
        }
        
        return $IsDuplicateNoSk;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SK) {
        $Data = $this->GetExist('', '');
        
        $RawQuery = "CALL DB2ADMIN.DELRWYTJABSTRUK('".$K_PEGAWAI."', '".$NO_SK."')";
		WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Error'] = '';
        $Data['Message'] = 'Data Riwayat Jabatan berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
    
    function GetCertificateByID($K_PEGAWAI, $NO_SK, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificateStruktural/',
            'Link' => HOST.'/images/CertificateStruktural/',
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
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATSTRUKTURALFILE(
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATSTRUKTURALFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."')";
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
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATSTRUKTURALFILE(
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