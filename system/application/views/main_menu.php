<?php
	$User = $this->llogin->GetUser();
?>
<?php if ($_SESSION['UserLogin']['ApplicationRequest'] == 'Simpeg') { ?>
	<?php if (in_array($User['UserGroupID'], $this->config->item('admin_group_id'))) { ?>
		<a class="menuitem " href="<?php echo HOST.'/index.php/Pegawai'; ?>">Pencarian</a>		
		<?php if ($this->llogin->IsUserFakultas() == 0 || true) { ?>
		<a class="menuitem submenuheader" href="#">Seleksi Pegawai</a> 
		<div class="submenu">
			<ul>
				<li><a href="<?php echo HOST.'/index.php/SeleksiDosen/CariPeserta'; ?>">Pencarian</a></li>
				<li><a href="<?php echo HOST.'/index.php/SeleksiDosen'; ?>">Tambah Peserta</a></li>						
				<li><a href="<?php echo HOST.'/index.php/SeleksiDosen/HapusPesertaAll'; ?>">Hapus Peserta</a></li>
				<li><a href="<?php echo HOST.'/index.php/SeleksiDosen/UnggahPeserta'; ?>">Unggah Peserta</a></li>												
				<li><a href="<?php echo HOST.'/index.php/SeleksiDosen/Cetak'; ?>">Cetak</a></li>								
			</ul>
		</div>
		<?php } ?>
		<?php if ($this->llogin->IsUserFakultas() == 0 || true) { ?>
			<a class="menuitem" href="<?php echo HOST.'/index.php/Pegawai/Tambah'; ?>">Pegawai Baru</a>
		<?php } ?>
		<a class="menuitem submenuheader" href="#">Laporan</a>
		<div class="submenu">
			<ul>
				<li><a href="<?php echo HOST.'/index.php/Laporan'; ?>">Kepegawaian</a></li>
				<li><a href="<?php echo HOST.'/index.php/LaporanEkd'; ?>">Nilai EKD</a></li>
				<li><a href="<?php echo HOST.'/index.php/LaporanEkd/Simulasi'; ?>">Simulasi</a></li>
				<li><a href="<?php echo HOST.'/index.php/LaporanEkd/AssessorActivity'; ?>">Kegiatan Asesor</a></li>
				<li><a href="#">Entry EKD Dosen</a></li>
			</ul>
		</div>
		<a class="menuitem" href="<?php echo HOST.'/index.php/Asessor'; ?>">Asesor</a>
		<!-- <a class="menuitem" href="<?php echo HOST.'/index.php/DirGuruBesar'; ?>">Directory Guru Besar</a>	-->
		<a class="menuitem" href="<?php echo HOST.'/index.php/Panduan'; ?>">Panduan</a>
		<a class="menuitem" href="<?php echo HOST.'/index.php/Pesan'; ?>">Pesan</a>
		<a class="menuitem" href="<?php echo HOST.'/index.php/login/Out'; ?>">Keluar</a>
	<?php } else { ?>
		<a class="menuitem" href="<?php echo HOST.'/index.php/login/Out'; ?>">Keluar</a>
	<?php } ?>
<?php } else if ($_SESSION['UserLogin']['ApplicationRequest'] == 'Siado') { ?>
	<a class="menuitem" href="<?php echo HOST.'/index.php/Panduan'; ?>">Panduan</a>
	<a class="menuitem" href="<?php echo HOST.'/index.php/SendToEkd/Logout'; ?>">Kembali ke Siado</a>
<?php } ?>