<?php if (isset($array_pegawai) && count($array_pegawai) > 0) { ?>
<div id="ListPegawai" class="cnt_table_main" style=" : 100%;"><table style="width : 100%">
<tr>
	<th class="left" style=" : 25px;">&nbsp;</th>
	<th class="normal"  style="width:12px">&nbsp;</th>
	<th class="normal" style=" : 125px;">NIP</th>
	<th class="normal" style=" : 200px;">Nama Pegawai</th>
	<th class="normal" style=" : 100px;">Unit Kerja</th>
	<th class="normal" style=" : 100px;">Fungsional</th>
	<th class="normal" style=" : 75px;">Email</th>
	<th class="normal" style=" : 75px;">Jurusan</th>
	<th class="normal" style=" : 100px;">Prodi</th>
	<th class="normal" style=" : 75px;">Golongan</th>
	<th class="normal" style=" : 100px;">Download</th></tr>
	  
	<?php foreach ($array_pegawai as $key => $row) { ?>
		<tr>
			<td class="licon">
				<img src="<?php echo base_url('images/Delete.png'); ?>" class="DeletePegawai link" title="Delete" /></td>
			<td class="icon">
				<img src="<?php echo base_url('images/Profile.jpg'); ?>" class="Detail link" title="Profile" width="16px" /></td>
			<td  ><a href="<?php echo $row['LinkEdit']; ?>"><?php echo $row['K_PEGAWAI']; ?></a></td>
			<td  ><a href="<?php echo $row['LinkEdit']; ?>"><?php echo $row['NAMA']; ?></a></td>
			<td  ><?php echo $row['UNIT_KERJA']; ?>&nbsp;</td>
			<td  ><?php echo $row['JABATAN_FUNGSIONAL']; ?>&nbsp;</td>
			<td  ><?php echo @$row['EMAIL']; ?>&nbsp;</td>
			<td  ><?php echo $row['JURUSAN']; ?>&nbsp;</td>
			<td  ><?php echo $row['PRODI']; ?>&nbsp;</td>
			<td  ><?php echo $row['GOLONGAN']; ?>&nbsp;</td>
			<td class="body center">
				<?php if (!empty($row['link_download_excel'])) { ?>
					<a href="<?php echo $row['link_download_excel']; ?>">
						<img src="<?php echo base_url('images/Excel.jpg'); ?>" /></a>
				<?php } else { ?>
					&nbsp;
				<?php } ?>
			</td>
		</tr>
	<?php } ?>
	
</table></div>

<div id="PageFeature" class="clearfix" style="padding:10px 0">
	<div id="PagePegawai " style="width:50%" class="left">
		<?php for ($Counter = -5; $Counter < 5; $Counter++) { ?>
			<?php $page_counter = $page_active + $Counter; ?>
			<?php if ($page_counter >= 1 && $page_counter <= $page_count) { ?>
				<?php $Class = ($Counter == 0) ? 'active' : ''; ?>
				<a class="<?php echo $Class; ?>"><?php echo $page_counter; ?></a>
			<?php } ?>
		<?php } ?>
	</div>
	<div class="Excel right" style="line-height:20px; font-size:90%; display:inline-block">
		<img src="<?php echo base_url('images/Excel.jpg'); ?>" title="Export to Excel" alt="Export to Excel" style="margin: 0 0 -8px 0;width:20px; display:inline-block" />
		<div  style="line-height:20px; font-size:90%; display:inline-block; vertical-align:middle">
    Export to Excel
    </div>
	</div>
</div>

<?php } else if (isset($_POST['CariPegawai']) && !empty($_POST['CariPegawai'])) { ?>
	<div style="padding: 10px 0;">Data tidak ditemukan karena tidak ada data yang sesuai dengan kriteria pencarian.</div>
<?php } ?>