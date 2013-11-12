<?php
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <table style="width: 100%;">
            <tr>
                <td class="left" style="width: 4%;">No</td>
                <td class="center" style="width: 21%;">Fakultas / Unit Kerja</td>
                <td class="normal" style="width: 5%; text-align: center;">III1</td>
                <td class="normal" style="width: 5%; text-align: center;">IV1</td>
                <td class="normal" style="width: 5%; text-align: center;">GOL1</td>
                <td class="normal" style="width: 5%; text-align: center;">III2</td>
                <td class="normal" style="width: 5%; text-align: center;">IV2</td>
                <td class="normal" style="width: 5%; text-align: center;">GOL2</td>
                <td class="normal" style="width: 5%; text-align: center;">III3</td>
                <td class="normal" style="width: 5%; text-align: center;">IV3</td>
                <td class="normal" style="width: 5%; text-align: center;">GOL3</td>
                <td class="normal" style="width: 5%; text-align: center;">III4</td>
                <td class="normal" style="width: 5%; text-align: center;">IV4</td>
                <td class="normal" style="width: 5%; text-align: center;">GOL4</td>
                <td class="normal" style="width: 5%; text-align: center;">III5</td>
                <td class="normal" style="width: 5%; text-align: center;">IV5</td>
                <td class="normal" style="width: 5%; text-align: center;">GOL5</td>
            </tr>
    ';
    
    $Counter = 0;
    $Laporan['Total'] = array(
        'JML_III1' => 0, 'JML_IV1' => 0, 'JML_GOL1' => 0, 'JML_III2' => 0, 'JML_IV2' => 0, 'JML_GOL2' => 0,
        'JML_III3' => 0, 'JML_IV3' => 0, 'JML_GOL3' => 0, 'JML_III4' => 0, 'JML_IV4' => 0, 'JML_GOL4' => 0,
        'JML_III5' => 0, 'JML_IV5' => 0, 'JML_GOL5' => 0
    );
    
    foreach ($Laporan['List'] as $Key => $Element) {
        $Counter++;
        $Laporan['Total']['JML_III1'] += $Element['JML_III1'];
        $Laporan['Total']['JML_IV1'] += $Element['JML_IV1'];
        $Laporan['Total']['JML_GOL1'] += $Element['JML_GOL1'];
        $Laporan['Total']['JML_III2'] += $Element['JML_III2'];
        $Laporan['Total']['JML_IV2'] += $Element['JML_IV2'];
        $Laporan['Total']['JML_GOL2'] += $Element['JML_GOL2'];
        $Laporan['Total']['JML_III3'] += $Element['JML_III3'];
        $Laporan['Total']['JML_IV3'] += $Element['JML_IV3'];
        $Laporan['Total']['JML_GOL3'] += $Element['JML_GOL3'];
        $Laporan['Total']['JML_III4'] += $Element['JML_III4'];
        $Laporan['Total']['JML_IV4'] += $Element['JML_IV4'];
        $Laporan['Total']['JML_GOL4'] += $Element['JML_GOL4'];
        $Laporan['Total']['JML_III5'] += $Element['JML_III5'];
        $Laporan['Total']['JML_IV5'] += $Element['JML_IV5'];
        $Laporan['Total']['JML_GOL5'] += $Element['JML_GOL5'];
        
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">'.$Element['FAKULTAS'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_III1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_IV1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_GOL1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_III2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_IV2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_GOL2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_III3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_IV3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_GOL3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_III4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_IV4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_GOL4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_III5'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_IV5'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_GOL5'].'</td>
            </tr>';
    }
    
    echo '
        <tr>
            <td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_III1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_IV1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_GOL1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_III2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_IV2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_GOL2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_III3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_IV3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_GOL3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_III4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_IV4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_GOL4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_III5'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_IV5'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_GOL5'].'</td>
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