<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LKenaikan_Gaji {
    var $CI = null;
    
    function LKenaikan_Gaji() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/SalaryIncrease/';
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'KenaikanGaji',
            'PageTitle' => 'Penjelasan Kenaikan Gaji'
        );
        return $Array;
    }
    
    function GetArray($Param) {
		$Param['NO_SK'] = (isset($Param['NO_SK'])) ? $Param['NO_SK'] : 'x';
		
        $Counter = 0;
        $Array = array();
        $RawQuery = "CALL DB2ADMIN.GETRWYTGAJI('".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        while ($Row = db2_fetch_assoc($Query)) {
			$ArrayParam = array('ReturnArray' => true, 'WithRandom' => false);
			$Certificate = $this->GetCertificateByID($Param['K_PEGAWAI'], $Row['NO_SK'], $ArrayParam);
			$Row['FileLink'] = $Certificate['FileLink'];
			
            $Array[$Counter] = $Row;
            $Array[$Counter]['LinkEdit'] = HOST.'/index.php/KenaikanGaji/Ubah/'.ConvertLink($Param['K_PEGAWAI']).'/'.ConvertLink($Row['NO_SK']);
            $Array[$Counter]['LinkDelete'] = HOST.'/index.php/KenaikanGaji/Hapus/'.ConvertLink($Param['K_PEGAWAI']).'/'.ConvertLink($Row['NO_SK']);
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
            $Data['GAJI'] = $this->CI->input->post('GAJI');
            $Data['TMT'] = $this->CI->input->post('TMT');
            $Data['K_PERUBAHAN_GAJI'] = $this->CI->input->post('K_PERUBAHAN_GAJI');
            $Data['Error'] = '';
            
            $Data['TMT'] = (empty($Data['TMT'])) ? '' : ChangeFormatDate($Data['TMT']);
			
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/SalaryIncrease/',
                    'Name' => md5($Data['K_PEGAWAI'] . $Data['NO_SK'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $Data['Certificate'] = $this->GetCertificateByID($Data['K_PEGAWAI'], $Data['NO_SK']);
            }
            
            $Message = '';
            if ($ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSRIWAYATGAJI(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['GAJI']."',
                        '".$Data['TMT']."', '".$Data['K_PERUBAHAN_GAJI']."', '".$this->CI->session->UserLogin['UserID']."'
					)";
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            } else if ($ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.UPDRIWAYATGAJI(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['GAJI']."',
                        '".$Data['TMT']."', '".$Data['K_PERUBAHAN_GAJI']."', '".$this->CI->session->UserLogin['UserID']."'
					)";
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            }
            
			if ($Row = db2_fetch_assoc($Query)) {
				$Data['Error'] = $Row['ERROR'];
				$Data['Message'] = $Row['MSG'];
				
				if ($Data['Error'] != '00000') {
					$Data['ShowGrid'] = '0';
				}
			}
        }
        
        return $Data;
    }
    
    function GetExist($K_PEGAWAI, $NO_SK) {
        $Data = array(
            'K_PEGAWAI' => '',
            'NO_SK' => '',
            'GAJI' => '',
            'TMT' => '',
            'K_PERUBAHAN_GAJI' => '',
            'PERUBAHAN_GAJI' => ''
        );
        
        if (!empty($K_PEGAWAI) && !empty($NO_SK)) {
            $RawQuery = "CALL DB2ADMIN.GETRWYTGAJI('$K_PEGAWAI', '$NO_SK')";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
                $Data = $Row;
            }
        }
        
        return $Data;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SK) {
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATGAJI('".$K_PEGAWAI."', '".$NO_SK."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data = $this->GetExist('', '', '');
        $Data['ShowGrid'] = '1';
		$Data['ParameterUpdate'] = 'insert';
		if ($Row = db2_fetch_assoc($Query)) {
			$Data['Error'] = $Row['ERROR'];
			$Data['Message'] = $Row['MSG'];
		}
		
        return $Data;
    }
	
    function GetCertificateByID($K_PEGAWAI, $NO_SK, $Param = array()) {
		$Param['ReturnArray'] = (isset($Param['ReturnArray'])) ? $Param['ReturnArray'] : false;
		$Param['WithRandom'] = (isset($Param['WithRandom'])) ? $Param['WithRandom'] : true;
		
        $File = array(
            'Path' => PATH.'/images/SalaryIncrease/',
            'Link' => HOST.'/images/SalaryIncrease/',
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
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATGAJIFILE(
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
		$Param['NO_URUT'] = (isset($Param['NO_URUT'])) ? $Param['NO_URUT'] : 'x';
		$ArrayFile = array();
		$Counter = 0;
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATGAJIFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."')";
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
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATGAJIFILE(
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