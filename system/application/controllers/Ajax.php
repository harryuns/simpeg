<?php

class Ajax extends Controller {
    var $Action = null;
    
    function Ajax() {
        parent::Controller();
        
        $this->Action = $this->input->post('Action');
    }
    
    function Jenjang() {
        $Result = '';
        if ($this->Action == 'GetJenjangByUnitKerja') {
            $K_UNIT_KERJA = $this->input->post('K_UNIT_KERJA');
            $ArrayJenjang = $this->ljenjang->GetJenjangByUnitKerja($K_UNIT_KERJA);
            $Result = GetOption(false, $ArrayJenjang, '');
        }
        
        echo $Result;
        exit;
    }
    
    function Fakultas() {
        $Result = '';
        if ($this->Action == 'GetFakultasByJenjang') {
            $K_JENJANG = $this->input->post('K_JENJANG');
            $K_FAKULTAS = $this->input->post('K_FAKULTAS');
            
            // Set Default
            $K_FAKULTAS = (empty($K_FAKULTAS)) ? $_SESSION['UserLogin']['Fakultas']['ID'] : $K_FAKULTAS;
            
            $ArrayFakultas = $this->lfakultas->GetFakultasByJenjang($K_JENJANG, $K_FAKULTAS);
            $Result = GetOption(false, $ArrayFakultas, '');
        } else if ($this->Action == 'GetFakultasByJenjangUnitKerja') {
            $K_JENJANG = $this->input->post('K_JENJANG');
            $K_UNIT_KERJA = $this->input->post('K_UNIT_KERJA');
            $ArrayFakultas = $this->lfakultas->GetFakultasByJenjangUnitKerja($K_JENJANG, $K_UNIT_KERJA);
            $Result = GetOption(false, $ArrayFakultas, '');
        }
        
        echo $Result;
        exit;
    }
    
    function Jurusan() {
        $Result = '';
        if ($this->Action == 'GetJurusanById') {
            $K_JENJANG = $this->input->post('K_JENJANG');
            $K_FAKULTAS = $this->input->post('K_FAKULTAS');
            $ArrayJurusan = $this->ljurusan->GetById($K_JENJANG, $K_FAKULTAS);
            $Result = GetOption(false, $ArrayJurusan, '');
        }
        
        echo $Result;
        exit;
    }
    
    function ProgramStudi() {
        $Result = '';
        if ($this->Action == 'GetProgramStudiById') {
            $K_JENJANG = $this->input->post('K_JENJANG');
            $K_FAKULTAS = $this->input->post('K_FAKULTAS');
            $K_JURUSAN = $this->input->post('K_JURUSAN');
            $ArrayProgramStudi = $this->lprogram_studi->GetById($K_JENJANG, $K_FAKULTAS, $K_JURUSAN);
            $Result = GetOption(false, $ArrayProgramStudi, '');
        }
        
        echo $Result;
        exit;
    }
    
	function UnitKerja() {
        $Result = '';
        if ($this->Action == 'GetUnitKerjaByJenisKerja') { 
			$Param['IS_FAKULTAS'] = (isset($_POST['K_JENIS_KERJA']) && $_POST['K_JENIS_KERJA'] == '02') ? 'x' : '1';
			
            $ArrayUnitKerja = $this->lunit_kerja->GetArrayAll($_SESSION['UserLogin']['Fakultas']['ID'], $Param);
            $Result = GetOption(false, $ArrayUnitKerja, '');
		} else if ($this->Action == 'GetUnitKerjaByID') {
			$ArrayUnitKerja = $this->lunit_kerja->GetArrayAll($_SESSION['UserLogin']['Fakultas']['ID'], array());
			if (count($ArrayUnitKerja) == 1) {
				foreach ($ArrayUnitKerja as $key => $unit_kerja) {
					$unit_kerja['id'] = $key;
					$Result = json_encode($unit_kerja);
				}
			}
        } else if ($this->Action == 'GetPopupUnitKerja') { 
			$Result = $this->load->view('common/form_unit_kerja_tree', array(), true);
        }
        
        echo $Result;
        exit;
	}
	
