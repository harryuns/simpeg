<?php
	// count total
	$Laporan['Total'] = array( 'JUMLAH_I' => 0, 'JUMLAH_II' => 0, 'JUMLAH_III' => 0, 'JUMLAH_IV' => 0, 'JUMLAH_V' => 0 );
    foreach ($Laporan['List'] as $key => $row) {
        $Laporan['Total']['JUMLAH_I'] += $row['JUMLAH_I'];
        $Laporan['Total']['JUMLAH_II'] += $row['JUMLAH_II'];
        $Laporan['Total']['JUMLAH_III'] += $row['JUMLAH_III'];
        $Laporan['Total']['JUMLAH_IV'] += $row['JUMLAH_IV'];
        $Laporan['Total']['JUMLAH_V'] += $row['JUMLAH_V'];
    }
?>

<div class="cnt_table_main">
	<div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;"><?php echo $Laporan['Title']; ?></div>
	<table style="width: 100%;">
		<tr>
			<td class="left" style="width: 4%;">No</td>
			<td class="center" style="width: 36%;">Fakultas / Unit Kerja</td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 4); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 3); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 2); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo ($Laporan['Year'] - 1); ?></td>
			<td class="normal" style="width: 12%; text-align: center;"><?php echo $Laporan['Year']; ?></td></tr>
		
		<!-- write body -->
		<?php $counter = 0; ?>
		<?php foreach ($Laporan['List'] as $key => $row) { ?>
		<?php $counter++; ?>
		<tr>
			<td class="licon" style="text-align: center;"><?php echo $counter; ?></td>
			<td class="body" style="text-align: left;"><?php echo $row['CONTENT']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['JUMLAH_I']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['JUMLAH_II']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['JUMLAH_III']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['JUMLAH_IV']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['JUMLAH_V']; ?></td></tr>
		<?php } ?>
		<tr>
			<td class="licon" style="text-align: center;" colspan="2">Jumlah</td>
			<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['JUMLAH_I']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['JUMLAH_II']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['JUMLAH_III']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['JUMLAH_IV']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $Laporan['Total']['JUMLAH_V']; ?></td></tr>
	</table>
</div>