<?php
	$record_per_page = 50;
	$row_counter = ($page_active * $record_per_page) - $record_per_page;
	$is_dosen = ($_POST['K_JENIS_KERJA'] == '01') ? true : false;
?>

<?php if (isset($array_pegawai) && count($array_pegawai) > 0) { ?>
<div id="ListPegawai" class="cnt_table_main"><table style="width: 1500px;">
<tr>
	<td class="left" style="width: 20px;" rowspan="2">No</td>
	<td class="center" style="width: 300px;" rowspan="2">NAMA</td>
	<?php if ($is_dosen) { ?><td class="center" style="width: 100px;" rowspan="2">NIDN</td><?php } ?>
	<td class="normal" style="width: 100px; text-align: center;" rowspan="2">NIP</td>
	<td class="normal" style="width: 100px; text-align: center;" colspan="2">PANGKAT</td>
	<td class="normal" style="width: 100px; text-align: center;" colspan="2">JABATAN</td>
	<td class="normal" style="width: 100px; text-align: center;" colspan="2">MASA KERJA</td>
	<td class="normal" style="width: 100px; text-align: center;" colspan="3">LATIHAN PRAJABATAN</td>
	<td class="normal" style="width: 100px; text-align: center;" colspan="3">PENDIDIKAN</td>
	<td class="normal" style="width: 100px; text-align: center;" rowspan="2">TANGGAL LAHIR</td>
	<td class="normal" style="width: 100px; text-align: center;" rowspan="2">UMUR</td>
	<td class="normal" style="width: 100px; text-align: center;" rowspan="2">CATATAN MUTASI KEPEG</td>
	<td class="normal" style="width: 100px; text-align: center;" rowspan="2">FAK</td></tr>
<tr>
	<td class="body center">GOL</td>
	<td class="body center">TMT</td>
	<td class="body center">NAMA</td>
	<td class="body center">TMT</td>
	<td class="body center">SEMUA</td>
	<td class="body center">GOL</td>
	<td class="body center">NAMA</td>
	<td class="body center">BLN/TH</td>
	<td class="body center">JAM</td>
	<td class="body center">NAMA</td>
	<td class="body center">TAHUN</td>
	<td class="body center">IJZ</td></tr>
	
	<?php foreach ($array_pegawai as $key => $row) { ?>
		<?php $row_counter++; ?>
		
		<tr>
			<td class="licon" style="text-align: center;"><?php echo $row_counter; ?></td>
			<td class="body" style="text-align: left;"><?php echo $row['NAMA_LENGKAP']; ?></td>
			<?php if ($is_dosen) { ?><td class="body" style="text-align: left;"><?php echo $row['NIDN']; ?></td><?php } ?>
			<td class="body" style="text-align: left;">
				<a href="<?php echo $row['LinkEdit']; ?>"><?php echo $row['K_PEGAWAI']; ?></a>
			</td>
			<td class="body" style="text-align: left;"><?php echo $row['GOL']; ?></td>
			<td class="body" style="text-align: left;"><?php echo ExchangeFormatDate($row['TMT_GOL']); ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['BAGIAN_JABATAN']; ?></td>
			<td class="body" style="text-align: center;"><?php echo ExchangeFormatDate($row['TMT_JABATAN']); ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['MASA_KERJA_SEMUA']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['MASA_KERJA_GOLONGAN']; ?></td>
			<td class="body" style="text-align: center;">&nbsp;</td>
			<td class="body" style="text-align: center;">&nbsp;</td>
			<td class="body" style="text-align: center;">&nbsp;</td>
			<td class="body" style="text-align: center;"><?php echo $row['JENJANG_PENDIDIKAN']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['THN_LULUS']; ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['IJZ']; ?></td>
			<td class="body" style="text-align: center;"><?php echo ExchangeFormatDate($row['TGL_LAHIR']); ?></td>
			<td class="body" style="text-align: center;"><?php echo $row['UMUR']; ?></td>
			<td class="body" style="text-align: center;">&nbsp;</td>
			<td class="body" style="text-align: center;">&nbsp;</td></tr>
    <?php } ?>

</table></div>

<div id="PageFeature">
	<div id="PagePegawai">
		<?php for ($Counter = -5; $Counter < 5; $Counter++) { ?>
			<?php $page_counter = $page_active + $Counter; ?>
			<?php if ($page_counter >= 1 && $page_counter <= $page_count) { ?>
				<?php $Class = ($Counter == 0) ? 'active' : ''; ?>
				<a class="<?php echo $Class; ?>"><?php echo $page_counter; ?></a>
			<?php } ?>
		<?php } ?>
	</div>
	<!--
	<div class="Excel">
		<img src="<?php echo HOST.'/images/Excel.jpg'; ?>" title="Export to Excel" alt="Export to Excel" style="margin: 0 0 -8px 0;" />
		Export to Excel
	</div>
	-->
</div>

<?php } else if (isset($_POST['CariPegawai']) && !empty($_POST['CariPegawai'])) { ?>
	<div style="padding: 10px 0;">Data tidak ditemukan karena tidak ada data yang sesuai dengan kriteria pencarian.</div>
<?php } ?>