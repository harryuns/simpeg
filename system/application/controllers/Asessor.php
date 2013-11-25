<?php

class Asessor extends Controller {
    function Asessor() {
        parent::Controller();
    }
    
    function index() {
        $Array['Page'] = array('PageName' => 'Asessor', 'PageTitle' => 'Asessor');
        $Array['ArrayTahunAkademik'] = $this->llaporan_ekd->GetYear(TAHUN_AKADEMIK, date("Y"));
        $this->load->view('pegawai_asessor', $Array);
    }
    
    function Ajax() {
        $Action = (isset($_POST['Action'])) ? $_POST['Action'] : '';
        
        if ($Action == 'GetListPegawai') {
            $_POST['FakultasID'] = $_SESSION['UserLogin']['Fakultas']['ID'];
            $Array['ArrayPegawai'] = $this->lpegawai->GetArrayPegawai($_POST);
            $Content = $this->GetContentListAsessor($Array);
            echo $Content;
        }
        else if ($Action == 'SetAssessor') {
            $_POST['NIP_1'] = (isset($_POST['NIP_1'])) ? $_POST['NIP_1'] : '';
            $_POST['NAMA_1'] = (isset($_POST['NAMA_1'])) ? $_POST['NAMA_1'] : '';
            
            $Asessor['Data'][0] = array('Nip' => $_POST['NIP_0'], 'Name' => $_POST['NAMA_0']);
            $Asessor['Data'][1] = array('Nip' => $_POST['NIP_1'], 'Name' => $_POST['NAMA_1']);
            $Asessor['ArrayAssessor'] = explode(',', $_POST['ArrayAssessor']);
            $Asessor['SEMESTER'] = $_POST['SEMESTER'];
            $Asessor['ASESOR_KE'] = $_POST['ASESOR_KE'];
            $Asessor['TAHUN_AKADEMIK'] = $_POST['TAHUN_AKADEMIK'];
            unset($Asessor['Action']);
            
            // Clean Invalid Data
            foreach ($Asessor['Data'] as $Key => $Data) {
                if (empty($Data['Nip']) || empty($Data['Name'])) {
                    unset($Asessor['Data'][$Key]);
                }
            }
            
            // Add Second Asessor
            if (count($Asessor['Data']) == 1) {
                $Asessor['Data'][1] = array('Nip' => '', 'Name' => '');
            }
            
            unset($_POST['NIP_0']);
            unset($_POST['NAMA_0']);
            unset($_POST['NIP_1']);
            unset($_POST['NAMA_1']);
            unset($_POST['SEMESTER']);
            unset($_POST['TAHUN_AKADEMIK']);
            unset($_POST['Action']);
            
            // Collect Data Asessor
            $DataAsessor['THN_AKADEMIK'] = $Asessor['TAHUN_AKADEMIK'];
            $DataAsessor['IS_GANJIL'] = $Asessor['SEMESTER'];
            $DataAsessor['K_ASESOR_I'] = $Asessor['Data'][0]['Nip'];
            $DataAsessor['K_ASESOR_I_NAME'] = $Asessor['Data'][0]['Name'];
            $DataAsessor['K_ASESOR_II'] = $Asessor['Data'][1]['Nip'];
            $DataAsessor['K_ASESOR_II_NAME'] = $Asessor['Data'][1]['Name'];
            $DataAsessor['ASESOR_KE'] = $Asessor['ASESOR_KE'];
            $DataAsessor['KETERANGAN'] = '';
            
            $ArrayUpdate = array(
                'Success' => array(),
                'Fail' => array()
            );
            foreach ($Asessor['ArrayAssessor'] as $AssessorKey => $K_PEGAWAI) {
                $DataAsessor['K_PEGAWAI'] = $K_PEGAWAI;
                $Result = $this->ldata_asessor->UpdateSingleAsessor($DataAsessor);
                
                if ($Result['QueryMessage'] == '00000') {
                    $ArrayUpdate['Success'][] = $K_PEGAWAI.';.;'.$Result['Message'];
                } else {
                    $ArrayUpdate['Fail'][] = $K_PEGAWAI.';.;'.$Result['Message'];;
                }
            }
            
            $ArrayTemp = array(
                'Success' => implode(';,;', $ArrayUpdate['Success']),
                'Fail' => implode(';,;', $ArrayUpdate['Fail']),
                'Message' => 'Insert Asessor selesai'
            );
            $StringUpdate = ArrayToJSON($ArrayTemp);
            echo $StringUpdate; exit;
        }
    }
    
    function GetContentListAsessor($Array) {
        $Content = '';
        
        if (count($Array['ArrayPegawai']['Pegawai']) > 1) {
            foreach ($Array['ArrayPegawai']['Pegawai'] as $Key => $Pegawai) {
                $Content .= '
                    <tr>
                        <td class="licon" style="text-align: left;">'.$Pegawai['K_PEGAWAI'].'</td>
                        <td class="icon" style="text-align: left;">'.$Pegawai['NAMA'].'</td>
                        <td class="body">'.$Pegawai['FAKULTAS'].'</td>
                        <td class="body">'.$Pegawai['JENJANG'].'</td>
                        <td class="body">'.$Pegawai['JURUSAN'].'</td>
                        <td class="body"><div class="class_'.$Key.'">&nbsp;</div></td>
                        <td class="body" style="text-align: center;"><input type="checkbox" name="AssessorCheck" value="'.$Pegawai['K_PEGAWAI'].'" class="class_'.$Key.'" /></td></tr>
                ';
            }
            
            $Content = '
                <table>
                    <tr>
                        <td style="width: 125px;" class="left">NIP</td>
                        <td style="width: 250px;" class="normal">Nama</td>
                        <td style="width: 125px;" class="normal">Fakultas</td>
                        <td style="width: 100px;" class="normal">Jenjang</td>
                        <td style="width: 100px;" class="normal">Jurusan</td>
                        <td style="width: 100px;" class="normal">&nbsp;</td>
                        <td style="width: 100px; text-align: center;" class="normal">Pilih</td></tr>
                    '.$Content.'
                    <tr>
                        <td class="licon" colspan="6">&nbsp;</td>
                        <td class="body" style="text-align: center;"><input type="button" name="AssessorSimpan" value="Simpan" ></td></tr>
                </table>';
            
            if ($Array['ArrayPegawai']['PageCount'] > 1) {
                $ContentPage = '';
                
                for ($Counter = -5; $Counter < 5; $Counter++) {
                    $PageActive = $Array['ArrayPegawai']['PageActive'] + $Counter;
                    
                    if ($PageActive >= 1 && $PageActive <= $Array['ArrayPegawai']['PageCount']) {
                        $Class = ($Counter == 0) ? 'active' : '';
                        $ContentPage .= '<a class="'.$Class.'">'.$PageActive.'</a> ';
                    }
                }
                
                $Content .= '<div id="PagePegawai" style="margin: 5px 0 0 0; padding: 5px 0pt 0pt 0pt;">'.$ContentPage.'</div>';
            }
        } else {
            $Content = '<div>Data tidak ditemukan karena tidak ada data yang sesuai dengan kriteria pencarian.</div>';
        }
        
        return $Content;
    }
}