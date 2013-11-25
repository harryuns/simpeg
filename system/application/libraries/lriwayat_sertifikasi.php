<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Sertifikasi {
    var $CI = null;
    
    function LRiwayat_Sertifikasi() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/CertificateCertification/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatSertifikasi',
            'PageTitle' => 'Riwayat Sertifikasi'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $Path = 'RiwayatSertifikasi') {
        $Array = array();
        
        $Counter = 0;
        $RawQuery = "CALL DB2ADMIN.GETRWYTSERTBYID('".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Counter] = $Row;
            $Array[$Counter]['LinkEdit'] = HOST.'/index.php/'.$Path.'/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SERTIFIKAT']).'/'.ConvertLink($Row['NO_PESERTA']);
            $Array[$Counter]['LinkDelete'] = HOST.'/index.php/'.$Path.'/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SERTIFIKAT']).'/'.ConvertLink($Row['NO_PESERTA']);
            $Counter++;
        }
        
        return $Array;
    }
    
    function SimpegUpdate($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA) {
        $Data = $this->GetExist($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA);
        $Data['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($NO_SERTIFIKAT) && !empty($NO_PESERTA)) ? 'update' : 'insert';
        $Data['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $Data['Certificate'] = $this->GetCertificateByID($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA);
        $Data['ShowGrid'] = (!empty($Tambah) || $Data['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $Data['K_PEGAWAI'] = $K_PEGAWAI;
            $Data['NO_SERTIFIKAT'] = $this->CI->input->post('NO_SERTIFIKAT');
            $Data['NO_PESERTA'] = $this->CI->input->post('NO_PESERTA');
            $Data['TGL_SERTIFIKAT'] = $this->CI->input->post('TGL_SERTIFIKAT');
            $Data['K_PTP'] = $this->CI->input->post('K_PTP');
            $Data['PEJABAT_TT'] = $this->CI->input->post('PEJABAT_TT');
            $Data['K_RUMPUN_ILMU'] = $this->CI->input->post('K_RUMPUN_ILMU');
            $Data['TUNJANGAN_SERTIFIKASI'] = $this->CI->input->post('TUNJANGAN_SERTIFIKASI');
            $Data['TGL_AKHIR'] = $this->CI->input->post('TGL_AKHIR');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['Error'] = '';
            
            $Data['TGL_SERTIFIKAT'] = (empty($Data['TGL_SERTIFIKAT'])) ? '' : ChangeFormatDate($Data['TGL_SERTIFIKAT']);
            $Data['TGL_AKHIR'] = (empty($Data['TGL_AKHIR'])) ? '' : ChangeFormatDate($Data['TGL_AKHIR']);
            
            // Validation
            $Validation = 'pass';
            if (empty($Data['NO_SERTIFIKAT'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'No Sertifikat belum di isi.';
            } else if (empty($Data['NO_PESERTA'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'No Peserta belum di isi.';
            }
            
            if ($Validation == 'false') {
                $Data['ShowGrid'] = '0';
                $Data['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateCertification/',
                    'Name' => md5($Data['K_PEGAWAI'] . $Data['NO_SERTIFIKAT'] . $Data['NO_PESERTA'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $Data['Certificate'] = $this->GetCertificateByID($Data['K_PEGAWAI'], $Data['NO_SERTIFIKAT'], $Data['NO_PESERTA']);
            }
            
			$ParamCertificate = array('ReturnArray' => true, 'WithRandom' => false);
			$Certificate = $this->GetCertificateByID($Data['K_PEGAWAI'], $Data['NO_SERTIFIKAT'], $Data['NO_PESERTA'], $ParamCertificate);
			
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSRWYTSERTIFIKASI(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SERTIFIKAT']."', '".$Data['NO_PESERTA']."',
                        '".$Data['TGL_SERTIFIKAT']."', '".$Data['K_PTP']."', '".$Data['PEJABAT_TT']."', 
                        '".$Data['K_RUMPUN_ILMU']."', '".$Data['TUNJANGAN_SERTIFIKASI']."', '".$Data['TGL_AKHIR']."',
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$Certificate['FileName']."')
                    ";
				
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.UPDRWYTSERTIFIKASI(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SERTIFIKAT']."', '".$Data['NO_PESERTA']."',
                        '".$Data['TGL_SERTIFIKAT']."', '".$Data['K_PTP']."', '".$Data['PEJABAT_TT']."', 
                        '".$Data['K_RUMPUN_ILMU']."', '".$Data['TUNJANGAN_SERTIFIKASI']."', '".$Data['TGL_AKHIR']."',
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$Certificate['FileName']."')
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
                        $Data['Message'] = $Message;
                    } else {
                        $Data['Error'] = '00001';
                        $Data['ShowGrid'] = '0';
                        $Data['Message'] = 'No Sertifikat sudah terpakai.';
                        $Data['ParameterUpdate'] = $ParameterUpdate;
                    }
                }
            }
        }
        
        return $Data;
    }
    
    function GetExist($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA) {
        $Data = array(
            'K_PEGAWAI' => '',
            'NO_SERTIFIKAT' => '',
            'NO_PESERTA' => '',
            'TGL_SERTIFIKAT' => '',
            'K_PTP' => '',
            'PEJABAT_TT' => '',
            'K_RUMPUN_ILMU' => '',
            'TUNJANGAN_SERTIFIKASI' => '',
            'TGL_AKHIR' => '',
            'KETERANGAN' => ''
        );
        
        if (!empty($K_PEGAWAI) && !empty($NO_SERTIFIKAT) && !empty($NO_PESERTA)) {
            $RawQuery = "
                SELECT *
                FROM DB2ADMIN.RIWAYAT_SERTIFIKASI
                WHERE
                    K_PEGAWAI = '$K_PEGAWAI'
                    AND NO_SERTIFIKAT = '$NO_SERTIFIKAT'
                    AND NO_PESERTA = '$NO_PESERTA'";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
                $Data = $Row;
            }
        }
        
        return $Data;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA) {
        $Data = $this->GetExist('', '', '');
        
        $RawQuery = "CALL DB2ADMIN.DELRWYTSERTIFIKASI('".$K_PEGAWAI."', '".$NO_SERTIFIKAT."', '".$NO_PESERTA."')";
		WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Error'] = '';
        $Data['Message'] = 'Data Riwayat Sertifikasi berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
    
    function GetCertificateByID($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificateCertification/',
            'Link' => HOST.'/images/CertificateCertification/',
            'Name' => md5($K_PEGAWAI . $NO_SERTIFIKAT . $NO_PESERTA . SALT)
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
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATSERTIFIKASIFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['NO_SERTIFIKAT']."', '".$Param['NO_PESERTA']."', '".$Param['NO_URUT']."',
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATSERTIFIKASIFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SERTIFIKAT']."', '".$Param['NO_PESERTA']."', '".$Param['NO_URUT']."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        while (false !== $Row = db2_fetch_assoc($Query)) {
			$Counter++;
			$Row['NameFile'] = $Row['NO_PESERTA'] . ' File ke ' . $Counter;
			$Row['LinkFile'] = HOST . $this->PathName . $Row['FILENAME'];
			$ArrayFile[] = $Row;
        }
		
		return $ArrayFile;
	}
	
	function DeleteFile($Param) {
		$FilePath = PATH . $this->PathName . $Param['FILENAME'];
		@unlink($FilePath);
		
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATSERTIFIKASIFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['NO_SERTIFIKAT']."', '".$Param['NO_PESERTA']."', '".$Param['NO_URUT']."'
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