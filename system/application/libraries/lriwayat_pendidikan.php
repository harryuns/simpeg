<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Pendidikan {
    var $CI = null;
    
    function LRiwayat_Pendidikan() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/CertificateEducation/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatPendidikan',
            'PageTitle' => 'Riwayat Pendidikan'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI) {
        $ArrayRiwayatPendidikan = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATPENDBYID('".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        $Counter = 0;
        while ($Row = db2_fetch_assoc($Query)) {
			$Row['NO_IJAZAH_BARU'] = $this->GetNoIjazahDatabase($Row);
			$Row['TGL_IJAZAH'] = ($Row['TGL_IJAZAH'] == EMPTY_DATE) ? '' : $Row['TGL_IJAZAH'];
			
            $ArrayRiwayatPendidikan[$Counter] = $Row;
            $ArrayRiwayatPendidikan[$Counter]['LinkEdit'] = HOST.'/index.php/RiwayatPendidikan/Ubah/'.ConvertLink($K_PEGAWAI).'/'.$Row['K_JENJANG'].'/'.ConvertLink($Row['NO_IJAZAH']);
            $ArrayRiwayatPendidikan[$Counter]['LinkDelete'] = HOST.'/index.php/RiwayatPendidikan/Hapus/'.ConvertLink($K_PEGAWAI).'/'.$Row['K_JENJANG'].'/'.ConvertLink($Row['NO_IJAZAH']);
            $Counter++;
        }
        
        return $ArrayRiwayatPendidikan;
    }
    
    function SimpegUpdate($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH) {
        $RiwayatPendidikan = $this->GetExistRiwayatPendidikan($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH);
        $RiwayatPendidikan['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($K_JENJANG) && !empty($NO_IJAZAH)) ? 'update' : 'insert';
        $RiwayatPendidikan['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $RiwayatPendidikan['Certificate'] = $this->GetCertificateByID($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH);
        $RiwayatPendidikan['Transkrip'] = $this->GetCertificateTranskripByID($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH);
        $RiwayatPendidikan['ShowGrid'] = (!empty($Tambah) || $RiwayatPendidikan['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $RiwayatPendidikan['K_PEGAWAI'] = $K_PEGAWAI;
            $RiwayatPendidikan['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
            $RiwayatPendidikan['NO_IJAZAH'] = $this->CI->input->post('NO_IJAZAH');
            $RiwayatPendidikan['TGL_IJAZAH'] = $this->CI->input->post('TGL_IJAZAH');
            $RiwayatPendidikan['IPK'] = str_replace(',', '.', $this->CI->input->post('IPK'));
            $RiwayatPendidikan['THN_MASUK'] = trim($this->CI->input->post('THN_MASUK'));
            $RiwayatPendidikan['PT'] = $this->CI->input->post('PT');
            $RiwayatPendidikan['K_NEGARA'] = $this->CI->input->post('K_NEGARA');
            $RiwayatPendidikan['PROG_STUDI'] = $this->CI->input->post('PROG_STUDI');
            $RiwayatPendidikan['BIDANG_ILMU'] = $this->CI->input->post('BIDANG_ILMU');
            $RiwayatPendidikan['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $RiwayatPendidikan['K_STATUS_STUDI'] = $this->CI->input->post('K_STATUS_STUDI');
            $RiwayatPendidikan['THN_LULUS'] = $this->CI->input->post('THN_LULUS');
            $RiwayatPendidikan['PROFESI'] = $this->CI->input->post('PROFESI');
            $RiwayatPendidikan['K_ASAL_PT_S3DIKTI'] = $this->CI->input->post('K_ASAL_PT_S3DIKTI');
            $RiwayatPendidikan['NO_SK_TUBEL'] = $this->CI->input->post('NO_SK_TUBEL');
            $RiwayatPendidikan['TMT_TUBEL'] = $this->CI->input->post('TMT_TUBEL');
            $RiwayatPendidikan['NO_SK_PEMBEBASAN'] = $this->CI->input->post('NO_SK_PEMBEBASAN');
            $RiwayatPendidikan['TMT_PEMBEBASAN'] = $this->CI->input->post('TMT_PEMBEBASAN');
            $RiwayatPendidikan['TMT_LULUS'] = $this->CI->input->post('TMT_LULUS');
            $RiwayatPendidikan['STATUS_PENGAKTIFAN'] = $this->CI->input->post('STATUS_PENGAKTIFAN');
            $RiwayatPendidikan['NO_SK_PENGAKTIFAN'] = $this->CI->input->post('NO_SK_PENGAKTIFAN');
            $RiwayatPendidikan['TMT_PENGAKTIFAN'] = $this->CI->input->post('TMT_PENGAKTIFAN');
            $RiwayatPendidikan['NO_IJAZAH_BARU'] = $this->CI->input->post('NO_IJAZAH_BARU');
			$RiwayatPendidikan['IS_STUDI_LANJUT'] = $this->CI->lstatus_studi->IsStudiLanjut($RiwayatPendidikan['K_STATUS_STUDI']);
            $RiwayatPendidikan['Error'] = '';
            
			$RiwayatPendidikan['NO_IJAZAH'] = $this->GetNoIjazahForm($RiwayatPendidikan);
            
	    $RiwayatPendidikan['NO_IJAZAH_BARU'] = ($RiwayatPendidikan['NO_IJAZAH'] == $RiwayatPendidikan['NO_IJAZAH_BARU']) ? '' : $RiwayatPendidikan['NO_IJAZAH_BARU'];
            $RiwayatPendidikan['TGL_IJAZAH'] = (empty($RiwayatPendidikan['TGL_IJAZAH'])) ? EMPTY_DATE : ChangeFormatDate($RiwayatPendidikan['TGL_IJAZAH']);
            $RiwayatPendidikan['TMT_TUBEL'] = (empty($RiwayatPendidikan['TMT_TUBEL'])) ? '' : ChangeFormatDate($RiwayatPendidikan['TMT_TUBEL']);
            $RiwayatPendidikan['TMT_PEMBEBASAN'] = (empty($RiwayatPendidikan['TMT_PEMBEBASAN'])) ? '' : ChangeFormatDate($RiwayatPendidikan['TMT_PEMBEBASAN']);
            $RiwayatPendidikan['TMT_LULUS'] = (empty($RiwayatPendidikan['TMT_LULUS'])) ? '' : ChangeFormatDate($RiwayatPendidikan['TMT_LULUS']);
            $RiwayatPendidikan['TMT_PENGAKTIFAN'] = (empty($RiwayatPendidikan['TMT_PENGAKTIFAN'])) ? '' : ChangeFormatDate($RiwayatPendidikan['TMT_PENGAKTIFAN']);
            $RiwayatPendidikan['IPK'] = (empty($RiwayatPendidikan['IPK'])) ? 0 : $RiwayatPendidikan['IPK'];
            $RiwayatPendidikan['PROG_STUDI'] = (empty($RiwayatPendidikan['PROG_STUDI'])) ? '-' : $RiwayatPendidikan['PROG_STUDI'];
			$RiwayatPendidikan['STATUS_PENGAKTIFAN'] = (empty($RiwayatPendidikan['STATUS_PENGAKTIFAN'])) ? 0 : 1;
            
            // Validation
            $Validation = 'pass';
            if (empty($RiwayatPendidikan['THN_MASUK'])) {
                $Validation = 'false';
                $RiwayatPendidikan['Error'] = '00001';
                $RiwayatPendidikan['Message'] = 'Tahun Masuk belum di isi.';
/*
            } else if (empty($RiwayatPendidikan['PT'])) {
                $Validation = 'false';
                $RiwayatPendidikan['Error'] = '00001';
                $RiwayatPendidikan['Message'] = 'PT belum di isi.';
            } else if (strlen($RiwayatPendidikan['THN_MASUK']) != 4) {
                $Validation = 'false';
                $RiwayatPendidikan['Error'] = '00001';
                $RiwayatPendidikan['Message'] = 'Data Tahun Masuk tidak sesuai.';
/* */
            } else if ($this->CI->ldb2->InvalidFileUpload == '1') {
                $Validation = 'false';
                $RiwayatPendidikan['Error'] = '00001';
                $RiwayatPendidikan['Message'] = 'Hanya file berekstensi jpg yang bisa diupload ke server.';
            }
            
            if ($Validation == 'false') {
                $RiwayatPendidikan['ShowGrid'] = '0';
                $RiwayatPendidikan['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Ijazah
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateEducation/',
                    'Name' => md5($RiwayatPendidikan['K_PEGAWAI'] . $RiwayatPendidikan['K_JENJANG'] . $RiwayatPendidikan['NO_IJAZAH'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $RiwayatPendidikan['Certificate'] = $this->GetCertificateByID($RiwayatPendidikan['K_PEGAWAI'], $RiwayatPendidikan['K_JENJANG'], $RiwayatPendidikan['NO_IJAZAH']);
            }
            
            // Upload Transkrip
            if (isset($_FILES) && isset($_FILES['Transkrip']) && isset($_FILES['Transkrip']['name']) && !empty($_FILES['Transkrip']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateEducation/',
                    'Name' => md5($RiwayatPendidikan['K_PEGAWAI'] . $RiwayatPendidikan['K_JENJANG'] . $RiwayatPendidikan['NO_IJAZAH'] . 'TRANSKRIP' . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Transkrip']['name']))
                );
                $ResultUpdate = Upload($File, 'Transkrip');
                $RiwayatPendidikan['Transkrip'] = $this->GetCertificateTranskripByID($RiwayatPendidikan['K_PEGAWAI'], $RiwayatPendidikan['K_JENJANG'], $RiwayatPendidikan['NO_IJAZAH']);
            }
            
			$ParamCertificate = array('ReturnArray' => true, 'WithRandom' => false);
			$Certificate = $this->GetCertificateByID($RiwayatPendidikan['K_PEGAWAI'], $RiwayatPendidikan['K_JENJANG'], $RiwayatPendidikan['NO_IJAZAH'], $ParamCertificate);
			$Transkrip = $this->GetCertificateTranskripByID($RiwayatPendidikan['K_PEGAWAI'], $RiwayatPendidikan['K_JENJANG'], $RiwayatPendidikan['NO_IJAZAH'], $ParamCertificate);
			
            $Message = '';
            if ($Validation == 'pass') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRIWAYATPENDD(
                        '".$RiwayatPendidikan['K_PEGAWAI']."', '".$RiwayatPendidikan['K_JENJANG']."', '".$RiwayatPendidikan['NO_IJAZAH']."', '".$RiwayatPendidikan['TGL_IJAZAH']."',
						'".$RiwayatPendidikan['THN_MASUK']."', '".$RiwayatPendidikan['PT']."',  '".$RiwayatPendidikan['K_NEGARA']."', '".$RiwayatPendidikan['KETERANGAN']."',
						'".$this->CI->session->UserLogin['UserID']."', '".$RiwayatPendidikan['IPK']."', '".$RiwayatPendidikan['PROG_STUDI']."', '".$RiwayatPendidikan['BIDANG_ILMU']."',
						'".$RiwayatPendidikan['THN_LULUS']."', '".$RiwayatPendidikan['K_STATUS_STUDI']."', '".$Transkrip['FileName']."', '".$Certificate['FileName']."',
						'".$RiwayatPendidikan['K_ASAL_PT_S3DIKTI']."', '".$RiwayatPendidikan['PROFESI']."', 'x', '".$RiwayatPendidikan['NO_SK_TUBEL']."',
						'".$RiwayatPendidikan['TMT_TUBEL']."', '".$RiwayatPendidikan['NO_SK_PEMBEBASAN']."', '".$RiwayatPendidikan['TMT_PEMBEBASAN']."', '".$RiwayatPendidikan['TMT_LULUS']."',
						'".$RiwayatPendidikan['STATUS_PENGAKTIFAN']."', '".$RiwayatPendidikan['NO_SK_PENGAKTIFAN']."', '".$RiwayatPendidikan['TMT_PENGAKTIFAN']."', '".$RiwayatPendidikan['IS_STUDI_LANJUT']."',
						'".$RiwayatPendidikan['NO_IJAZAH_BARU']."'
					)";
				WriteLog($RiwayatPendidikan['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil disimpan.';
            }
			
            if (!empty($Message)) {
                if ($Row = db2_fetch_assoc($Query)) {
                    $QueryMessage = $Row['ERROR'];
                    
                    if ($QueryMessage == '00000') {
                        $RiwayatPendidikan['NO_IJAZAH'] = '';
                        $RiwayatPendidikan['Message'] = $Message;
                    } else {
                        $RiwayatPendidikan['ShowGrid'] = '0';
                        $RiwayatPendidikan['Message'] = 'Error. '.$QueryMessage;
                        $RiwayatPendidikan['ParameterUpdate'] = $ParameterUpdate;
                        
                        WriteLogErrorQuery($RawQuery.' - '.$QueryMessage);
                    }
                }
            }
        }
        
        return $RiwayatPendidikan;
    }
    
    function GetExistRiwayatPendidikan($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH) {
        $Array = array(
            'K_PEGAWAI' => '',
            'K_JENJANG' => '01',
            'NO_IJAZAH' => '',
            'NO_IJAZAH_BARU' => '',
            'TGL_IJAZAH' => '',
            'IPK' => '',
            'THN_MASUK' => '',
            'PT' => '',
            'K_NEGARA' => '360',
            'PROG_STUDI' => '',
            'BIDANG_ILMU' => '',
            'KETERANGAN' => '',
            'K_STATUS_STUDI' => '',
            'K_ASAL_PT_S3DIKTI' => '',
            'THN_LULUS' => '',
            'PROFESI' => ''
        );
        
		if (!empty($K_PEGAWAI) && !empty($K_JENJANG) && !empty($NO_IJAZAH)) {
			$RawQuery = "CALL DB2ADMIN.GETRIWAYATPENDBYKEY('$K_PEGAWAI','$K_JENJANG','$NO_IJAZAH')";
			$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
			$Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
			if ($Row = db2_fetch_assoc($Query)) {
				$Array = $Row;
				$Array['IPK'] = number_format($Array['IPK'], 2, '.', '');
				$Array['TMT_TUBEL'] = DateToStandartDate($Array['TMT_TUBEL']);
				$Array['THN_LULUS'] = (empty($Array['THN_LULUS'])) ? '' : $Array['THN_LULUS'];
				$Array['TGL_IJAZAH'] = ($Array['TGL_IJAZAH'] == EMPTY_DATE) ? '' : $Array['TGL_IJAZAH'];
				$Array['NO_IJAZAH_BARU'] = $this->GetNoIjazahDatabase($Array);
			}
		}
        
        return $Array;
    }
    
	function GetNoIjazahForm($Param) {
		$NoIjazah = '';
		
		if (empty($Param['NO_IJAZAH']) && empty($Param['NO_IJAZAH_BARU'])) {
			$NoIjazah = date('Y-m-d H:i:s');
		} else if (empty($Param['NO_IJAZAH']) && !empty($Param['NO_IJAZAH_BARU'])) {
			$NoIjazah = $Param['NO_IJAZAH_BARU'];
		} else if (!empty($Param['NO_IJAZAH'])) {
			$NoIjazah = $Param['NO_IJAZAH'];
		}
		
		return $NoIjazah;
	}
	
	function GetNoIjazahDatabase($Param) {
		$NoIjazah = $Param['NO_IJAZAH'];
		if (strlen($Param['NO_IJAZAH']) == 20) {
			$NoIjazah = '';
		} else {
			$NoIjazah = preg_replace('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/i', '', $Param['NO_IJAZAH']);
		}
		
		return $NoIjazah;
	}
	
    function IsDuplicateIjazah($NO_IJAZAH) {
        $IsDuplicateIjazah = false;
        
        $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_PENDIDIKAN WHERE NO_IJAZAH = '$NO_IJAZAH'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $IsDuplicateIjazah = true;
        }
        
        return $IsDuplicateIjazah;
    }
    
    function SimpegDelete($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH) {
        $RiwayatPangkat = array();
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATPENDD('".$K_PEGAWAI."', '".$K_JENJANG."', '".$NO_IJAZAH."')";
		WriteLog($K_PEGAWAI, $RawQuery);
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $RiwayatPangkat['Error'] = '';
        $RiwayatPangkat['Message'] = 'Data Riwayat Pendidikan berhasil dihapus.';
        $RiwayatPangkat['ParameterUpdate'] = 'insert';
        $RiwayatPangkat['ShowGrid'] = '1';
        
        return $RiwayatPangkat;
    }
    
	function GetCertificateByID($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificateEducation/',
            'Link' => HOST.'/images/CertificateEducation/',
            'Name' => md5($K_PEGAWAI . $K_JENJANG . $NO_IJAZAH . SALT)
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
    
	function GetCertificateTranskripByID($K_PEGAWAI, $K_JENJANG, $NO_IJAZAH, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/CertificateEducation/',
            'Link' => HOST.'/images/CertificateEducation/',
            'Name' => md5($K_PEGAWAI . $K_JENJANG . $NO_IJAZAH . 'TRANSKRIP' . SALT)
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
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATPENDIDIKANFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['K_JENJANG']."', '".$Param['NO_IJAZAH']."', '".$Param['NO_URUT']."',
			'".$Param['FILENAME']."', '".$Param['IS_IJAZAH']."', '".$Param['USERID']."'
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATPENDIDIKANFILE('".$Param['K_PEGAWAI']."', '".$Param['K_JENJANG']."', '".$Param['NO_IJAZAH']."', '".$Param['NO_URUT']."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        while (false !== $Row = db2_fetch_assoc($Query)) {
			$Counter++;
			$Row['NameFile'] = $Row['NO_IJAZAH'] . ' File ke ' . $Counter;
			$Row['LinkFile'] = HOST . $this->PathName . $Row['FILENAME'];
			$ArrayFile[] = $Row;
        }
		
		return $ArrayFile;
	}
	
	function DeleteFile($Param) {
		$FilePath = PATH . $this->PathName . $Param['FILENAME'];
		@unlink($FilePath);
		
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATPENDIDIKANFILE(
			'".$Param['K_PEGAWAI']."', '".$Param['K_JENJANG']."', '".$Param['NO_IJAZAH']."', '".$Param['NO_URUT']."'
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
