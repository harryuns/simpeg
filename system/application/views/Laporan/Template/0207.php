<?php
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <table style="width: 100%;">
            <tr>
                <td class="left" style="width: 4%;">No</td>
                <td class="center" style="width: 18%;">Jenis Kerja</td>
                <td class="center" style="width: 18%;">Status Kerja</td>
                <td class="normal" style="width: 10%; text-align: center;">&lt; 20</td>
                <td class="normal" style="width: 10%; text-align: center;">&lt; 30</td>
                <td class="normal" style="width: 10%; text-align: center;">&lt; 40</td>
                <td class="normal" style="width: 10%; text-align: center;">&lt; 50</td>
                <td class="normal" style="width: 10%; text-align: center;">&lt; 60</td>
                <td class="normal" style="width: 10%; text-align: center;">&gt; 60</td>
            </tr>
    ';
	
    $Counter = 0;
    $Laporan['Total'] = array(
        'UMUR_KRG_20' => 0, 'UMUR_KRG_30' => 0, 'UMUR_KRG_40' => 0,
		'UMUR_KRG_50' => 0, 'UMUR_KRG_60' => 0, 'UMUR_LBH_60' => 0
    );
	
    foreach ($Laporan['List'] as $Key => $Element) {
        $Counter++;
        $Laporan['Total']['UMUR_KRG_20'] += $Element['UMUR_KRG_20'];
        $Laporan['Total']['UMUR_KRG_30'] += $Element['UMUR_KRG_30'];
        $Laporan['Total']['UMUR_KRG_40'] += $Element['UMUR_KRG_40'];
        $Laporan['Total']['UMUR_KRG_50'] += $Element['UMUR_KRG_50'];
        $Laporan['Total']['UMUR_KRG_60'] += $Element['UMUR_KRG_60'];
        $Laporan['Total']['UMUR_LBH_60'] += $Element['UMUR_LBH_60'];
		
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">'.$Element['CONTENT1'].'</td>
                <td class="body" style="text-align: left;">'.$Element['CONTENT2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['UMUR_KRG_20'].'</td>
                <td class="body" style="text-align: center;">'.$Element['UMUR_KRG_30'].'</td>
                <td class="body" style="text-align: center;">'.$Element['UMUR_KRG_40'].'</td>
                <td class="body" style="text-align: center;">'.$Element['UMUR_KRG_50'].'</td>
                <td class="body" style="text-align: center;">'.$Element['UMUR_KRG_60'].'</td>
                <td class="body" style="text-align: center;">'.$Element['UMUR_LBH_60'].'</td>
            </tr>';
    }
    
    echo '
        <tr>
            <td class="licon" style="text-align: center;" colspan="3">Jumlah</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['UMUR_KRG_20'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['UMUR_KRG_30'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['UMUR_KRG_40'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['UMUR_KRG_50'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['UMUR_KRG_60'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['UMUR_LBH_60'].'</td>
        </tr>';
    
    echo '
        </table></div>
		
        <div id="PageFeature">
            <div class="Excel">
                <img alt="Export to Excel" title="Export to Excel" src="'.HOST.'/images/Excel.jpg">
            </div>
        </div>
    ';
?>