<?php
    $ArrayYear = array();
    for ($Year = date("Y"); $Year >= 2000; $Year--) {
        $ArrayYear[$Year] = $Year;
    }
	$ArrayJenjang = $this->CI->ljenjang->GetArrayJenjang();
	$ArrayFakultas = $this->CI->lfakultas->GetArrayFakultas();
	$ArrayStatusKerja = $this->CI->lstatus_kerja->GetArrayStatusKerja(array( 'with_all' => true ));
?>
<!--
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Fakultas</div>
<div style="float: left; width: 350px;"><select name="K_FAKULTAS" style="width: 300px;"><?php echo GetOption(false, $ArrayFakultas, ''); ?></select></div>
<div class="clear"></div>
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Jenjang</div>
<div style="float: left; width: 350px;"><select name="K_JENJANG" style="width: 300px;"><?php echo GetOption(false, $ArrayJenjang, ''); ?></select></div>
<div class="clear"></div>
-->
<input type="hidden" name="K_JENIS_KERJA" value="02" />

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