    function JabatanStruktural() {
        $Result = '';
        if ($this->Action == 'GetArrayByUnitKerja') {
            $K_UNIT_KERJA = $this->input->post('K_UNIT_KERJA');
            $ArrayUnitKerja = $this->ljabatan_struktural->GetArrayByUnitKerja($K_UNIT_KERJA);
            $Result = GetOption(false, $ArrayUnitKerja, '');
        }
        
        echo $Result;
        exit;
    }
    
    function NamaLaporan() {
        $Result = '';
        if ($this->Action == 'GetArrayNamaLaporan') {
            $JenisLaporan = $this->input->post('JenisLaporan');
            $ArrayNamaLaporan = $this->llaporan->GetArrayNamaLaporan($JenisLaporan);
            $Result = GetOption(false, $ArrayNamaLaporan, '');
        }
        
        echo $Result;
        exit;
    }
    
    function GetLaporanFilter() {
        $Result = '';
        if ($this->Action == 'GetLaporanFilter') {
            $JenisLaporan = $this->input->post('JenisLaporan');
            $NamaLaporan = $this->input->post('NamaLaporan');
            $Result = $this->llaporan->GetLaporanFilter($JenisLaporan, $NamaLaporan);
        }
        
        echo $Result;
        exit;
    }
    
    function GetResultLaporan() {
        $Result = '';
        if ($this->Action == 'GetResultLaporan') {
            $JenisLaporan = $this->input->post('JenisLaporan');
            $NamaLaporan = $this->input->post('NamaLaporan');
			
            if ($NamaLaporan == 'LaporanEkd') {
                $Result = $this->llaporan_ekd->GetLaporanEkd($_POST);
            } else if ($NamaLaporan == 'LaporanEkdSimulasi') {
				$Result = $this->llaporan_ekd->GetLaporanSimulasi($_POST);
            } else if ($NamaLaporan == 'LaporanEkdAssessorActivity') {
				$Result = $this->llaporan_ekd->GetAssessorActivity($_POST);
            } else if ($NamaLaporan == 'LaporanEkdAssessorActivityListDosen') {
				$Result = $this->llaporan_ekd->GetAssessorActivityListDosen($_POST);
            } else {
                $Result = $this->llaporan->GetResultLaporan($JenisLaporan, $NamaLaporan);
            }
        }
        
        echo $Result;
        exit;
    }
    
    function Image() {
        $Action = $this->input->post('Action');
        
        if ($Action == 'Delete') {
            $ImageLink = $this->input->post('ImageLink');
            $Image = str_replace(HOST, PATH, $ImageLink);
            $Image = preg_replace('/\?\d+/i', '', $Image);
            @unlink($Image);
        }
    }
    
    function Pegawai() {
        $Action = $this->input->post('Action');
		
        if ($Action == 'GetPreviewPegawai') {
            $K_PEGAWAI = $this->input->post('K_PEGAWAI');
            $Array['Pegawai'] = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
            $Array['ArrayPegawaiAktif'] = $this->lpegawai_aktif->GetArrayPegawaiActive($K_PEGAWAI);
            $Array['ArrayRiwayatDiklat'] = $this->lriwayat_diklat->GetArray($K_PEGAWAI);
            $Array['ArrayRiwayatPangkat'] = $this->lriwayat_pangkat->GetArray($K_PEGAWAI);
            $Array['ArrayRiwayatPendidikan'] = $this->lriwayat_pendidikan->GetArray($K_PEGAWAI);
            $Array['ArrayRiwayatHonorer'] = $this->lriwayat_honorer->GetArray($K_PEGAWAI);
            $Array['ArrayRiwayatFungsional'] = $this->lriwayat_jabatan_fungsional->GetArray($K_PEGAWAI);
            $Array['ArrayRiwayatStruktural'] = $this->lriwayat_jabatan_struktural->GetArray($K_PEGAWAI);
            
            $Array['ArrayAgama'] = $this->lagama->GetArrayAgama();
            $Array['ArrayAktif'] = $this->laktif->GetArrayAktif();
            $Array['ArrayDiklat'] = $this->ldiklat->GetArray();
            $Array['ArrayNegara'] = $this->lnegara->GetArrayNegara();
            $Array['ArrayAsalSk'] = $this->lasal_sk->GetArrayAsalSk();
            $Array['ArrayJenjang'] = $this->ljenjang->GetArrayAll();
            $Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArrayAll();
            $Array['ArrayPenjelasan'] = $this->lpenjelasan->GetArrayPenjelasan();
            $Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
            $Array['ArrayJenisKelamin'] = $this->ljenis_kelamin->GetArrayJenisKelamin();
            $Array['ArrayStatusKawin'] = $this->lstatus_kawin->GetArrayStatusKawin();
            $Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
            $Array['ArrayStatusPensiun'] = $this->lstatus_pensiun->GetArrayStatusPensiun();
            
            $this->load->view('pegawai_preview', $Array);
		} else if ($Action == 'GetWidgetDetail') {
			$this->load->view('widget/pegawai_detail');
        }
    }
    
