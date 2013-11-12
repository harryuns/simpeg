<?php
	$status_kerja = (empty($_POST['STATUS_KERJA'])) ? 1 : $_POST['STATUS_KERJA'];
	
	// count total
	$Laporan['Total'] = array( '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0 );
    foreach ($Laporan['List'] as $key => $row) {
        $Laporan['Total']['2'] += $row['2'];
        $Laporan['Total']['3'] += $row['3'];
        $Laporan['Total']['4'] += $row['4'];
        $Laporan['Total']['5'] += $row['5'];
        $Laporan['Total']['6'] += $row['6'];
        $Laporan['Total']['7'] += $row['7'];
        $Laporan['Total']['8'] += $row['8'];
        $Laporan['Total']['9'] += $row['9'];
        $Laporan['Total']['10'] += $row['10'];
        $Laporan['Total']['11'] += $row['11'];
    }
?>

<div class="cnt_table_main">
	<div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;"><?php echo $Laporan['Title']; ?></div>
	<table style="width: 100%;">
		<!-- print table header -->
		<?php if ($status_kerja == 1) { ?>
		<tr>
			<td class="left" style="width: 4%;" rowspan="2">No</td>
			<td class="center" style="width: 36%;" rowspan="2">Fakultas / Unit Kerja</td>
			<td class="normal" style="width: 12%; text-align: center;" colspan="3"><?php echo ($Laporan['Year'] - 4); ?></td>
			<td class="normal" style="width: 12%; text-align: center;" colspan="3"><?php echo ($Laporan['Year'] - 3); ?></td>
			<td class="normal" style="width: 12%; text-align: center;" colspan="3"><?php echo ($Laporan['Year'] - 2); ?></td>
			<td class="normal" style="width: 12%; text-align: center;" colspan="3"><?php echo ($Laporan['Year'] - 1); ?></td>
			<td class="normal" style="width: 12%; text-align: center;" colspan="3"><?php echo $Laporan['Year']; ?></td></tr>
		<tr>
			<td class="normal" style="text-align: center;">PNS</td>
			<td class="normal" style="text-align: center;">Non</td>
			<td class="normal" style="text-align: center;">Jml</td>
			<td class="normal" style="text-align: center;">PNS</td>
			<td class="normal" style="text-align: center;">Non</td>
			<td class="normal" style="text-align: center;">Jml</td>
			<td class="normal" style="text-align: center;">PNS</td>
			<td class="normal" style="text-align: center;">Non</td>
			<td class="normal" style="text-align: center;">Jml</td>
			<td class="normal" style="text-align: center;">PNS</td>
			<td class="normal" style="text-align: center;">Non</td>
			<td class="normal" style="text-align: center;">Jml</td>
			<td class="normal" style="text-align: center;">PNS</td>
			<td class="normal" style="text-align: center;">Non</td>
			<td class="normal" style="text-align: center;">Jml</td></tr>
		<?php } else if ($status_kerja == 2 || $status_kerja == 3) { ?>
		<tr>
			<td class="left" style="width: 4%;">No</td>
			<td class="center" style="width: 36%;">Fakultas / Unit Kerja</td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 4); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 3); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 2); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 1); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo $Laporan['Year']; ?></td></tr>
		<?php } ?>
		
		<!-- print table body -->
		<?php if ($status_kerja == 1) { ?>
			<?php $counter = 0; ?>
			<?php foreach ($Laporan['List'] as $key => $row) { ?>
			<?php $counter++; ?>
            <tr>
                <td class="licon" style="text-align: center;"><?php echo $counter; ?></td>
                <td class="body" style="text-align: left;"><?php echo $row['FAKULTAS']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['2']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['3']; ?></td>
                <td class="body" style="text-align: center;"><?php echo ($row['2'] + $row['3']); ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['4']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['5']; ?></td>
                <td class="body" style="text-align: center;"><?php echo ($row['4'] + $row['5']); ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['6']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['7']; ?></td>
                <td class="body" style="text-align: center;"><?php echo ($row['6'] + $row['7']); ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['8']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['9']; ?></td>
                <td class="body" style="text-align: center;"><?php echo ($row['8'] + $row['9']); ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['10']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['11']; ?></td>
                <td class="body" style="text-align: center;"><?php echo ($row['10'] + $row['11']); ?></td></tr>
			<?php } ?>
			
			<tr>
				<td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['2']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['3']; ?></td>
				<td class="body" style="text-align: center;"><?php echo ($Laporan['Total']['2'] + $Laporan['Total']['3']); ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['4']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['5']; ?></td>
				<td class="body" style="text-align: center;"><?php echo ($Laporan['Total']['4'] + $Laporan['Total']['4']); ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['6']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['7']; ?></td>
				<td class="body" style="text-align: center;"><?php echo ($Laporan['Total']['6'] + $Laporan['Total']['7']); ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['8']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['9']; ?></td>
				<td class="body" style="text-align: center;"><?php echo ($Laporan['Total']['8'] + $Laporan['Total']['8']); ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['10']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['11']; ?></td>
				<td class="body" style="text-align: center;"><?php echo ($Laporan['Total']['10'] + $Laporan['Total']['11']); ?></td></tr>
		<?php } else if ($status_kerja == 2) { ?>
			<?php $counter = 0; ?>
			<?php foreach ($Laporan['List'] as $key => $row) { ?>
			<?php $counter++; ?>
            <tr>
                <td class="licon" style="text-align: center;"><?php echo $counter; ?></td>
                <td class="body" style="text-align: left;"><?php echo $row['FAKULTAS']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['2']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['4']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['6']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['8']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['10']; ?></td></tr>
			<?php } ?>
			<tr>
				<td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['2']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['4']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['6']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['8']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['10']; ?></td></tr>
		<?php } else if ($status_kerja == 3) { ?>
			<?php $counter = 0; ?>
			<?php foreach ($Laporan['List'] as $key => $row) { ?>
			<?php $counter++; ?>
            <tr>
                <td class="licon" style="text-align: center;"><?php echo $counter; ?></td>
                <td class="body" style="text-align: left;"><?php echo $row['FAKULTAS']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['3']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['5']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['7']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['9']; ?></td>
                <td class="body" style="text-align: center;"><?php echo $row['11']; ?></td></tr>
			<?php } ?>
			<tr>
				<td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['3']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['5']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['7']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['9']; ?></td>
				<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['11']; ?></td></tr>
		<?php } ?>
	</table>
</div>

<?php
    echo '
        <div id="PageFeature" class="hidden">
            <div class="Excel">
                <img alt="Export to Excel" title="Export to Excel" src="'.HOST.'/images/Excel.jpg">
            </div>
        </div>
    ';
?>