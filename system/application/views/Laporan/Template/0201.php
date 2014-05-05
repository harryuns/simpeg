<?php
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <table>
            <tr>
                <td class="left" rowspan="2">No</td>
                <td class="center" rowspan="2">Jurusan</td>
                <td class="normal" style="text-align: center;" colspan="3">'.($Laporan['Year'] - 4).'</td>
                <td class="normal" style="text-align: center;" colspan="3">'.($Laporan['Year'] - 3).'</td>
                <td class="normal" style="text-align: center;" colspan="3">'.($Laporan['Year'] - 2).'</td>
                <td class="normal" style="text-align: center;" colspan="3">'.($Laporan['Year'] - 1).'</td>
                <td class="normal" style="text-align: center;" colspan="3">'.$Laporan['Year'].'</td>
            </tr>
            <tr>
                <td class="body" style="text-align: center; ">L</td>
                <td class="body" style="text-align: center; ">P</td>
                <td class="body" style="text-align: center; ">Jml</td>
                <td class="body" style="text-align: center; ">L</td>
                <td class="body" style="text-align: center; ">P</td>
                <td class="body" style="text-align: center; ">Jml</td>
                <td class="body" style="text-align: center; ">L</td>
                <td class="body" style="text-align: center; ">P</td>
                <td class="body" style="text-align: center; ">Jml</td>
                <td class="body" style="text-align: center; ">L</td>
                <td class="body" style="text-align: center; ">P</td>
                <td class="body" style="text-align: center; ">Jml</td>
                <td class="body" style="text-align: center; ">L</td>
                <td class="body" style="text-align: center; ">P</td>
                <td class="body" style="text-align: center; ">Jml</td>
            </tr>
    ';
	
    $Counter = 0;
    $Laporan['Total'] = array(
        'JML_L_0' => 0, 'JML_P_0' => 0, 'JML_LP_0' => 0, 'JML_L_1' => 0, 'JML_P_1' => 0, 'JML_LP_1' => 0,
		'JML_L_2' => 0, 'JML_P_2' => 0, 'JML_LP_2' => 0, 'JML_L_3' => 0, 'JML_P_3' => 0, 'JML_LP_3' => 0,
		'JML_L_4' => 0, 'JML_P_4' => 0, 'JML_LP_4' => 0
    );
    
    foreach ($Laporan['List'] as $Key => $Element) {
        $Counter++;
		$Element['JML_LP_0'] = $Element['JML_L_0'] + $Element['JML_P_0'];
		$Element['JML_LP_1'] = $Element['JML_L_1'] + $Element['JML_P_1'];
		$Element['JML_LP_2'] = $Element['JML_L_2'] + $Element['JML_P_2'];
		$Element['JML_LP_3'] = $Element['JML_L_3'] + $Element['JML_P_3'];
		$Element['JML_LP_4'] = $Element['JML_L_4'] + $Element['JML_P_4'];
        $Laporan['Total']['JML_L_0'] += $Element['JML_L_0'];
        $Laporan['Total']['JML_P_0'] += $Element['JML_P_0'];
        $Laporan['Total']['JML_LP_0'] += $Element['JML_LP_0'];
        $Laporan['Total']['JML_L_1'] += $Element['JML_L_1'];
        $Laporan['Total']['JML_P_1'] += $Element['JML_P_1'];
        $Laporan['Total']['JML_LP_1'] += $Element['JML_LP_1'];
        $Laporan['Total']['JML_L_2'] += $Element['JML_L_2'];
        $Laporan['Total']['JML_P_2'] += $Element['JML_P_2'];
        $Laporan['Total']['JML_LP_2'] += $Element['JML_LP_2'];
        $Laporan['Total']['JML_L_3'] += $Element['JML_L_3'];
        $Laporan['Total']['JML_P_3'] += $Element['JML_P_3'];
        $Laporan['Total']['JML_LP_3'] += $Element['JML_LP_3'];
        $Laporan['Total']['JML_L_4'] += $Element['JML_L_4'];
        $Laporan['Total']['JML_P_4'] += $Element['JML_P_4'];
        $Laporan['Total']['JML_LP_4'] += $Element['JML_LP_4'];
		
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">'.$Element['JURUSAN'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L_0'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P_0'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP_0'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L_1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P_1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP_1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L_2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P_2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP_2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L_3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P_3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP_3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L_4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P_4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP_4'].'</td>
            </tr>';
    }
    
    echo '
        <tr>
            <td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L_0'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P_0'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP_0'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L_1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P_1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP_1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L_2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P_2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP_2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L_3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P_3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP_3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L_4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P_4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP_4'].'</td>
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