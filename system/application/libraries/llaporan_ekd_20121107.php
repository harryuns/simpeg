<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LLaporan_Ekd {
    var $CI = null;
    
    function LLaporan_Ekd() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array('PageName' => 'Laporan EKD', 'PageTitle' => 'Laporan EKD');
        return $Array;
    }
    
    function GetYear($MinYear, $MaxYear) {
        $Array = array();
        for ($i = $MaxYear; $i >= $MinYear; $i--) {
            $YearLow = $i;
            $YearHigh = $i + 1;
            
            $Array[$i] = $YearLow.' / '.$YearHigh;
        }
        return $Array;
    }
    
    function GetArray($Data) {
        $ArrayList = array();
        $Data['SEMESTER'] = (isset($Data['SEMESTER'])) ? $Data['SEMESTER'] : 'x';
        $TempFakultas = explode(' - ', $Data['K_FAKULTAS']);
        $Fakultas = $TempFakultas[0];
		$Data['KESIMPULAN'] = (isset($Data['KESIMPULAN'])) ? $Data['KESIMPULAN'] : 'x';
		
        $RawQuery = "CALL EKD.EKDLAPORANEVLS('".$Fakultas."', '".$Data['TAHUN']."', '".$Data['KESIMPULAN']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Row['PD1'] = (isset($Row['PD1'])) ? $Row['PD1'] : '0';
            $Row['PL1'] = (isset($Row['PL1'])) ? $Row['PL1'] : '0';
            $Row['PG1'] = (isset($Row['PG1'])) ? $Row['PG1'] : '0';
            $Row['PK1'] = (isset($Row['PK1'])) ? $Row['PK1'] : '0';
            $Row['PD2'] = (isset($Row['PD2'])) ? $Row['PD2'] : '0';
            $Row['PL2'] = (isset($Row['PL2'])) ? $Row['PL2'] : '0';
            $Row['PG2'] = (isset($Row['PG2'])) ? $Row['PG2'] : '0';
            $Row['PK2'] = (isset($Row['PK2'])) ? $Row['PK2'] : '0';
            $Row['KKP'] = (isset($Row['KKP'])) ? $Row['KKP'] : '0';
            $ArrayList[] = $Row;
        }
        
        $Data['FORMAT'] = (isset($Data['FORMAT'])) ? $Data['FORMAT'] : '';
        $RecordPerPage = ($Data['FORMAT'] == 'html') ? 2000 : 100;
        $Report['Page']['Active'] = (isset($Data['PageActive']) && !empty($Data['PageActive'])) ? $Data['PageActive'] : 1;
        $Report['Page']['Total'] = ceil(count($ArrayList) / $RecordPerPage);
        
        $PageStart = ($Report['Page']['Active'] - 1) * $RecordPerPage;
        $PageEnd = $PageStart + $RecordPerPage;
        $Report['Data']['Record'] = GetPageFromArray($ArrayList, $PageStart, $PageEnd);
        
        return $Report;
    }
    
	function GetArraySimulasi($Param) {
        $Array = array( 'Record' => array() );
		
		$ArrayDataTemp = explode(' - ', $Param['K_FAKULTAS']);
		$K_FAKULTAS = (isset($ArrayDataTemp[0])) ? $ArrayDataTemp[0] : '01';
		$TAHUN = (isset($Param['TAHUN'])) ? $Param['TAHUN'] : 1;
		
		$RawQuery = "CALL EKD.EKDLAPSIMDOSENAKAD('".$K_FAKULTAS."', '".$TAHUN."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
			$Row = $this->SyncSimulasiRecord($Row);
            $Array['Record'][] = $Row;
        }
		
		$Array['Data'] = array('TotalT' => 0, 'TotalM' => 0);
		foreach ($Array['Record'] as $Key => $ArrayTemp) {
			if ($ArrayTemp['KESIMPULAN'] == 'T') {
				$Array['Data']['TotalT']++;
			} else if ($ArrayTemp['KESIMPULAN'] == 'M') {
				$Array['Data']['TotalM']++;
			}
		}
		
		return $Array;
	}
	
	function GetArrayAssessorActivity($Param) {
        $Array = array( 'Record' => array() );
		
		$ArrayDataTemp = explode(' - ', $Param['K_FAKULTAS']);
		$K_FAKULTAS = (isset($ArrayDataTemp[0])) ? $ArrayDataTemp[0] : '01';
		$TAHUN = (isset($Param['TAHUN'])) ? $Param['TAHUN'] : 1;
		
		$RawQuery = "CALL EKD.EKDLAPSTATASESOR('".$TAHUN."', '".$K_FAKULTAS."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array['Record'][] = $Row;
        }
		
		return $Array;
	}
	
	function GetArrayAssessorActivityListDosen($Param) {
        $Array = array( 'Record' => array() );
		
		$TAHUN = (isset($Param['TAHUN'])) ? $Param['TAHUN'] : 'x';
		$K_ASESOR = (isset($Param['K_ASESOR'])) ? $Param['K_ASESOR'] : 'x';
		$K_SEMESTER = (isset($Param['K_SEMESTER'])) ? $Param['K_SEMESTER'] : '0';
		
		$RawQuery = "CALL EKD.EKDGETDOSENASSLST('".$TAHUN."', '".$K_SEMESTER."', '".$K_ASESOR."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
            $Array['Record'][] = $Row;
        }
		
		foreach ($Array['Record'] as $Key => $Temp) {
			$Param = array(
				'TAHUN' => $TAHUN,
				'K_PEGAWAI' => $Temp['NIP']
			);
			$Array['Record'][$Key]['KESIMPULAN'] = $this->GetEkdKesimpulanByNip($Param);
		}
		
		return $Array;
	}
	
	function GetEkdKesimpulanByNip($Param) {
		$Result = '';
		$RawQuery = "CALL EKD.EKDSETDSNAKADBYAS1('".$Param['K_PEGAWAI']."', '".$Param['TAHUN']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
        db2_execute($Statement);
        while ($Row = db2_fetch_assoc($Statement)) {
			$Result = $Row['KESIMPULAN'];
        }
		return $Result;
	}
	
    function GetLaporanEkd($Data) {
        $Report = $this->GetArray($Data);
        
        $Data['FORMAT'] = (isset($Data['FORMAT'])) ? $Data['FORMAT'] : 'SiteHtml';
        if ($Data['FORMAT'] == 'html') {
            $Content = $this->GetContentCetak($Data, $Report);
        } else {
            $Content = $this->GetContentHtml($Data, $Report);
        }
        
        return $Content;
    }
    
    function GetContentHtml($Data, $Report) {
        $Content = '';
        foreach ($Report['Data']['Record'] as $Key => $Array) {
			$JsonRecord = json_encode($Array);
			
            $Content .= '
                    <tr>
                        <td class="licon"><a class="cursor DialogKesimpulan">'.$Array['NIP'].'</a><span class="hidden">'.$JsonRecord.'</span></td>
                        <td class="icon">'.$Array['NO_SERTIFIKAT'].'</td>
                        <td class="icon">'.$Array['NAMA'].'</td>
                        <td class="icon">'.$Array['FAKULTAS'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PD1'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PL1'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PG1'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PK1'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PD2'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PL2'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PG2'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['PK2'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['KKP'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['STATUS'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['KESIMPULAN'].'</td>
                    </tr>';
        }
        
        if (!empty($Content)) {
			$LinkCetakHtml = HOST.'/index.php/LaporanEkd/Cetak/'.$Data['K_FAKULTAS'].'/'.$Data['TAHUN'].'/html';
			
            $Content = '
				<div style="float: left;">*Catatan: untuk melihat kesimpulan silahkan klik kiri pada NIP.</div>
				<div style="float: right; padding:0 15px 0 0;"><a href="'.$LinkCetakHtml.'">Cetak dalam versi HTML</a></div>
				<div class="clear"></div>
                <div class="cnt_table_main"><table style="width: 1000px;">
                    <tr>
                        <td class="left" rowspan="2" style="width: 200px; text-align: center;">NIP</td>
                        <td class="normal" rowspan="2" style="width: 275px; text-align: center;">No Sertifikat</td>
                        <td class="normal" rowspan="2" style="width: 275px; text-align: center;">Nama</td>
                        <td class="normal" rowspan="2" style="width: 275px; text-align: center;">FAKULTAS</td>
                        <td class="normal" colspan="4" style="width: 25px; text-align: center;">Semester Gasal</td>
                        <td class="normal" colspan="4" style="width: 25px; text-align: center;">Semester Genap</td>
                        <td class="normal" rowspan="2" style="width: 25px; text-align: center;">Kewajiban Khusus Profesor</td>
                        <td class="normal" rowspan="2" style="width: 25px; text-align: center;">Status</td>
                        <td class="normal" rowspan="2" style="width: 25px; text-align: center;">Kesimpulan</td>
                    </tr>
                    <tr>
                        <td class="body" style="width: 25px; text-align: center;">PD</td>
                        <td class="body" style="width: 25px; text-align: center;">PL</td>
                        <td class="body" style="width: 25px; text-align: center;">PG</td>
                        <td class="body" style="width: 25px; text-align: center;">PK</td>
                        <td class="body" style="width: 25px; text-align: center;">PD</td>
                        <td class="body" style="width: 25px; text-align: center;">PL</td>
                        <td class="body" style="width: 25px; text-align: center;">PG</td>
                        <td class="body" style="width: 25px; text-align: center;">PK</td>
                    </tr>
                    '.$Content.'
                </table></div>
            ';
            
            $ContentFeature = '';
            if ($Report['Page']['Total'] > 1) {
                $ContentPage = '';
                for ($Counter = -5; $Counter < 5; $Counter++) {
                    $PageActive = $Report['Page']['Active'] + $Counter;
                    
                    if ($PageActive >= 1 && $PageActive <= $Report['Page']['Total']) {
                        $Class = ($Counter == 0) ? 'active' : '';
                        $ContentPage .= '<a class="'.$Class.'">'.$PageActive.'</a> ';
                    }
                }
                
                $ContentFeature .= '<div id="PagePegawai">'.$ContentPage.'</div>';
            }
            $ContentFeature .= '
                <div class="Excel" style="display: none;">
                    <a href="'.$LinkCetakHtml.'" target="_blank">
                        <img alt="Cetak" style="border: 0px;" title="Cetak" src="'.HOST.'/images/html.jpg" /></a></div>';
            
            if (!empty($ContentFeature)) {
                $Content .= '<div id="PageFeature" style="margin: 10px 0 0 0;">'.$ContentFeature.'</div>';
            }
            
        } else {
            $Content = 'Maaf tidak ada hasil yang ditemukan.';
        }
        
        return $Content;
    }
    
    function GetContentCetak($Data, $Report) {
        $Content = '';
        $Counter = 1;
        foreach ($Report['Data']['Record'] as $Key => $Data) {
            $Content .= '
                <tr>
                    <td>'.$Counter.'</th>
                    <td>'.$Data['NO_SERTIFIKAT'].'</td>
                    <td>'.$Data['NAMA'].'</td>
                    <td>'.$Data['FAKULTAS'].'</td>
                    <td>'.$Data['PD1'].'</td>
                    <td>'.$Data['PL1'].'</td>
                    <td>'.$Data['PG1'].'</td>
                    <td>'.$Data['PK1'].'</td>
                    <td>'.$Data['PD2'].'</td>
                    <td>'.$Data['PL2'].'</td>
                    <td>'.$Data['PG2'].'</td>
                    <td>'.$Data['PK2'].'</td>
                    <td>'.$Data['KKP'].'</td>
                    <td>'.$Data['STATUS'].'</td>
                    <td>'.$Data['KESIMPULAN'].'</td></tr>
            ';
            $Counter++;
        }
        
        $Content = '
            <table class="tableClass" cellpadding="4" cellspacing="-1" width="100%">
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">No. Sertifikat</th>
                <th rowspan="2">Nama Dosen</th>
                <th rowspan="2">Fakultas</th>
                <th colspan="4">Semester Gasal</th>
                <th colspan="4">Semester Genap</th>
                <th rowspan="2">Kewajiban<br>Khusus<br>Profesor</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Kesimpulan</th></tr>
            <tr>
                <th>PD</th>
                <th>PL</th>
                <th>PG</th>
                <th>PK</th>
                <th>PD</th>
                <th>PL</th>
                <th>PG</th>
                <th>PK</th></tr>
            '.$Content.'
            </table>';
        
        return $Content;
    }
	
	function GetLaporanSimulasi($Param) {
		$Param['WithExport'] = (isset($Param['WithExport'])) ? $Param['WithExport'] : true;
		
		$ArrayDataTemp = explode(' - ', $Param['K_FAKULTAS']);
		$K_FAKULTAS = (isset($ArrayDataTemp[0])) ? $ArrayDataTemp[0] : '01';
		$ArrayReport = $this->GetArraySimulasi($Param);
		
        $Content = '';
        foreach ($ArrayReport['Record'] as $Key => $Array) {
            $Content .= '
                    <tr>
                        <td class="licon">
							<a class="cursor DialogKesimpulan">'.$Array['K_PEGAWAI'].'</a>
							<span class="hidden">'.json_encode($Array).'</span></td>
                        <td class="icon">'.$Array['NAMA'].'</td>
                        <td class="body">'.$Array['PD_GANJIL'].'</td>
                        <td class="body">'.$Array['PL_GANJIL'].'</td>
                        <td class="body">'.$Array['PG_GANJIL'].'</td>
                        <td class="body">'.$Array['PK_GANJIL'].'</td>
                        <td class="body">'.$Array['PD_GENAP'].'</td>
                        <td class="body">'.$Array['PL_GENAP'].'</td>
                        <td class="body">'.$Array['PG_GENAP'].'</td>
                        <td class="body">'.$Array['PK_GENAP'].'</td>
                        <td class="body">'.$Array['KK_PROF'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['STATUS'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['KESIMPULAN'].'</td>
                    </tr>';
        }
        
        if (!empty($Content)) {
			$LinkCetakHtml = HOST.'/index.php/LaporanEkd/CetakSimulasi/'.$K_FAKULTAS.'/'.$Param['TAHUN'].'/html';
			
            $Content = '
				<div style="float: left;">
					<div>Total T = '.$ArrayReport['Data']['TotalT'].'</div>
					<div>Total M = '.$ArrayReport['Data']['TotalM'].'</div>
					<div style="padding: 5px 0 0 0;">*Catatan: untuk melihat kesimpulan silahkan klik kiri pada NIP.</div>
				</div>
				<div style="float: right; padding:0 15px 0 0;"><a href="'.$LinkCetakHtml.'">Cetak dalam versi HTML</a></div>
				<div class="clear"></div>
                <div class="cnt_table_main" style="overflow: hidden;"><table style="width: 800px;">
                    <tr>
                        <td class="left" rowspan="2" style="width: 200px; text-align: center;">NIP</td>
                        <td class="normal" rowspan="2" style="width: 275px; text-align: center;">Nama</td>
                        <td class="normal" colspan="4" style="width: 25px; text-align: center;">Ganjil</td>
                        <td class="normal" colspan="4" style="width: 25px; text-align: center;">Genap</td>
                        <td class="normal" rowspan="2" style="width: 25px; text-align: center;">KK Prof</td>
                        <td class="normal" rowspan="2" style="width: 25px; text-align: center;">Status</td>
                        <td class="normal" rowspan="2" style="width: 25px; text-align: center;">Kesimpulan</td></tr>
                    <tr>
                        <td class="body" style="width: 25px; text-align: center;">PD</td>
                        <td class="body" style="width: 25px; text-align: center;">PL</td>
                        <td class="body" style="width: 25px; text-align: center;">PG</td>
                        <td class="body" style="width: 25px; text-align: center;">PK</td>
                        <td class="body" style="width: 25px; text-align: center;">PD</td>
                        <td class="body" style="width: 25px; text-align: center;">PL</td>
                        <td class="body" style="width: 25px; text-align: center;">PG</td>
                        <td class="body" style="width: 25px; text-align: center;">PK</td></tr>
                    '.$Content.'
                </table></div>
            ';
			
			if ($Param['WithExport']) {
				$Content .= '
					<div id="PageFeature" style="display: none;">
						<div class="Excel">
							<a href="'.$LinkCetakHtml.'" target="_blank">
								<img alt="Cetak" style="border: 0px;" title="Cetak" src="'.HOST.'/images/html.jpg" /></a>
						</div>
					</div>';
			}
        } else {
            $Content = 'Maaf tidak ada hasil yang ditemukan.';
        }
        
        return $Content;
	}
	
	function GetAssessorActivity($Param) {
		$Param['WithExport'] = (isset($Param['WithExport'])) ? $Param['WithExport'] : false;
		
		$LinkCetakHtml = '#';
		$ArrayDataTemp = explode(' - ', $Param['K_FAKULTAS']);
		$K_FAKULTAS = (isset($ArrayDataTemp[0])) ? $ArrayDataTemp[0] : '01';
		$ArrayReport = $this->GetArrayAssessorActivity($Param);
		
        $Content = '';
        foreach ($ArrayReport['Record'] as $Key => $Array) {
            $Content .= '
                    <tr>
                        <td class="licon">
							<a class="cursor ListDosen">'.$Array['K_ASESOR'].'</a>
							<span class="hidden">'.json_encode($Array).'</span></td>
                        <td class="icon">'.$Array['NAMA'].'</td>
                        <td class="body">'.$Array['FAKULTAS'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['JML_DOS'].'</td>
                        <td class="body" style="text-align: center;">'.$Array['NUM_SELESAI'].'</td>
                    </tr>';
        }
        
        if (!empty($Content)) {
            $Content = '
                <div class="cnt_table_main" style="overflow: hidden;"><table style="width: 800px;">
                    <tr>
                        <td class="left" style="width: 160px; text-align: center;">NIP Asesor</td>
                        <td class="normal" style="width: 280px; text-align: center;">Nama</td>
                        <td class="normal" style="width: 160px; text-align: center;">Fakultas</td>
                        <td class="normal" style="width: 100px; text-align: center;">Jumlah Dosen</td>
                        <td class="normal" style="width: 100px; text-align: center;">Jumlah Selesai</td></tr>
                    '.$Content.'
                </table></div>
            ';
			
			if ($Param['WithExport']) {
				$Content .= '
					<div id="PageFeature" style="display: none;">
						<div class="Excel">
							<a href="'.$LinkCetakHtml.'" target="_blank">
								<img alt="Cetak" style="border: 0px;" title="Cetak" src="'.HOST.'/images/html.jpg" /></a>
						</div>
					</div>';
			}
        } else {
            $Content = 'Maaf tidak ada hasil yang ditemukan.';
        }
        
        return $Content;
	}
	
	function GetAssessorActivityListDosen($Param) {
		$ArrayDosen = $this->GetArrayAssessorActivityListDosen($Param);
		
		$Content = '';
		foreach ($ArrayDosen['Record'] as $Key => $Array) {
			$Content .= '
				<tr>
					<td style="padding: 3px;">'.$Array['NIP'].'</td>
					<td>'.$Array['NAMA'].'</td>
					<td style="text-align: center;">'.$Array['ASESOR_KE'].'</td>
					<td style="text-align: center;">'.$Array['STATUS'].'</td>
					<td style="text-align: center;">'.$Array['KESIMPULAN'].'</td></tr>';
		}
		
		if (empty($Content)) {
			$Content = 'Tidak ada dosen yang diasesori.';
		} else {
			$Content = '
				<table style="font-size: 10px;" border="1" cellspacing="0">
					<tr style="text-align: center;">
						<td style="width: 125px; padding: 3px;">NIP</td>
						<td style="width: 325px;">Nama</td>
						<td style="width: 100px;">Assesor Ke</td>
						<td style="width: 100px;">Status</td>
						<td style="width: 100px;">Kesimpulan</td></tr>
					'.$Content.'
				</table>';
		}
		
		echo $Content;
	}
	
	function SyncSimulasiRecord($Row) {
		$ArrayAlasan = explode(',', $Row['ALASAN']);
		foreach ($ArrayAlasan as $Key => $Value) {
			$ArrayValue = explode(':', $Value);
			if (isset($ArrayValue[0])) {
				$ArrayValue[0] = trim($ArrayValue[0]);
			}
			if (isset($ArrayValue[1])) {
				$ArrayValue[1] = number_format($ArrayValue[1], 2, '.', '');
			}
			
			$Row['ArrayAlasan'][] = $ArrayValue;
		}
		return $Row;
	}
}
?>