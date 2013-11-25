<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Home_Base {
    var $CI = null;
    
    function LRiwayat_Home_Base() {
        $this->CI =& get_instance();
		
		$this->PathName = '/images/RiwayatHomeBase/';
    }
    
    function GetProperty($Param) {
		$Array = array( 'PageName' => 'RiwayatHomeBase', 'PageTitle' => 'Riwayat Home Base' );
		
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $ID_RIWAYAT_HOMEBASE = 'x') {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRWYTHOMEBASE('".$ID_RIWAYAT_HOMEBASE."', '".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Row['ID_RIWAYAT_HOMEBASE']] = $Row;
            $Array[$Row['ID_RIWAYAT_HOMEBASE']]['LinkEdit'] = HOST.'/index.php/RiwayatHomeBase/Ubah/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['ID_RIWAYAT_HOMEBASE']);
            $Array[$Row['ID_RIWAYAT_HOMEBASE']]['LinkDelete'] = HOST.'/index.php/RiwayatHomeBase/Hapus/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['ID_RIWAYAT_HOMEBASE']);
        }
        
        return $Array;
    }
    
    function SimpegUpdate($K_PEGAWAI, $ID_RIWAYAT_HOMEBASE) {
		$Data = array();
        $Submit = $this->CI->input->post('Submit');
        if (!empty($Submit)) {
            $Record['K_PEGAWAI'] = $K_PEGAWAI;
			
            $Record['ID_RIWAYAT_HOMEBASE'] = $this->CI->input->post('ID_RIWAYAT_HOMEBASE_HI');
			$Record['ID_RIWAYAT_HOMEBASE'] = (empty($Record['ID_RIWAYAT_HOMEBASE'])) ? $Record['ID_RIWAYAT_HOMEBASE'] : RestoreLink($Record['ID_RIWAYAT_HOMEBASE']);
			$Record['NO_SK'] = $this->CI->input->post('NO_SK');
            $Record['TGL_SK'] = $this->CI->input->post('TGL_SK');
            $Record['K_ASAL_SK'] = $this->CI->input->post('K_ASAL_SK');
            $Record['TMT'] = $this->CI->input->post('TMT');
            $Record['K_UNIT_KERJA'] = $this->CI->input->post('K_UNIT_KERJA');
            $Record['K_JABATAN_FUNGSIONAL'] = $this->CI->input->post('K_JABATAN_FUNGSIONAL');
            $Record['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
            $Record['K_FAKULTAS'] = $this->CI->input->post('K_FAKULTAS');
            $Record['K_JURUSAN'] = $this->CI->input->post('K_JURUSAN');
            $Record['K_PROG_STUDI'] = $this->CI->input->post('K_PROG_STUDI');
            $Record['IS_PDPT'] = $this->CI->input->post('IS_PDPT');
            $Record['IS_SIMPEG'] = $this->CI->input->post('IS_SIMPEG');
			
            $Record['TGL_SK'] = (empty($Record['TGL_SK'])) ? '' : ChangeFormatDate($Record['TGL_SK']);
            $Record['TMT'] = (empty($Record['TMT'])) ? '' : ChangeFormatDate($Record['TMT']);
            
			$RawQuery = "CALL DB2ADMIN.INSUPDRWYTHOMEBASE(
				'".$Record['ID_RIWAYAT_HOMEBASE']."', '".$Record['K_PEGAWAI']."', '".$Record['NO_SK']."',
				'".$Record['TGL_SK']."', '".$Record['K_ASAL_SK']."', '".$Record['TMT']."', 
				'".$Record['K_UNIT_KERJA']."', '".$Record['K_JENJANG']."', 
				'".$Record['K_FAKULTAS']."', '".$Record['K_JURUSAN']."', '".$Record['K_PROG_STUDI']."', 
				'".$this->CI->session->UserLogin['UserID']."', '".$Record['IS_PDPT']."', '".$Record['IS_SIMPEG']."'
			)";
			
			WriteLog($Record['K_PEGAWAI'], $RawQuery);
			$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
			$Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
			if ($Row = db2_fetch_assoc($Query)) {
				$QueryMessage = $Row['ERROR'];
				
				if ($QueryMessage == '00000') {
					$Data['Message'] = 'Data berhasil ditambahkan.';
				} else {
					$Data['ShowGrid'] = '0';
					$Data['Message'] = 'Error.';
					$Data['Error'] = '00001';
					$Data['Record'] = $Record;
					
					WriteLogErrorQuery($RawQuery.' - '.$QueryMessage);
				}
			}
        }
        
        return $Data;
    }
    
    function SimpegDelete($ID_RIWAYAT_HOMEBASE) {
        $RawQuery = "CALL DB2ADMIN.DELRWYTHOMEBASE('".$ID_RIWAYAT_HOMEBASE."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Message'] = 'Data Riwayat Home Base berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
	
	/* Region File */
	
	function UpdateFile($Param) {
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.INSUPDRHOMEBASEFILE(
			'x', '".$Param['ID_RIWAYAT_HOMEBASE']."', '".$Param['FILENAME']."', '".$Param['USERID']."'
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
        $RawQuery = "CALL DB2ADMIN.GETRHOMEBASEFILE('x', '".$Param['ID_RIWAYAT_HOMEBASE']."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        while (false !== $Row = db2_fetch_assoc($Query)) {
			$Counter++;
			$Row['NameFile'] = ' File ke ' . $Counter;
			$Row['LinkFile'] = HOST . $this->PathName . $Row['FILENAME'];
			$ArrayFile[] = $Row;
        }
		
		return $ArrayFile;
	}
	
	function DeleteFile($Param) {
		$FilePath = PATH . $this->PathName . $Param['FILENAME'];
		@unlink($FilePath);
		
		$Result = array();
        $RawQuery = "CALL DB2ADMIN.DELRHOMEBASEFILE('".$Param['ID_RIWAYAT_HOMEBASE_FILE']."')";
		
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        if ($Row = db2_fetch_assoc($Query)) {
			$Result = $Row;
			
			if ($Result['ERROR'] == '00000' || $Result['ERROR'] == '56098') {
				$Result['MSG'] = 'Data berhasil dihapus';
			}
        }
		
		return $Result;
	}
	
	/* Region End File */
}
?>
