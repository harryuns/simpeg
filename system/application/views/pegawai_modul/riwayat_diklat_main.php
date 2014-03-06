<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_diklat = $this->ldiklat->GetArray();
	$array_pegawai_diklat = $this->riwayat_diklat_model->get_array(array( 'k_pegawai' => $k_pegawai ));
	$array_pegawai_diklat_request = $this->riwayat_diklat_request_model->get_array(array( 'k_pegawai' => $k_pegawai, 'IS_VALIDATE' => 0 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Diklat' ) ); ?>

<body>
<div id="body"><div id="frame">
	<div id="sidebar">
		<div class="hidden cnt-page"><?php echo json_encode($page); ?></div>
		<div class="glossymenu"><?php $this->load->view('main_menu'); ?></div>
		<div class="glossymenu" style="padding: 50px 0 0 0;"><?php $this->load->view('main_sub_menu'); ?></div>
	</div>
	
	<div id="content"><div class="full" style="min-height: 400px;"><div id="CntRightFull">
		<?php $this->load->view('pegawai_info'); ?>
		
		<?php if (!empty($message)) { ?>
			<div class="MessagePopup"><?php echo $message; ?></div>
		<?php } ?>
		
		<div class="cnt-grid">
			<?php if (count($array_pegawai_diklat) > 0) { ?>
				<h1>Riwayat Diklat</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1300px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">No Sertifikat</td>
						<td class="normal" style="width: 100px;">Tanggal SK</td>
						<td class="normal" style="width: 100px;">Diklat</td>
						<td class="normal" style="width: 200px;">Penyelenggara</td>
						<td class="normal" style="width: 100px;">Tempat Diklat</td>
						<td class="normal" style="width: 100px;">Angkatan</td>
						<td class="normal" style="width: 100px;">Tanggal Mulai</td>
						<td class="normal" style="width: 100px;">Tanggal Lulus</td>
						<td class="normal" style="width: 300px;">Keterangan</td>
						<td class="normal" style="width: 50px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_diklat as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_valid"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
						</td>
						<td class="body"><?php echo $row['NO_SERTIFIKAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SERTIFIKAT']); ?></td>
						<td class="body"><?php echo $row['DIKLAT']; ?></td>
						<td class="body"><?php echo $row['PENYELENGGARA']; ?></td>
						<td class="body"><?php echo $row['TMP_DIKLAT']; ?></td>
						<td class="body"><?php echo $row['ANGKATAN']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_LULUS']); ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_diklat_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table style="width: 1450px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Jenis Request</td>
						<td class="normal" style="width: 150px;">No Sertifikat</td>
						<td class="normal" style="width: 100px;">Tanggal SK</td>
						<td class="normal" style="width: 100px;">Diklat</td>
						<td class="normal" style="width: 200px;">Penyelenggara</td>
						<td class="normal" style="width: 100px;">Tempat Diklat</td>
						<td class="normal" style="width: 100px;">Angkatan</td>
						<td class="normal" style="width: 100px;">Tanggal Mulai</td>
						<td class="normal" style="width: 100px;">Tanggal Lulus</td>
						<td class="normal" style="width: 300px;">Keterangan</td>
						<td class="normal" style="width: 50px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_diklat_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_request"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQUEST']); ?></td>
						<td class="body"><?php echo $row['NO_SERTIFIKAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SERTIFIKAT']); ?></td>
						<td class="body"><?php echo $row['DIKLAT']; ?></td>
						<td class="body"><?php echo $row['PENYELENGGARA']; ?></td>
						<td class="body"><?php echo $row['TMP_DIKLAT']; ?></td>
						<td class="body"><?php echo $row['ANGKATAN']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_LULUS']); ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-new" />
			</div>
		</div>
		
		<div class="cnt-form hidden">
			<h1>Riwayat Diklat</h1>
			
			<form style="width: 80%;" id="FormRiwayatDiklat" action="<?php echo base_url('index.php/pegawai_modul/riwayat_diklat/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQUEST" value="x" />
				<input type="hidden" name="ID_RIWAYAT_DIKLAT" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQUEST" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>No Sertifikat</td>
						<td><input type="text" style="width: 150px;" size="50" name="NO_SERTIFIKAT" class="required sk_char" alt="Silahkan memasukkan No Sertifikat" /></td></tr>
					<tr>
						<td>Tanggal Sertifikat</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_SERTIFIKAT" class="datepicker" /></td></tr>
					<tr>
						<td style="width: 200px;">Diklat</td>
						<td style="width: 300px;">
							<select style="width: 150px;" name="K_DIKLAT"><?php echo GetOption(false, $array_diklat, ''); ?></select>
							<input type="text" style="width: 125px;" size="50" name="DIKLAT_NAMA" class="hidden" />
						</td></tr>
					<tr>
						<td>Penyelenggara</td>
						<td><input type="text" style="width: 150px;" size="50" name="PENYELENGGARA"></td></tr>
					<tr>
						<td>Nama Diklat</td>
						<td><input type="text" style="width: 150px;" size="50" name="NAMA_DIKLAT" /></td></tr>
					<tr>
						<td>Tempat Diklat</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMP_DIKLAT"></td></tr>
					<tr>
						<td>Angkatan</td>
						<td><input type="text" style="width: 150px;" size="50" name="ANGKATAN"></td></tr>
					<tr>
						<td>Tanggal Mulai</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_MULAI" class="datepicker" /></td></tr>
					<tr>
						<td>Tanggal Lulus</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_LULUS" class="datepicker" /></td></tr>
					<tr>
						<td>Jumlah Jam</td>
						<td><input type="text" style="width: 150px;" size="50" name="JML_JAM" class="integer" /></td></tr>
					<tr>
						<td>Predikat</td>
						<td><input type="text" style="width: 150px;" size="50" name="PREDIKAT" /></td></tr>
					<tr>
						<td>Diklat Luar Negeri</td>
						<td><input type="checkbox" value="1" name="IS_LUARNEGERI" /></td></tr>
					<tr>
						<td>Keterangan</td>
						<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"></textarea></td></tr>
					<tr>
						<td colspan="2" style="padding: 10px 0;">
							<input type="button" class="btn-cancel" value="Batal" />
							<input type="submit" class="btn-submit" value="Save" />
						</td></tr>
				</table>
			</form>
		</div>
		
		<div class="cnt-upload hidden">
			<h1>Upload Dokumen</h1>
			
			<div class="grid-upload"></div>
			
			<div id="form-upload" class="cnt_table_main">
				<input type="hidden" name="action" />
				<input type="hidden" name="K_PEGAWAI" />
				<input type="hidden" name="ID_REQUEST" />
				<input type="hidden" name="ID_RIWAYAT_DIKLAT" />
				
				<table style="width: 80%; display: inline-table;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td style="width: 25%;">Upload</td>
						<td style="width: 75%;">
							<input type="text" readonly="readonly" name="FILENAME" style="width: 250px;" class="required" alt="Silahkan milih file terlebih dahulu" />
							<input type="button" class="btn-browse" value="Pilih File" />
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding: 10px 0; text-align: center;">
							<input type="button" class="btn-upload-cancel" value="Batal" />
							<input type="submit" class="btn-upload-submit" value="Save" />
						</td></tr>
				</table>
			</div>
		</div>
	</div></div></div>

<script type="text/javascript">
(function() {
	InitForm.Start('FormRiwayatDiklat');
	
	var page = {
		init: function() {
			var raw = $('.cnt-page').text();
			eval('var data = ' + raw);
			page.data = data;
			
			if (page.data.is_user_fakultas) {
				$('.record-request .btn-validate').remove();
			}
		},
		show_grid: function() {
			$('.cnt-grid').show();
			$('.cnt-form').hide();
			$('.cnt-upload').hide();
			window.scrollTo(0,200);
		},
		show_form: function() {
			$('.cnt-grid').hide();
			$('.cnt-form').show();
			$('.cnt-upload').hide();
		},
		show_upload: function(p) {
			$('.cnt-grid').hide();
			$('.cnt-form').hide();
			$('.cnt-upload').show();
			
			page.load_grid_upload(p);
		},
		form_type: function(action) {
			if (action == 'update_request') {
				$('.cnt-request').show();
			} else if (action == 'update_valid') {
				$('.cnt-request').hide();
			}
		},
		load_grid_upload: function(p) {
			$('.cnt-upload .grid-upload').html('');
			Func.ajax({
				url: $('.cnt-form form').attr('action').replace('action', 'view'),
				param: p.record, is_json: false, callback: function(result) {
					$('.cnt-upload .grid-upload').html(result);
					
					if (page.data.is_user_fakultas) {
						$('.grid-upload .btn-validate-upload').remove();
					}
					
					// init delete
					$('.grid-upload .btn-delete-upload').click(function() {
						var raw = $(this).parents('tr').find('.record').html();
						eval('var record = ' + raw);
						
						if (page.data.is_user_fakultas && $(this).attr('data-action') == 'delete_upload_valid') {
							var param = record;
							param.action = 'update_request_with_delete_file';
							Func.ajax({ url: $('.cnt-form form').attr('action'), param: param, callback: function(result) {
								if (result.status) {
									window.location = window.location.href
								} else {
									ShowDialogObject({ ArrayMessage: [result.message] });
								}
							} });
						} else {
							var param = record;
							param.reload = false;
							param.action = $(this).attr('data-action');
							Func.ajax({ url: $('.cnt-form form').attr('action'), param: param, callback: function(result) {
								ShowDialogObject({ ArrayMessage: [result.message] });
								page.load_grid_upload(p);
							} });
						}
					});
					
					// init validate
					$('.grid-upload .btn-validate-upload').click(function() {
						var raw = $(this).parents('tr').find('.record').html();
						eval('var record = ' + raw);
						record.reload = false;
						record.action = $(this).attr('data-action');
						
						Func.ajax({ url: $('.cnt-form form').attr('action'), param: record, callback: function(result) {
							ShowDialogObject({ ArrayMessage: [result.message] });
							page.load_grid_upload(p);
						} });
					});
				}
			});
		}
	}
	
	// button
	$('.record-new').click(function() {
		page.show_form();
		page.form_type('update_request');
		
		// reset form
		$('.cnt-form form')[0].reset();
		
		// init form
//		$('.cnt-form .btn-submit').show();
		$('.cnt-form [name="action"]').val('update_request');
		$('.cnt-form [name="ID_RIWAYAT_DIKLAT"]').val('x');
		$('.cnt-form [name="JENIS_REQUEST"]').val('I');
		$('.cnt-form [name="K_DIKLAT"]').change();
	});
	$('.cnt-grid .btn-edit').click(function() {
		page.show_form();
		
		// set action
		var action = $(this).attr('data-action');
		action = (action == 'update_valid' && page.data.is_user_fakultas) ? 'update_request' : action;
		$('.cnt-form [name="action"]').val(action);
		page.form_type(action);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form [name="ID_REQUEST"]').val((record.ID_REQUEST == null) ? 'x' : record.ID_REQUEST);
		$('.cnt-form [name="NO_SERTIFIKAT"]').val(record.NO_SERTIFIKAT);
		$('.cnt-form [name="TGL_SERTIFIKAT"]').val(Func.swap_date(record.TGL_SERTIFIKAT));
		$('.cnt-form [name="K_DIKLAT"]').val(record.K_DIKLAT);
		$('.cnt-form [name="DIKLAT_NAMA"]').val(record.DIKLAT_NAMA);
		$('.cnt-form [name="PENYELENGGARA"]').val(record.PENYELENGGARA);
		$('.cnt-form [name="NAMA_DIKLAT"]').val(record.NAMA_DIKLAT);
		$('.cnt-form [name="TMP_DIKLAT"]').val(record.TMP_DIKLAT);
		$('.cnt-form [name="ANGKATAN"]').val(record.ANGKATAN);
		$('.cnt-form [name="TGL_MULAI"]').val(Func.swap_date(record.TGL_MULAI));
		$('.cnt-form [name="TGL_LULUS"]').val(Func.swap_date(record.TGL_LULUS));
		$('.cnt-form [name="JML_JAM"]').val(record.JML_JAM);
		$('.cnt-form [name="PREDIKAT"]').val(record.PREDIKAT);
		$('.cnt-form [name="KETERANGAN"]').val(record.KETERANGAN);
		$('.cnt-form [name="IS_LUARNEGERI"]').attr('checked', ( record.IS_LUARNEGERI == 1 ? 'checked' : ''));
		
		// set combo
		$('.cnt-form [name="K_DIKLAT"]').change();
		
		// set ansync data
		$('.cnt-form [name="ID_RIWAYAT_DIKLAT"]').val((record.ID_RIWAYAT_DIKLAT == null) ? 'x' : record.ID_RIWAYAT_DIKLAT);
		
		// update request or valid
		if (action == 'update_request') {
			$('.cnt-form [name="JENIS_REQUEST"]').val(record.JENIS_REQUEST);
		} else if (action == 'update_valid') {
			$('.cnt-form [name="JENIS_REQUEST"]').val('U');
		}
	});
	$('.cnt-grid .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		if (page.data.is_user_fakultas && $(this).attr('data-action') == 'delete_valid') {
			var param = record;
			var form = $('.cnt-form form');
			
			// set data
			param.action = 'update_request';
			param.JENIS_REQUEST = 'D';
			
			Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
				if (result.status) {
					window.location = window.location.href
				} else {
					ShowDialogObject({ ArrayMessage: [result.message] });
				}
			} });
		} else {
			record.action = $(this).attr('data-action');
			Func.rec_delete({ action: $('.cnt-form form').attr('action'), param: record });
		}
	});
	$('.cnt-grid .btn-validate').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var param = ' + raw);
		param.action = 'validation';
		Func.ajax({ url: $('.cnt-form form').attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	$('.cnt-grid .btn-upload').click(function() {
		// set action
		var action = $(this).attr('data-action');
		$('.cnt-form [name="action"]').val(action);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		$('#form-upload [name="action"]').val(action);
		$('#form-upload [name="K_PEGAWAI"]').val(record.K_PEGAWAI);
		$('#form-upload [name="FILENAME"]').val('');
		
		// add param
		if (record.ID_REQUEST != null)
			$('#form-upload [name="ID_REQUEST"]').val(record.ID_REQUEST);
		if (record.ID_RIWAYAT_DIKLAT != null)
			$('#form-upload [name="ID_RIWAYAT_DIKLAT"]').val(record.ID_RIWAYAT_DIKLAT);
		
		record.reload = false;
		record.action = (action == 'update_upload_valid') ? 'get_upload_valid' : 'get_upload_request';
		page.show_upload({ record: record });
	});
	$('.cnt-form .btn-cancel').click(function() {
		page.show_grid();
	});
	
	// init form
	$('.cnt-form [name="K_DIKLAT"]').change(function() {
		var value = $('.cnt-form [name="K_DIKLAT"]').val();
		(value == '99') ? $('.cnt-form [name="DIKLAT_NAMA"]').show() : $('.cnt-form [name="DIKLAT_NAMA"]').hide();
	});
	$('.cnt-form form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form form');
		var ArrayError = InitForm.Validation('FormRiwayatDiklat');
		
		// validation
		var TGL_MULAI = InitForm.GetTimeFromString($('.cnt-form [name="TGL_MULAI"]').val());
		var TGL_LULUS = InitForm.GetTimeFromString($('.cnt-form [name="TGL_LULUS"]').val());
		if (TGL_MULAI > TGL_LULUS) {
			ArrayError[ArrayError.length] = 'Tanggal Mulai harus lebih kecil daripada Tanggal Lulus';
		}
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('FormRiwayatDiklat');
		param.TGL_SERTIFIKAT = Func.swap_date(param.TGL_SERTIFIKAT);
		param.TGL_MULAI = Func.swap_date(param.TGL_MULAI);
		param.TGL_LULUS = Func.swap_date(param.TGL_LULUS);
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	// init upload
	upload_document = function(p) { $('[name="FILENAME"]').val(p.file_name); }
	$('.btn-browse').click(function() { window.iframe_upload.browse(); });
	$('.btn-upload-cancel').click(function() { page.show_grid() });
	$('.btn-upload-submit').click(function(event) {
		event.preventDefault();
		
		var param = Site.Form.GetValue('form-upload');
		var array_error = InitForm.Validation('form-upload');
		if (array_error.length > 0) {
			return ShowWarning(array_error);
		}
		
		// submit
		if (page.data.is_user_fakultas && param.action == 'update_upload_valid') {
			param.action = 'update_request_with_update_file';
			Func.ajax({ url: $('.cnt-form form').attr('action'), param: param, callback: function(result) {
				if (result.status) {
					window.location = window.location.href;
				} else {
					ShowDialogObject({ ArrayMessage: [result.message] });
				}
			} });
			console.log('here');
		} else {
			param.reload = false;
			Func.ajax({ url: $('.cnt-form form').attr('action'), param: param, callback: function(result) {
				if (result.status) {
					$('#form-upload [name="FILENAME"]').val('');
					
					// reload grid
					param.action = (param.action == 'update_upload_valid') ? 'get_upload_valid' : 'get_upload_request';
					page.load_grid_upload({ record: param });
				} else {
					ShowDialogObject({ ArrayMessage: [result.message] });
				}
			} });
		}
	});
	
	page.init();
})();
</script>
	
</div></div>
</body>
</html>