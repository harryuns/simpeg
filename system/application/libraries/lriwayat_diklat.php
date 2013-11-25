<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Diklat {
    var $CI = null;
    
    function LRiwayat_Diklat() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/CertificateDiklat/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatDiklat',
            'PageTitle' => 'Riwayat Diklat'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI) {
        $ArrayRiwayatDiklat = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATDKLTBYID('".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        while ($Row = @db2_fetch_assoc($Query)) {
            $ArrayRiwayatDiklat[$Row['NO_SERTIFIKAT']] = $Row;
            $ArrayRiwayatDiklat[$Row['NO_SERTIFIKAT']]['LinkEdit'] = HOST.'/index.php/RiwayatDiklat/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SERTIFIKAT']);
            $ArrayRiwayatDiklat[$Row['NO_SERTIFIKAT']]['LinkDelete'] = HOST.'/index.php/RiwayatDiklat/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SERTIFIKAT']);
        }
        
        return $ArrayRiwayatDiklat;
    }
    
    function SimpegUpdate($K_PEGAWAI, $NO_SERTIFIKAT) {
        $RiwayatDiklat = $this->GetExistRiwayatDiklat($K_PEGAWAI, $NO_SERTIFIKAT);
        $RiwayatDiklat['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($NO_SERTIFIKAT)) ? 'update' : 'insert';
        $RiwayatDiklat['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $RiwayatDiklat['Certificate'] = $this->GetCertificateByID($K_PEGAWAI, $NO_SERTIFIKAT);
        $RiwayatDiklat['ShowGrid'] = (!empty($Tambah) || $RiwayatDiklat['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $RiwayatDiklat['K_PEGAWAI'] = $K_PEGAWAI;
            $RiwayatDiklat['NO_SERTIFIKAT'] = $this->CI->input->post('NO_SERTIFIKAT');
            $RiwayatDiklat['K_DIKLAT'] = $this->CI->input->post('K_DIKLAT');
            $RiwayatDiklat['PENYELENGGARA'] = $this->CI->input->post('PENYELENGGARA');
            $RiwayatDiklat['TMP_DIKLAT'] = $this->CI->input->post('TMP_DIKLAT');
            $RiwayatDiklat['NAMA_DIKLAT'] = $this->CI->input->post('NAMA_DIKLAT');
            $RiwayatDiklat['ANGKATAN'] = $this->CI->input->post('ANGKATAN');
            $RiwayatDiklat['TGL_SERTIFIKAT'] = $this->CI->input->post('TGL_SERTIFIKAT');
            $RiwayatDiklat['TGL_MULAI'] = $this->CI->input->post('TGL_MULAI');
            $RiwayatDiklat['TGL_LULUS'] = $this->CI->input->post('TGL_LULUS');
            $RiwayatDiklat['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $RiwayatDiklat['JUMLAH_JAM'] = $this->CI->input->post('JUMLAH_JAM');
            $RiwayatDiklat['PREDIKAT'] = $this->CI->input->post('PREDIKAT');
            $RiwayatDiklat['LOKASI'] = $this->CI->input->post('LOKASI');
            $RiwayatDiklat['IS_LUARNEGERI'] = $this->CI->input->post('IS_LUARNEGERI');
            $RiwayatDiklat['Error'] = '';
            
			$RiwayatDiklat['IS_LUARNEGERI'] = (empty($RiwayatDiklat['IS_LUARNEGERI'])) ? 0 : $RiwayatDiklat['IS_LUARNEGERI'];
            $RiwayatDiklat['TGL_SERTIFIKAT'] = (empty($RiwayatDiklat['TGL_SERTIFIKAT'])) ? 'x' : ChangeFormatDate($RiwayatDiklat['TGL_SERTIFIKAT']);
            $RiwayatDiklat['TGL_MULAI'] = (empty($RiwayatDiklat['TGL_MULAI'])) ? 'x' : ChangeFormatDate($RiwayatDiklat['TGL_MULAI']);
            $RiwayatDiklat['TGL_LULUS'] = (empty($RiwayatDiklat['TGL_LULUS'])) ? 'x' : ChangeFormatDate($RiwayatDiklat['TGL_LULUS']);
            
            $NO_SERTIFIKAT = $this->GetExistRiwayatDiklat($RiwayatDiklat['K_PEGAWAI'], $RiwayatDiklat['NO_SERTIFIKAT']);
            
            // Validation
            $Validation = 'pass';
            if (empty($RiwayatDiklat['NO_SERTIFIKAT'])) {
                $Validation = 'false';
                $RiwayatDiklat['NO_SERTIFIKAT'] = '';
                $RiwayatDiklat['Error'] = '00001';
                $RiwayatDiklat['Message'] = 'No SK belum di isi.';
            } else if ($this->CI->ldb2->InvalidFileUpload == '1') {
                $Validation = 'false';
                $RiwayatDiklat['Error'] = '00001';
                $RiwayatDiklat['Message'] = 'Hanya file berekstensi jpg yang bisa diupload ke server.';
            }
            
            if ($Validation == 'false') {
                $RiwayatDiklat['ShowGrid'] = '0';
                $RiwayatPendidikan['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateDiklat/',
                    'Name' => md5($RiwayatDiklat['K_PEGAWAI'] . $RiwayatDiklat['NO_SERTIFIKAT'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $RiwayatDiklat['Certificate'] = $this->GetCertificateByID($RiwayatDiklat['K_PEGAWAI'], $RiwayatDiklat['NO_SERTIFIKAT']);
            }
            
			$ParamCertificate = array('ReturnArray' => true, 'WithRandom' => false);
			$Certificate = $this->GetCertificateByID($RiwayatDiklat['K_PEGAWAI'], $RiwayatDiklat['NO_SERTIFIKAT'], $ParamCertificate);
			
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRIWAYATDKLT(
                        '".$RiwayatDiklat['K_PEGAWAI']."', '".$RiwayatDiklat['NO_SERTIFIKAT']."', '".$RiwayatDiklat['TGL_SERTIFIKAT']."',
                        '".$RiwayatDiklat['PENYELENGGARA']."', '".$RiwayatDiklat['K_DIKLAT']."', '', 
                        '".$RiwayatDiklat['ANGKATAN']."', '".$RiwayatDiklat['TGL_MULAI']."', '".$RiwayatDiklat['TGL_LULUS']."',
                        '".$RiwayatDiklat['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$RiwayatDiklat['TMP_DIKLAT']."',
						'".$Certificate['FileName']."', '".$RiwayatDiklat['JUMLAH_JAM']."', '".$RiwayatDiklat['PREDIKAT']."',
						'".$RiwayatDiklat['IS_LUARNEGERI']."', '".$RiwayatDiklat['NAMA_DIKLAT']."'
					)
				";
				
				WriteLog($RiwayatDiklat['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRIWAYATDKLT(
                        '".$RiwayatDiklat['K_PEGAWAI']."', '".$RiwayatDiklat['NO_SERTIFIKAT']."', '".$RiwayatDiklat['TGL_SERTIFIKAT']."',
                        '".$RiwayatDiklat['PENYELENGGARA']."', '".$RiwayatDiklat['K_DIKLAT']."', '', 
                        '".$RiwayatDiklat['ANGKATAN']."', '".$RiwayatDiklat['TGL_MULAI']."', '".$RiwayatDiklat['TGL_LULUS']."',
                        '".$RiwayatDiklat['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$RiwayatDiklat['TMP_DIKLAT']."',
						'".$Certificate['FileName']."', '".$RiwayatDiklat['JUMLAH_JAM']."', '".$RiwayatDiklat['PREDIKAT']."',
						'".$RiwayatDiklat['IS_LUARNEGERI']."', '".$RiwayatDiklat['NAMA_DIKLAT']."'
					)
				";
				
                WriteLog($RiwayatDiklat['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil diperbaharui.';
            }
            
            if (!empty($Message)) {
                if ($Row = db2_fetch_assoc($Query)) {
                    $QueryMessage = $Row['ERROR'];
                    
                    if ($QueryMessage == '00000') {
                        $RiwayatDiklat['NO_SERTIFIKAT'] = '';
                        $RiwayatDiklat['Message'] = $Message;
                    } else if ($QueryMessage == '00001') {
                        $RiwayatDiklat['NO_SERTIFIKAT'] = '';
                        $RiwayatDiklat['ShowGrid'] = '0';
                        $RiwayatDiklat['Message'] = 'No SK sudah terpakai.';
                        $RiwayatDiklat['ParameterUpdate'] = $ParameterUpdate;
                    } else {
                        $RiwayatDiklat['ShowGrid'] = '0';
                        $RiwayatDiklat['Message'] = 'Error.';
                        $RiwayatDiklat['ParameterUpdate'] = $ParameterUpdate;
                    }
                }
            }
        }
        
        return $RiwayatDiklat;
    }
    
    function GetExistRiwayatDiklat($K_PEGAWAI, $NO_SERTIFIKAT) {
        $RiwayatDiklat = array(
            'K_PEGAWAI' => '',
            'NO_SERTIFIKAT' => '',
            'K_DIKLAT' => '',
            'TGL_MULAI' => '',
            'TGL_LULUS' => '',
            'TGL_SERTIFIKAT' => '',
            'PENYELENGGARA' => '',
            'TMP_DIKLAT' => '',
            'ANGKATAN' => '',
            'JUMLAH_JAM' => 0,
            'PREDIKAT' => '',
            'KETERANGAN' => ''
        );
        
		if (! empty($NO_SERTIFIKAT)) {
			$RawQuery = "CALL DB2ADMIN.GETRIWAYATDKLTBYKEY('$K_PEGAWAI', '$NO_SERTIFIKAT')";
			$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
			$Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
			if ($Row = @db2_fetch_assoc($Query)) {
				$RiwayatDiklat = $Row;
			}
		}
        
        return $RiwayatDiklat;
    }
    
    function IsDuplicateNoSk($NO_SERTIFIKAT) {
        $IsDuplicateNoSk = false;
        
        $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_DIKLAT WHERE NO_SERTIFIKAT = '$NO_SERTIFIKAT'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $IsDuplicateNoSk = true;
        }
        
        return $IsDuplicateNoSk;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SERTIFIKAT) {
        $RiwayatDiklat = $this->GetExistRiwayatDiklat($K_PEGAWAI, '');
        
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATDKLT('".$K_PEGAWAI."', '".$NO_SERTIFIKAT."')";
		WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $RiwayatDiklat['Error'] = '';
        $RiwayatDiklat['Message'] = 'Data Riwayat Diklat berhasil dihapus.';
        $RiwayatDiklat['ParameterUpdate'] = 'insert';
        $RiwayatDiklat['ShowGrid'] = '1';
        
        return $RiwayatDiklat;
    }
    
    function GetCertificateByID($K_PEGAWAI, $NO_SERTIFIKAT, $Param = array()) {
        if (empty($NO_SERTIFIKAT)) {
            return '';
        }
		
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificateDiklat/',
            'Link' => HOST.'/images/CertificateDiklat/',
            'Name' => md5($K_PEGAWAI . $NO_SERTIFIKAT . SALT)
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
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATDIKLATFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['NO_SERTIFIKAT']."', '".$Param['NO_URUT']."', '".$Param['FILENAME']."',
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATDIKLATFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SERTIFIKAT']."', '".$Param['NO_URUT']."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        while (false !== $Row = db2_fetch_assoc($Query)) {
			$Counter++;
			$Row['NameFile'] = $Row['NO_SERTIFIKAT'] . ' File ke ' . $Counter;
			$Row['LinkFile'] = HOST . $this->PathName . $Row['FILENAME'];
			$ArrayFile[] = $Row;
        }
		
		return $ArrayFile;
	}
	
	function DeleteFile($Param) {
		$FilePath = PATH . $this->PathName . $Param['FILENAME'];
		@unlink($FilePath);
		
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATDIKLATFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['NO_SERTIFIKAT']."', '".$Param['NO_URUT']."'
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