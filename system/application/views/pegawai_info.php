<?php
	// make it exist for label
	if (!isset($Pegawai)) {
		$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
		$Pegawai = $this->lpegawai->GetPegawaiById($k_pegawai);
	}
	
	$ArrayStatusKerja = $this->lstatus_kerja->GetArrayStatusKerja();
	$ArrayJenisKerja = $this->ljenis_kerja->GetArrayJenisKerja();
?>

<?php if (!empty($Pegawai['K_PEGAWAI'])) { ?>
<div id="InfoPegawai" style="padding: 0 0 20px 0;">
    <div style="float: left; width: 100px;">NIP</div>
    <div style="float: left; width: 250px;"><?php echo $Pegawai['K_PEGAWAI']; ?></div>
    <div style="clear: both;"></div>
    <div style="float: left; width: 100px;">Nama</div>
    <div style="float: left; width: 250px;"><?php echo $Pegawai['NAMA_GELAR']; ?></div>
    <div style="clear: both;"></div>
    <div style="float: left; width: 100px;">Status Kerja</div>
    <div style="float: left; width: 250px;"><?php echo $ArrayStatusKerja[$Pegawai['K_STATUS_KERJA']]['Content']; ?></div>
    <div style="clear: both;"></div>
    <div style="float: left; width: 100px;">Jenis Kerja</div>
    <div style="float: left; width: 250px;"><?php echo $ArrayJenisKerja[$Pegawai['K_JENIS_KERJA']]['Content']; ?></div>
    <div style="clear: both;"></div>
</div>
<?php } ?>

<div class="hidden">
	<iframe name="iframe_upload" src="<?php echo HOST.'/index.php/common/upload'; ?>"></iframe>
</div>

<?php
if (!empty($Page['PageTitle'])) {
    echo '<h1>'.$Page['PageTitle'].'</h1>';
}
?>