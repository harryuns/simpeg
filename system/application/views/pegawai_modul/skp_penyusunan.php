<?php
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$tahun = (empty($this->uri->segments[5])) ? date("Y") : $this->uri->segments[5];
	$page = array( 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_kegiatan_skp = $this->skp_model->get_array_kegiatan(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
	$array_penilai_skp = $this->skp_model->get_array_penilai(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
	
	// link print
	if (count($array_penilai_skp) > 0) {
		$link_print = $array_penilai_skp[0]['link_print_sasaran_kerja'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'SKP Target' ) ); ?>

<body>
<div id="body"><div id="frame">
	<div id="sidebar">
		<div class="hidden cnt-page"><?php echo json_encode($page); ?></div>
		<div class="glossymenu"><?php $this->load->view('main_menu'); ?></div>

	</div>
	
	<div id="content">
  	
  	<div class="contentmenu clearfix"><?php $this->load->view('main_sub_menu'); ?></div>
		<?php $this->load->view('common/form_unit_kerja'); ?>
    
  <div class="full" style="min-height: 400px;"><div id="CntRightFull">
		<?php $this->load->view('pegawai_info'); ?>
		
		<?php if (!empty($message)) { ?>
			<div class="MessagePopup"><?php echo $message; ?></div>
		<?php } ?>
		
		<?php $this->load->view('pegawai_modul/skp_filter', array( 'tahun' => $tahun )); ?>
		
		<div class="cnt-grid-kegiatan">
			<h1>SKP TARGET</h1>
			<?php if (count($array_kegiatan_skp) > 0) { ?>
				<div class="cnt_table_main"><table>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="normal">Kegiatan</td>
						<td class="normal">AK Target</td>
						<td class="normal">KUAN Target</td>
						<td class="normal">KUAL Target</td>
						<td class="normal">Waktu Target</td>
						<td class="normal">Biaya Target</td>
						<td class="normal">Validasi</td></tr>
					<?php foreach ($array_kegiatan_skp as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_penyusunan"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_penyusunan"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['KEGIATAN']; ?></td>
						<td class="body"><?php echo $row['AK_TARGET']; ?></td>
						<td class="body"><?php echo $row['KUAN_TARGET']; ?></td>
						<td class="body"><?php echo $row['KUAL_TARGET']; ?></td>
						<td class="body"><?php echo $row['WAKTU_TARGET']; ?></td>
						<td class="body"><?php echo $row['BIAYA_TARGET']; ?></td>
						<td class="body"><?php echo $row['VALID_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-kegiatan-new" />
				
				<?php if (!empty($link_print)) { ?>
				<input type="button" name="Cetak" value="Cetak" style="float: right;" onclick="location.href='<?php echo $link_print; ?>'" />
				<?php } ?>
			</div>
		</div>
		
		<div class="cnt-grid-penilai">
			<h1>SKP PEJABAT PENILAI</h1>
			<?php if (count($array_penilai_skp) > 0) { ?>
				<div class="cnt_table_main"><table>
					<tr>
						<td class="left" rowspan="2">&nbsp;</td>
						<td class="normal" colspan="2" style="text-align: center;">Pejabat Penilai</td>
						<td class="normal" colspan="2" style="text-align: center;">Atasan Pejabat Penilai</td></tr>
					<tr>
						<td class="normal" style="text-align: center;">Nama</td>
						<td class="normal" style="text-align: center;">NIP</td>
						<td class="normal" style="text-align: center;">Nama</td>
						<td class="normal" style="text-align: center;">NIP</td></tr>
					<?php foreach ($array_penilai_skp as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_penilai"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_penilai"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['NAMA_PENILAI_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['K_PENILAI_PEGAWAI']; ?></td>
						<td class="body"><?php echo $row['NAMA_PEJABAT']; ?></td>
						<td class="body"><?php echo $row['K_PEJABAT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-penilai-new" />
			</div>
		</div>
		
		<div class="cnt-form-kegiatan hidden">
			<h1>FORM SKP TARGET</h1>
			
			<form style="width: 80%;" id="form-kegiatan" action="<?php echo base_url('index.php/pegawai_modul/skp_penyusunan/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_NILAI_TUPOKSI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
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
						<td colspan="2" style="padding: 10px 0;">
							<input type="button" class="btn-cancel" value="Batal" />
							<input type="submit" class="btn-submit" value="Save" />
						</td></tr>
				</table>
			</form>
		</div>
		
		<div class="cnt-form-penilai hidden">
			<h1>FORM SKP PEJABAT PENILAI</h1>
			
			<form style="width: 80%;" id="form-penilai" action="<?php echo base_url('index.php/pegawai_modul/skp_penyusunan/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="K_PENILAI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Pejabat Penilai</td>
						<td><input type="text" style="width: 50%;" size="50" name="K_PENILAI_PEGAWAI" class="required auto-pegawai" alt="Pejabat Penilai kosong" /></td></tr>
					<tr>
						<td>Atasan Pejabat Penilai</td>
						<td><input type="text" style="width: 50%;" size="50" name="K_PEJABAT" class="required auto-pegawai" alt="Atahan Pejabat Penilai kosong" /></td></tr>
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
			$('.cnt-grid-penilai').show();
			$('.cnt-grid-kegiatan').show();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-penilai').hide();
			window.scrollTo(0,200);
		},
		show_form_kegiatan: function() {
			$('.cnt-grid-penilai').hide();
			$('.cnt-grid-kegiatan').hide();
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
	
	/* Form Kegiatan */
	
	$('.record-kegiatan-new').click(function() {
		page.show_form_kegiatan();
		
		// reset form
		$('.cnt-form-kegiatan form')[0].reset();
		
		// init form
		$('.cnt-form-kegiatan [name="action"]').val('update_penyusunan');
		$('.cnt-form-kegiatan [name="TAHUN"]').val($('select[name="TAHUN"]').val());
		$('.cnt-form-kegiatan [name="ID_NILAI_TUPOKSI"]').val('x');
		$('.cnt-form-kegiatan .btn-submit').show();
	});
	$('.cnt-grid-kegiatan .btn-edit').click(function() {
		page.show_form_kegiatan();
		
		// set action
		var action = $(this).attr('data-action');
		$('.cnt-form-kegiatan [name="action"]').val(action);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-kegiatan [name="ID_NILAI_TUPOKSI"]').val(record.ID_NILAI_TUPOKSI);
		$('.cnt-form-kegiatan [name="TAHUN"]').val(record.TAHUN);
		$('.cnt-form-kegiatan [name="KEGIATAN"]').val(record.KEGIATAN);
		$('.cnt-form-kegiatan [name="AK_TARGET"]').val(record.AK_TARGET);
		$('.cnt-form-kegiatan [name="KUAN_TARGET"]').val(record.KUAN_TARGET);
		$('.cnt-form-kegiatan [name="KUAL_TARGET"]').val(record.KUAL_TARGET);
		$('.cnt-form-kegiatan [name="WAKTU_TARGET"]').val(record.WAKTU_TARGET);
		$('.cnt-form-kegiatan [name="BIAYA_TARGET"]').val(record.BIAYA_TARGET);
		
		if (record.IS_VALID == 1) {
			$('.cnt-form-kegiatan .btn-submit').hide();
		} else {
			$('.cnt-form-kegiatan .btn-submit').show();
		}
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
	
	/* End Form Kegiatan */
	
	/* Form Penilai */
	
	$('.record-penilai-new').click(function() {
		page.show_form_penilai();
		
		// reset form
		$('.cnt-form-penilai form')[0].reset();
		
		// init form
		$('.cnt-form-penilai [name="action"]').val('update_penilai');
		$('.cnt-form-penilai [name="TAHUN"]').val($('select[name="TAHUN"]').val());
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
		
		$('.cnt-form-penilai [name="K_PENILAI"]').val(record.K_PENILAI);
		$('.cnt-form-penilai [name="TAHUN"]').val(record.TAHUN);
		$('.cnt-form-penilai [name="K_PENILAI_PEGAWAI"]').val(record.K_PENILAI_PEGAWAI);
		$('.cnt-form-penilai [name="K_PEJABAT"]').val(record.K_PEJABAT);
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