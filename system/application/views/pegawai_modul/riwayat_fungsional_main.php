<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$pegawai = $this->lpegawai->GetPegawaiById($k_pegawai);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_asal_sk = $this->asal_sk_model->get_array();
	$array_jabatan_pekerjaan = $this->jabatan_pekerjaan_model->get_array();
	$array_jabatan_fungsional = $this->jabatan_fungsional_model->get_array(array( 'IS_DOSEN' => @$pegawai['IsDosen'] ));
	$array_pegawai_fungsional = $this->riwayat_fungsional_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_pegawai_fungsional_request = $this->riwayat_fungsional_request_model->get_array(array( 'K_PEGAWAI' => $k_pegawai, 'IS_VALIDATE' => 0 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Jabatan Fungsional' ) ); ?>

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
			<?php if (count($array_pegawai_fungsional) > 0) { ?>
				<h1>Riwayat Jabatan Fungsional</h1>
				<div class="cnt_table_main record-valid"><table>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="normal">No SK</td>
						<td class="normal">Jabatan Fungsional</td>
						<td class="normal">Unit Kerja</td>
						<td class="normal">Tanggal SK</td>
						<td class="normal">Asal SK</td>
						<td class="normal">TMT</td>
						<td class="normal">Angka Kredit</td>
						<td class="normal">Keterangan</td>
						<td class="normal">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_fungsional as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_valid"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
						</td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo $row['JABATAN_FUNGSIONAL']; ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['ANGKA_KREDIT']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_fungsional_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="normal">Jenis Request</td>
						<td class="normal">No SK</td>
						<td class="normal">Jabatan Fungsional</td>
						<td class="normal">Unit Kerja</td>
						<td class="normal">Tanggal SK</td>
						<td class="normal">Asal SK</td>
						<td class="normal">TMT</td>
						<td class="normal">Angka Kredit</td>
						<td class="normal">Keterangan</td>
						<td class="normal">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_fungsional_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_request"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQ_JABATAN_FUNGSIONAL']); ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo $row['JABATAN_FUNGSIONAL']; ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['ANGKA_KREDIT']; ?></td>
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
			<h1>Riwayat Jabatan Fungsional</h1>
			
			<form style="width: 80%;" id="FormRiwayatHomeBase" action="<?php echo base_url('index.php/pegawai_modul/riwayat_fungsional/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQ_JABATAN_FUNGSIONAL" value="x" />
				<input type="hidden" name="ID_RIWAYAT_JABATAN_FUNGSIONAL" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQ_JABATAN_FUNGSIONAL" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>No SK</td>
						<td><input type="text" style="width: 85%;" size="50" name="NO_SK" class="required sk_char" alt="No SK kosong" /></td></tr>
					<tr>
						<td>Tanggal SK</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_SK" class="required datepicker" alt="Tanggal SK kosong" /></td></tr>
					<tr>
						<td style="width: 200px;">Asal SK</td>
						<td style="width: 300px;"><select style="width: 85%;" name="K_ASAL_SK">
							<?php echo ShowOption(array( 'Array' => $array_asal_sk, 'ArrayID' => 'K_ASAL_SK', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td></tr>
					<tr>
						<td>TMT</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMT" class="datepicker" /></td></tr>
					<tr>
						<td style="width: 200px;">Unit Kerja</td>
						<td style="width: 300px;">
							<input type="hidden" name="K_UNIT_KERJA" data-change="1" />
							<input type="text" style="width: 150px;" size="50" class="unit-kerja" readonly="readonly" />
							<input type="button" style="width: 75px;" class="show_unitkerja" data-target=".unit-kerja" value="Ubah" />
						</td></tr>
					<tr>
						<td style="width: 200px;">Jabatan Fungsional</td>
						<td style="width: 300px;"><select style="width: 85%;" name="K_JABATAN_FUNGSIONAL">
							<?php echo ShowOption(array( 'Array' => $array_jabatan_fungsional, 'ArrayID' => 'K_JABATAN_FUNGSIONAL', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td></tr>
					<tr class="cnt-bidang-ilmu">
						<td>Bidang Ilmu</td>
						<td><input type="text" style="width: 150px;" size="50" name="BIDANG_ILMU" /></td></tr>
					<tr>
						<td style="width: 200px;">Jabatan Pekerjaan</td>
						<td style="width: 300px;"><select style="width: 85%;" name="JABATAN_LAIN">
							<?php echo ShowOption(array( 'Array' => $array_jabatan_pekerjaan, 'ArrayID' => 'K_JABATAN_PEKERJAAN', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td>
					</tr>
					<tr>
						<td>Penandatangan SK</td>
						<td><input type="text" style="width: 150px;" size="50" name="PENANDATANGAN_SK" /></td></tr>
					<tr>
						<td>Tunjangan Fungsional</td>
						<td><input type="text" style="width: 150px;" size="50" name="TUNJANGAN_FUNGSIONAL" class="integer" /></td></tr>
					<tr>
						<td>Angka Kredit</td>
						<td>
							<input type="text" style="width: 150px;" size="50" name="ANGKA_KREDIT" maxlength="10" />
							<div>Gunakan tanda titik '.' sebagai pengganti tanda koma ','</div>
						</td></tr>
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
				<input type="hidden" name="ID_REQ_JABATAN_FUNGSIONAL" />
				<input type="hidden" name="ID_RIWAYAT_JABATAN_FUNGSIONAL" />
				
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
	InitForm.Start('FormRiwayatHomeBase');
	
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
			jabatan_fungsional: function() {
				var value = $('select[name="K_JABATAN_FUNGSIONAL"]').val();
				
				if (value == '03' || value == '04') {
					$('.cnt-bidang-ilmu').show();
				} else {
					$('.cnt-bidang-ilmu').hide();
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
		$('.cnt-form [name="ID_RIWAYAT_JABATAN_FUNGSIONAL"]').val('x');
		$('.cnt-form [name="JENIS_REQ_JABATAN_FUNGSIONAL"]').val('I');
		$('.cnt-form [name="K_JABATAN_FUNGSIONAL"]').change();
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
		
		a = record
		record = a;
		
		$('.cnt-form [name="JENIS_REQ_JABATAN_FUNGSIONAL"]').val(record.JENIS_REQ_JABATAN_FUNGSIONAL);
		$('.cnt-form [name="ID_RIWAYAT_JABATAN_FUNGSIONAL"]').val((record.ID_RIWAYAT_JABATAN_FUNGSIONAL == null) ? 'x' : record.ID_RIWAYAT_JABATAN_FUNGSIONAL);
		$('.cnt-form [name="ID_REQ_JABATAN_FUNGSIONAL"]').val((record.ID_REQ_JABATAN_FUNGSIONAL == null) ? 'x' : record.ID_REQ_JABATAN_FUNGSIONAL);
		$('.cnt-form [name="NO_SK"]').val(record.NO_SK);
		$('.cnt-form [name="TGL_SK"]').val(Func.swap_date(record.TGL_SK));
		$('.cnt-form [name="TMT"]').val(Func.swap_date(record.TMT));
		$('.cnt-form [name="K_ASAL_SK"]').val(record.K_ASAL_SK);
		$('.cnt-form [name="K_UNIT_KERJA"]').val(record.K_UNIT_KERJA);
		$('.cnt-form [name="K_UNIT_KERJA"]').next().val(record.UNIT_KERJA)
		$('.cnt-form [name="K_JABATAN_FUNGSIONAL"]').val(record.K_JABATAN_FUNGSIONAL);
		$('.cnt-form [name="KETERANGAN"]').val(record.KETERANGAN);
		$('.cnt-form [name="TUNJANGAN_FUNGSIONAL"]').val(record.TUNJANGAN_FUNGSIONAL);
		$('.cnt-form [name="ANGKA_KREDIT"]').val(record.ANGKA_KREDIT);
		$('.cnt-form [name="BIDANG_ILMU"]').val(record.BIDANG_ILMU);
		$('.cnt-form [name="JABATAN_LAIN"]').val(record.JABATAN_LAIN);
		$('.cnt-form [name="PENANDATANGAN_SK"]').val(record.PENANDATANGAN_SK);
		
		// set combo
		$('.cnt-form [name="K_JABATAN_FUNGSIONAL"]').change();
		
		// update request or valid
		if (action_form == 'update_request') {
			if (action == 'update_valid') {
				$('.cnt-form [name="JENIS_REQ_JABATAN_FUNGSIONAL"]').val('U');
			} else {
				$('.cnt-form [name="JENIS_REQ_JABATAN_FUNGSIONAL"]').val(record.JENIS_REQ_JABATAN_FUNGSIONAL);
			}
		} else if (action_form == 'update_valid') {
			$('.cnt-form [name="JENIS_REQ_JABATAN_FUNGSIONAL"]').val('U');
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
			param.JENIS_REQ_JABATAN_FUNGSIONAL = 'D';
			
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
		if (record.ID_REQ_JABATAN_FUNGSIONAL != null)
			$('#form-upload [name="ID_REQ_JABATAN_FUNGSIONAL"]').val(record.ID_REQ_JABATAN_FUNGSIONAL);
		if (record.ID_RIWAYAT_JABATAN_FUNGSIONAL != null)
			$('#form-upload [name="ID_RIWAYAT_JABATAN_FUNGSIONAL"]').val(record.ID_RIWAYAT_JABATAN_FUNGSIONAL);
		
		record.reload = false;
		record.action = (action == 'update_upload_valid') ? 'get_upload_valid' : 'get_upload_request';
		page.show_upload({ record: record });
	});
	$('.cnt-form .btn-cancel').click(function() {
		page.show_grid();
	});
	
	// init form
	$('.cnt-form [name="K_JABATAN_FUNGSIONAL"]').change(function() {
		page.combo.jabatan_fungsional();
	});
	$('.cnt-form form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form form');
		var ArrayError = InitForm.Validation('FormRiwayatHomeBase');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('FormRiwayatHomeBase');
		param.TGL_SK = Func.swap_date(param.TGL_SK);
		param.TMT = Func.swap_date(param.TMT);
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