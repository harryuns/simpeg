<?php
	$User = $this->llogin->GetUser();
?>

    <nav id="nav">
    
    <ul id="menu">
    
<?php if ($_SESSION['UserLogin']['ApplicationRequest'] == 'Simpeg') { ?>
	<?php if (in_array($User['UserGroupID'], $this->config->item('admin_group_id'))) { ?>
    <li>
		<a class="menuitem " href="<?php echo HTTPS.'/index.php/Pegawai'; ?>"><span class="menu-icon menu-cari">&nbsp;</span>Pencarian</a>		
    </li>
		<?php if ($this->llogin->IsUserFakultas() == 0 || true) { ?>
		<li>
    <a class="menuitem submenuheader" href="#"><span class="menu-icon menu-seleksi">&nbsp;</span>Seleksi Pegawai</a> 
		
      <ul class="submenu">
          <li><a href="<?php echo HTTPS.'/index.php/SeleksiDosen/CariPeserta'; ?>">Pencarian</a></li>
          <li><a href="<?php echo HTTPS.'/index.php/SeleksiDosen'; ?>">Tambah Peserta</a></li>						
          <li><a href="<?php echo HTTPS.'/index.php/SeleksiDosen/HapusPesertaAll'; ?>">Hapus Peserta</a></li>
          <li><a href="<?php echo HTTPS.'/index.php/SeleksiDosen/UnggahPeserta'; ?>">Unggah Peserta</a></li>												
          <li><a href="<?php echo HTTPS.'/index.php/SeleksiDosen/Cetak'; ?>">Cetak</a></li>								
      </ul>
    </li>
		<?php } ?>
		<?php if ($this->llogin->IsUserFakultas() == 0 || true) { ?>
			<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/Pegawai/Tambah'; ?>"><span class="menu-icon menu-tambah">&nbsp;</span>Pegawai Baru</a></li>
		<?php } ?>
		<li><a class="menuitem submenuheader" href="#"><span class="menu-icon menu-laporan">&nbsp;</span>Laporan</a>
		<ul class="submenu">
				<li><a href="<?php echo HTTPS.'/index.php/Laporan'; ?>">Kepegawaian</a></li>
				<li><a href="<?php echo HTTPS.'/index.php/LaporanEkd'; ?>">Nilai EKD</a></li>
				<li><a href="<?php echo HTTPS.'/index.php/LaporanEkd/Simulasi'; ?>">Simulasi</a></li>
				<li><a href="<?php echo HTTPS.'/index.php/LaporanEkd/AssessorActivity'; ?>">Kegiatan Asesor</a></li>
				<li><a href="#">Entry EKD Dosen</a></li>
		</ul>
    </li>
		<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/Asessor'; ?>"><span class="menu-icon menu-asesor">&nbsp;</span>Asesor</a></li>
		<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/DirGuruBesar'; ?>"><span class="menu-icon menu-direktori">&nbsp;</span>Directory Guru Besar</a></li>
		<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/Panduan'; ?>"><span class="menu-icon menu-panduan">&nbsp;</span>Panduan</a></li>
		<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/Pesan'; ?>"><span class="menu-icon menu-pesan">&nbsp;</span>Pesan</a></li>
        <li><div class="sp"></div>
		<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/login/Out'; ?>"><span class="menu-icon misc-keluar">&nbsp;</span>Keluar</a></li>
	<?php } else { ?>
		<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/login/Out'; ?>"><span class="menu-icon misc-keluar">&nbsp;</span>Keluar</a></li>
	<?php } ?>
<?php } else if ($_SESSION['UserLogin']['ApplicationRequest'] == 'Siado') { ?>
	<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/Panduan'; ?>"><span class="menu-icon menu-keluar">&nbsp;</span>Panduan</a></li>
	<li><a class="menuitem" href="<?php echo HTTPS.'/index.php/SendToEkd/Logout'; ?>"><span class="menu-icon menu-keluar">&nbsp;</span>Kembali ke Siado</a></li>
<?php } ?>

    </ul>
    </nav>
    
    
    