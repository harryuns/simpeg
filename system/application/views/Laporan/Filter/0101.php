<?php
    $ArrayYear = array();
    for ($Year = date("Y"); $Year >= 2000; $Year--) {
        $ArrayYear[$Year] = $Year;
    }
?>
<input type="hidden" name="IS_DOSEN" value="1" />
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Status Kerja</div>
<div style="float: left; width: 350px;">
    <select name="STATUS_KERJA" style="width: 300px;">
		<option value="2">Pegawai Negeri Sipil</option>
		<option value="3">Pegawai Tetap Non PNS</option>
		<option value="1" selected>Semua</option>
	</select>
</div>
<div class="clear"></div>
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Tahun</div>
<div style="float: left; width: 500px;">
    <select name="Tahun" style="width: 100px;"><?php echo GetOption(false, $ArrayYear, ''); ?></select>
    <img src="<?php echo HOST; ?>/images/Info.png" title="Informasi yang ditampilkan adalah 5 tahun kebelakang" style="width: 20px; height: 20px; margin: 0 0 -5px 0;" />
</div>
<div class="clear"></div>