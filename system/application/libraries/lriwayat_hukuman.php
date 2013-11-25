<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Hukuman {
    var $CI = null;
    
    function LRiwayat_Hukuman() {
        $this->CI =& get_instance();
    }
    
    function GetProperty($Param) {
		$Array = array( 'PageName' => 'RiwayatHukuman', 'PageTitle' => 'Riwayat Hukuman' );
		
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $NO_URUT = '') {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATHUKBYKEY('".$K_PEGAWAI."', '".$NO_URUT."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Row['NO_URUT']] = $Row;
            $Array[$Row['NO_URUT']]['LinkEdit'] = HOST.'/index.php/RiwayatHukuman/Ubah/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['NO_URUT']);
            $Array[$Row['NO_URUT']]['LinkDelete'] = HOST.'/index.php/RiwayatHukuman/Hapus/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['NO_URUT']);
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
			$Record['ID_HUKUMAN'] = $this->CI->input->post('ID_HUKUMAN');
			$Record['NO_SK'] = $this->CI->input->post('NO_SK');
            $Record['TGL_SK'] = $this->CI->input->post('TGL_SK');
            $Record['TMT'] = $this->CI->input->post('TMT');
            $Record['NIP_PEJABAT'] = $this->CI->input->post('NIP_PEJABAT');
            $Record['NAMA_PEJABAT'] = $this->CI->input->post('NAMA_PEJABAT');
			
            $Record['TGL_SK'] = (empty($Record['TGL_SK'])) ? '' : ChangeFormatDate($Record['TGL_SK']);
            $Record['TMT'] = (empty($Record['TMT'])) ? '' : ChangeFormatDate($Record['TMT']);
            
			$RawQuery = "CALL DB2ADMIN.INSUPDRIWHUKUMAN(
				'".$Record['K_PEGAWAI']."', '".$Record['NO_URUT']."', '".$Record['ID_HUKUMAN']."',
				'".$Record['NO_SK']."', '".$Record['TGL_SK']."', '".$Record['TMT']."', 
				'".$Record['NIP_PEJABAT']."', '".$Record['NAMA_PEJABAT']."', '".$this->CI->session->UserLogin['UserID']."'
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
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATHUKUMAN('".$K_PEGAWAI."', '".$NO_URUT."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Message'] = 'Data Riwayat Hukuman berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
}
?>
