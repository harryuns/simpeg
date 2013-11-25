<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Jabatan_Fungsional {
    var $CI = null;
    
    function LRiwayat_Jabatan_Fungsional() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/CertificateFungsional/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatFungsional',
            'PageTitle' => 'Riwayat Fungsional'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI) {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRWYTJABFUNGBYID('".$K_PEGAWAI."', 'x')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Row['NO_SK']] = $Row;
            $Array[$Row['NO_SK']]['LinkEdit'] = HOST.'/index.php/RiwayatFungsional/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
            $Array[$Row['NO_SK']]['LinkDelete'] = HOST.'/index.php/RiwayatFungsional/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
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
            $Data['K_UNIT_KERJA'] = $this->CI->input->post('K_UNIT_KERJA');
            $Data['K_JABATAN_FUNGSIONAL'] = $this->CI->input->post('K_JABATAN_FUNGSIONAL');
            $Data['BIDANG_ILMU'] = $this->CI->input->post('BIDANG_ILMU');
            $Data['JABATAN_LAIN'] = $this->CI->input->post('JABATAN_LAIN');
            $Data['PENANDATANGAN_SK'] = $this->CI->input->post('PENANDATANGAN_SK');
            $Data['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
            $Data['K_FAKULTAS'] = $this->CI->input->post('K_FAKULTAS');
            $Data['K_JURUSAN'] = $this->CI->input->post('K_JURUSAN');
            $Data['K_PROG_STUDI'] = $this->CI->input->post('K_PROG_STUDI');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['TUNJANGAN_FUNGSIONAL'] = $this->CI->input->post('TUNJANGAN_FUNGSIONAL');
            $Data['ANGKA_KREDIT'] = $this->CI->input->post('ANGKA_KREDIT');
            $Data['Error'] = '';
            
            $NO_SK = $this->GetExist($Data['K_PEGAWAI'], $Data['NO_SK']);
            $Data['TGL_SK'] = (empty($Data['TGL_SK'])) ? '' : ChangeFormatDate($Data['TGL_SK']);
            $Data['TMT'] = (empty($Data['TMT'])) ? '' : ChangeFormatDate($Data['TMT']);
            $Data['BIDANG_ILMU'] = ($Data['K_JABATAN_FUNGSIONAL'] == '03' || $Data['K_JABATAN_FUNGSIONAL'] == '04') ? $Data['BIDANG_ILMU'] : '';
            
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
                $Data['Message'] = 'TMT belum di isi.';
            }
            
            if ($Validation == 'false') {
                $Data['ShowGrid'] = '0';
                $Data['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateFungsional/',
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
                    CALL DB2ADMIN.INSUPDRWYTJABFUNG(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['TMT']."', '".$Data['K_UNIT_KERJA']."', 
                        '".$Data['K_JABATAN_FUNGSIONAL']."', '".$Data['KETERANGAN']."',
                        '".$this->CI->session->UserLogin['UserID']."', '".$Data['TUNJANGAN_FUNGSIONAL']."', '".$Data['ANGKA_KREDIT']."',
                        '".$Data['BIDANG_ILMU']."', '".$Data['JABATAN_LAIN']."', '".$Data['PENANDATANGAN_SK']."'
					)
				";
				
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRWYTJABFUNG(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['TMT']."', '".$Data['K_UNIT_KERJA']."', 
                        '".$Data['K_JABATAN_FUNGSIONAL']."', '".$Data['KETERANGAN']."', 
                        '".$this->CI->session->UserLogin['UserID']."', '".$Data['TUNJANGAN_FUNGSIONAL']."', '".$Data['ANGKA_KREDIT']."',
                        '".$Data['BIDANG_ILMU']."', '".$Data['JABATAN_LAIN']."', '".$Data['PENANDATANGAN_SK']."'
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
            'K_UNIT_KERJA' => '04',
            'K_JABATAN_FUNGSIONAL' => '',
            'BIDANG_ILMU' => '',
            'JABATAN_LAIN' => '',
            'PENANDATANGAN_SK' => '',
            'K_JENJANG' => '99',
            'K_FAKULTAS' => '99',
            'K_JURUSAN' => '99',
            'K_PROG_STUDI' => '96',
            'TUNJANGAN_FUNGSIONAL' => '',
            'ANGKA_KREDIT' => '',
            'KETERANGAN' => ''
        );
        
        if (!empty($K_PEGAWAI) && !empty($NO_SK)) {
			$RawQuery = "CALL DB2ADMIN.GETRWYTJABFUNGBYID('".$K_PEGAWAI."', '".$NO_SK."')";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
				$Row['ANGKA_KREDIT'] = number_format($Row['ANGKA_KREDIT'], 2, '.', '');
                $Data = $Row;
            }
        }
        
        $Data['BIDANG_ILMU'] = (isset($Data['BIDANG_ILMU'])) ? $Data['BIDANG_ILMU'] : '';
		
        return $Data;
    }
    
    function IsDuplicateNoSk($NO_SK) {
        $IsDuplicateNoSk = false;
        
        $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_JABATAN_FUNGSIONAL WHERE NO_SK = '$NO_SK'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $IsDuplicateNoSk = true;
        }
        
        return $IsDuplicateNoSk;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SK) {
        $Data = $this->GetExist('', '');
        
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATJABFUNG('".$K_PEGAWAI."', '".$NO_SK."')";
		WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Error'] = '';
        $Data['Message'] = 'Data Riwayat Jabatan Fungsional berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
    
    function GetCertificateByID($K_PEGAWAI, $NO_SK, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificateFungsional/',
            'Link' => HOST.'/images/CertificateFungsional/',
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
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATFUNGSIONALFILE(
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATFUNGSIONALFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."')";
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
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATFUNGSIONALFILE(
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
