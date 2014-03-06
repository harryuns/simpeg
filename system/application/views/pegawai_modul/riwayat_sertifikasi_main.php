<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_ptp = $this->ptp_model->get_array();
	$array_rumpun_ilmu = $this->rumpun_ilmu_model->get_array();
	$array_pegawai_sertifikasi = $this->riwayat_sertifikasi_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_pegawai_sertifikasi_request = $this->riwayat_sertifikasi_request_model->get_array(array( 'K_PEGAWAI' => $k_pegawai, 'IS_VALIDATE' => 0 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Sertifikasi' ) ); ?>

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
		
		<div class="cnt-grid">
			<?php if (count($array_pegawai_sertifikasi) > 0) { ?>
				<h1>Riwayat Sertifikasi</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1325px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">No Sertifikat</td>
						<td class="normal" style="width: 125px;">Tanggal Sertifikat</td>
						<td class="normal" style="width: 150px;">No Peserta</td>
						<td class="normal" style="width: 200px;">Pejabat TT</td>
						<td class="normal" style="width: 100px;">Tunjangan</td>
						<td class="normal" style="width: 150px;">Tanggal Akhir</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_sertifikasi as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_valid"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
						</td>
						<td class="body"><?php echo $row['NO_SERTIFIKAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SERTIFIKAT']); ?></td>
						<td class="body"><?php echo $row['NO_PESERTA']; ?></td>
						<td class="body"><?php echo $row['PEJABAT_TT']; ?></td>
						<td class="body"><?php echo $row['TUNJANGAN_SERTIFIKASI']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_AKHIR']); ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_sertifikasi_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table style="width: 1500px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Jenis Request</td>
						<td class="normal" style="width: 150px;">No Sertifikat</td>
						<td class="normal" style="width: 125px;">Tanggal Sertifikat</td>
						<td class="normal" style="width: 150px;">No Peserta</td>
						<td class="normal" style="width: 200px;">Pejabat TT</td>
						<td class="normal" style="width: 100px;">Tunjangan</td>
						<td class="normal" style="width: 150px;">Tanggal Akhir</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_sertifikasi_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_request"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQ_SERTIFIKASI']); ?></td>
						<td class="body"><?php echo $row['NO_SERTIFIKAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SERTIFIKAT']); ?></td>
						<td class="body"><?php echo $row['NO_PESERTA']; ?></td>
						<td class="body"><?php echo $row['PEJABAT_TT']; ?></td>
						<td class="body"><?php echo $row['TUNJANGAN_SERTIFIKASI']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_AKHIR']); ?></td>
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
			<h1>Riwayat Sertifikasi</h1>
			
			<form style="width: 80%;" id="FormRiwayatSertifikasi" action="<?php echo base_url('index.php/pegawai_modul/riwayat_sertifikasi/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQ_SERTIFIKASI" value="x" />
				<input type="hidden" name="ID_RIWAYAT_SERTIFIKASI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQ_SERTIFIKASI" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>No Sertifikat</td>
						<td><input type="text" style="width: 85%;" size="50" name="NO_SERTIFIKAT" class="required sk_char" alt="No SK kosong" /></td></tr>
					<tr>
						<td>Tanggal Sertifikat</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_SERTIFIKAT" class="required datepicker" alt="Tanggal SK kosong" /></td></tr>
					<tr>
						<td>No Peserta</td>
						<td><input type="text" style="width: 150px;" size="50" name="NO_PESERTA" class="required" alt="Silahkan memasukkan No Peserta" /></td></tr>
					<tr>
						<td>PTP Serdos</td>
						<td><select style="width: 250px;" name="K_PTP">
							<?php echo ShowOption(array( 'Array' => $array_ptp, 'ArrayID' => 'K_PTP', 'ArrayTitle' => 'NAMA' )); ?>
						</select></td>
					</tr>
					<tr>
						<td>Pejabat TT</td>
						<td><input type="text" style="width: 150px;" size="50" name="PEJABAT_TT" class="required" alt="Silahkan memasukkan Pejabat TT" /></td></tr>
					<tr>
						<td>Rumpun Ilmu</td>
						<td><select style="width: 250px;" name="K_RUMPUN_ILMU">
							<?php echo ShowOption(array( 'Array' => $array_rumpun_ilmu, 'ArrayID' => 'K_RUMPUN_ILMU', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td>
					</tr>
					<tr>
						<td>Tunjangan Sertifikasi</td>
						<td><input type="text" style="width: 150px;" size="50" name="TUNJANGAN_SERTIFIKASI"class="integer required" alt="Silahkan memasukkan Tunjangan Sertifikat yang sesuai" /></td></tr>
					<tr>
						<td>Tanggal Akhir</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_AKHIR" class="datepicker required" alt="Silahkan memasukkan Tanggal Akhir" /></td></tr>
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
				<input type="hidden" name="ID_REQ_SERTIFIKASI" />
				<input type="hidden" name="ID_RIWAYAT_SERTIFIKASI" />
				
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
	InitForm.Start('FormRiwayatSertifikasi');
	
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
		
		// reset form
		$('.cnt-form form')[0].reset();
		
		// init form
		$('.cnt-form [name="action"]').val('update_request');
		$('.cnt-form [name="ID_RIWAYAT_SERTIFIKASI"]').val('x');
		$('.cnt-form [name="JENIS_REQ_SERTIFIKASI"]').val('I');
	});
	$('.cnt-grid .btn-edit').click(function() {
		page.show_form();
		
		// set action
		var action = $(this).attr('data-action');
		var action_form = (action == 'update_valid' && page.data.is_user_fakultas) ? 'update_request' : action;
		$('.cnt-form [name="action"]').val(action_form);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		Func.populate({ cnt: '.cnt-form', record: record});
		$('.cnt-form [name="ID_REQ_SERTIFIKASI"]').val((record.ID_REQ_SERTIFIKASI == null) ? 'x' : record.ID_REQ_SERTIFIKASI);
		$('.cnt-form [name="ID_RIWAYAT_SERTIFIKASI"]').val((record.ID_RIWAYAT_SERTIFIKASI == null) ? 'x' : record.ID_RIWAYAT_SERTIFIKASI);
		
		// update request or valid
		if (action_form == 'update_request') {
			if (action == 'update_valid') {
				$('.cnt-form [name="JENIS_REQ_SERTIFIKASI"]').val('U');
			} else {
				$('.cnt-form [name="JENIS_REQ_SERTIFIKASI"]').val(record.JENIS_REQ_SERTIFIKASI);
			}
		} else if (action_form == 'update_valid') {
			$('.cnt-form [name="JENIS_REQ_SERTIFIKASI"]').val('U');
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
			param.JENIS_REQ_SERTIFIKASI = 'D';
			
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
		if (record.ID_REQ_SERTIFIKASI != null)
			$('#form-upload [name="ID_REQ_SERTIFIKASI"]').val(record.ID_REQ_SERTIFIKASI);
		if (record.ID_RIWAYAT_SERTIFIKASI != null)
			$('#form-upload [name="ID_RIWAYAT_SERTIFIKASI"]').val(record.ID_RIWAYAT_SERTIFIKASI);
		
		record.reload = false;
		record.action = (action == 'update_upload_valid') ? 'get_upload_valid' : 'get_upload_request';
		page.show_upload({ record: record });
	});
	$('.cnt-form .btn-cancel').click(function() {
		page.show_grid();
	});
	
	// init form
	$('.cnt-form form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form form');
		var ArrayError = InitForm.Validation('FormRiwayatSertifikasi');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('FormRiwayatSertifikasi');
		param.TGL_AKHIR = Func.swap_date(param.TGL_AKHIR);
		param.TGL_SERTIFIKAT = Func.swap_date(param.TGL_SERTIFIKAT);
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