<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Organisasi {
    var $CI = null;
    
    function LRiwayat_Organisasi() {
        $this->CI =& get_instance();
    }
    
    function GetProperty($Param) {
		$Array = array( 'PageName' => 'RiwayatOrganisasi', 'PageTitle' => 'Riwayat Organisasi' );
		
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $NO_URUT = 'x') {
        $Array = array();
        
        $RawQuery = "CALL DB2ADMIN.GETRIWAYATORGBYKEY('".$K_PEGAWAI."', '".$NO_URUT."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Row['NO_URUT']] = $Row;
            $Array[$Row['NO_URUT']]['LinkEdit'] = HOST.'/index.php/RiwayatOrganisasi/Ubah/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['NO_URUT']);
            $Array[$Row['NO_URUT']]['LinkDelete'] = HOST.'/index.php/RiwayatOrganisasi/Hapus/' . ConvertLink($Row['K_PEGAWAI']) . '/' . ConvertLink($Row['NO_URUT']);
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
			$Record['NAMA'] = $this->CI->input->post('NAMA');
            $Record['KEDUDUKAN'] = $this->CI->input->post('KEDUDUKAN');
            $Record['TGL_MULAI'] = $this->CI->input->post('TGL_MULAI');
            $Record['TGL_SELESAI'] = $this->CI->input->post('TGL_SELESAI');
            $Record['NO_SK'] = $this->CI->input->post('NO_SK');
            $Record['NIP_PEJABAT'] = $this->CI->input->post('NIP_PEJABAT');
            $Record['NAMA_PEJABAT'] = $this->CI->input->post('NAMA_PEJABAT');
            $Record['JABATAN_PEJABAT'] = $this->CI->input->post('JABATAN_PEJABAT');
			
            $Record['TGL_MULAI'] = (empty($Record['TGL_MULAI'])) ? '' : ChangeFormatDate($Record['TGL_MULAI']);
            $Record['TGL_SELESAI'] = (empty($Record['TGL_SELESAI'])) ? '' : ChangeFormatDate($Record['TGL_SELESAI']);
            
			$RawQuery = "CALL DB2ADMIN.INSUPDRIWORG(
				'".$Record['K_PEGAWAI']."', '".$Record['NO_URUT']."', '".$Record['NAMA']."',
				'".$Record['KEDUDUKAN']."', '".$Record['TGL_MULAI']."', '".$Record['TGL_SELESAI']."', 
				'".$Record['NO_SK']."', '".$Record['NIP_PEJABAT']."', '".$Record['NAMA_PEJABAT']."',
				'".$Record['JABATAN_PEJABAT']."', '".$this->CI->session->UserLogin['UserID']."'
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
    
    function SimpegDelete($K_PEGAWAI, $NO_URUT) {
        $RawQuery = "CALL DB2ADMIN.DELRIWAYATORG('".$K_PEGAWAI."', '".$NO_URUT."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Message'] = 'Data Riwayat Organisasi berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
}
?>
