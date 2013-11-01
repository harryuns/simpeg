<?php
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <table style="width: 100%;">
            <tr>
                <td class="left" style="width: 4%;" rowspan="2">No</td>
                <td class="center" style="width: 21%;" rowspan="2">Fakultas</td>
                <td class="normal" style="width: 15%; text-align: center;" colspan="3">'.($Laporan['Year'] - 4).'</td>
                <td class="normal" style="width: 15%; text-align: center;" colspan="3">'.($Laporan['Year'] - 3).'</td>
                <td class="normal" style="width: 15%; text-align: center;" colspan="3">'.($Laporan['Year'] - 2).'</td>
                <td class="normal" style="width: 15%; text-align: center;" colspan="3">'.($Laporan['Year'] - 1).'</td>
                <td class="normal" style="width: 15%; text-align: center;" colspan="3">'.$Laporan['Year'].'</td>
            </tr>
            <tr>
                <td class="body" style="text-align: center; width: 5%;">L</td>
                <td class="body" style="text-align: center; width: 5%;">P</td>
                <td class="body" style="text-align: center; width: 5%;">Jml</td>
                <td class="body" style="text-align: center; width: 5%;">L</td>
                <td class="body" style="text-align: center; width: 5%;">P</td>
                <td class="body" style="text-align: center; width: 5%;">Jml</td>
                <td class="body" style="text-align: center; width: 5%;">L</td>
                <td class="body" style="text-align: center; width: 5%;">P</td>
                <td class="body" style="text-align: center; width: 5%;">Jml</td>
                <td class="body" style="text-align: center; width: 5%;">L</td>
                <td class="body" style="text-align: center; width: 5%;">P</td>
                <td class="body" style="text-align: center; width: 5%;">Jml</td>
                <td class="body" style="text-align: center; width: 5%;">L</td>
                <td class="body" style="text-align: center; width: 5%;">P</td>
                <td class="body" style="text-align: center; width: 5%;">Jml</td>
            </tr>
    ';
    
    $Counter = 0;
    $Laporan['Total'] = array(
        'JML_L1' => 0, 'JML_P1' => 0, 'JML_LP1' => 0, 'JML_L2' => 0, 'JML_P2' => 0, 'JML_LP2' => 0,
        'JML_L3' => 0, 'JML_P3' => 0, 'JML_LP3' => 0, 'JML_L4' => 0, 'JML_P4' => 0, 'JML_LP4' => 0,
        'JML_L5' => 0, 'JML_P5' => 0, 'JML_LP5' => 0,
    );
    
    foreach ($Laporan['List'] as $Key => $Element) {
        $Counter++;
        $Laporan['Total']['JML_L1'] += $Element['JML_L1'];
        $Laporan['Total']['JML_P1'] += $Element['JML_P1'];
        $Laporan['Total']['JML_LP1'] += $Element['JML_LP1'];
        $Laporan['Total']['JML_L2'] += $Element['JML_L2'];
        $Laporan['Total']['JML_P2'] += $Element['JML_P2'];
        $Laporan['Total']['JML_LP2'] += $Element['JML_LP2'];
        $Laporan['Total']['JML_L3'] += $Element['JML_L3'];
        $Laporan['Total']['JML_P3'] += $Element['JML_P3'];
        $Laporan['Total']['JML_LP3'] += $Element['JML_LP3'];
        $Laporan['Total']['JML_L4'] += $Element['JML_L4'];
        $Laporan['Total']['JML_P4'] += $Element['JML_P4'];
        $Laporan['Total']['JML_LP4'] += $Element['JML_LP4'];
        $Laporan['Total']['JML_L5'] += $Element['JML_L5'];
        $Laporan['Total']['JML_P5'] += $Element['JML_P5'];
        $Laporan['Total']['JML_LP5'] += $Element['JML_LP5'];
        
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">'.$Element['FAKULTAS'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_L5'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_P5'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_LP5'].'</td>
            </tr>';
    }
    
    echo '
        <tr>
            <td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_L5'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_P5'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_LP5'].'</td>
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