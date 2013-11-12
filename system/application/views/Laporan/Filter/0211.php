<?php
	$ArrayStatusKerja = $this->CI->lstatus_kerja->GetArrayStatusKerja(array( 'with_all' => true ));
	
    $ArrayYear = array();
    for ($Year = date("Y"); $Year >= 2000; $Year--) {
        $ArrayYear[$Year] = $Year;
    }
	$ArrayJenjang = $this->CI->ljenjang->GetArrayJenjang();
	$ArrayFakultas = $this->CI->lfakultas->GetArrayFakultas();
?>
<input type="hidden" name="IS_DOSEN" value="0" />
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Status Kerja</div>
<div style="float: left; width: 350px;"><select name="K_STATUS_KERJA" style="width: 300px;"><?php echo GetOption(false, $ArrayStatusKerja, 'x'); ?></select></div>
<div class="clear"></div>
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Tahun</div>
<div style="float: left; width: 500px;">
    <select name="Tahun" style="width: 100px;"><?php echo GetOption(false, $ArrayYear, ''); ?></select>
    <img src="<?php echo HOST; ?>/images/Info.png" title="Informasi yang ditampilkan adalah 5 tahun kebelakang" style="width: 20px; height: 20px; margin: 0 0 -5px 0;" /></div>
<div class="clear"></div>