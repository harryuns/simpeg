<?php
    echo '
        <div class="cnt_table_main">
        <div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;">'.$Laporan['Title'].'</div>
        <table style="width: 100%;">
            <tr>
                <td class="left" style="width: 4%;">No</td>
                <td class="center" style="width: 50%;">Content</td>
                <td class="center" style="width: 11%;">No Urut</td>
                <td class="center" style="width: 10%;">Singkat</td>
                <td class="center" style="width: 15%;">Sekolah</td>
                <td class="center" style="width: 10%;">Jumlah</td>
            </tr>
    ';
    
    $Counter = 0;
    $Laporan['Total'] = array('JUMLAH' => 0);
    
    foreach ($Laporan['List'] as $Key => $Element) {
        $Counter++;
        $Laporan['Total']['JUMLAH'] += $Element['JUMLAH'];
        
        echo '
            <tr>
                <td class="licon" style="text-align: center;">'.$Counter.'</td>
                <td class="body" style="text-align: left;">'.$Element['CONTENT'].'</td>
                <td class="body" style="text-align: center;">'.$Element['NO_URUT'].'</td>
                <td class="body" style="text-align: center;">'.$Element['SINGKAT'].'</td>
                <td class="body" style="text-align: center;">'.$Element['SEKOLAH'].'</td>
                <td class="body" style="text-align: center;">'.$Element['JUMLAH'].'</td>
            </tr>';
    }
    
    echo '
        <tr>
            <td class="licon" style="text-align: center;" colspan="5">Jumlah</td>
            <td class="body" style="text-align: center;">'.$Laporan['Total']['JUMLAH'].'</td>
        </tr>';
    
    echo 
        '</table></div>
        
        <div id="PageFeature">
            <div class="Excel">
                <img alt="Export to Excel" title="Export to Excel" src="'.HOST.'/images/Excel.jpg">
            </div>
        </div>
    ';
?>