<?php
	$config_page['page_count'] = 10;
	
	$K_PEGAWAI = $_POST['K_PEGAWAI'];
	$pegawai = $this->lpegawai->GetPegawaiById($K_PEGAWAI);
	$array_pegawai_aktif = $this->lpegawai_aktif->GetArrayPegawaiActive($K_PEGAWAI);
	$array_riwayat_diklat = $this->lriwayat_diklat->GetArray($K_PEGAWAI);
	$array_riwayat_pangkat = $this->lriwayat_pangkat->GetArray($K_PEGAWAI);
	$array_riwayat_pendidikan = $this->lriwayat_pendidikan->GetArray($K_PEGAWAI);
	$array_riwayat_honorer = $this->lriwayat_honorer->GetArray($K_PEGAWAI);
	$array_riwayat_fungsional = $this->lriwayat_jabatan_fungsional->GetArray($K_PEGAWAI);
	$array_riwayat_struktural = $this->lriwayat_jabatan_struktural->GetArray($K_PEGAWAI);
	
	// kinerja bidang pendidikan
	$param_kinerja_bidang_pendidikan['k_pegawai'] = $K_PEGAWAI;
	$param_kinerja_bidang_pendidikan['k_kegiatan'] = 1;
	$array_kinerja_bidang_pendidikan = $this->dosen_luaran_model->get_kegiatan($param_kinerja_bidang_pendidikan);
	
	// kinerja bidang penelitian
	$param_kinerja_bidang_penelitian['k_pegawai'] = $K_PEGAWAI;
	$param_kinerja_bidang_penelitian['k_kegiatan'] = 2;
	$array_kinerja_bidang_penelitian = $this->dosen_luaran_model->get_kegiatan($param_kinerja_bidang_penelitian);
	
	// kinerja bidang pengabdian
	$param_kinerja_bidang_pengabdian['k_pegawai'] = $K_PEGAWAI;
	$param_kinerja_bidang_pengabdian['k_kegiatan'] = 3;
	$array_kinerja_bidang_pengabdian = $this->dosen_luaran_model->get_kegiatan($param_kinerja_bidang_pengabdian);
	
	// kinerja penunjang lainnya
	$param_kinerja_penunjang_lainnya['k_pegawai'] = $K_PEGAWAI;
	$param_kinerja_penunjang_lainnya['k_kegiatan'] = 4;
	$array_kinerja_penunjang_lainnya = $this->dosen_luaran_model->get_kegiatan($param_kinerja_penunjang_lainnya);
	
	// kinerja kewajiban khusus
	$param_kewajiban_khusus['k_pegawai'] = $K_PEGAWAI;
	$param_kewajiban_khusus['k_pegawai'] = 'x';
	$param_kewajiban_khusus['k_kegiatan'] = 5;
	$array_kewajiban_khusus = $this->dosen_luaran_model->get_kegiatan($param_kewajiban_khusus);
	
	// helper
	$array_aktif = $this->laktif->GetArrayAktif();
	$array_diklat = $this->ldiklat->GetArray();
	$array_jenjang = $this->ljenjang->GetArrayAll();
	$array_asal_sk = $this->lasal_sk->GetArrayAsalSk();
	$array_penjelasan = $this->lpenjelasan->GetArrayPenjelasan();
	
	$Array['ArrayAgama'] = $this->lagama->GetArrayAgama();
	$Array['ArrayNegara'] = $this->lnegara->GetArrayNegara();
	$Array['ArrayUnitKerja'] = $this->lunit_kerja->GetArrayAll();
	$Array['ArrayJenisKerja'] = $this->ljenis_kerja->GetArrayJenisKerja();
	$Array['ArrayJenisKelamin'] = $this->ljenis_kelamin->GetArrayJenisKelamin();
	$Array['ArrayStatusKawin'] = $this->lstatus_kawin->GetArrayStatusKawin();
	$Array['ArrayStatusKerja'] = $this->lstatus_kerja->GetArrayStatusKerja();
	$Array['ArrayStatusPensiun'] = $this->lstatus_pensiun->GetArrayStatusPensiun();
