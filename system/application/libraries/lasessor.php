<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LAsessor {
    var $CI = null;
    
    function LAsessor() {
        $this->CI =& get_instance();
    }
    
    function Update($Data) {
        $DataResult = array(
                'Message' => 'Error.',
                'Status' => '0'
            );
        
        $RawQuery = "CALL EKD.EKDINSUPDDSNASESOR(
            '".$Data['NIP']."', '".$Data['THN_AKAD']."', '".$Data['IS_GJL']."',
            '".$Data['K_ASS']."', '".$Data['ASS_KE']."', '".$Data['KTR']."',
            '".$this->CI->session->UserLogin['UserID']."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        if ($Row = db2_fetch_assoc($Query)) {
            $ResultQuery = trim($Row['ERROR']);
            
            if ($ResultQuery == 'x') {
                $DataResult['Status'] = '0';
                $DataResult['Message'] = 'Update gagal, NIP Asesor tidak sesuai.';
            } else {
                $DataResult['Status'] = '1';
                $DataResult['Message'] = 'Data Asessor berhasil diperbaharui.';
            }
        }
        
        return $DataResult;
    }
}
?>