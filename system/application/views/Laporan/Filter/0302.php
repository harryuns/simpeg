<?php
	$user_fakultas_id = $_SESSION['UserLogin']['Fakultas']['ID'];
//	$user_fakultas_id = '01';
	
	$ArrayJurusan = $this->CI->ljurusan->GetArray();
	$ArrayFakultas = $this->CI->lfakultas->GetArrayFakultas();
	$ArrayProgramStudi = $this->CI->lprogram_studi->GetArray();
	$ArrayStatusKerja = $this->CI->lstatus_kerja->GetArrayStatusKerja(array( 'with_all' => true ));
	
	// get unit kerja (admin / fakultas)
	if ($user_fakultas_id == 'x') {
		$unit_kerja = $this->CI->lunit_kerja->get_by_id(array( 'K_UNIT_KERJA' => 'x' ));
	} else {
		$unit_kerja = $this->CI->lunit_kerja->get_by_id(array( 'K_FAKULTAS' => $user_fakultas_id ));
	}
?>
<div class="hidden">
	<input type="hidden" name="K_JENJANG" value="x" />
  
  <div class="form-row">
  	<label>Fakultas</label>
    <select name="K_FAKULTAS" style="width: 300px;"><?php echo GetOption(false, $ArrayFakultas, 'x'); ?></select>
  </div>
  <div class="form-row">
  	<label>Jurusan</label>
    <select name="K_JURUSAN" style="width: 300px;"><?php echo GetOption(false, $ArrayJurusan, 'x'); ?></select>
  </div>
  <div class="form-row">
  	<label>Program Studi</label>
    <select name="K_PROG_STUDI" style="width: 300px;"><?php echo GetOption(false, $ArrayProgramStudi, 'x'); ?></select>
  </div>
  
	<div class="clear"></div>
</div>

<div class="form-row">
	<label>Status Kerja</label>
  <select name="K_STATUS_KERJA" style="width: 300px;"><?php echo GetOption(false, $ArrayStatusKerja, 'x'); ?></select>
</div>
<div class="form-row">
	<label>Unit Kerja</label>
  <input type="hidden" name="K_UNIT_KERJA" value="<?php echo @$unit_kerja['K_UNIT_KERJA']; ?>" data-change="1" data-record="" />
	<input type="text" style="width: 200px;" size="50" value="<?php echo @$unit_kerja['CONTENT']; ?>" class="unit-kerja" readonly="readonly" />
	
	<?php if ($user_fakultas_id == 'x') { ?>
	<input type="button" style="width: 75px;" class="auto_show_unitkerja" data-target=".unit-kerja" value="Ubah" />
	<?php } ?>
</div>
<div class="form-row">
	<label>Per Tanggal</label>
  <input type="text" name="TGL_BATAS" class="datepicker required" value="<?php echo date("d-m-Y"); ?>" />
</div>

<div class="clear"></div>