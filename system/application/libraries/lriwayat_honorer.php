<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Honorer {
    var $CI = null;
    
    function LRiwayat_Honorer() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/RiwayatHonorer/';
    }
    
    function GetProperty($Param) {
		if ($Param['IsDosen']) {
			$Array = array( 'PageName' => 'RiwayatHonorer', 'PageTitle' => 'Riwayat Pegawai Tetap Non PNS' );
			$Array = array( 'PageName' => 'RiwayatHonorer', 'PageTitle' => 'Riwayat Penempatan Kerja' );
		} else {
			$Array = array( 'PageName' => 'RiwayatHonorer', 'PageTitle' => 'Riwayat Kepegawaian' );
			$Array = array( 'PageName' => 'RiwayatHonorer', 'PageTitle' => 'Riwayat Penempatan Kerja' );
		}
		
        return $Array;
    }
    
    function GetArray($K_PEGAWAI) {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRWYTHONORERBYID('".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
		while ($Row = db2_fetch_assoc($Query)) {
			$Array[$Row['NO_SK']] = $Row;
			$Array[$Row['NO_SK']]['LinkEdit'] = HOST.'/index.php/RiwayatHonorer/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
			$Array[$Row['NO_SK']]['LinkDelete'] = HOST.'/index.php/RiwayatHonorer/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['NO_SK']);
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
        $Data['ShowGrid'] = (!empty($Tambah) || $Data['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $Data['K_PEGAWAI'] = $K_PEGAWAI;
            $Data['NO_SK'] = $this->CI->input->post('NO_SK');
            $Data['TGL_SK'] = $this->CI->input->post('TGL_SK');
            $Data['K_ASAL_SK'] = $this->CI->input->post('K_ASAL_SK');
            $Data['TMT'] = $this->CI->input->post('TMT');
            $Data['K_UNIT_KERJA'] = $this->CI->input->post('K_UNIT_KERJA');
            $Data['K_BIDANG_KERJA'] = $this->CI->input->post('K_BIDANG_KERJA');
            $Data['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
            $Data['K_FAKULTAS'] = $this->CI->input->post('K_FAKULTAS');
            $Data['K_JURUSAN'] = $this->CI->input->post('K_JURUSAN');
            $Data['K_PROG_STUDI'] = $this->CI->input->post('K_PROG_STUDI');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['GAJI'] = $this->CI->input->post('GAJI');
            $Data['BIDANG_KERJA'] = $this->CI->input->post('BIDANG_KERJA');
            $Data['Error'] = '';
            
            $NO_SK = $this->GetExist($Data['K_PEGAWAI'], $Data['NO_SK']);
            $Data['TGL_SK'] = (empty($Data['TGL_SK'])) ? '' : ChangeFormatDate($Data['TGL_SK']);
            $Data['TMT'] = (empty($Data['TMT'])) ? '' : ChangeFormatDate($Data['TMT']);
            
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
            
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRWYTHONORER(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['TMT']."', '".$Data['K_UNIT_KERJA']."', 
                        '".$Data['K_BIDANG_KERJA']."', '".$Data['K_JENJANG']."', '".$Data['K_FAKULTAS']."', 
                        '".$Data['K_JURUSAN']."', '".$Data['K_PROG_STUDI']."', '".$Data['KETERANGAN']."', 
                        '".$this->CI->session->UserLogin['UserID']."', '".$Data['GAJI']."', '".$Data['BIDANG_KERJA']."'
						)
                    ";
				
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRWYTHONORER(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SK']."', '".$Data['TGL_SK']."',
                        '".$Data['K_ASAL_SK']."', '".$Data['TMT']."', '".$Data['K_UNIT_KERJA']."', 
                        '".$Data['K_BIDANG_KERJA']."', '".$Data['K_JENJANG']."', '".$Data['K_FAKULTAS']."', 
                        '".$Data['K_JURUSAN']."', '".$Data['K_PROG_STUDI']."', '".$Data['KETERANGAN']."', 
                        '".$this->CI->session->UserLogin['UserID']."', '".$Data['GAJI']."', '".$Data['BIDANG_KERJA']."'
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
                        $Data['Error'] = '00001';
                        $Data['ParameterUpdate'] = $ParameterUpdate;
                    } else {
                        $Data['ShowGrid'] = '0';
                        $Data['Message'] = 'Error.';
                        $Data['Error'] = '00001';
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
            'K_UNIT_KERJA' => '',
            'K_BIDANG_KERJA' => '',
            'K_JENJANG' => '01',
            'K_FAKULTAS' => '09',
            'K_JURUSAN' => '04',
            'K_PROG_STUDI' => '96',
            'GAJI' => '',
            'BIDANG_KERJA' => '',
            'KETERANGAN' => ''
        );
        
        if (!empty($K_PEGAWAI) && !empty($NO_SK)) {
//            $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_HONORER WHERE K_PEGAWAI = '$K_PEGAWAI' AND NO_SK = '$NO_SK'";
            $RawQuery = "CALL DB2ADMIN.GETRWYTHONORERBYID('".$K_PEGAWAI."', '".$NO_SK."')";
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
        
        $RawQuery = "SELECT * FROM DB2ADMIN.RIWAYAT_HONORER WHERE NO_SK = '$NO_SK'";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
            $IsDuplicateNoSk = true;
        }
        
        return $IsDuplicateNoSk;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SK) {
        $Data = $this->GetExist('', '');
        
        $RawQuery = "CALL DB2ADMIN.DELRWYTHONORER('".$K_PEGAWAI."', '".$NO_SK."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Error'] = '';
        $Data['Message'] = 'Data Riwayat Honorer berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
	
	/* Region File */
	
	function UpdateFile($Param) {
		$Param['NO_URUT'] = ($Param['NO_URUT'] == 'x') ? '0' : $Param['NO_URUT'];
		
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.INSUPDRIWAYATHONORERFILE(
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
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATHONORERFILE('".$Param['K_PEGAWAI']."', '".$Param['NO_SK']."', '".$Param['NO_URUT']."')";
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
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATHONORERFILE(
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