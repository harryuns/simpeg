<?php if (isset($array_pegawai) && count($array_pegawai) > 0) { ?>
<div id="ListPegawai" class="cnt_table_main" style="width: 100%;"><table>
<tr>
	<td class="left" style="width: 25px;">&nbsp;</td>
	<td class="normal" style="width: 25px;">&nbsp;</td>
	<td class="normal" style="width: 125px;">NIP</td>
	<td class="normal" style="width: 250px;">Nama Pegawai</td>
	<td class="normal" style="width: 125px;">Unit Kerja</td>
	<td class="normal" style="width: 125px;">Fungsional</td>
	<!--
	<td class="normal" style="width: 100px;">Jenjang</td>
	-->
	<td class="normal" style="width: 100px;">Jurusan</td>
	<td class="normal" style="width: 100px;">Prodi</td>
	<td class="normal" style="width: 100px;">Golongan</td>
	<td class="normal" style="width: 100px;">Download</td></tr>
	
	<?php foreach ($array_pegawai as $key => $row) { ?>
		<tr>
			<td class="licon">
				<img src="<?php echo HOST; ?>/images/Delete.png" class="DeletePegawai link" title="Delete" /></td>
			<td class="icon">
				<img src="<?php echo HOST; ?>/images/Profile.jpg" class="Detail link" title="Profile" /></td>
			<td class="body"><a href="<?php echo $row['LinkEdit']; ?>"><?php echo $row['K_PEGAWAI']; ?></a></td>
			<td class="body"><a href="<?php echo $row['LinkEdit']; ?>"><?php echo $row['NAMA']; ?></a></td>
			<td class="body"><?php echo $row['UNIT_KERJA']; ?>&nbsp;</td>
			<td class="body"><?php echo @$row['FUNGSIONAL']; ?>&nbsp;</td>
			<!--
			<td class="body"><?php echo $row['JENJANG']; ?>&nbsp;</td>
			-->
			<td class="body"><?php echo $row['JURUSAN']; ?>&nbsp;</td>
			<td class="body"><?php echo $row['PRODI']; ?>&nbsp;</td>
			<td class="body"><?php echo $row['GOLONGAN']; ?>&nbsp;</td>
			<td class="body center">
				<?php if (!empty($row['link_download_excel'])) { ?>
					<a href="<?php echo $row['link_download_excel']; ?>">
						<img src="<?php echo HOST.'/images/Excel.jpg'; ?>" style="width: 25px;" /></a>
				<?php } else { ?>
					&nbsp;
				<?php } ?>
			</td>
		</tr>
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
	<div class="Excel">
		<img src="<?php echo HOST.'/images/Excel.jpg'; ?>" title="Export to Excel" alt="Export to Excel" style="margin: 0 0 -8px 0;" />
		Export to Excel
	</div>
</div>

<?php } else if (isset($_POST['CariPegawai']) && !empty($_POST['CariPegawai'])) { ?>
	<div style="padding: 10px 0;">Data tidak ditemukan karena tidak ada data yang sesuai dengan kriteria pencarian.</div>
<?php } ?>