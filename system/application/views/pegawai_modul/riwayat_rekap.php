<?php
	$array_pegawai_aktif_request = $this->riwayat_aktif_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_diklat_request = $this->riwayat_diklat_request_model->get_array(array( 'k_pegawai' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_fungsional_request = $this->riwayat_fungsional_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_homebase_request = $this->riwayat_homebase_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_honorer_request = $this->riwayat_honorer_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_hukuman_request = $this->riwayat_hukuman_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_keluarga_request = $this->riwayat_keluarga_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_organisasi_request = $this->riwayat_organisasi_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_pangkat_request = $this->riwayat_pangkat_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_pendidikan_request = $this->riwayat_pendidikan_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_riwayat_penghargaan_request = $this->riwayat_penghargaan_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_perubahan_gaji_request = $this->riwayat_perubahan_gaji_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_seminar_request = $this->riwayat_seminar_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_sertifikasi_request = $this->riwayat_sertifikasi_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
	$array_pegawai_struktural_request = $this->riwayat_struktural_request_model->get_array(array( 'K_PEGAWAI' => 'x', 'IS_VALIDATE' => 0, 'limit' => 5 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Rekap Riwayat Belum Tervalidasi' ) ); ?>

<body>
<div id="body"><div id="frame">
	<div id="sidebar">
		<div class="glossymenu"><?php $this->load->view('main_menu'); ?></div>
	</div>
	
	<div id="content"><div class="full" style="min-height: 400px;"><div id="CntRightFull">
		<div class="cnt-grid">
			<?php if (count($array_pegawai_aktif_request) > 0) { ?>
				<h1>Perubahan / Mutasi Pegawai</h1>
				<div class="cnt_table_main record-valid"><table style="width: 975px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 175px;">Status Aktif</td>
						<td class="normal" style="width: 175px;">No SK</td>
						<td class="normal" style="width: 175px;">Tanggal Mulai</td>
						<td class="normal" style="width: 175px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_aktif_request as $row) { ?>
					<?php $link = base_url('index.php/pegawai_modul/riwayat_aktif/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['AKTIF']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_diklat_request) > 0) { ?>
				<h1>Riwayat Diklat</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1500px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No Sertifikat</td>
						<td class="normal" style="width: 100px;">Tanggal SK</td>
						<td class="normal" style="width: 100px;">Diklat</td>
						<td class="normal" style="width: 200px;">Penyelenggara</td>
						<td class="normal" style="width: 100px;">Tempat Diklat</td>
						<td class="normal" style="width: 100px;">Angkatan</td>
						<td class="normal" style="width: 100px;">Tanggal Mulai</td>
						<td class="normal" style="width: 100px;">Tanggal Lulus</td>
						<td class="normal" style="width: 300px;">Keterangan</td>
						<td class="normal" style="width: 50px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_diklat_request as $row) { ?>
					<?php $link = base_url('index.php/pegawai_modul/riwayat_diklat/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SERTIFIKAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SERTIFIKAT']); ?></td>
						<td class="body"><?php echo $row['DIKLAT']; ?></td>
						<td class="body"><?php echo $row['PENYELENGGARA']; ?></td>
						<td class="body"><?php echo $row['TMP_DIKLAT']; ?></td>
						<td class="body"><?php echo $row['ANGKATAN']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_LULUS']); ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_homebase_request) > 0) { ?>
				<h1>Riwayat Home Base</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1500px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 225px;">Asal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 225px;">Unit Kerja</td>
						<td class="normal" style="width: 225px;">Prodi</td>
						<td class="normal" style="width: 50px;">PDPT</td>
						<td class="normal" style="width: 50px;">SIMPEG</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_homebase_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_homebase/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo $row['PRODI']; ?></td>
						<td class="body"><?php echo $row['IS_PDPT_TEXT']; ?></td>
						<td class="body"><?php echo $row['IS_SIMPEG_TEXT']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_hukuman_request) > 0) { ?>
				<h1>Riwayat Hukuman</h1>
				<div class="cnt_table_main record-valid"><table style="width: 900px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 125px;">NIP Pejabat</td>
						<td class="normal" style="width: 125px;">Nama Pejabat</td></tr>
					<?php foreach ($array_pegawai_hukuman_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_hukuman/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['NIP_PEJABAT']; ?></td>
						<td class="body"><?php echo $row['NAMA_PEJABAT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_fungsional_request) > 0) { ?>
				<h1>Riwayat Jabatan Fungsional</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1650px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 200px;">Jabatan Fungsional</td>
						<td class="normal" style="width: 200px;">Unit Kerja</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 225px;">Asal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 100px;">Angka Kredit</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_fungsional_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_fungsional/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo $row['JABATAN_FUNGSIONAL']; ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['ANGKA_KREDIT']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_struktural_request) > 0) { ?>
				<h1>Riwayat Jabatan Struktural</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1575px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 100px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 200px;">Asal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 200px;">Unit Kerja</td>
						<td class="normal" style="width: 200px;">Jabatan Struktural</td>
						<td class="normal" style="width: 100px;">Tunjangan Struktural</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_struktural_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_struktural/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo $row['JABATAN_STRUKTURAL']; ?></td>
						<td class="body"><?php echo $row['TUNJANGAN_STRUKTURAL']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_keluarga_request) > 0) { ?>
				<h1>Riwayat Keluarga</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1350px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 125px;">Nama</td>
						<td class="normal" style="width: 150px;">Hub. Keluarga</td>
						<td class="normal" style="width: 125px;">Tanggal Lahir</td>
						<td class="normal" style="width: 150px;">Tempat Lahir</td>
						<td class="normal" style="width: 150px;">Pendidikan</td>
						<td class="normal" style="width: 150px;">Alamat</td>
						<td class="normal" style="width: 150px;">Pekerjaan</td>
						<td class="normal" style="width: 150px;">Keterangan</td></tr>
					<?php foreach ($array_pegawai_keluarga_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_keluarga/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NAMA']; ?></td>
						<td class="body"><?php echo $row['KELUARGA']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_LAHIR']); ?></td>
						<td class="body"><?php echo $row['TMP_LAHIR']; ?></td>
						<td class="body"><?php echo $row['JENJANG']; ?></td>
						<td class="body"><?php echo $row['ALAMAT']; ?></td>
						<td class="body"><?php echo $row['PEKERJAAN']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_organisasi_request) > 0) { ?>
				<h1>Riwayat Organisasi</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1325px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">Nama</td>
						<td class="normal" style="width: 150px;">Kedudukan</td>
						<td class="normal" style="width: 225px;">No SK</td>
						<td class="normal" style="width: 150px;">NIP Pejabat</td>
						<td class="normal" style="width: 225px;">Tanggal Mulai</td>
						<td class="normal" style="width: 225px;">Tanggal Selesai</td></tr>
					<?php foreach ($array_pegawai_organisasi_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_organisasi/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NAMA']; ?></td>
						<td class="body"><?php echo $row['KEDUDUKAN']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo $row['NIP_PEJABAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SELESAI']); ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_pangkat_request) > 0) { ?>
				<h1>Riwayat Pangkat</h1>
				<div class="cnt_table_main record-valid"><table style="width: 2075px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 150px;">Pangkat</td>
						<td class="normal" style="width: 150px;">Golongan</td>
						<td class="normal" style="width: 200px;">Asal SK</td>
						<td class="normal" style="width: 200px;">Penjelasan</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 150px;">Gaji Pokok</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 200px;">Penandatangan SK</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_pangkat_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_pangkat/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['PANGKAT']; ?></td>
						<td class="body"><?php echo $row['GOLONGAN']; ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo $row['PENJELASAN']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['GAJI_POKOK']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['PENANDATANGAN_SK']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_pendidikan_request) > 0) { ?>
				<h1>Riwayat Pendidikan</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1550px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 100px;">Jenjang</td>
						<td class="normal" style="width: 150px;">No Ijazah</td>
						<td class="normal" style="width: 125px;">Tanggal Ijazah</td>
						<td class="normal" style="width: 75px;">IPK</td>
						<td class="normal" style="width: 150px;">PT</td>
						<td class="normal" style="width: 100px;">Tahun Masuk</td>
						<td class="normal" style="width: 300px;">Program Studi</td>
						<td class="normal" style="width: 100px;">Bidang Ilmu</td>
						<td class="normal" style="width: 100px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Ijazah</td>
						<td class="normal" style="width: 75px;">Transkrip</td></tr>
					<?php foreach ($array_pegawai_pendidikan_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_pendidikan/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['JENJANG']; ?></td>
						<td class="body"><?php echo $row['NO_IJAZAH']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_IJAZAH']); ?></td>
						<td class="body"><?php echo $row['IPK']; ?></td>
						<td class="body"><?php echo $row['PT']; ?></td>
						<td class="body"><?php echo $row['THN_MASUK']; ?></td>
						<td class="body"><?php echo $row['PROG_STUDI']; ?></td>
						<td class="body"><?php echo $row['BIDANG_ILMU']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_IJAZAH_TEXT']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_NON_IJAZAH_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_honorer_request) > 0) { ?>
				<h1>Riwayat Penempatan Kerja</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1400px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 225px;">Asal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 225px;">Unit Kerja</td>
						<td class="normal" style="width: 225px;">Prodi</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_honorer_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_honorer/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo $row['PRODI']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_riwayat_penghargaan_request) > 0) { ?>
				<h1>Riwayat Penghargaan</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1150px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 200px;">Asal SK</td>
						<td class="normal" style="width: 200px;">Nama Penghargaan</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 50px;">Sertifikat</td></tr>
					<?php foreach ($array_riwayat_penghargaan_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_penghargaan/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo $row['NAMA_PENGHARGAAN']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_perubahan_gaji_request) > 0) { ?>
				<h1>Riwayat Perubahan Gaji</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1000px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 125px;">No SK</td>
						<td class="normal" style="width: 125px;">TMT</td>
						<td class="normal" style="width: 225px;">Gaji</td>
						<td class="normal" style="width: 275px;">Perubahan Gaji</td>
						<td class="normal" style="width: 50px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_perubahan_gaji_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_perubahan_gaji/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['GAJI']; ?></td>
						<td class="body"><?php echo $row['PERUBAHAN_GAJI']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_seminar_request) > 0) { ?>
				<h1>Riwayat Seminar</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1225px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">Tahun</td>
						<td class="normal" style="width: 150px;">Nama</td>
						<td class="normal" style="width: 200px;">Lokasi</td>
						<td class="normal" style="width: 150px;">Tingkat</td>
						<td class="normal" style="width: 150px;">Kedudukan</td>
						<td class="normal" style="width: 225px;">Penyelenggara</td></tr>
					<?php foreach ($array_pegawai_seminar_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_seminar/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['TAHUN']; ?></td>
						<td class="body"><?php echo $row['NAMA']; ?></td>
						<td class="body"><?php echo $row['LOKASI']; ?></td>
						<td class="body"><?php echo $row['TINGKAT']; ?></td>
						<td class="body"><?php echo $row['KEDUDUKAN']; ?></td>
						<td class="body"><?php echo $row['PENYELENGGARA']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_sertifikasi_request) > 0) { ?>
				<h1>Riwayat Sertifikasi</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1350px;">
					<tr>
						<td class="left" style="width: 50px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">NIP</td>
						<td class="normal" style="width: 150px;">No Sertifikat</td>
						<td class="normal" style="width: 125px;">Tanggal Sertifikat</td>
						<td class="normal" style="width: 150px;">No Peserta</td>
						<td class="normal" style="width: 200px;">Pejabat TT</td>
						<td class="normal" style="width: 100px;">Tunjangan</td>
						<td class="normal" style="width: 150px;">Tanggal Akhir</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_sertifikasi_request as $row) { ?>
						<?php $link = base_url('index.php/pegawai_modul/riwayat_sertifikasi/index/'.ConvertLink($row['K_PEGAWAI'])); ?>
					<tr>
						<td class="licon">
							<a href="<?php echo $link; ?>"><i class="fa fa-link fa-lg"></i></a>
						</td>
						<td class="body"><?php echo $row['K_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NO_SERTIFIKAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SERTIFIKAT']); ?></td>
						<td class="body"><?php echo $row['NO_PESERTA']; ?></td>
						<td class="body"><?php echo $row['PEJABAT_TT']; ?></td>
						<td class="body"><?php echo $row['TUNJANGAN_SERTIFIKASI']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_AKHIR']); ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
		</div>
	</div></div></div>
</div></div>
</body>
</html>