<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Keluarga {
    var $CI = null;
    
    function LRiwayat_Keluarga() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'RiwayatKeluarga',
            'PageTitle' => 'Riwayat Keluarga'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $Path = 'RiwayatKeluarga') {
        $Array = array();
        
        $Counter = 0;
		$RawQuery = "CALL DB2ADMIN.GETRWYTKLUARGABYID('$K_PEGAWAI', '')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        while ($Row = db2_fetch_assoc($Query)) {
            $Row['KeluargaID'] = $Row['ID'];
            
            $Array[$Counter] = $Row;
            $Array[$Counter]['LinkEdit'] = HOST.'/index.php/'.$Path.'/Ubah/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['KeluargaID']);
            $Array[$Counter]['LinkDelete'] = HOST.'/index.php/'.$Path.'/Hapus/'.ConvertLink($K_PEGAWAI).'/'.ConvertLink($Row['KeluargaID']);
            $Counter++;
        }
        
        return $Array;
    }
    
    function SimpegUpdate($K_PEGAWAI, $KeluargaID) {
        $Data = $this->GetExist($K_PEGAWAI, $KeluargaID);
        $Data['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($KeluargaID)) ? 'update' : 'insert';
        $Data['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $Data['ShowGrid'] = (!empty($Tambah) || $Data['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $Data['K_PEGAWAI'] = $K_PEGAWAI;
            $Data['KeluargaID'] = $this->CI->input->post('KeluargaID');
            $Data['NAMA'] = $this->CI->input->post('NAMA');
            $Data['K_KELUARGA'] = $this->CI->input->post('K_KELUARGA');
            $Data['TGL_NIKAH'] = $this->CI->input->post('TGL_NIKAH');
            $Data['TGL_LAHIR'] = $this->CI->input->post('TGL_LAHIR');
            $Data['TMP_LAHIR'] = $this->CI->input->post('TMP_LAHIR');
            $Data['ALAMAT'] = $this->CI->input->post('ALAMAT');
            $Data['K_JENJANG'] = $this->CI->input->post('K_JENJANG');
            $Data['PEKERJAAN'] = $this->CI->input->post('PEKERJAAN');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['KARTU_NIKAH'] = $this->CI->input->post('KARTU_NIKAH');
            $Data['PENDIDIKAN_AKHIR'] = $this->CI->input->post('PENDIDIKAN_AKHIR');
            $Data['KARIS'] = $this->CI->input->post('KARIS');
            $Data['KELAMIN'] = $this->CI->input->post('KELAMIN');
            $Data['IS_ALM'] = $this->CI->input->post('IS_ALM');
            $Data['IS_CERAI'] = $this->CI->input->post('IS_CERAI');
            $Data['Error'] = '';
			
            $Data['TGL_NIKAH'] = (empty($Data['TGL_NIKAH'])) ? 'x' : ChangeFormatDate($Data['TGL_NIKAH']);
            $Data['TGL_LAHIR'] = (empty($Data['TGL_LAHIR'])) ? 'x' : ChangeFormatDate($Data['TGL_LAHIR']);
            
            // Validation
            $Validation = 'pass';
            if (empty($Data['NAMA'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'Nama belum di isi.';
            }
            
            if ($Validation == 'false') {
                $Data['ShowGrid'] = '0';
                $Data['ParameterUpdate'] = $ParameterUpdate;
            }
            
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRWYTKELUARGA(
                        '".$Data['K_PEGAWAI']."', '".$Data['KeluargaID']."', '".$Data['NAMA']."', '".$Data['K_KELUARGA']."',
                        '".$Data['TGL_NIKAH']."', '".$Data['TGL_LAHIR']."', '".$Data['TMP_LAHIR']."', 
                        '".$Data['ALAMAT']."', '".$Data['K_JENJANG']."', '".$Data['PEKERJAAN']."',
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$Data['KARTU_NIKAH']."',
                        '".$Data['PENDIDIKAN_AKHIR']."', '".$Data['KELAMIN']."',
                        '".$Data['IS_ALM']."', '".$Data['IS_CERAI']."'
					)
				";
				
				WriteLog($Data['K_PEGAWAI'], $RawQuery);
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.INSUPDRWYTKELUARGA(
                        '".$Data['K_PEGAWAI']."', '".$Data['KeluargaID']."', '".$Data['NAMA']."', '".$Data['K_KELUARGA']."',
                        '".$Data['TGL_NIKAH']."', '".$Data['TGL_LAHIR']."', '".$Data['TMP_LAHIR']."', 
                        '".$Data['ALAMAT']."', '".$Data['K_JENJANG']."', '".$Data['PEKERJAAN']."',
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."', '".$Data['KARTU_NIKAH']."',
                        '".$Data['PENDIDIKAN_AKHIR']."', '".$Data['KELAMIN']."',
                        '".$Data['IS_ALM']."', '".$Data['IS_CERAI']."'
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
                        $Data['Message'] = $Message;
                    } else {
                        $Data['Error'] = '00001';
                        $Data['ShowGrid'] = '0';
                        $Data['Message'] = 'Error.';
                        $Data['ParameterUpdate'] = $ParameterUpdate;
						
						WriteLogErrorQuery($RawQuery.' - '.$QueryMessage);
                    }
                }
            }
        }
        
        return $Data;
    }
    
    function GetExist($K_PEGAWAI, $KeluargaID) {
        $Data = array(
            'K_PEGAWAI' => '',
            'KeluargaID' => '',
            'NAMA' => '',
            'K_KELUARGA' => '',
            'TGL_NIKAH' => '',
            'TGL_LAHIR' => '',
            'TMP_LAHIR' => '',
            'ALAMAT' => '',
            'K_JENJANG' => '',
            'PEKERJAAN' => '',
            'KETERANGAN' => '',
            'KARTU_NIKAH' => '',
            'PENDIDIKAN_AKHIR' => '',
            'KARIS' => '',
            'KELAMIN' => '',
            'IS_ALM' => ''
        );
		
        if (!empty($K_PEGAWAI) && !empty($KeluargaID)) {
            $RawQuery = "
                SELECT *
                FROM DB2ADMIN.RIWAYAT_KELUARGA
                WHERE
                    K_PEGAWAI = '$K_PEGAWAI'
                    AND ID = $KeluargaID";
            
			$RawQuery = "CALL DB2ADMIN.GETRWYTKLUARGABYID('$K_PEGAWAI', '$KeluargaID')";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
                $Data = $Row;
                $Data['KeluargaID'] = $Row['ID'];
            }
        }
        
        return $Data;
    }
    
    function SimpegDelete($K_PEGAWAI, $KeluargaID) {
        $Data = $this->GetExist('', '', '');
        
        $RawQuery = "CALL DB2ADMIN.DELRWYTKELUARGA('".$K_PEGAWAI."', '".$KeluargaID."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Error'] = '';
        $Data['Message'] = 'Data Riwayat Keluarga berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
}
?>