?>

<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Biodata</h6></div></div>
	<div class="table-overflow">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td>NIP</td>
					<td><?php echo $pegawai['K_PEGAWAI']; ?></td>
					<td rowspan="15">
						<?php if (!empty($pegawai['Foto'])) { ?>
							<img src="<?php echo $pegawai['Foto']; ?>" style="height: 130px; width: 100px;" />
						<?php } else { ?>
							&nbsp;
						<?php } ?>
					</td></tr>
				<tr>
					<td>Nama</td>
					<td><?php echo $pegawai['NAMA_GELAR']; ?></td></tr>
				<tr>
					<td>Tempat Lahir</td>
					<td><?php echo $pegawai['TMP_LAHIR']; ?></td></tr>
				<?php
				/*
				<tr>
					<td>Tanggal Lahir</td>
					<td><?php echo $pegawai['TGL_LAHIR']; ?></td></tr>
				<tr>
					<td>Alamat</td>
					<td><?php echo nl2br($pegawai['ALAMAT']); ?></td></tr>
				<tr>
					<td>Telepon Rumah</td>
					<td><?php echo $pegawai['TLP_RMH']; ?></td></tr>
				<tr>
					<td>No HP</td>
					<td><?php echo $pegawai['NO_HP']; ?></td></tr>
				<tr>
					<td>Email</td>
					<td><?php echo $pegawai['EMAIL']; ?></td></tr>
				*/
				?>
				<tr>
					<td>Jenis Kelamin</td>
					<td><?php echo $pegawai['JENIS_KELAMIN']; ?></td></tr>
				<tr>
					<td>Agama</td>
					<td><?php echo @$pegawai['AGAMA']; ?></td></tr>
				<tr>
					<td>Status Kawin</td>
					<td><?php echo @$pegawai['STATUS_KAWIN']; ?></td></tr>
				<tr>
					<td>Status Kerja</td>
					<td>&nbsp;</td></tr>
				<tr>
					<td>Jenis Kerja</td>
					<td>&nbsp;</td></tr>
				<tr>
					<td>Tahun Masuk</td>
					<td><?php echo $pegawai['THN_MASUK']; ?></td></tr>
				<tr>
					<td>Karpeg</td>
					<td><?php echo $pegawai['KARPEG']; ?></td></tr>
			</tbody>
		</table>
	</div>
</div>

