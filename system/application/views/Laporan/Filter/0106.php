<?php
	$ArrayStatusKerja = $this->CI->lstatus_kerja->GetArrayStatusKerja(array( 'with_all' => true ));
?>
<div style="float: left; width: 200px; padding: 0 0 10px 0;">Status Kerja</div>
<div style="float: left; width: 350px;"><select name="K_STATUS_KERJA" style="width: 300px;"><?php echo GetOption(false, $ArrayStatusKerja, 'x'); ?></select></div>
<div class="clear"></div>