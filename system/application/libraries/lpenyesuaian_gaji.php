<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LPenyesuaian_Gaji {
    var $CI = null;
    
    function LPenyesuaian_Gaji() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'PenyesuaianGaji',
            'PageTitle' => 'Impasing / Penyesuaian Gaji Pokok'
        );
        return $Array;
    }
    
    function GetArray($K_PEGAWAI, $Path = 'PenyesuaianGaji') {
        $Array = array();
        
        $Counter = 0;
        $RawQuery = "CALL DB2ADMIN.GETRWYTSERTBYID('".$K_PEGAWAI."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Query);
        
        while ($Row = db2_fetch_assoc($Query)) {
            $Array[$Counter] = $Row;
            $Array[$Counter]['LinkEdit'] = HOST.'/index.php/'.$Path.'/Ubah/'.$K_PEGAWAI.'/'.ConvertLink($Row['NO_SERTIFIKAT']).'/'.ConvertLink($Row['NO_PESERTA']);
            $Array[$Counter]['LinkDelete'] = HOST.'/index.php/'.$Path.'/Hapus/'.$K_PEGAWAI.'/'.ConvertLink($Row['NO_SERTIFIKAT']).'/'.ConvertLink($Row['NO_PESERTA']);
            $Counter++;
        }
        
        return $Array;
    }
    
    function SimpegUpdate($K_PEGAWAI, $NO_SK) {
        $Data = $this->GetExist($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA);
        $Data['ParameterUpdate'] = (!empty($K_PEGAWAI) && !empty($NO_SERTIFIKAT) && !empty($NO_PESERTA)) ? 'update' : 'insert';
        $Data['Error'] = '';
        
        $Tambah = $this->CI->input->post('Tambah');
        $Submit = $this->CI->input->post('Submit');
        $ParameterUpdate = $this->CI->input->post('ParameterUpdate');
        $Data['ShowGrid'] = (!empty($Tambah) || $Data['ParameterUpdate'] == 'update') ? '0' : '1';
        
        if (!empty($Submit)) {
            $Data['K_PEGAWAI'] = $K_PEGAWAI;
            $Data['NO_SERTIFIKAT'] = $this->CI->input->post('NO_SERTIFIKAT');
            $Data['NO_PESERTA'] = $this->CI->input->post('NO_PESERTA');
            $Data['TGL_SERTIFIKAT'] = $this->CI->input->post('TGL_SERTIFIKAT');
            $Data['ASAL_INSTITUSI'] = $this->CI->input->post('ASAL_INSTITUSI');
            $Data['PEJABAT_TT'] = $this->CI->input->post('PEJABAT_TT');
            $Data['RUMPUN_ILMU'] = $this->CI->input->post('RUMPUN_ILMU');
            $Data['TUNJANGAN_SERTIFIKASI'] = $this->CI->input->post('TUNJANGAN_SERTIFIKASI');
            $Data['TGL_AKHIR'] = $this->CI->input->post('TGL_AKHIR');
            $Data['KETERANGAN'] = $this->CI->input->post('KETERANGAN');
            $Data['Error'] = '';
            
            $Data['TGL_SERTIFIKAT'] = (empty($Data['TGL_SERTIFIKAT'])) ? '' : ChangeFormatDate($Data['TGL_SERTIFIKAT']);
            $Data['TGL_AKHIR'] = (empty($Data['TGL_AKHIR'])) ? '' : ChangeFormatDate($Data['TGL_AKHIR']);
            
            // Validation
            $Validation = 'pass';
            if (empty($Data['NO_SERTIFIKAT'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'No Sertifikat belum di isi.';
            } else if (empty($Data['NO_PESERTA'])) {
                $Validation = 'false';
                $Data['Error'] = '00001';
                $Data['Message'] = 'No Peserta belum di isi.';
            }
            
            if ($Validation == 'false') {
                $Data['ShowGrid'] = '0';
                $Data['ParameterUpdate'] = $ParameterUpdate;
            }
            
            // Upload Certificate
            if (isset($_FILES) && isset($_FILES['Image']) && isset($_FILES['Image']['name']) && !empty($_FILES['Image']['name'])) {
                $File = array(
                    'Path' => PATH.'/images/CertificateCertification/',
                    'Name' => md5($Data['K_PEGAWAI'] . $Data['NO_SERTIFIKAT'] . $Data['NO_PESERTA'] . SALT),
                    'Extention' => strtolower(GetExtention($_FILES['Image']['name']))
                );
                
                $ResultUpdate = Upload($File);
                $Data['Certificate'] = $this->GetCertificateByID($Data['K_PEGAWAI'], $Data['NO_SERTIFIKAT'], $Data['NO_PESERTA']);
            }
            
            $Message = '';
            if ($Validation == 'pass' && $ParameterUpdate == 'insert') {
                $RawQuery = "
                    CALL DB2ADMIN.INSRWYTSERTIFIKASI(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SERTIFIKAT']."', '".$Data['NO_PESERTA']."',
                        '".$Data['TGL_SERTIFIKAT']."', '".$Data['ASAL_INSTITUSI']."', '".$Data['PEJABAT_TT']."', 
                        '".$Data['RUMPUN_ILMU']."', '".$Data['TUNJANGAN_SERTIFIKASI']."', '".$Data['TGL_AKHIR']."',
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."')
                    ";
                
                $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
                $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
                $Message = 'Data berhasil ditambahkan.';
            } else if ($Validation == 'pass' && $ParameterUpdate == 'update') {
                $RawQuery = "
                    CALL DB2ADMIN.UPDRWYTSERTIFIKASI(
                        '".$Data['K_PEGAWAI']."', '".$Data['NO_SERTIFIKAT']."', '".$Data['NO_PESERTA']."',
                        '".$Data['TGL_SERTIFIKAT']."', '".$Data['ASAL_INSTITUSI']."', '".$Data['PEJABAT_TT']."', 
                        '".$Data['RUMPUN_ILMU']."', '".$Data['TUNJANGAN_SERTIFIKASI']."', '".$Data['TGL_AKHIR']."',
                        '".$Data['KETERANGAN']."', '".$this->CI->session->UserLogin['UserID']."')
                    ";
                
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
                    }
                }
            }
        }
        
        return $Data;
    }
    
    function GetExist($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA) {
        $Data = array(
            'K_PEGAWAI' => '',
            'NO_SERTIFIKAT' => '',
            'NO_PESERTA' => '',
            'TGL_SERTIFIKAT' => '',
            'ASAL_INSTITUSI' => '',
            'PEJABAT_TT' => '',
            'RUMPUN_ILMU' => '',
            'TUNJANGAN_SERTIFIKASI' => '',
            'TGL_AKHIR' => '',
            'KETERANGAN' => ''
        );
        
        if (!empty($K_PEGAWAI) && !empty($NO_SERTIFIKAT) && !empty($NO_PESERTA)) {
            $RawQuery = "
                SELECT *
                FROM DB2ADMIN.RIWAYAT_SERTIFIKASI
                WHERE
                    K_PEGAWAI = '$K_PEGAWAI'
                    AND NO_SERTIFIKAT = '$NO_SERTIFIKAT'
                    AND NO_PESERTA = '$NO_PESERTA'";
            $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
            $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
            if ($Row = db2_fetch_assoc($Query)) {
                $Data = $Row;
            }
        }
        
        return $Data;
    }
    
    function SimpegDelete($K_PEGAWAI, $NO_SERTIFIKAT, $NO_PESERTA) {
        $Data = $this->GetExist('', '', '');
        
        $RawQuery = "CALL DB2ADMIN.DELRWYTSERTIFIKASI('".$K_PEGAWAI."', '".$NO_SERTIFIKAT."', '".$NO_PESERTA."')";
        $Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        $Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
        
        $Data['Error'] = '';
        $Data['Message'] = 'Data Riwayat Sertifikasi berhasil dihapus.';
        $Data['ParameterUpdate'] = 'insert';
        $Data['ShowGrid'] = '1';
        
        return $Data;
    }
}
?>