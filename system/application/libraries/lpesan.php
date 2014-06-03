<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPesan {
    var $CI = null;
    
    function LPesan() {
        $this->CI =& get_instance();
    }
    
	function Insert($Param) {
		$Result = array();
        $RawQuery = "
			CALL EKD.INSREQUEST(
				'".$Param['K_PEGAWAI']."', '".$Param['ID_REQUEST']."', '".$Param['PESAN']."',
				'".$this->CI->session->UserLogin['UserID']."'
			)
		";
        $QueryInsert = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $ResultInsert = db2_execute($QueryInsert) or die(db2_stmt_errormsg($QueryInsert));
        
        if ($Row = db2_fetch_assoc($QueryInsert)) {
            $Result['Query'] = trim($Row['ERROR']);
        }
		
        return $Result;
	}
	
    function GetProperty() {
        $Return = array('PageName' => 'Pesan', 'PageTitle' => 'Pesan');
        return $Return;
    }
    
    function GetArray($param) {
        $ArrayList = array();
        $Date = (isset($param['Date']) && !empty($param['Date'])) ? ChangeFormatDate($param['Date']) : 'x';
        $PageActive = (isset($param['PageActive'])) ? $param['PageActive'] : '1';
        $SearchType = (isset($param['SearchType']) && !empty($param['SearchType'])) ? $param['SearchType'] : 'SearchByDate';
        $K_PEGAWAI = (isset($param['K_PEGAWAI'])) ? $param['K_PEGAWAI'] : '';
        $param['K_UNIT_KERJA'] = (isset($param['K_UNIT_KERJA'])) ? $param['K_UNIT_KERJA'] : 'x';
        
        if ($SearchType == 'SearchByDate') {
            $RawQuery = "CALL EKD.GETREQUESTBYDATE('".$Date."', '".$param['K_UNIT_KERJA']."')";
        } else {
            $RawQuery = "CALL EKD.GETREQUESTBYKPEG('".$K_PEGAWAI."')";
        }
        
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            if ($SearchType == 'SearchByNip') {
                $Row['SENDER'] = $K_PEGAWAI;
            }
            
            $ArrayWaktu = ConvertDateToArrayExt($Row['WAKTU'], true);
            $Row['WAKTU'] = $ArrayWaktu['Day'].'-'.$ArrayWaktu['Month'].'-'.$ArrayWaktu['Year'].' '.$ArrayWaktu['Hour'].':'.$ArrayWaktu['Minute'];
            $Nip = preg_replace('/[^0-9]/i', '', $Row['SENDER']);
            
            $Row['LinkPegawaiData'] = (empty($Nip)) ? '' : HOST.'/index.php/Pegawai/Tambah/'.ConvertLink($Nip);
            $Row['LinkPegawaiPesan'] = (empty($Nip)) ? '' : HOST.'/index.php/Pesan/Sender/'.ConvertLink($Nip);
            
            $ArrayList[] = $Row;
        }
        
        $PageOffset = 25;
        $PageStart = ($PageActive - 1) * $PageOffset;
        $PageEnd = $PageStart + $PageOffset;
        
        $Array = array();
        $Array['List'] = GetPageFromArray($ArrayList, $PageStart, $PageEnd);
        $Array['PageActive'] = $PageActive;
        $Array['PageCount'] = ceil(count($ArrayList) / $PageOffset);
        $Array['SearchDate'] = ($Date == 'x') ? '' : ChangeFormatDate($Date);
        
        return $Array;
    }
	
	function GetMessageReply($Param) {
		$ArrayMessage = array();
		$RawQuery = "CALL EKD.GETANSWERBYID('".$Param['ID_REQUEST']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
			$ArrayMessage[] = $Row;
        }
		return $ArrayMessage;
	}
	
	function Action($Param) {
		if ($Param['Action'] == 'ReplayComment') {
			$Result = $this->Insert($Param);
			echo json_encode($Result);
			exit;
		} else if ($Param['Action'] == 'GetMessageReply') {
			$ArrayMessage = $this->GetMessageReply(array('ID_REQUEST' => $_POST['ID_REQUEST']));
			echo json_encode($ArrayMessage);
			exit;
		}
	}
}
?>