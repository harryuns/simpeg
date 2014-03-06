<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_jenjang = $this->jenjang_model->get_array();
	$array_jenis_kelamin = $this->jenis_kelamin_model->get_array();
	$array_hubungan_keluarga = $this->hubungan_keluarga_model->get_array();
	$array_pegawai_keluarga = $this->riwayat_keluarga_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_pegawai_keluarga_request = $this->riwayat_keluarga_request_model->get_array(array( 'K_PEGAWAI' => $k_pegawai, 'IS_VALIDATE' => 0 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Keluarga' ) ); ?>

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
			<?php if (count($array_pegawai_keluarga) > 0) { ?>
				<h1>Riwayat Keluarga</h1>
				<div class="cnt_table_main record-valid"><table style="width: 1275px;">
					<tr>
						<td class="left" style="width: 125px;">&nbsp;</td>
						<td class="normal" style="width: 125px;">Nama</td>
						<td class="normal" style="width: 150px;">Hub. Keluarga</td>
						<td class="normal" style="width: 125px;">Tanggal Lahir</td>
						<td class="normal" style="width: 150px;">Tempat Lahir</td>
						<td class="normal" style="width: 150px;">Pendidikan</td>
						<td class="normal" style="width: 150px;">Alamat</td>
						<td class="normal" style="width: 150px;">Pekerjaan</td>
						<td class="normal" style="width: 150px;">Keterangan</td></tr>
					<?php foreach ($array_pegawai_keluarga as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['NAMA']; ?></td>
						<td class="body"><?php echo $row['KELUARGA']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_LAHIR']); ?></td>
						<td class="body"><?php echo $row['TMP_LAHIR']; ?></td>
						<td class="body"><?php echo $row['JENJANG']; ?></td>
						<td class="body"><?php echo $row['ALAMAT']; ?></td>
						<td class="body"><?php echo $row['PEKERJAAN']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_keluarga_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table style="width: 1425px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Jenis Request</td>
						<td class="normal" style="width: 125px;">Nama</td>
						<td class="normal" style="width: 150px;">Hub. Keluarga</td>
						<td class="normal" style="width: 125px;">Tanggal Lahir</td>
						<td class="normal" style="width: 150px;">Tempat Lahir</td>
						<td class="normal" style="width: 150px;">Pendidikan</td>
						<td class="normal" style="width: 150px;">Alamat</td>
						<td class="normal" style="width: 150px;">Pekerjaan</td>
						<td class="normal" style="width: 150px;">Keterangan</td></tr>
					<?php foreach ($array_pegawai_keluarga_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQ_KELUARGA']); ?></td>
						<td class="body"><?php echo $row['NAMA']; ?></td>
						<td class="body"><?php echo $row['KELUARGA']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_LAHIR']); ?></td>
						<td class="body"><?php echo $row['TMP_LAHIR']; ?></td>
						<td class="body"><?php echo $row['JENJANG']; ?></td>
						<td class="body"><?php echo $row['ALAMAT']; ?></td>
						<td class="body"><?php echo $row['PEKERJAAN']; ?></td>
						<td class="body"><?php echo $row['KETERANGAN']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-new" />
			</div>
		</div>
		
		<div class="cnt-form hidden">
			<h1>Riwayat Keluarga</h1>
			
			<form style="width: 80%;" id="form-riwayat-keluarga" action="<?php echo base_url('index.php/pegawai_modul/riwayat_keluarga/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQ_KELUARGA" value="x" />
				<input type="hidden" name="ID_RIWAYAT_KELUARGA" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQ_KELUARGA" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td style="width: 200px;">NAMA</td>
						<td style="width: 300px;"><input type="text" style="width: 150px;" size="50" name="NAMA" class="required" alt="Silahkan memasukkan Nama" /></td></tr>
					<tr>
						<td>Hubungan Keluarga</td>
						<td><select style="width: 150px;" name="K_KELUARGA">
							<?php echo ShowOption(array( 'Array' => $array_hubungan_keluarga, 'ArrayID' => 'K_KELUARGA', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td></tr>
					<tr class="cnt-tanggal-nikah">
						<td>Kartu Nikah</td>
						<td><input type="text" style="width: 150px;" size="50" name="KARTU_NIKAH"></td></tr>
					<tr class="cnt-tanggal-nikah">
						<td>Tanggal Nikah</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_NIKAH" class="datepicker" /></td></tr>
					<tr>
						<td>Tempat Lahir</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMP_LAHIR"></td></tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td><select style="width: 150px;" name="KELAMIN">
							<?php echo ShowOption(array( 'Array' => $array_jenis_kelamin, 'ArrayID' => 'ID', 'ArrayTitle' => 'CONTENT' )); ?>
						</select></td></tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_LAHIR" class="required datepicker" alt="Silahkan memasukkan Tanggal Lahir" /></td></tr>
					<tr>
						<td>Alamat</td>
						<td><input type="text" style="width: 150px;" size="50" name="ALAMAT"></td></tr>
					<tr>
						<td>Pendidikan Terakhir</td>
						<td>
							<select style="width: 150px;" name="K_JENJANG">
								<?php echo ShowOption(array( 'Array' => $array_jenjang, 'ArrayID' => 'K_JENJANG', 'ArrayTitle' => 'CONTENT' )); ?>
							</select>
							<input type="hidden" name="PENDIDIKAN_AKHIR" />
						</td></tr>
					<tr>
						<td>Pekerjaan</td>
						<td><input type="text" style="width: 150px;" size="50" name="PEKERJAAN"></td></tr>
					<tr>
						<td>Almarhum</td>
						<td><input type="checkbox" value="1" name="IS_ALM"></td></tr>
					<tr>
						<td>Cerai</td>
						<td><input type="checkbox" value="1" name="IS_CERAI"></td></tr>
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
	</div></div></div>

<script type="text/javascript">
(function() {
	InitForm.Start('form-riwayat-keluarga');
	
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
			window.scrollTo(0,200);
		},
		show_form: function() {
			$('.cnt-grid').hide();
			$('.cnt-form').show();
		},
		combo: {
			keluarga: function() {
				var value = $('select[name="K_KELUARGA"]').val();
				if (value == '01' || value == '02') {
					$('.cnt-tanggal-nikah').show();
				} else {
					$('.cnt-tanggal-nikah').hide();
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
		$('.cnt-form [name="ID_RIWAYAT_KELUARGA"]').val('x');
		$('.cnt-form [name="JENIS_REQ_KELUARGA"]').val('I');
		page.combo.keluarga();
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
		$('.cnt-form [name="ID_RIWAYAT_KELUARGA"]').val((record.ID_RIWAYAT_KELUARGA == null) ? 'x' : record.ID_RIWAYAT_KELUARGA);
		$('.cnt-form [name="ID_REQ_KELUARGA"]').val((record.ID_REQ_KELUARGA == null) ? 'x' : record.ID_REQ_KELUARGA);
		page.combo.keluarga();
		
		// update request or valid
		if (action_form == 'update_request') {
			if (action == 'update_valid') {
				$('.cnt-form [name="JENIS_REQ_KELUARGA"]').val('U');
			} else {
				$('.cnt-form [name="JENIS_REQ_KELUARGA"]').val(record.JENIS_REQ_KELUARGA);
			}
		} else if (action_form == 'update_valid') {
			$('.cnt-form [name="JENIS_REQ_KELUARGA"]').val('U');
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
			param.JENIS_REQ_KELUARGA = 'D';
			
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
	$('.cnt-form .btn-cancel').click(function() {
		page.show_grid();
	});
	
	// init form
	$('select[name="K_KELUARGA"]').change(function() { page.combo.keluarga(); });
	$('.cnt-form form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form form');
		var ArrayError = InitForm.Validation('form-riwayat-keluarga');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-riwayat-keluarga');
		param.TGL_LAHIR = Func.swap_date(param.TGL_LAHIR);
		param.TGL_NIKAH = Func.swap_date(param.TGL_NIKAH);
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	page.init();
})();
</script>
	
</div></div>
</body>
</html>