    function ExportPegawai() {
        if (isset($_POST['ExportType']) && !empty($_POST['ExportType'])) {
            $_SESSION['Export']['Excel'] = $_POST;
            
            $LinkExcel = HOST."/index.php/Ajax/ExportPegawai";
            echo "{ LinkExcel: '$LinkExcel' }";
            exit;
        }
        
        if (!isset($_SESSION['Export'])) {
            exit;
        }
        
        date_default_timezone_set('Europe/London');
        require_once PATH.'/system/application/libraries/PHPExcel.php';
        
		ini_set('memory_limit', '5G');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        
        if ($_SESSION['Export']['Excel']['ExportName'] == 'PencarianPegawai') {
            $objPHPExcel = $this->lpegawai->ExportSearch($objPHPExcel);
        } else if ($_SESSION['Export']['Excel']['ExportName'] == 'LaporanPegawai') {
            $Param['NamaLaporan'] = $_SESSION['Export']['Excel']['NamaLaporan'];
            $Param['JenisLaporan'] = $_SESSION['Export']['Excel']['JenisLaporan'];
			
			// Set Param
			if (isset($_SESSION['Export']['Excel']['Tahun']))
				$Param['TAHUN'] = $_SESSION['Export']['Excel']['Tahun'];
			if (isset($_SESSION['Export']['Excel']['K_JENJANG']))
				$Param['K_JENJANG'] = $_SESSION['Export']['Excel']['K_JENJANG'];
			if (isset($_SESSION['Export']['Excel']['K_FAKULTAS']))
				$Param['K_FAKULTAS'] = $_SESSION['Export']['Excel']['K_FAKULTAS'];
			if (isset($_SESSION['Export']['Excel']['K_STATUS_KERJA']))
				$Param['K_STATUS_KERJA'] = $_SESSION['Export']['Excel']['K_STATUS_KERJA'];
			if (isset($_SESSION['Export']['Excel']['K_UNIT_KERJA']))
				$Param['K_UNIT_KERJA'] = $_SESSION['Export']['Excel']['K_UNIT_KERJA'];
			if (isset($_SESSION['Export']['Excel']['K_JURUSAN']))
				$Param['K_JURUSAN'] = $_SESSION['Export']['Excel']['K_JURUSAN'];
			if (isset($_SESSION['Export']['Excel']['K_PROG_STUDI']))
				$Param['K_PROG_STUDI'] = $_SESSION['Export']['Excel']['K_PROG_STUDI'];
			if (isset($_SESSION['Export']['Excel']['TGL_BATAS']))
				$Param['TGL_BATAS'] = $_SESSION['Export']['Excel']['TGL_BATAS'];
			
			// Load Template
            $ClassName = 'report'.$Param['JenisLaporan'].$Param['NamaLaporan'];
            $this->load->library('Report/'.$ClassName);
			
            $objPHPExcel->Report = $this->llaporan->ExportExcel($Param);
            $objPHPExcel = $this->$ClassName->BuildExcel($objPHPExcel);
        } else {
            echo 'Request Excel Name Empty.';
            exit;
        }
        
        $objPHPExcel->setActiveSheetIndex(0);
//        unset($_SESSION['Export']);
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="DaftarPegawai.xls"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
	
	function Kota() {
		if ($this->Action == 'GetKotaByPropinsiID') {
            $K_NEGARA = $this->input->post('K_NEGARA');
            $K_PROPINSI = $this->input->post('K_PROPINSI');
            $Array = $this->lkota->GetArray($K_NEGARA, $K_PROPINSI);
            $Result = GetOption(false, $Array, '');
		}
        
        echo $Result;
        exit;
	}
}
?>