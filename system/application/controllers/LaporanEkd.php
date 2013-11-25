<?php

class LaporanEkd extends Controller {
    function Laporan() {
        parent::Controller();
    }
    
    function index() {
        $Array['Page'] = $this->llaporan_ekd->GetProperty();
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByEkdReport($_SESSION['UserLogin']['Fakultas']['ID']);
        $Array['ArrayTahun'] = $this->llaporan_ekd->GetYear(2005, date("Y") - 1);
        $Array['ArraySemester'] = array('x' => 'Semua');
        
        $this->load->view('laporan_ekd_list', $Array);
    }
    
    function Cetak() {
        $FunctionParam = func_get_args();
        $Data['K_FAKULTAS'] = (isset($FunctionParam[0])) ? $FunctionParam[0] : 'x';
        $Data['TAHUN'] = (isset($FunctionParam[1])) ? $FunctionParam[1] : date("Y");
        $Data['FORMAT'] = (isset($FunctionParam[2])) ? $FunctionParam[2] : 'html';
        $Data['KESIMPULAN'] = (isset($FunctionParam[3])) ? $FunctionParam[3] : 'x';
        $Data['K_STATUS_KERJA'] = (isset($FunctionParam[4])) ? $FunctionParam[4] : 'x';
        
        // Validate Fakultas
        $ArrayFakultas = explode(' - ', $Data['K_FAKULTAS']);
        $Data['K_FAKULTAS'] = $ArrayFakultas[0];
        $UnitKerjaTemp = (isset($ArrayFakultas[1])) ? $ArrayFakultas[1] : '01';
        $UnitKerjaID = ($Data['K_FAKULTAS'] == 'x') ? '01' : $UnitKerjaTemp;
        
        $ArrayMonth = GetArrayMonth();
        $Fakultas = $this->lfakultas->GetFakultasByID($Data['K_FAKULTAS']);
        $Jabatan = $this->lfakultas->GetJabatan($UnitKerjaID, '01');
        
        $Array['ReportContent'] = $this->llaporan_ekd->GetLaporanEkd($Data);
        $Array['Tahun'] = $Data['TAHUN'];
        
        $Array['PageTopTitle'] = ($Data['K_FAKULTAS'] == 'x') ? 'NAMA PERGURUAN TINGGI' : 'NAMA FAKULTAS';
        $Array['PageTopDesc'] = ($Data['K_FAKULTAS'] == 'x') ? 'Universitas Brawijaya' : 'Fakultas '.$Fakultas['CONTENT'];
        $Array['PageBottomTitle'] = ($Data['K_FAKULTAS'] == 'x') ? 'ALAMAT PERGURUAN TINGGI' : 'NAMA PERGURUAN TINGGI';
        $Array['PageBottomDesc'] = ($Data['K_FAKULTAS'] == 'x') ? 'Jl. Veteran Malang 65145 Indonesia' : 'Universitas Brawijaya';
        
        $Array['CurrentDate'] = date("d ").$ArrayMonth[date("m")].date(" Y");
        $Array['PageTitle'] = ($Data['K_FAKULTAS'] == 'x') ? 'LAMPIRAN III' : 'LAMPIRAN II';
        $Array['ReportTitle'] = ($Data['K_FAKULTAS'] == 'x') ? 'LAMPIRAN III REKAP UNIVERSITAS' : 'LAMPIRAN II REKAP FAKULTAS';
        $Array['ReportDesc'] = ($Data['K_FAKULTAS'] == 'x') ? 'LAPORAN EVALUASI TINGKAT UNIVERSITAS TAHUN '.$Data['TAHUN'] : 'LAPORAN EVALUASI TINGKAT FAKULTAS TAHUN '.$Data['TAHUN'];
        $Array['HeadOfficer'] = ($Data['K_FAKULTAS'] == 'x') ? 'Rektor' : 'Dekan';
        $Array['NamaPejabat'] = $Jabatan['NAMA'];
        $Array['NipPejabat'] = $Jabatan['K_PEGAWAI'];
        
        $this->load->view('laporan_ekd_cetak', $Array);
    }
	
    function Simulasi() {
        $Array['Page'] = array('PageTitle' => 'Simulasi', 'PageName' => 'Simulasi');
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByEkdReport($_SESSION['UserLogin']['Fakultas']['ID'], false);
        $Array['ArrayTahun'] = $this->llaporan_ekd->GetYear(TAHUN_AKADEMIK, date("Y"));
        
        $this->load->view('laporan_ekd_simulasi', $Array);
    }
	
	function CetakSimulasi() {
        $FunctionParam = func_get_args();
        $Param['K_FAKULTAS'] = (isset($FunctionParam[0])) ? $FunctionParam[0] : 'x';
        $Param['TAHUN'] = (isset($FunctionParam[1])) ? $FunctionParam[1] : date("Y");
        $Param['FORMAT'] = (isset($FunctionParam[2])) ? $FunctionParam[2] : 'html';
        $Param['WithExport'] = false;
		
		$Fakultas = $this->lfakultas->GetFakultasByID($Param['K_FAKULTAS']);
		$Param['TAHUN_NEXT'] = $Param['TAHUN'] + 1;
		
		$Array['PageTitle'] = 'Laporan Simulasi';
        $Array['PageTopTitle'] = 'NAMA FAKULTAS';
        $Array['PageTopDesc'] = 'Fakultas '.$Fakultas['CONTENT'];
        $Array['PageBottomTitle'] = 'NAMA PERGURUAN TINGGI';
        $Array['PageBottomDesc'] = 'Universitas Brawijaya';
        $Array['ReportTitle'] = 'Laporan Simulasi '.$Param['TAHUN'].' / '. $Param['TAHUN_NEXT'];
        $Array['ReportDesc'] = '';
		$Array['ContentReport'] = $this->llaporan_ekd->GetArraySimulasi($Param);
        
        $this->load->view('laporan_ekd_simulasi_cetak', $Array);
	}
	
	function AssessorActivity() {
        $Array['Page'] = array('PageTitle' => 'Laporan Kegiatan Assessor', 'PageName' => 'Laporan Kegiatan Assessor');
        $Array['ArrayFakultas'] = $this->lfakultas->GetFakultasByEkdReport($_SESSION['UserLogin']['Fakultas']['ID'], false);
        $Array['ArrayTahun'] = $this->llaporan_ekd->GetYear(TAHUN_AKADEMIK, date("Y"));
        
        $this->load->view('laporan_ekd_kegiatan_assessor', $Array);
	}
}