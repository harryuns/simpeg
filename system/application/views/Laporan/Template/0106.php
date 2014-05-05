<?php
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <table>
            <tr>
                <td class="left">No</td>
                <td class="center">Fakultas / Unit Kerja</td>
                <td class="normal" style="text-align: center;">S1</td>
                <td class="normal" style="text-align: center;">S2</td>
                <td class="normal" style="text-align: center;">S3</td>
                <td class="normal" style="text-align: center;">Spesialis 1</td>
            </tr>
    ';
    
    $Counter = 0;
    $Laporan['Total'] = array(
        'S1' => 0, 'S2' => 0, 'S3' => 0, 'SP1' => 0
    );
	
    foreach ($Laporan['List'] as $Key => $Element) {
        $Counter++;
        $Laporan['Total']['S1'] += $Element['S1'];
        $Laporan['Total']['S2'] += $Element['S2'];
        $Laporan['Total']['S3'] += $Element['S3'];
        $Laporan['Total']['SP1'] += $Element['SP1'];
        
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">'.$Element['UNIT_KERJA'].'</td>
                <td class="body" style="text-align: center;">'.$Element['S1'].'</td>
                <td class="body" style="text-align: center;">'.$Element['S2'].'</td>
                <td class="body" style="text-align: center;">'.$Element['S3'].'</td>
                <td class="body" style="text-align: center;">'.$Element['SP1'].'</td>
            </tr>';
    }
	
    echo '
        <tr>
            <td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['S1'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['S2'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['S3'].'</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['SP1'].'</td>
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