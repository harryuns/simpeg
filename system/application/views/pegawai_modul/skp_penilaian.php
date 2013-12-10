<?php
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_kegiatan_skp = $this->skp_model->get_array_kegiatan(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_penilai_skp = $this->skp_model->get_array_penilai(array( 'K_PEGAWAI' => $k_pegawai ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'SKP Penilaian' ) ); ?>

<body>
<div id="body"><div id="frame">
	<div id="sidebar">
		<div class="hidden cnt-page"><?php echo json_encode($page); ?></div>
		<div class="glossymenu"><?php $this->load->view('main_menu'); ?></div>
		<div class="glossymenu" style="padding: 50px 0 0 0;"><?php $this->load->view('main_sub_menu'); ?></div>
		<?php $this->load->view('common/form_unit_kerja'); ?>
	</div>
	
	<div id="content"><div class="full" style="min-height: 400px;"><div id="CntRightFull">
		<?php $this->load->view('pegawai_info'); ?>
		
		<?php if (!empty($message)) { ?>
			<div class="MessagePopup"><?php echo $message; ?></div>
		<?php } ?>
		
		<div class="cnt-grid-kegiatan">
			<h1>SKP Penilaian</h1>
			<?php if (count($array_kegiatan_skp) > 0) { ?>
				<div class="cnt_table_main"><table style="width: 900px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Tahun</td>
						<td class="normal" style="width: 150px;">Kegiatan</td>
						<td class="normal" style="width: 150px;">AK Target</td>
						<td class="normal" style="width: 150px;">KUAN Target</td>
						<td class="normal" style="width: 150px;">Waktu Target</td>
						<td class="normal" style="width: 150px;">Biaya Target</td>
						<td class="normal" style="width: 150px;">Perhitungan</td>
						<td class="normal" style="width: 125px;">Nilai Capaian</td></tr>
					<?php foreach ($array_kegiatan_skp as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_tupoksi"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_tupoksi"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['TAHUN']; ?></td>
						<td class="body"><?php echo $row['KEGIATAN']; ?></td>
						<td class="body"><?php echo $row['AK_TARGET']; ?></td>
						<td class="body"><?php echo $row['KUAN_TARGET']; ?></td>
						<td class="body"><?php echo $row['WAKTU_TARGET']; ?></td>
						<td class="body"><?php echo $row['BIAYA_TARGET']; ?></td>
						<td class="body"><?php echo $row['PERHITUNGAN']; ?></td>
						<td class="body"><?php echo $row['NILAI_CAPAIAN']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-kegiatan-new" />
			</div>
		</div>
		
		<div class="cnt-grid-penilai">
			<h1>SKP Penilai</h1>
			<?php if (count($array_penilai_skp) > 0) { ?>
				<div class="cnt_table_main"><table style="width: 475px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Tahun</td>
						<td class="normal" style="width: 150px;">Penilai</td></tr>
					<?php foreach ($array_penilai_skp as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a href="<?php echo $row['link_print']; ?>" target="_blank"><img class="link" src="<?php echo HOST; ?>/images/btn-print.png" /></a>
							<a class="btn-delete" data-action="delete_penilai"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_penilai"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['TAHUN']; ?></td>
						<td class="body"><?php echo $row['K_PENILAI_PEGAWAI']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-penilai-new" />
			</div>
		</div>
		
		<div class="cnt-form-kegiatan hidden">
			<h1>Form Riwayat SKP</h1>
			
			<form style="width: 80%;" id="form-kegiatan" action="<?php echo base_url('index.php/pegawai_modul/skp/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_NILAI_TUPOKSI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Tahun</td>
						<td><input type="text" style="width: 30%;" size="50" name="TAHUN" class="required integer" alt="Tahun kosong" /></td></tr>
					<tr>
						<td>Kegiatan</td>
						<td><textarea name="KEGIATAN" class="required" alt="Kegiatan kosong" style="width: 75%; height: 60px;"></textarea></td></tr>
					<tr>
						<td>AK Target</td>
						<td><input type="text" style="width: 30%;" size="50" name="AK_TARGET" class="required int" alt="AK Target kosong" /></td></tr>
					<tr>
						<td>KUAN Target</td>
						<td><input type="text" style="width: 30%;" size="50" name="KUAN_TARGET" class="required int" alt="KUAN Target kosong" /></td></tr>
					<tr>
						<td>KUAL Target</td>
						<td><input type="text" style="width: 30%;" size="50" name="KUAL_TARGET" class="required int" alt="KUAL Target kosong" /></td></tr>
					<tr>
						<td>Waktu Target</td>
						<td><input type="text" style="width: 30%;" size="50" name="WAKTU_TARGET" class="required" alt="Waktu Target kosong" /></td></tr>
					<tr>
						<td>Biaya Target</td>
						<td><input type="text" style="width: 30%;" size="50" name="BIAYA_TARGET" class="required" alt="Biaya Target kosong" /></td></tr>
					<tr>
						<td>AK Real</td>
						<td><input type="text" style="width: 30%;" size="50" name="AK_REAL" class="required int" alt="AK Real kosong" /></td></tr>
					<tr>
						<td>KUAN Real</td>
						<td><input type="text" style="width: 30%;" size="50" name="KUAN_REAL" class="required int" alt="KUAN Real kosong" /></td></tr>
					<tr>
						<td>KUAL Real</td>
						<td><input type="text" style="width: 30%;" size="50" name="KUAL_REAL" class="required int" alt="KUAL Real kosong" /></td></tr>
					<tr>
						<td>Waktu Real</td>
						<td><input type="text" style="width: 30%;" size="50" name="WAKTU_REAL" class="required" alt="Waktu Real kosong" /></td></tr>
					<tr>
						<td>Biaya Real</td>
						<td><input type="text" style="width: 30%;" size="50" name="BIAYA_REAL" class="required" alt="Biaya Real kosong" /></td></tr>
					<tr>
						<td colspan="2" style="padding: 10px 0;">
							<input type="button" class="btn-cancel" value="Batal" />
							<input type="submit" class="btn-submit" value="Save" />
						</td></tr>
				</table>
			</form>
		</div>
		
		<div class="cnt-form-penilai hidden">
			<h1>Form Penilai SKP</h1>
			
			<form style="width: 80%;" id="form-penilai" action="<?php echo base_url('index.php/pegawai_modul/skp/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="K_PENILAI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Tahun</td>
						<td><input type="text" style="width: 30%;" size="50" name="TAHUN" class="required integer" alt="Tahun kosong" /></td></tr>
					<tr>
						<td>Penilai</td>
						<td><input type="text" style="width: 50%;" size="50" name="K_PENILAI_PEGAWAI" class="required integer auto-pegawai" alt="Penilai kosong" /></td></tr>
					<tr>
						<td colspan="2" style="padding: 10px 0;">
							<input type="button" class="btn-cancel" value="Batal" />
							<input type="submit" class="btn-submit" value="Save" />
						</td></tr>
				</table>
			</form>
		</div>
	</div></div></div>

<script type="text/javascript">
(function() {
	InitForm.Start('form-kegiatan');
	InitForm.Start('form-penilai');
	
	var page = {
		init: function() {
			var raw = $('.cnt-page').text();
			eval('var data = ' + raw);
			page.data = data;
			
			Site.autocomplate({ action: 'pegawai' });
		},
		show_grid: function() {
			$('.cnt-grid-kegiatan').show();
			$('.cnt-grid-penilai').show();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-penilai').hide();
			window.scrollTo(0,200);
		},
		show_form_kegiatan: function() {
			$('.cnt-grid-kegiatan').hide();
			$('.cnt-grid-penilai').hide();
			$('.cnt-form-kegiatan').show();
			$('.cnt-form-penilai').hide();
		},
		show_form_penilai: function() {
			$('.cnt-grid-kegiatan').hide();
			$('.cnt-grid-penilai').hide();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-penilai').show();
		}
	}
	
	/* Form Riwayat */
	
	$('.record-kegiatan-new').click(function() {
		page.show_form_kegiatan();
		
		// reset form
		$('.cnt-form-kegiatan form')[0].reset();
		
		// init form
		$('.cnt-form-kegiatan [name="action"]').val('update_tupoksi');
		$('.cnt-form-kegiatan [name="TAHUN"]').val(new Date().getFullYear());
		$('.cnt-form-kegiatan [name="ID_NILAI_TUPOKSI"]').val('x');
	});
	$('.cnt-grid-kegiatan .btn-edit').click(function() {
		page.show_form_kegiatan();
		
		// set action
		var action = $(this).attr('data-action');
		$('.cnt-form-kegiatan [name="action"]').val(action);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-kegiatan [name="ID_NILAI_TUPOKSI"]').val((record.ID_NILAI_TUPOKSI == null) ? 'x' : record.ID_NILAI_TUPOKSI);
		$('.cnt-form-kegiatan [name="TAHUN"]').val(record.TAHUN);
		$('.cnt-form-kegiatan [name="K_JENIS_SKP"]').val(record.K_JENIS_SKP);
		$('.cnt-form-kegiatan [name="KEGIATAN"]').val(record.KEGIATAN);
		$('.cnt-form-kegiatan [name="AK_TARGET"]').val(record.AK_TARGET);
		$('.cnt-form-kegiatan [name="KUAN_TARGET"]').val(record.KUAN_TARGET);
		$('.cnt-form-kegiatan [name="KUAL_TARGET"]').val(record.KUAL_TARGET);
		$('.cnt-form-kegiatan [name="WAKTU_TARGET"]').val(record.WAKTU_TARGET);
		$('.cnt-form-kegiatan [name="BIAYA_TARGET"]').val(record.BIAYA_TARGET);
		$('.cnt-form-kegiatan [name="AK_REAL"]').val(record.AK_REAL);
		$('.cnt-form-kegiatan [name="KUAN_REAL"]').val(record.KUAN_REAL);
		$('.cnt-form-kegiatan [name="KUAL_REAL"]').val(record.KUAL_REAL);
		$('.cnt-form-kegiatan [name="WAKTU_REAL"]').val(record.WAKTU_REAL);
		$('.cnt-form-kegiatan [name="BIAYA_REAL"]').val(record.BIAYA_REAL);
	});
	$('.cnt-grid-kegiatan .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		record.action = $(this).attr('data-action');
		Func.rec_delete({ action: $('.cnt-form-kegiatan form').attr('action'), param: record });
	});
	$('.cnt-form-kegiatan .btn-cancel').click(function() {
		page.show_grid();
	});
	$('.cnt-form-kegiatan form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form-kegiatan form');
		var ArrayError = InitForm.Validation('form-kegiatan');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-kegiatan');
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Form Riwayat */
	
	/* Form Penilai */
	
	$('.record-penilai-new').click(function() {
		page.show_form_penilai();
		
		// reset form
		$('.cnt-form-penilai form')[0].reset();
		
		// init form
		$('.cnt-form-penilai [name="action"]').val('update_penilai');
		$('.cnt-form-penilai [name="K_PENILAI"]').val('x');
	});
	$('.cnt-grid-penilai .btn-edit').click(function() {
		page.show_form_penilai();
		
		// set action
		var action = $(this).attr('data-action');
		$('.cnt-form-penilai [name="action"]').val(action);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-penilai [name="K_PENILAI"]').val((record.K_PENILAI == null) ? 'x' : record.K_PENILAI);
		$('.cnt-form-penilai [name="TAHUN"]').val(record.TAHUN);
		$('.cnt-form-penilai [name="K_PENILAI_PEGAWAI"]').val(record.K_PENILAI_PEGAWAI);
	});
	$('.cnt-grid-penilai .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		record.action = $(this).attr('data-action');
		Func.rec_delete({ action: $('.cnt-form-penilai form').attr('action'), param: record });
	});
	$('.cnt-form-penilai .btn-cancel').click(function() {
		page.show_grid();
	});
	$('.cnt-form-penilai form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form-penilai form');
		var ArrayError = InitForm.Validation('form-penilai');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-penilai');
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Form Penilai */
	
	page.init();
})();
</script>
	
</div></div>
</body>
</html>