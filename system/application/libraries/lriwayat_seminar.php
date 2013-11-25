<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Seminar {
    var $CI = null;
    
    function LRiwayat_Seminar() {
        $this->CI =& get_instance();
    }
    
    function GetProperty($Param) {
		$Array = array( 'PageName' => 'RiwayatSeminar', 'PageTitle' => 'Riwayat Seminar' );
		
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $NO_URUT = 'x') {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATSEMNBYKEY('".$K_PEGAWAI."', '".$NO_URUT."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Row['NO_URUT']] = $Row;
            $Array[$Row['NO_URUT']]['LinkEdit'] = HOST.'/index.php/RiwayatSeminar/Ubah/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['NO_URUT']);
            $Array[$Row['NO_URUT']]['LinkDelete'] = HOST.'/index.php/RiwayatSeminar/Hapus/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['NO_URUT']);
        }
        
        return $Array;
    }
    
    function SimpegUpdate($K_PEGAWAI, $NO_URUT) {
		$Data = array();
        $Submit = $this->CI->input->post('Submit');
        if (!empty($Submit)) {
            $Record['K_PEGAWAI'] = $K_PEGAWAI;
			
            $Record['NO_URUT'] = $this->CI->input->post('NO_URUT_HI');
			$Record['NO_URUT'] = (empty($Record['NO_URUT'])) ? $Record['NO_URUT'] : RestoreLink($Record['NO_URUT']);
			$Record['TAHUN'] = $this->CI->input->post('TAHUN');
            $Record['NAMA'] = $this->CI->input->post('NAMA');
            $Record['LOKASI'] = $this->CI->input->post('LOKASI');
            $Record['TINGKAT'] = $this->CI->input->post('TINGKAT');
            $Record['PENYELENGGARA'] = $this->CI->input->post('PENYELENGGARA');
            $Record['ID_KEDUDUKAN'] = $this->CI->input->post('ID_KEDUDUKAN');
			
			$RawQuery = "CALL DB2ADMIN.INSUPDRWYTSMNR(
				'".$Record['K_PEGAWAI']."', '".$Record['NO_URUT']."', ".$Record['TAHUN'].",
				'".$Record['NAMA']."', '".$Record['LOKASI']."', '".$Record['TINGKAT']."',
				'".$Record['PENYELENGGARA']."', '".$Record['ID_KEDUDUKAN']."', '".$this->CI->session->UserLogin['UserID']."'
			)";
			WriteLog($Record['K_PEGAWAI'], $RawQuery);
			$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
			$Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
			if ($Row = db2_fetch_assoc($Query)) {
				$QueryMessage = $Row['ERROR'];
				
				if ($QueryMessage == '00000') {
					$Data['Message'] = 'Data berhasil disimpan.';
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
    
    function SimpegDelete($K_PEGAWAI, $NO_URUT) {
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATSMNR('".$K_PEGAWAI."', '".$NO_URUT."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Message'] = 'Data Riwayat Seminar berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
}
?>
