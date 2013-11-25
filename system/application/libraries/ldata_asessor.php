<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LData_Asessor {
    var $CI = null;
    
    function LData_Asessor() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'DataAsessor',
            'PageTitle' => 'Data Asessor'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI) {
        $Result = array();
        
        $Query = db2_prepare($this->CI->ldb2->Handle, "CALL EKD.GETRWYTASESOR('".$K_PEGAWAI."')");
        db2_execute($Query);
        
        $Counter = 0;
        while ($Row = db2_fetch_assoc($Query)) {
            $Result[$Counter] = $Row;
            $Result[$Counter]['K_ASESOR_I'] = $Row['K_ASESOR1'];
            $Result[$Counter]['K_ASESOR_I_NAME'] = $Row['NAMA1'];
            $Result[$Counter]['K_ASESOR_II'] = $Row['K_ASESOR2'];
            $Result[$Counter]['K_ASESOR_II_NAME'] = $Row['NAMA2'];
			$Result[$Counter]['SEMESTER'] = ($Result[$Counter]['IS_GANJIL'] == '1') ? 'Ganjil' : 'Genap';
            $Result[$Counter]['LinkEdit'] = HOST.'/index.php/DataAsessor/Ubah/'.ConvertLink($K_PEGAWAI).'/'.$Row['THN_AKADEMIK'].'/'.$Row['IS_GANJIL'];
            $Result[$Counter]['LinkDelete'] = HOST.'/index.php/DataAsessor/Hapus/'.ConvertLink($K_PEGAWAI).'/'.$Row['THN_AKADEMIK'].'/'.$Row['IS_GANJIL'];
            
            unset($Result[$Counter]['K_ASESOR1']);
            unset($Result[$Counter]['NAMA1']);
            unset($Result[$Counter]['K_ASESOR2']);
            unset($Result[$Counter]['NAMA2']);
            
            $Counter++;
        }
        
        return $Result;
    }
    
    function SimpegUpdate($K_PEGAWAI, $THN_AKADEMIK, $IS_GANJIL) {
        $DataAsessor = $this->GetExistData($K_PEGAWAI, $THN_AKADEMIK, $IS_GANJIL);
        $DataAsessor['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($THN_AKADEMIK) && $IS_GANJIL != '') ? 'update' : 'insert';
        $DataAsessor['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $DataAsessor['ShowGrid'] = (!empty($Tambah) || $DataAsessor['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $DataAsessor['K_PEGAWAI'] = $K_PEGAWAI;
            $DataAsessor['THN_AKADEMIK'] = $this->CI->input->post('THN_AKADEMIK');
            $DataAsessor['IS_GANJIL'] = $this->CI->input->post('IS_GANJIL');
            $DataAsessor['K_ASESOR_I'] = $this->CI->input->post('K_ASESOR_I');
            $DataAsessor['K_ASESOR_I_NAME'] = $this->CI->input->post('K_ASESOR_I_NAME');
            $DataAsessor['K_ASESOR_II'] = $this->CI->input->post('K_ASESOR_II');
            $DataAsessor['K_ASESOR_II_NAME'] = $this->CI->input->post('K_ASESOR_II_NAME');
            $DataAsessor['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            
            if ($ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL EKD.INSRWYTASESOR(
                        '".$DataAsessor['K_PEGAWAI']."', '".$DataAsessor['THN_AKADEMIK']."', '".$DataAsessor['IS_GANJIL']."',
                        '".$DataAsessor['K_ASESOR_I']."', '".$DataAsessor['K_ASESOR_II']."', '".$DataAsessor['KETERANGAN']."',
                        '".$this->CI->session->UserLogin['UserID']."')
                    ";
                
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            } else {
                $RawQuery = "
                    CALL EKD.UPDRWYTASESOR(
                        '".$DataAsessor['K_PEGAWAI']."', '".$DataAsessor['THN_AKADEMIK']."', '".$DataAsessor['IS_GANJIL']."',
                        '".$DataAsessor['K_ASESOR_I']."', '".$DataAsessor['K_ASESOR_II']."', '".$DataAsessor['KETERANGAN']."',
                        '".$this->CI->session->UserLogin['UserID']."')
                    ";
                
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            }
            
            if ($Row = db2_fetch_assoc($Query)) {
                $RawQuery = preg_replace('/\s+/i', ' ', trim($RawQuery));
                $DataAsessor['Message'] = $Row['MSG'];
                $DataAsessor['QueryMessage'] = $Row['ERROR'];
                $DataAsessor['RawQuery'] = $RawQuery;
                
                if ($DataAsessor['QueryMessage'] == '00000') {
                } else {
                    $DataAsessor['ShowGrid'] = '0';
                    $DataAsessor['ParameterUpdate'] = $ParameterUpdate;
                    
                    WriteLogErrorQuery($RawQuery.' - '.$DataAsessor['QueryMessage']);
                }
            }
        }
        
        return $DataAsessor;
    }
    
    function UpdateSingleAsessor($Param = array()) {
        $RawQuery = "
            CALL EKD.INSASESOR(
                '".$Param['K_PEGAWAI']."', '".$Param['THN_AKADEMIK']."', '".$Param['IS_GANJIL']."',
                '".$Param['K_ASESOR_I']."', '".$Param['ASESOR_KE']."', '".$this->CI->session->UserLogin['UserID']."')
            ";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $ResultQuery = array();
        if ($Row = db2_fetch_assoc($Query)) {
            $RawQuery = preg_replace('/\s+/i', ' ', trim($RawQuery));
            $ResultQuery['Message'] = $Row['MSG'];
            $ResultQuery['QueryMessage'] = $Row['ERROR'];
            $ResultQuery['RawQuery'] = $RawQuery;
        }
        
        return $ResultQuery;
    }
    
    function GetExistData($K_PEGAWAI, $THN_AKADEMIK, $IS_GANJIL) {
        $Array = array(
            'K_PEGAWAI' => '',
            'THN_AKADEMIK' => '',
            'IS_GANJIL' => '',
            'K_ASESOR_I' => '',
            'K_ASESOR_I_NAME' => '',
            'K_ASESOR_II' => '',
            'K_ASESOR_II_NAME' => '',
            'KETERANGAN' => ''
        );
        
        $ArrayData = $this->GetArray($K_PEGAWAI);
        foreach ($ArrayData as $Key => $Element) {
            if ($K_PEGAWAI == $Element['K_PEGAWAI'] && $THN_AKADEMIK == $Element['THN_AKADEMIK'] && $IS_GANJIL == $Element['IS_GANJIL']) {
                $Array = $ArrayData[$Key];
                break;
            }
        }
        
        return $Array;
    }
    
    function SimpegDelete($K_PEGAWAI, $THN_AKADEMIK, $IS_GANJIL) {
        $RawQuery = "CALL EKD.DELRWYTASESOR('".$K_PEGAWAI."', '".$THN_AKADEMIK."', '".$IS_GANJIL."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        if ($Row = db2_fetch_assoc($Query)) {
            $DataAsessor['Error'] = $Row['ERROR'];
            $DataAsessor['Message'] = $Row['MSG'];
        }
        
        $DataAsessor['ParameterUpdate'] = 'insert';
        $DataAsessor['ShowGrid'] = '1';
        
        return $DataAsessor;
    }
    
    function GetArrayDosenAsessor($NamaAsessor) {
        if (empty($NamaAsessor)) {
            return array();
        }
        
        $Array = array();
        $RawQuery = "CALL EKD.GETDOSENASASESOR('$NamaAsessor')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[] = array(
                'Nip' => $Row['K_PEGAWAI'],
                'Name' => $Row['NAMA']
            );
        }
        
        return $Array;
    }
    
    function GetContentListDosenAsessor($ArrayDosen) {
        $Content = '';
        $LimitLecture = 20;
        foreach ($ArrayDosen as $Key => $Array) {
            $Content .= '
                <div class="Record">
                    <div style="float: left; width: 200px;">'.$Array['Nip'].'</div>
                    <div style="float: left; width: 250px;">'.$Array['Name'].'</div>
                    <div class="clear"></div>
                </div>
            ';
            
            $LimitLecture--;
            if ($LimitLecture < 0) {
                break;
            }
        }
        
        if (!empty($Content)) {
            $Content = '
                <div style="text-align: center;">
                    <div style="float: left; width: 200px; font-weight: 700;">NIP</div>
                    <div style="float: left; width: 250px; font-weight: 700;">Nama</div>
                    <div class="clear"></div>
                    '.$Content.'
                </div>';
        } else {
            $Content = '<div style="color: #FF0000;">Pencarian asessor tidak ditemukan.</div>';
        }
        
        return $Content;
    }
}
?>