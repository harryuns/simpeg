<?php
	$ArrayStatusKerja = $this->CI->lstatus_kerja->GetArrayStatusKerja(array( 'with_all' => true ));
?>

<div class="form-row">
	<label>Status Kerja</label>
  <select name="K_STATUS_KERJA" style="width: 300px;"><?php echo GetOption(false, $ArrayStatusKerja, 'x'); ?></select>
</div>

<div class="clear"></div>