<?php if (count($array_riwayat_pendidikan) > 0) { ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Riwayat Pendidikan</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Jenjang</th>
					<th>No Ijazah</th>
					<th>Tanggal Ijazah</th>
					<th>Tahun Masuk</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_riwayat_pendidikan as $key => $row) { ?>
				<tr>
					<td><?php echo $array_jenjang[$row['K_JENJANG']]['Content']; ?></td>
					<td><?php echo $row['NO_IJAZAH']; ?></td>
					<td><?php echo ConvertDateToString($row['TGL_IJAZAH']); ?></td>
					<td><?php echo $row['THN_MASUK']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_pegawai_aktif) > 0) { ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Pegawai Aktif</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Aktif</th>
					<th>No SK</th>
					<th>Tanggal Mulai</th>
					<th>Tanggal Selesai</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_pegawai_aktif as $key => $row) { ?>
				<tr>
					<td><?php echo $row['STATUS_AKTIF']; ?></td>
					<td><?php echo $row['NO_SK']; ?></td>
					<td><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
					<td><?php echo ConvertDateToString($row['TGL_SELESAI']); ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_riwayat_diklat) > 0) { ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Riwayat Diklat</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No SK</th>
					<th>Tanggal SK</th>
					<th>Diklat</th>
					<th>Tingkat</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_riwayat_diklat as $key => $row) { ?>
				<tr>
					<td><?php echo $row['NO_SERTIFIKAT']; ?></td>
					<td><?php echo ConvertDateToString($row['TGL_SERTIFIKAT']); ?></td>
					<td><?php echo $array_diklat[$row['K_DIKLAT']]['Content']; ?></td>
					<td><?php echo $row['TINGKAT']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_riwayat_pangkat) > 0) { ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Riwayat Pangkat</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No SK</th>
					<th>Tanggal SK</th>
					<th>Penjelasan</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_riwayat_pangkat as $key => $row) { ?>
				<tr>
					<td><?php echo $row['NO_SK']; ?></td>
					<td><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
					<td><?php echo $array_penjelasan[$row['K_PENJELASAN']]['Content']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_kinerja_bidang_pendidikan) > 0) { ?>
<?php $render_data_table = (count($array_kinerja_bidang_pendidikan) > $config_page['page_count']) ? 'data-table-detail' : ''; ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Kinerja Bidang Pendidikan</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered <?php echo $render_data_table; ?>">
			<thead>
				<tr>
					<th>Nama Kegiatan</th>
					<th>Kelompok Kegiatan</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_kinerja_bidang_pendidikan as $key => $row) { ?>
				<tr>
					<td><?php echo $row['KEGIATAN']; ?></td>
					<td><?php echo $row['KELOMPOK_KEGIATAN']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_kinerja_bidang_penelitian) > 0) { ?>
<?php $render_data_table = (count($array_kinerja_bidang_penelitian) > $config_page['page_count']) ? 'data-table-detail' : ''; ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Kinerja Bidang Penelitian</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered <?php echo $render_data_table; ?>">
			<thead>
				<tr>
					<th>Nama Kegiatan</th>
					<th>Kelompok Kegiatan</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_kinerja_bidang_penelitian as $key => $row) { ?>
				<tr>
					<td><?php echo $row['KEGIATAN']; ?></td>
					<td><?php echo $row['KELOMPOK_KEGIATAN']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_kinerja_bidang_pengabdian) > 0) { ?>
<?php $render_data_table = (count($array_kinerja_bidang_pengabdian) > $config_page['page_count']) ? 'data-table-detail' : ''; ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Kinerja Bidang Pengabdian</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered <?php echo $render_data_table; ?>">
			<thead>
				<tr>
					<th>Nama Kegiatan</th>
					<th>Kelompok Kegiatan</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_kinerja_bidang_pengabdian as $key => $row) { ?>
				<tr>
					<td><?php echo $row['KEGIATAN']; ?></td>
					<td><?php echo $row['KELOMPOK_KEGIATAN']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_kinerja_penunjang_lainnya) > 0) { ?>
<?php $render_data_table = (count($array_kinerja_penunjang_lainnya) > $config_page['page_count']) ? 'data-table-detail' : ''; ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Kinerja Penunjang Lainnya</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered <?php echo $render_data_table; ?>">
			<thead>
				<tr>
					<th>Nama Kegiatan</th>
					<th>Kelompok Kegiatan</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_kinerja_penunjang_lainnya as $key => $row) { ?>
				<tr>
					<td><?php echo $row['KEGIATAN']; ?></td>
					<td><?php echo $row['KELOMPOK_KEGIATAN']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<?php if (count($array_kewajiban_khusus) > 0) { ?>
<?php $render_data_table = (count($array_kewajiban_khusus) > $config_page['page_count']) ? 'data-table-detail' : ''; ?>
<div class="widget accordion">
	<div class="navbar"><div class="navbar-inner"><h6>Kewajiban Khusus Profesor</h6></div></div>
	<div class="table-overflow hide">
		<table class="table table-bordered <?php echo $render_data_table; ?>">
			<thead>
				<tr>
					<th>Nama Kegiatan</th>
					<th>Kelompok Kegiatan</th></tr>
			</thead>
			<tbody>
				<?php foreach ($array_kewajiban_khusus as $key => $row) { ?>
				<tr>
					<td><?php echo $row['KEGIATAN']; ?></td>
					<td><?php echo $row['KELOMPOK_KEGIATAN']; ?></td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php } ?>

<div class="form-actions" style="text-align: center;">
	<button type="button" class="btn btn-danger">Kembali</button>
</div>