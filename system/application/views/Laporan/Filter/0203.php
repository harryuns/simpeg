<?php
    $ArrayYear = array();
    for ($Year = date("Y"); $Year >= 2000; $Year--) {
        $ArrayYear[$Year] = $Year;
    }
	$ArrayJenjang = $this->CI->ljenjang->GetArrayJenjang();
	$ArrayFakultas = $this->CI->lfakultas->GetArrayFakultas();
?>
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Tahun</div>
<div style="float: left; width: 500px;">
    <select name="Tahun" style="width: 100px;"><?php echo GetOption(false, $ArrayYear, ''); ?></select>
    <img src="<?php echo HOST; ?>/images/Info.png" title="Informasi yang ditampilkan adalah 5 tahun kebelakang" style="width: 20px; height: 20px; margin: 0 0 -5px 0;" /></div>
<div class="clear"></div>
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Fakultas</div>
<div style="float: left; width: 350px;"><select name="K_FAKULTAS" style="width: 300px;"><?php echo GetOption(false, $ArrayFakultas, ''); ?></select></div>
<div class="clear"></div>
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Jenjang</div>
<div style="float: left; width: 350px;"><select name="K_JENJANG" style="width: 300px;"><?php echo GetOption(false, $ArrayJenjang, ''); ?></select></div>
<div class="clear"></div>