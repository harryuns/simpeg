<?php
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <table style="width: 100%;">
            <tr>
                <td class="left" style="width: 5%;">No</td>
                <td class="center" style="width: 20%;">Jurusan</td>
                <td class="center" style="width: 20%;">Jabatan Fungsional</td>
                <td class="normal" style="width: 11%; text-align: center;">'.($Laporan['Year'] - 4).'</td>
                <td class="normal" style="width: 11%; text-align: center;">'.($Laporan['Year'] - 3).'</td>
                <td class="normal" style="width: 11%; text-align: center;">'.($Laporan['Year'] - 2).'</td>
                <td class="normal" style="width: 11%; text-align: center;">'.($Laporan['Year'] - 1).'</td>
                <td class="normal" style="width: 11%; text-align: center;">'.$Laporan['Year'].'</td>
            </tr>
    ';
    
    $Counter = 0;
    $Laporan['Total'] = array(
        'JML_0' => 0, 'JML_1' => 0, 'JML_2' => 0, 'JML_3' => 0, 'JML_4' => 0
    );
    
    foreach ($Laporan['List'] as $Key => $Element) {
        $Counter++;
        $Laporan['Total']['JML_0'] += $Element['JML_0'];
        $Laporan['Total']['JML_1'] += $Element['JML_1'];
        $Laporan['Total']['JML_2'] += $Element['JML_2'];
        $Laporan['Total']['JML_3'] += $Element['JML_3'];
        $Laporan['Total']['JML_4'] += $Element['JML_4'];
        
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">'.$Element['JURUSAN'].'</td>
                <td class="body" style="text-align: left;">'.$Element['JABATAN_FUNGSIONAL'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_4'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JML_0'].'</td>
            </tr>';
    }
	
    echo '
        <tr>
            <td class="licon" style="text-align: center;" colspan="3">Jumlah</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_4'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JML_0'].'</td>
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