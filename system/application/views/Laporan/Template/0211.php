<?php
	$array_total = array();
	$array_column = array( 'Pustakawan Utama', 'Arsiparis Utama', 'Pranata Komputer', 'Pranata Laboratorium Kependidikan', 'Pustakawan Muda', 'Pustakawan Pertama', 'Pustakawan Penyelia', 'Pustakawan Pelaksana Lanjutan', 'Pustakawan Pelaksana', 'Fungsional Umum Tenaga Kependidikan', 'Arsiparis Pertama', 'Arsiparis Penyelia', 'Arsiiparis Pelaksana Lanjutan', 'Arsiparis Pelaksana' );
	$fakultas_length = 200;
	$table_length = (count($array_column) * 100) + 25 + $fakultas_length;
?>
<div class="cnt_table_main">
<div style="padding: 10px 0; font-weight: 700; font-size: 11px; text-align: center;"><?php echo $Laporan['Title']; ?></div>
<table style="width: <?php echo $table_length; ?>px;">
	<tr>
		<td class="left" style="width: 25px;">No</td>
		<td class="center" style="width: <?php echo $fakultas_length; ?>px;">Fakultas / Unit Kerja</td>
		<?php foreach ($array_column as $name) { ?>
			<td class="center" style="width: 100px;"><?php echo $name; ?></td>
		<?php } ?>
	</tr>
	
	<?php $counter = 0; ?>
	<?php foreach ($Laporan['List'] as $key => $row) { ?>
	<?php $counter++; ?>
	<tr>
		<td class="licon" style="text-align: center;"><?php echo $counter; ?></td>
		<td class="body" style="text-align: left;"><?php echo $row['UNIT_KERJA']; ?></td>
		<?php foreach ($array_column as $name) { ?>
		<?php $array_total[$name] = (isset($array_total[$name])) ? $array_total[$name] : 0; ?>
		<?php $array_total[$name] += $row[$name]; ?>
		<td class="body" style="text-align: center;"><?php echo $row[$name]; ?></td>
		<?php } ?>
	</tr>
	<?php } ?>
	
	<tr>
		<td colspan="2" class="center">Total</td>
		<?php foreach ($array_column as $name) { ?>
			<td class="center" style="width: 100px;"><?php echo @$array_total[$name]; ?></td>
		<?php } ?>
	</tr>
</table>