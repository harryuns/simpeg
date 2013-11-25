<?php
//	print_r($ArrayRiwayatPangkat); exit;
	$Pegawai['Foto'] = (empty($Pegawai['Foto'])) ? HOST.'/images/Profile.jpg' : $Pegawai['Foto'];
?>
<html>
<head>
	<title>Curriculum Vitae - <?php echo $Pegawai['NAMA']; ?></title>
	<style>table, th, td { border: 1px solid black; }</style>
</head>
<body>
	<div style="text-align: center; text-decoration: underline;">DAFTAR RIWAYAT HIDUP</div>
	<div style="text-align: right; ">
		<img style="width: 96px; height: 126px; border: 1px solid #000000; padding: 2px;" src="<?php echo $Pegawai['Foto']; ?>" />
	</div>
	<div style="clear: both;"></div>
	
	<div style="text-decoration: underline;">I. KETERANGAN PERORANGAN</div>
	<div style="font-style: italic; padding: 10px 0; text-align: center;">Hapus ditulis dengan nama sendiri, menggunakan huruf capital / balok dan tinta hitam.</div>
	<div style="padding: 0 0 20px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr>
				<td style="width: 3%; text-align: center;">1</td>
				<td colspan="2" style="width: 42%; padding: 7px 0 8px 10px;">Nama Lengkap</td>
				<td style="width: 55%; padding: 7px 0 8px 10px;"><?php echo $Pegawai['NAMA']; ?></td></tr>
			<tr>
				<td style="text-align: center;">2</td>
				<td colspan="2" style="padding: 7px 0 8px 10px;">NIP</td>
				<td style="padding: 7px 0 8px 10px;"><?php echo $Pegawai['K_PEGAWAI']; ?></td></tr>
			<tr>
				<td style="text-align: center;">3</td>
				<td colspan="2" style="padding: 7px 0 8px 10px;">Pangkat dan Golongan Ruang</td>
				<td style="padding: 7px 0 8px 10px;"><?php echo $Pegawai['PANGKAT'] . ' / ' . $Pegawai['GOLONGAN'] . $Pegawai['RUANG']; ?></td></tr>
			<tr>
				<td style="text-align: center;">4</td>
				<td colspan="2" style="padding: 7px 0 8px 10px;">Tempat lahir / tanggal lahir</td>
				<td style="padding: 7px 0 8px 10px;"><?php echo $Pegawai['TMP_LAHIR'] . ', ' . ConvertDateToString($Pegawai['TGL_LAHIR']); ?></td></tr>
			<tr>
				<td style="text-align: center;">5</td>
				<td colspan="2" style="padding: 7px 0 8px 10px;">Jenis Kelamin</td>
				<td style="padding: 7px 0 8px 10px;"><?php echo $Pegawai['JENIS_KELAMIN']; ?></td></tr>
			<tr>
				<td style="text-align: center;">6</td>
				<td colspan="2" style="padding: 7px 0 8px 10px;">Agama</td>
				<td style="padding: 7px 0 8px 10px;"><?php echo $Pegawai['AGAMA']; ?></td></tr>
			<tr>
				<td style="text-align: center;">7</td>
				<td colspan="2" style="padding: 7px 0 8px 10px;">Status Perkawinan</td>
				<td style="padding: 7px 0 8px 10px;"><?php echo $Pegawai['STATUS_KAWIN']; ?></td></tr>
			<tr>
				<td rowspan="5" style="text-align: center;">8</td>
				<td rowspan="5" style="width: 21%; padding: 0 0 0 10px;">Alamat Rumah</td>
				<td style="width: 21%; padding: 7px 0 8px 10px;">a. Jalan</td>
				<td style="padding: 7px 0 8px 10px;"><?php echo $Pegawai['ALAMAT']; ?></td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">b. Kelurahan / Desa</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">c. Kecamatan</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">d. Kabupaten / Kota</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">e. Propinsi</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td rowspan="7" style="text-align: center;">9</td>
				<td rowspan="7" style="width: 21%; padding: 0 0 0 10px;">Keterangan Badan</td>
				<td style="width: 21%; padding: 7px 0 8px 10px;">a. Tinggi (cm)</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">b. Berat Badan (kg)</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">c. Rambut</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">d. Bentuk Muka</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">e. Warna Kulit</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">e. Ciri Khas</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="padding: 7px 0 8px 10px;">e. Cacat tubuh</td>
				<td style="">&nbsp;</td></tr>
			<tr>
				<td style="text-align: center;">10</td>
				<td colspan="2" style="padding: 7px 0 8px 10px;">Kegemaran (Hobby)</td>
				<td style="">&nbsp;</td></tr>
		</table>
	</div>
	
	<div style="text-decoration: underline;">II. RIWAYAT PENDIDIKAN</div>
	<div style="padding: 10px 0;">1. Pendidikan di Dalam dan Luar Negeri 12)</div>
	<div>
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 15%;">TINGKAT</td>
				<td style="width: 15%;">NAMA PENDIDIKAN</td>
				<td style="width: 15%;">JURUSAN</td>
				<td style="width: 15%;">STTB/TANDA LULUSAN/IJAZAH TAHUN</td>
				<td style="width: 15%;">TEMPAT</td>
				<td style="width: 15%; padding: 10px 0;">NAMA KEPALA SEKOLAH DIREKTUR/DEKAN/PROMOTOR</td></tr>
			<tr style="text-align: center;">
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatPendidikan as $Key => $Array) { ?>
				<?php $Counter++; ?>
				<tr>
					<td style="text-align: center;"><?php echo $Counter; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['JENJANG']; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['PROG_STUDI']; ?></td>
					<td>&nbsp;</td>
					<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_IJAZAH'], "Y"); ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NEGARA']; ?></td>
					<td>&nbsp;</td></tr>
			<?php } ?>
		</table>
	</div>
	<div style="padding: 10px 0;">2. Kursus/Latihan di Dalam dan di Luar Negeri 13)</div>
	<div style="padding: 0 0 20px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 19%; padding: 10px 0;">NAMA/KURSUS/LATIHAN</td>
				<td style="width: 19%; padding: 10px 0;">LAMANYA/TGL BULAN/THN/SD. TGL/BLN.THN</td>
				<td style="width: 19%; padding: 10px 0;">IJAZAH/TANDA LULUS/SURAT KETERANGAN TAHUN</td>
				<td style="width: 14%; padding: 10px 0;">TEMPAT</td>
				<td style="width: 24%; padding: 10px 0;">KETERANGAN</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="padding: 10px 0 10px 10px;">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td></tr>
		</table>
	</div>
	
	<div style="text-decoration: underline;">III. RIWAYAT PEKERJAAN</div>
	<div style="padding: 10px 0;">1. Riwayat Kepangkatan golongan ruang penggajian 14)</div>
	<div>
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center; font-size: 14px;">
				<td rowspan="2" style="width: 5%; text-align: center;">NO</td>
				<td rowspan="2" style="width: 15%; padding: 10px 0;">PANGKAT</td>
				<td rowspan="2" style="width: 15%; padding: 10px 0;">GOL RUANG PENGAJIAN</td>
				<td rowspan="2" style="width: 10%; padding: 10px 0;">BERLAKU TERHITUNG MULAI TANGGAL</td>
				<td rowspan="2" style="width: 10%; padding: 10px 0;">GAJI POKOK</td>
				<td colspan="3" style="width: 30%; padding: 10px 0;">SURAT KEPUTUSAN</td>
				<td rowspan="2" style="width: 15%; padding: 10px 0;">PERATURAN YANG DUJADIKAN DASAR</td></tr>
			<tr style="text-align: center;">
				<td style="padding: 10px 0;">PEJABAT</td>
				<td style="padding: 10px 0;">NOMOR</td>
				<td style="padding: 10px 0;">TGL</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatPangkat as $Key => $Array) { ?>
				<?php $Counter++; ?>
				<?php $Array['PANGKAT'] = trim($Array['PANGKAT']); ?>
				<?php $Pangkat = (empty($Array['PANGKAT'])) ? '&nbsp;' : $Array['PANGKAT']; ?>
				<tr>
					<td style="text-align: center;"><?php echo $Counter; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Pangkat; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['PANGKAT'] . ' / ' . $Array['GOLONGAN'] . $Array['RUANG']; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TMT']); ?></td>
					<td style="padding: 10px 10px 10px 0; text-align: right;"><?php echo (empty($Array['GAJI_POKOK'])) ? 0 : $Array['GAJI_POKOK']; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['ASAL_SK']; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NO_SK']; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_SK']); ?></td>
					<td>&nbsp;</td></tr>
			<?php } ?>
		</table>
	</div>
	<div style="padding: 10px 0;">2. Pengalaman jabatan/pekerjaan 15)</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td rowspan="2" style="width: 5%; text-align: center;">NO</td>
				<td rowspan="2" style="width: 15%; padding: 10px 0;">JABATAN / PEKERJAAN</td>
				<td rowspan="2" style="width: 15%; padding: 10px 0;">MULAI DAN SAMPAI</td>
				<td rowspan="2" style="width: 10%; padding: 10px 0;">GOL RUANG PENGAJIAN</td>
				<td rowspan="2" style="width: 10%; padding: 10px 0;">GAJI POKOK</td>
				<td colspan="3" style="width: 30%; padding: 10px 0;">SURAT KEPUTUSAN</td></tr>
			<tr style="text-align: center;">
				<td style="padding: 10px 0;">PEJABAT</td>
				<td style="padding: 10px 0;">NOMOR</td>
				<td style="padding: 10px 0;">TGL</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="padding: 10px 0 10px 10px;">&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td></tr>
		</table>
	</div>
	
	<div style="text-decoration: underline;">IV. TANDA JASA / PENGHARGAAN 160</div>
	<div style="padding: 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 40%; padding: 10px 0;">NAMA/BINTANG LENCANA PENGHARGAAN</td>
				<td style="width: 15%; padding: 10px 0;">TAHUN PEROLEHAN</td>
				<td style="width: 40%; padding: 10px 0;">NAMA NEGARA/INSTANSI YANG MEMBERI</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatPenghargaan as $Key => $Array) { ?>
				<?php $Counter++; ?>
				<tr>
					<td style="text-align: center;"><?php echo $Counter; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NAMA_PENGHARGAAN']; ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_SK'], "Y"); ?></td>
					<td style="padding: 10px 0 10px 10px;"><?php echo $Array['ASAL_SK']; ?></td></tr>
			<?php } ?>
		</table>
	</div>
	
	<div style="text-decoration: underline;">V. PENGALAMAN KUNJUNGAN KE LUAR NEGERI 7)</div>
	<div style="padding: 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 25%; padding: 10px 0;">NEGARA</td>
				<td style="width: 25%; padding: 10px 0;">TUJUAN KUNJUNGAN</td>
				<td style="width: 20%; padding: 10px 0;">LAMANYA</td>
				<td style="width: 25%; padding: 10px 0;">YANG MEMBIAYAI</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td></tr>
		</table>
	</div>
	
	<div style="text-decoration: underline;">VI. KETERANGAN KELUARGA 18)</div>
	<div style="padding: 10px 0;">1. Istri/Suami</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 15%; padding: 10px 0;">NAMA</td>
				<td style="width: 15%; padding: 10px 0;">TEMPAT LAHIR</td>
				<td style="width: 15%; padding: 10px 0;">TANGGAL LAHIR</td>
				<td style="width: 15%; padding: 10px 0;">TANGGAL NIKAH</td>
				<td style="width: 15%; padding: 10px 0;">PEKERJAAN</td>
				<td style="width: 20%; padding: 10px 0;">KETERANGAN</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td>
				<td style="text-align: center;">6</td>
				<td style="text-align: center;">7</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatKeluarga as $Key => $Array) { ?>
				<?php if (in_array($Array['K_KELUARGA'], array('01', '02'))) { ?>
					<?php $Counter++; ?>
					<?php $Array['PEKERJAAN'] = trim($Array['PEKERJAAN']); ?>
					<?php $Array['KETERANGAN'] = trim($Array['KETERANGAN']); ?>
					<?php $Array['PEKERJAAN'] = (empty($Array['PEKERJAAN'])) ? '&nbsp;' : $Array['PEKERJAAN']; ?>
					<?php $Array['KETERANGAN'] = (empty($Array['KETERANGAN'])) ? '&nbsp;' : $Array['KETERANGAN']; ?>
					<tr>
						<td style="text-align: center;"><?php echo $Counter; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NAMA']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['TMP_LAHIR']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_LAHIR']); ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_NIKAH']); ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['PEKERJAAN']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['KETERANGAN']; ?></td></tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
	
	<div style="padding: 10px 0;">2. Anak</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 15%; padding: 10px 0;">NAMA</td>
				<td style="width: 15%; padding: 10px 0;">JENIS KELAMIN</td>
				<td style="width: 15%; padding: 10px 0;">TEMPAT LAHIR</td>
				<td style="width: 15%; padding: 10px 0;">TANGGAL LAHIR</td>
				<td style="width: 15%; padding: 10px 0;">SEKOLAH / PEKERJAAN</td>
				<td style="width: 20%; padding: 10px 0;">KETERANGAN</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td>
				<td style="text-align: center;">6</td>
				<td style="text-align: center;">7</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatKeluarga as $Key => $Array) { ?>
				<?php if (in_array($Array['K_KELUARGA'], array('03', '04'))) { ?>
					<?php $Counter++; ?>
					<?php $Array['PEKERJAAN'] = trim($Array['PEKERJAAN']); ?>
					<?php $Array['KETERANGAN'] = trim($Array['KETERANGAN']); ?>
					<?php $Array['PEKERJAAN'] = (empty($Array['PEKERJAAN'])) ? '&nbsp;' : $Array['PEKERJAAN']; ?>
					<?php $Array['KETERANGAN'] = (empty($Array['KETERANGAN'])) ? '&nbsp;' : $Array['KETERANGAN']; ?>
					<tr>
						<td style="text-align: center;"><?php echo $Counter; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NAMA']; ?></td>
						<td style="padding: 10px 0 10px 10px;">&nbsp;</td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['TMP_LAHIR']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_LAHIR']); ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['PEKERJAAN']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['KETERANGAN']; ?></td></tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>

	<div style="padding: 10px 0;">3. Bapak dan Ibu kandung</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 25%; padding: 10px 0;">NAMA</td>
				<td style="width: 25%; padding: 10px 0;">TANGGAL LAHIR/UMUR</td>
				<td style="width: 25%; padding: 10px 0;">PEKERJAAAN</td>
				<td style="width: 30%; padding: 10px 0;">KETERANGAN</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatKeluarga as $Key => $Array) { ?>
				<?php if (in_array($Array['K_KELUARGA'], array('05'))) { ?>
					<?php $Counter++; ?>
					<?php $Array['PEKERJAAN'] = trim($Array['PEKERJAAN']); ?>
					<?php $Array['KETERANGAN'] = trim($Array['KETERANGAN']); ?>
					<?php $Array['PEKERJAAN'] = (empty($Array['PEKERJAAN'])) ? '&nbsp;' : $Array['PEKERJAAN']; ?>
					<?php $Array['KETERANGAN'] = (empty($Array['KETERANGAN'])) ? '&nbsp;' : $Array['KETERANGAN']; ?>
					<tr>
						<td style="text-align: center;"><?php echo $Counter; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NAMA']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_LAHIR']); ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['PEKERJAAN']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['KETERANGAN']; ?></td></tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>

	<div style="padding: 10px 0;">4. Bapak dan Ibu Mertua</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 25%; padding: 10px 0;">NAMA</td>
				<td style="width: 25%; padding: 10px 0;">TANGGAL LAHIR/UMUR</td>
				<td style="width: 25%; padding: 10px 0;">PEKERJAAAN</td>
				<td style="width: 30%; padding: 10px 0;">KETERANGAN</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatKeluarga as $Key => $Array) { ?>
				<?php if (in_array($Array['K_KELUARGA'], array('06'))) { ?>
					<?php $Counter++; ?>
					<?php $Array['PEKERJAAN'] = trim($Array['PEKERJAAN']); ?>
					<?php $Array['KETERANGAN'] = trim($Array['KETERANGAN']); ?>
					<?php $Array['PEKERJAAN'] = (empty($Array['PEKERJAAN'])) ? '&nbsp;' : $Array['PEKERJAAN']; ?>
					<?php $Array['KETERANGAN'] = (empty($Array['KETERANGAN'])) ? '&nbsp;' : $Array['KETERANGAN']; ?>
					<tr>
						<td style="text-align: center;"><?php echo $Counter; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NAMA']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_LAHIR']); ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['PEKERJAAN']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['KETERANGAN']; ?></td></tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>

	<div style="padding: 10px 0;">5. Saudara Kandung</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 20%; padding: 10px 0;">NAMA</td>
				<td style="width: 15%; padding: 10px 0;">JENIS KELAMIN</td>
				<td style="width: 20%; padding: 10px 0;">TANGGAL LAHIR/UMUR</td>
				<td style="width: 20%; padding: 10px 0;">PEKERJAAAN</td>
				<td style="width: 20%; padding: 10px 0;">KETERANGAN</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td>
				<td style="text-align: center;">6</td></tr>
			<?php $Counter = 0; ?>
			<?php foreach ($ArrayRiwayatKeluarga as $Key => $Array) { ?>
				<?php if (in_array($Array['K_KELUARGA'], array('07'))) { ?>
					<?php $Counter++; ?>
					<?php $Array['PEKERJAAN'] = trim($Array['PEKERJAAN']); ?>
					<?php $Array['KETERANGAN'] = trim($Array['KETERANGAN']); ?>
					<?php $Array['PEKERJAAN'] = (empty($Array['PEKERJAAN'])) ? '&nbsp;' : $Array['PEKERJAAN']; ?>
					<?php $Array['KETERANGAN'] = (empty($Array['KETERANGAN'])) ? '&nbsp;' : $Array['KETERANGAN']; ?>
					<tr>
						<td style="text-align: center;"><?php echo $Counter; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['NAMA']; ?></td>
						<td style="padding: 10px 0 10px 10px;">&nbsp;</td>
						<td style="padding: 10px 0 10px 10px;"><?php echo ConvertDateToString($Array['TGL_LAHIR']); ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['PEKERJAAN']; ?></td>
						<td style="padding: 10px 0 10px 10px;"><?php echo $Array['KETERANGAN']; ?></td></tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
	
	<div style="text-decoration: underline;">VII. KETERANGAN ORGANISASI</div>
	<div style="padding: 10px 0;">1. Semasa mengikuti pendidikan pada SLTA ke bawah</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 20%; padding: 10px 0;">NAMA ORGANISASI</td>
				<td style="width: 20%; padding: 10px 0;">KEDUDUKAN DALAM ORGANISASI</td>
				<td style="width: 15%; padding: 10px 0;">DALAM TAHUN s/d TAHUN</td>
				<td style="width: 20%; padding: 10px 0;">TEMPAT</td>
				<td style="width: 20%; padding: 10px 0;">NAMA PIMPINAN ORGANISASI</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td>
				<td style="text-align: center;">6</td></tr>
		</table>
	</div>

	<div style="padding: 10px 0;">2. Semasa mengikuti pendidikan pada perguruan tinggi</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 20%; padding: 10px 0;">NAMA ORGANISASI</td>
				<td style="width: 20%; padding: 10px 0;">KEDUDUKAN DALAM ORGANISASI</td>
				<td style="width: 15%; padding: 10px 0;">DALAM TAHUN s/d TAHUN</td>
				<td style="width: 20%; padding: 10px 0;">TEMPAT</td>
				<td style="width: 20%; padding: 10px 0;">NAMA PIMPINAN ORGANISASI</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td>
				<td style="text-align: center;">6</td></tr>
		</table>
	</div>

	<div style="padding: 10px 0;">3. Sesudah selesai pendidikan dan atau selama menjadi pegawai</div>
	<div style="padding: 0 0 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td style="width: 5%; text-align: center;">NO</td>
				<td style="width: 20%; padding: 10px 0;">NAMA ORGANISASI</td>
				<td style="width: 20%; padding: 10px 0;">KEDUDUKAN DALAM ORGANISASI</td>
				<td style="width: 15%; padding: 10px 0;">DALAM TAHUN s/d TAHUN</td>
				<td style="width: 20%; padding: 10px 0;">TEMPAT</td>
				<td style="width: 20%; padding: 10px 0;">NAMA PIMPINAN ORGANISASI</td></tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td>
				<td style="text-align: center;">6</td></tr>
		</table>
	</div>
	
	<div style="text-decoration: underline;">VIII. KETERANGAN LAIN-LAIN</div>
	<div style="padding: 10px 0;">
		<table style="width: 100%; border: 1px solid #000000; border-spacing: 0px;">
			<tr style="text-align: center;">
				<td rowspan="2" style="width: 5%; text-align: center;">NO</td>
				<td rowspan="2" style="width: 20%; padding: 10px 0;">NAMA KETERANGAN</td>
				<td colspan="2" style="width: 20%; padding: 10px 0;">SURAT KETERANGAN</td>
				<td rowspan="2" style="width: 15%; padding: 10px 0;">TANGGAL</td></tr>
			<tr style="text-align: center;">
				<td>PEJABAT</td>
				<td>NOMOR</td>
			</tr>
			<tr>
				<td style="text-align: center;">1</td>
				<td style="text-align: center;">2</td>
				<td style="text-align: center;">3</td>
				<td style="text-align: center;">4</td>
				<td style="text-align: center;">5</td></tr>
			<tr>
				<td style="text-align: center; padding: 25px 0;">1</td>
				<td style="padding: 25px 0 25px 10px;">KETERANGAN BERKELAKUAN BAIK</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td></tr>
			<tr>
				<td style="text-align: center; padding: 25px 0;">2</td>
				<td style="padding: 25px 0 25px 10px;">KETERANGAN BERBADAN SEHAT</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td></tr>
			<tr>
				<td style="text-align: center; padding: 25px 0;">3</td>
				<td style="padding: 25px 0 25px 10px;" colspan="4">KETERANGAN LAIN YANG DIANGGAP PERLU</td></tr>
		</table>
	</div>

	<div style="padding: 0 0 10px 0;">Demikina daftar riwayat hidup ini saya buat dengan sesungguhnya, dan apabila dikemudian hari terdapat keterangan yang tidak benar saya bersedia dituntut dimuka pengadilan, serta bersedia menerima segala tindakan yang diambil oleh pemerintah.</div>
	<div style="padding: 0 0 0 60%;">
		<div>Malang, <?php echo ConvertDateToString(date("Y-m-d")); ?></div>
		<div>Yang membuat</div>
		<div style="padding: 60px 0 0 0;">(<?php echo $Pegawai['NAMA']; ?>)</div>
	</div>
	<div style="clear: both;"></div>

	<div style="font-weight: 700;">PERHATIAN:</div>
</body>
</html>