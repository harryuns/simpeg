<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_asal_sk = $this->asal_sk_model->get_array();
	$array_bidang_kerja = $this->bidang_kerja_model->get_array();
	$array_pegawai_struktural = $this->riwayat_struktural_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_pegawai_struktural_request = $this->riwayat_struktural_request_model->get_array(array( 'K_PEGAWAI' => $k_pegawai, 'IS_VALIDATE' => 0 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Jabatan Fungsional' ) ); ?>

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
			<?php if (count($array_pegawai_struktural) > 0) { ?>
				<h1>Riwayat Jabatan Fungsional</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1550px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 100px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 200px;">Asal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 200px;">Unit Kerja</td>
						<td class="normal" style="width: 200px;">Jabatan Struktural</td>
						<td class="normal" style="width: 100px;">Tunjangan Struktural</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_struktural as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_valid"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
						</td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo $row['JABATAN_STRUKTURAL']; ?></td>
						<td class="body"><?php echo $row['TUNJANGAN_STRUKTURAL']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td>
						<td class="body"><?php echo $row['JML_FILE_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_struktural_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table style="width: 1700px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Jenis Request</td>
						<td class="normal" style="width: 100px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 200px;">Asal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 200px;">Unit Kerja</td>
						<td class="normal" style="width: 200px;">Jabatan Struktural</td>
						<td class="normal" style="width: 100px;">Tunjangan Struktural</td>
						<td class="normal" style="width: 200px;">Keterangan</td>
						<td class="normal" style="width: 75px;">Sertifikat</td></tr>
					<?php foreach ($array_pegawai_struktural_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-upload" data-action="update_upload_request"><img class="link" src="<?php echo HOST; ?>/images/folder.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQ_JABATAN_STRUKTURAL']); ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo $row['ASAL_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['UNIT_KERJA']; ?></td>
						<td class="body"><?php echo $row['JABATAN_STRUKTURAL']; ?></td>
						<td class="body"><?php echo $row['TUNJANGAN_STRUKTURAL']; ?></td>
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
			
			<form style="width: 80%;" id="FormRiwayatHomeBase" action="<?php echo base_url('index.php/pegawai_modul/riwayat_struktural/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQ_JABATAN_STRUKTURAL" value="x" />
				<input type="hidden" name="ID_RIWAYAT_JABATAN_STRUKTURAL" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQ_JABATAN_STRUKTURAL" />
				
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
						<td style="width: 300px;"><select style="width: 85%;" name="K_JABATAN_STRUKTURAL"><option>-</option></select></td></tr>
					<tr class="cnt-bidang-kerja">
						<td style="width: 200px;">Bidang Kerja</td>
						<td style="width: 300px;"><select style="width: 85%;" name="K_BIDANG_KERJA">
							<?php echo ShowOption(array( 'Array' => $array_bidang_kerja, 'ArrayID' => 'K_BIDANG_KERJA', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td></tr>
					<tr>
						<td colspan="2">
							<div style="padding: 0pt 0pt 10px;">Jabatan Struktural yang dipegang</div>
							<table cellspacing="0" cellpadding="5" border="0" class="tabel" style="width: 100%; background: none repeat scroll 0% 0% transparent; border: 2px solid rgb(180, 212, 224);"><tbody>
								<tr>
									<td style="width: 202px;">Jenjang</td>
									<td><select style="width: 85%;" name="K_JENJANG"><?php echo GetOption(false, $ArrayJenjang, $RiwayatStruktural['K_JENJANG']); ?></select></td></tr>
								<tr>
									<td>Fakultas</td>
									<td><select style="width: 85%;" name="K_FAKULTAS"><?php echo GetOption(false, $ArrayFakultas, $RiwayatStruktural['K_FAKULTAS']); ?></select></td></tr>
								<tr>
									<td>Jurusan</td>
									<td><select style="width: 85%;" name="K_JURUSAN"><?php echo GetOption(false, $ArrayJurusan, $RiwayatStruktural['K_JURUSAN']); ?></select></td></tr>
								<tr>
									<td>Program Studi</td>
									<td><select style="width: 85%;" name="K_PROG_STUDI"><?php echo GetOption(false, $ArrayProgramStudi, $RiwayatStruktural['K_PROG_STUDI']); ?></select></td></tr>
							</tbody></table>
						</td>
					</tr>
					<tr>
						<td>Tunjangan Struktural</td>
						<td><input type="text" style="width: 150px;" size="50" name="TUNJANGAN_STRUKTURAL" class="integer" /></td></tr>
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
				<input type="hidden" name="ID_REQ_JABATAN_STRUKTURAL" />
				<input type="hidden" name="ID_RIWAYAT_JABATAN_STRUKTURAL" />
				
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
			unit_kerja: function() {
				var param = {
					combo: $('[name="K_JENJANG"]'),
					callback: function() {
						page.combo.jenjang();
						page.combo.jabatan_struktural();
					},
					ajax: {
						url: Web.HOST + '/index.php/Ajax/Jenjang',
						param: { Action: 'GetJenjangByUnitKerja', K_UNIT_KERJA: $('[name="K_UNIT_KERJA"]').val() }
					}
				}
				Func.set_combo(param);
			},
			jenjang: function() {
				var param = {
					combo: $('[name="K_FAKULTAS"]'),
					callback: function() {
						page.combo.fakultas();
					},
					ajax: {
						url: Web.HOST + '/index.php/Ajax/Fakultas',
						param: {
							Action: 'GetFakultasByJenjangUnitKerja',
							K_UNIT_KERJA: $('[name="K_UNIT_KERJA"]').val(),
							K_JENJANG: $('[name="K_JENJANG"]').val()
						}
					}
				}
				Func.set_combo(param);
			},
			fakultas: function() {
				var param = {
					combo: $('[name="K_JURUSAN"]'),
					callback: function() {
						page.combo.jurusan();
					},
					ajax: {
						url: Web.HOST + '/index.php/Ajax/Jurusan',
						param: {
							Action: 'GetJurusanById',
							K_FAKULTAS: $('[name="K_FAKULTAS"]').val(),
							K_JENJANG: $('[name="K_JENJANG"]').val()
						}
					}
				}
				Func.set_combo(param);
			},
			jurusan: function() {
				var param = {
					combo: $('[name="K_PROG_STUDI"]'),
					ajax: {
						url: Web.HOST + '/index.php/Ajax/ProgramStudi',
						param: {
							Action: 'GetProgramStudiById',
							K_FAKULTAS: $('[name="K_FAKULTAS"]').val(),
							K_JENJANG: $('[name="K_JENJANG"]').val(),
							K_JURUSAN: $('[name="K_JURUSAN"]').val()
						}
					}
				}
				Func.set_combo(param);
			},
			jabatan_struktural: function() {
				var param = {
					combo: $('[name="K_JABATAN_STRUKTURAL"]'),
					callback: function() {
						page.combo.bidang_kerja();
					},
					ajax: {
						url: Web.HOST + '/index.php/Ajax/JabatanStruktural',
						param: { Action: 'GetJabatanStrukturalByUnitKerja', K_UNIT_KERJA: $('[name="K_UNIT_KERJA"]').val() }
					}
				}
				Func.set_combo(param);
			},
			bidang_kerja: function() {
				var value = $('select[name="K_JABATAN_STRUKTURAL"]').val();
				
				if (value == '99') {
					$('.cnt-bidang-kerja').show();
				} else {
					$('.cnt-bidang-kerja').hide();
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
		$('.cnt-form [name="ID_RIWAYAT_JABATAN_STRUKTURAL"]').val('x');
		$('.cnt-form [name="JENIS_REQ_JABATAN_STRUKTURAL"]').val('I');
		$('.cnt-form [name="K_UNIT_KERJA"]').change();
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
		
		$('.cnt-form [name="JENIS_REQ_JABATAN_STRUKTURAL"]').val(record.JENIS_REQ_JABATAN_STRUKTURAL);
		$('.cnt-form [name="ID_RIWAYAT_JABATAN_STRUKTURAL"]').val((record.ID_RIWAYAT_JABATAN_STRUKTURAL == null) ? 'x' : record.ID_RIWAYAT_JABATAN_STRUKTURAL);
		$('.cnt-form [name="ID_REQ_JABATAN_STRUKTURAL"]').val((record.ID_REQ_JABATAN_STRUKTURAL == null) ? 'x' : record.ID_REQ_JABATAN_STRUKTURAL);
		$('.cnt-form [name="NO_SK"]').val(record.NO_SK);
		$('.cnt-form [name="TGL_SK"]').val(Func.swap_date(record.TGL_SK));
		$('.cnt-form [name="TMT"]').val(Func.swap_date(record.TMT));
		$('.cnt-form [name="K_ASAL_SK"]').val(record.K_ASAL_SK);
		$('.cnt-form [name="K_UNIT_KERJA"]').val(record.K_UNIT_KERJA);
		$('.cnt-form [name="K_UNIT_KERJA"]').next().val(record.UNIT_KERJA)
		$('.cnt-form [name="K_JABATAN_STRUKTURAL"]').val(record.K_JABATAN_STRUKTURAL);
		$('.cnt-form [name="KETERANGAN"]').val(record.KETERANGAN);
		$('.cnt-form [name="TUNJANGAN_STRUKTURAL"]').val(record.TUNJANGAN_STRUKTURAL);
		$('.cnt-form [name="ANGKA_KREDIT"]').val(record.ANGKA_KREDIT);
		$('.cnt-form [name="BIDANG_ILMU"]').val(record.BIDANG_ILMU);
		$('.cnt-form [name="JABATAN_LAIN"]').val(record.JABATAN_LAIN);
		$('.cnt-form [name="PENANDATANGAN_SK"]').val(record.PENANDATANGAN_SK);
		
		// set ansync data
		var jabatan_struktural_param = {
			value: record.K_UNIT_KERJA,
			combo: $('.cnt-form [name="K_JABATAN_STRUKTURAL"]'),
			callback: function() { page.combo.bidang_kerja(); },
			ajax: { url: Web.HOST + '/index.php/Ajax/JabatanStruktural', param: { Action: 'GetJabatanStrukturalByUnitKerja', K_UNIT_KERJA: record.K_UNIT_KERJA } }
		}
		Func.set_combo(jabatan_struktural_param);
		var jenjang_param = {
			value: record.K_JENJANG,
			combo: $('.cnt-form [name="K_JENJANG"]'),
			ajax: { url: Web.HOST + '/index.php/Ajax/Jenjang', param: { Action: 'GetJenjangByUnitKerja', K_UNIT_KERJA: record.K_UNIT_KERJA } }
		}
		Func.set_combo(jenjang_param);
		var fakultas_param = {
			value: record.K_FAKULTAS,
			combo: $('.cnt-form [name="K_FAKULTAS"]'),
			ajax: { url: Web.HOST + '/index.php/Ajax/Fakultas', param: { Action: 'GetFakultasByJenjangUnitKerja', K_UNIT_KERJA: record.K_UNIT_KERJA, K_JENJANG: record.K_JENJANG } }
		}
		Func.set_combo(fakultas_param);
		var jurusan_param = {
			value: record.K_JURUSAN,
			combo: $('.cnt-form [name="K_JURUSAN"]'),
			ajax: { url: Web.HOST + '/index.php/Ajax/Jurusan', param: { Action: 'GetJurusanById', K_FAKULTAS: record.K_FAKULTAS, K_JENJANG: record.K_JENJANG } }
		}
		Func.set_combo(jurusan_param);
		var program_studi_param = {
			value: record.K_PROG_STUDI,
			combo: $('.cnt-form [name="K_PROG_STUDI"]'),
			ajax: { url: Web.HOST + '/index.php/Ajax/ProgramStudi', param: { Action: 'GetProgramStudiById', K_FAKULTAS: record.K_FAKULTAS, K_JENJANG: record.K_JENJANG, K_JURUSAN: record.K_JURUSAN } }
		}
		Func.set_combo(program_studi_param);
		
		// update request or valid
		if (action_form == 'update_request') {
			if (action == 'update_valid') {
				$('.cnt-form [name="JENIS_REQ_JABATAN_STRUKTURAL"]').val('U');
			} else {
				$('.cnt-form [name="JENIS_REQ_JABATAN_STRUKTURAL"]').val(record.JENIS_REQ_JABATAN_STRUKTURAL);
			}
		} else if (action_form == 'update_valid') {
			$('.cnt-form [name="JENIS_REQ_JABATAN_STRUKTURAL"]').val('U');
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
			param.JENIS_REQ_JABATAN_STRUKTURAL = 'D';
			
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
		if (record.ID_REQ_JABATAN_STRUKTURAL != null)
			$('#form-upload [name="ID_REQ_JABATAN_STRUKTURAL"]').val(record.ID_REQ_JABATAN_STRUKTURAL);
		if (record.ID_RIWAYAT_JABATAN_STRUKTURAL != null)
			$('#form-upload [name="ID_RIWAYAT_JABATAN_STRUKTURAL"]').val(record.ID_RIWAYAT_JABATAN_STRUKTURAL);
		
		record.reload = false;
		record.action = (action == 'update_upload_valid') ? 'get_upload_valid' : 'get_upload_request';
		page.show_upload({ record: record });
	});
	$('.cnt-form .btn-cancel').click(function() {
		page.show_grid();
	});
	
	// init form
	$('.cnt-form [name="K_UNIT_KERJA"]').change(function() {
		page.combo.unit_kerja();
	});
	$('.cnt-form [name="K_JABATAN_STRUKTURAL"]').change(function() {
		page.combo.bidang_kerja();
	});
	$('.cnt-form [name="K_JENJANG"]').change(function() {
		page.combo.jenjang();
	});
	$('.cnt-form [name="K_FAKULTAS"]').change(function() {
		page.combo.fakultas();
	});
	$('.cnt-form [name="K_JURUSAN"]').change(function() {
		page.combo.jurusan();
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
				window.location = window.location.href;
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