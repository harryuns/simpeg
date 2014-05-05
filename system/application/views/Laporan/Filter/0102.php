<?php
	$ArrayStatusKerja = $this->CI->lstatus_kerja->GetArrayStatusKerja(array( 'with_all' => true ));
	
    $ArrayYear = array();
    for ($Year = date("Y"); $Year >= 2000; $Year--) {
        $ArrayYear[$Year] = $Year;
    }
?>
<input type="hidden" name="K_JENIS_KERJA" value="01" />


<div class="form-row">
	<label>Status Kerja</label>
  <select name="K_STATUS_KERJA" style="width: 300px;"><?php echo GetOption(false, $ArrayStatusKerja, 'x'); ?></select>
</div>
<div class="form-row">
	<label>Tahun</label>
  <select name="Tahun" style="width: 100px;"><?php echo GetOption(false, $ArrayYear, ''); ?></select>
    <img src="<?php echo HOST; ?>/images/Info.png" title="Informasi yang ditampilkan adalah 5 tahun kebelakang" style="width: 20px; height: 20px; margin: 0 0 -5px 0;" />
</div>

<div class="clear"></div>