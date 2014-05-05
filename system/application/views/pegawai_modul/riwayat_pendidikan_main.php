<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_negara = $this->negara_model->get_array();
	$array_jenjang = $this->jenjang_model->get_array();
	$array_status_studi = $this->status_studi_model->get_array();
	$array_perguruan_tinggi = $this->perguruan_tinggi_model->get_array();
	
	$array_pegawai_pendidikan = $this->riwayat_pendidikan_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_pegawai_pendidikan_request = $this->riwayat_pendidikan_request_model->get_array(array( 'K_PEGAWAI' => $k_pegawai, 'IS_VALIDATE' => 0 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Pendidikan' ) ); ?>

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
		
		<div class="cnt-grid">
			<?php if (count($array_pegawai_pendidikan) > 0) { ?>
				<h1>Riwayat Pendidikan</h1>
				<div class="cnt_table_main record-valid"><table>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="normal">Jenjang</td>
						<td class="normal">No Ijazah</td>
						<td class="normal">Tanggal Ijazah</td>
						<td class="normal">IPK</td>
						<td class="normal">PT</td>
						<td class="normal">Tahun Masuk</td>
						<td class="normal">Program Studi</td>
						<td class="normal">Bidang Ilmu</td>
						<td class="normal">Keterangan</td>
						<td class="normal">Ijazah</td>
						<td class="normal">Transkrip</td></tr>
					<?php foreach ($array_pegawai_pendidikan as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_valid"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
						</td>
						<td class="body"><?php echo $row['JENJANG']; ?></td>
						<td class="body"><?php echo $row['NO_IJAZAH']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_IJAZAH']); ?></td>
						<td class="body"><?php echo $row['IPK']; ?></td>
						<td class="body"><?php echo $row['PT']; ?></td>
						<td class="body"><?php echo $row['THN_MASUK']; ?></td>
						<td class="body"><?php echo $row['PROG_STUDI']; ?></td>
						<td class="body"><?php echo $row['BIDANG_ILMU']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_IJAZAH_TEXT']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_NON_IJAZAH_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_pendidikan_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="normal">Jenis Request</td>
						<td class="normal">Jenjang</td>
						<td class="normal">No Ijazah</td>
						<td class="normal">Tanggal Ijazah</td>
						<td class="normal">IPK</td>
						<td class="normal">PT</td>
						<td class="normal">Tahun Masuk</td>
						<td class="normal">Program Studi</td>
						<td class="normal">Bidang Ilmu</td>
						<td class="normal">Keterangan</td>
						<td class="normal">Ijazah</td>
						<td class="normal">Transkrip</td></tr>
					<?php foreach ($array_pegawai_pendidikan_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_request"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQ_PENDIDIKAN']); ?></td>
						<td class="body"><?php echo $row['JENJANG']; ?></td>
						<td class="body"><?php echo $row['NO_IJAZAH']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_IJAZAH']); ?></td>
						<td class="body"><?php echo $row['IPK']; ?></td>
						<td class="body"><?php echo $row['PT']; ?></td>
						<td class="body"><?php echo $row['THN_MASUK']; ?></td>
						<td class="body"><?php echo $row['PROG_STUDI']; ?></td>
						<td class="body"><?php echo $row['BIDANG_ILMU']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_IJAZAH_TEXT']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_NON_IJAZAH_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-new" />
			</div>
		</div>
		
		<div class="cnt-form hidden">
			<h1>Riwayat Pendidikan</h1>
			
			<form style="width: 80%;" id="FormRiwayatPendidikan" action="<?php echo base_url('index.php/pegawai_modul/riwayat_pendidikan/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQ_PENDIDIKAN" value="x" />
				<input type="hidden" name="ID_RIWAYAT_PENDIDIKAN" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQ_PENDIDIKAN" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td style="width: 200px;">Jenjang</td>
						<td style="width: 300px;"><select style="width: 150px;" name="K_JENJANG" class="required">
							<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'K_JENJANG', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td>
					</tr>
					<tr>
						<td>Perguruan Tinggi / Sekolah</td>
						<td><input type="text" style="width: 150px;" size="50" name="PT" /></td></tr>
					<tr>
						<td>Negara</td>
						<td><select style="width: 150px;" name="K_NEGARA">
							<?php echo ShowOption(array( 'Array' => $array_negara, 'ArrayID' => 'K_NEGARA', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td>
					</tr>
					<tr class="cnt-program-studi">
						<td>Program Studi</td>
						<td><input type="text" style="width: 150px;" size="50" name="PROG_STUDI"></td></tr>
					<tr>
						<td>Bidang Ilmu / Peminatan</td>
						<td><input type="text" style="width: 150px;" size="50" name="BIDANG_ILMU"></td></tr>
					<tr class="hidden">
						<td>Profesi</td>
						<td><input type="text" style="width: 150px;" size="50" name="PROFESI" class="" /></td></tr>
					<tr>
						<td>Tahun Masuk</td>
						<td><input type="text" style="width: 150px;" size="50" name="THN_MASUK" class="required integer" /></td></tr>
					<tr>
						<td>Status Kuliah / Kelulusan</td>
						<td><select style="width: 150px;" name="K_STATUS_STUDI">
							<?php echo ShowOption(array( 'Array' => $array_status_studi, 'ArrayID' => 'K_STATUS_STUDI', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td>
					</tr>
					<tr>
						<td>No SK Tubel / Ijin Belajar</td>
						<td><input type="text" style="width: 150px;" size="50" name="NO_SK_TUBEL" /></td></tr>
					<tr>
						<td>TMT Tubel / Ijin Belajar</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMT_TUBEL" class="datepicker" /></td></tr>
					<tr>
						<td>No SK Pembebasan</td>
						<td><input type="text" style="width: 150px;" size="50" name="NO_SK_PEMBEBASAN" /></td></tr>
					<tr>
						<td>TMT Pembebasan</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMT_PEMBEBASAN" class="datepicker" /></td></tr>
					<tr>
						<td>TMT Lulus</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMT_LULUS" class="datepicker" /></td></tr>
					<tr>
						<td>No Ijazah</td>
						<td><input type="text" style="width: 150px;" size="50" name="NO_IJAZAH" class="sk_char" /></td></tr>
					<tr>
						<td>Tanggal Ijazah</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_IJAZAH" class="datepicker" /></td></tr>
					<tr>
						<td>Status Pengaktifan</td>
						<td>
							<input type="checkbox" name="STATUS_PENGAKTIFAN" value="1" />
						</td></tr>
					<tr>
						<td>No SK Pengaktifan</td>
						<td><input type="text" style="width: 150px;" size="50" name="NO_SK_PENGAKTIFAN" /></td></tr>
					<tr>
						<td>TMT Pengaktifan</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMT_PENGAKTIFAN" class="datepicker" /></td></tr>
					<tr class="cnt-ipk">
						<td>IPK</td>
						<td>
							<input type="text" style="width: 150px;" size="50" name="IPK" class="float" />
							<div>Gunakan tanda titik '.' sebagai pengganti tanda koma ','</div>
						</td></tr>
					<tr>
						<td>Tahun Lulus</td>
						<td><input type="text" style="width: 150px;" size="50" name="THN_LULUS" class="integer" /></td></tr>
					<tr id="cnt-asal-pt">
						<td>Asal PT memperoleh pendidikan S3</td>
						<td><select style="width: 150px;" name="K_ASAL_PT_S3DIKTI">
							<?php echo ShowOption(array( 'Array' => $array_perguruan_tinggi, 'ArrayID' => 'K_ASAL_PT_S3DIKTI', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td>
					</tr>
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
				<input type="hidden" name="ID_REQ_PENDIDIKAN" />
				<input type="hidden" name="ID_RIWAYAT_PENDIDIKAN" />
				
				<table style="width: 80%; display: inline-table;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td style="width: 25%;">Upload</td>
						<td style="width: 75%;">
							<input type="text" readonly="readonly" name="FILENAME" style="width: 250px;" class="required" alt="Silahkan milih file terlebih dahulu" />
							<input type="button" class="btn-browse" value="Pilih File" />
						</td>
					</tr>
					<tr>
						<td>File Ijazah</td>
						<td>
							<input type="checkbox" name="IS_IJAZAH" value="1" />
						</td></tr>
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
	InitForm.Start('FormRiwayatPendidikan');
	
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
		},
		
		combo: {
			jenjang: function() {
				var value = $('select[name="K_JENJANG"]').val();
				
				if (Func.InArray(value, ['1','2','3','4','5','6'])) {
					$('.cnt-ipk').hide();
					$('.cnt-program-studi').hide();
				} else {
					$('.cnt-ipk').show();
					$('.cnt-program-studi').show();
				}
				
				if (value == '03') {
					$('#cnt-asal-pt').show();
				} else {
					$('#cnt-asal-pt').hide();
				}
			}
		}
	}
	
	// button
	$('.record-new').click(function() {
		page.show_form();
		
		// reset form
		$('.cnt-form form')[0].reset();
		
		// init form
		$('.cnt-form [name="action"]').val('update_request');
		$('.cnt-form [name="ID_RIWAYAT_PENDIDIKAN"]').val('x');
		$('.cnt-form [name="JENIS_REQ_PENDIDIKAN"]').val('I');
		$('.cnt-form [name="K_JENJANG"]').change();
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
		$('.cnt-form [name="ID_RIWAYAT_PENDIDIKAN"]').val((record.ID_RIWAYAT_PENDIDIKAN == null) ? 'x' : record.ID_RIWAYAT_PENDIDIKAN);
		$('.cnt-form [name="ID_REQ_PENDIDIKAN"]').val((record.ID_REQ_PENDIDIKAN == null) ? 'x' : record.ID_REQ_PENDIDIKAN);
		$('.cnt-form [name="K_JENJANG"]').change();
		
		// update request or valid
		if (action_form == 'update_request') {
			if (action == 'update_valid') {
				$('.cnt-form [name="JENIS_REQ_PENDIDIKAN"]').val('U');
			} else {
				$('.cnt-form [name="JENIS_REQ_PENDIDIKAN"]').val(record.JENIS_REQ_PENDIDIKAN);
			}
		} else if (action_form == 'update_valid') {
			$('.cnt-form [name="JENIS_REQ_PENDIDIKAN"]').val('U');
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
			param.JENIS_REQ_PENDIDIKAN = 'D';
			
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
		$('#form-upload [name="IS_IJAZAH"]').attr('checked', false);
		
		// add param
		if (record.ID_REQ_PENDIDIKAN != null)
			$('#form-upload [name="ID_REQ_PENDIDIKAN"]').val(record.ID_REQ_PENDIDIKAN);
		if (record.ID_RIWAYAT_PENDIDIKAN != null)
			$('#form-upload [name="ID_RIWAYAT_PENDIDIKAN"]').val(record.ID_RIWAYAT_PENDIDIKAN);
		
		record.reload = false;
		record.action = (action == 'update_upload_valid') ? 'get_upload_valid' : 'get_upload_request';
		page.show_upload({ record: record });
	});
	$('.cnt-form .btn-cancel').click(function() {
		page.show_grid();
	});
	
	// init form
	$('.cnt-form [name="K_JENJANG"]').change(function() {
		page.combo.jenjang();
	});
	$('.cnt-form form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form form');
		var ArrayError = InitForm.Validation('FormRiwayatPendidikan');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('FormRiwayatPendidikan');
		param.IPK = (param.IPK == '') ? 0 : param.IPK;
		param.TMT_TUBEL = Func.swap_date(param.TMT_TUBEL);
		param.TMT_LULUS = Func.swap_date(param.TMT_LULUS);
		param.TGL_IJAZAH = Func.swap_date(param.TGL_IJAZAH);
		param.TMT_PEMBEBASAN = Func.swap_date(param.TMT_PEMBEBASAN);
		param.TMT_PENGAKTIFAN = Func.swap_date(param.TMT_PENGAKTIFAN);
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
					$('#form-upload [name="IS_IJAZAH"]').attr('checked', false);
					
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