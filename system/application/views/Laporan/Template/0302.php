<?php
	$RecordPerPage = 50;
	$PageActive = (isset($_POST['PageActive'])) ? $_POST['PageActive'] : 1;
	$PageCount = ceil(count($Laporan['List']) / $RecordPerPage);
	
	$RecordStart = ($PageActive * $RecordPerPage) - $RecordPerPage;
	$RecordEnd = $PageActive * $RecordPerPage;
	$ArrayLaporan = GetPageFromArray($Laporan['List'], $RecordStart, $RecordEnd);
	
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <div style="padding: 5px 0; font-weight: 700; font-size: 11px;">Unit Kerja : ' . $Laporan['UnitKerja']['CONTENT'] . '</div>
		
        <table style="width: 1600px;">
            <tr>
                <td class="left" style="width: 20px;" rowspan="2">No</td>
                <td class="center" style="width: 300px;" rowspan="2">NAMA</td>
                <td class="normal" style="width: 100px; text-align: center;" rowspan="2">NIP</td>
                <td class="normal" style="width: 100px; text-align: center;" colspan="2">PANGKAT</td>
                <td class="normal" style="width: 100px; text-align: center;" colspan="2">JABATAN</td>
                <td class="normal" style="width: 100px; text-align: center;" colspan="2">MASA KERJA</td>
                <td class="normal" style="width: 100px; text-align: center;" colspan="3">LATIHAN PRAJABATAN</td>
                <td class="normal" style="width: 100px; text-align: center;" colspan="3">PENDIDIKAN</td>
                <td class="normal" style="width: 100px; text-align: center;" rowspan="2">TANGGAL LAHIR</td>
                <td class="normal" style="width: 100px; text-align: center;" rowspan="2">UMUR</td>
                <td class="normal" style="width: 100px; text-align: center;" rowspan="2">CATATAN MUTASI KEPEG</td>
                <td class="normal" style="width: 100px; text-align: center;" rowspan="2">FAK</td>
                <td class="normal" style="width: 100px; text-align: center;" rowspan="2">JURUSAN</td>
				<td class="normal" style="width: 100px; text-align: center;" rowspan="2">JENIS KELAMIN</td>
			</tr>
            <tr>
                <td class="body center">GOL</td>
                <td class="body center">TMT</td>
                <td class="body center">NAMA</td>
                <td class="body center">TMT</td>
                <td class="body center">SEMUA</td>
                <td class="body center">GOL</td>
                <td class="body center">NAMA</td>
                <td class="body center">BLN/TH</td>
                <td class="body center">JAM</td>
                <td class="body center">NAMA</td>
                <td class="body center">TAHUN</td>
                <td class="body center">IJZ</td>
			</tr>
    ';
	
    $Counter = $RecordStart;
    foreach ($ArrayLaporan as $Key => $Element) {
        $Counter++;
		
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">' . $Element['NAMA_LENGKAP'] . '</td>
                <td class="body" style="text-align: left;">' . $Element['K_PEGAWAI'] . '</td>
                <td class="body" style="text-align: left;">' . $Element['GOL'] . '</td>
                <td class="body" style="text-align: left;">' . ExchangeFormatDate($Element['TMT_GOL']) . '</td>
                <td class="body" style="text-align: center;">' . $Element['BAGIAN_JABATAN'] . '</td>
                <td class="body" style="text-align: center;">' . ExchangeFormatDate($Element['TMT_JABATAN']) . '</td>
                <td class="body" style="text-align: center;">' . $Element['TOTAL_MASA_KERJA_KESELURUHAN'] . '</td>
                <td class="body" style="text-align: center;">' . $Element['MASA_KERJA_GOLONGAN'] . '</td>
                <td class="body" style="text-align: center;">&nbsp;</td>
                <td class="body" style="text-align: center;">&nbsp;</td>
                <td class="body" style="text-align: center;">&nbsp;</td>
                <td class="body" style="text-align: center;">' . $Element['JENJANG_PENDIDIKAN'] . '</td>
                <td class="body" style="text-align: center;">' . $Element['THN_LULUS'] . '</td>
                <td class="body" style="text-align: center;">' . $Element['IJZ'] . '</td>
                <td class="body" style="text-align: center;">' . ExchangeFormatDate($Element['TGL_LAHIR']) . '</td>
                <td class="body" style="text-align: center;">' . $Element['UMUR'] . '</td>
                <td class="body" style="text-align: center;">&nbsp;</td>
                <td class="body" style="text-align: center;">' . $Element['UNIT_KERJA'] . '</td>
                <td class="body" style="text-align: center;">' . $Element['JURUSAN_TEXT'] . '</td>
				<td class="body" style="text-align: center;">' . $Element['JENIS_KELAMIN'] . '</td>
            </tr>';
    }
    
	$PageHtml = '';
	for ($Counter = -2; $Counter <= 2; $Counter++) {
		$PageNumber = $PageActive + $Counter;
		if ($PageNumber > 0 && $PageNumber <= $PageCount) {
			$ClassActive = ($Counter == 0) ? 'active' : '';
			$PageHtml .= '<a class="' . $ClassActive . '">' . $PageNumber . '</a> ';
		}
	}
	
    echo '
        </table></div>
		
        <div id="PageFeature" style="margin: 10px 0 0 0;">
            <div class="Excel">
                <img alt="Export to Excel" title="Export to Excel" src="'.HOST.'/images/Excel.jpg">
            </div>
			<div class="Paging">' . $PageHtml . '</div>
        </div>
		
		<div style="padding: 15px 0 0 25px;">
			* Jika terdapat data double di DUK, dicek kembali :<br />
			<ol>
				<li>Data riwayat pendidikan dengan jenjang, tgl ijazah dan tahun lulus yang sama</li>
				<li>Data riwayat fungsional dengan tmt atau tgl sk yang sama</li>
				<li>Data riwayat homebase dengan tmt atau tgl sk yang sama</li>
				<li>Data riwayat pangkat dengan golongan pangkat atau tmt yang sama</li>
			</ul>
		</div>
    ';
?>