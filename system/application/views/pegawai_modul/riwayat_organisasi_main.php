<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_asal_sk = $this->asal_sk_model->get_array();
	$array_jabatan_fungsional = array();
	$array_pegawai_organisasi = $this->riwayat_organisasi_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_pegawai_organisasi_request = $this->riwayat_organisasi_request_model->get_array(array( 'K_PEGAWAI' => $k_pegawai, 'IS_VALIDATE' => 0 ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Organisasi' ) ); ?>

<body>
<div id="body"><div id="frame">
	<div id="sidebar">
		<div class="hidden cnt-page"><?php echo json_encode($page); ?></div>
		<div class="glossymenu"><?php $this->load->view('main_menu'); ?></div>
	</div>
	
	<div id="content">
  	<div class="contentmenu clearfix"><?php $this->load->view('main_sub_menu'); ?></div>
  <div class="full" style="min-height: 400px;"><div id="CntRightFull">
		<?php $this->load->view('pegawai_info'); ?>
		
		<?php if (!empty($message)) { ?>
			<div class="MessagePopup"><?php echo $message; ?></div>
		<?php } ?>
		
		<div class="cnt-grid">
			<?php if (count($array_pegawai_organisasi) > 0) { ?>
				<h1>Riwayat Organisasi</h1>
				<div class="cnt_table_main record-valid"><table>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="normal">Nama</td>
						<td class="normal">Kedudukan</td>
						<td class="normal">No SK</td>
						<td class="normal">NIP Pejabat</td>
						<td class="normal">Tanggal Mulai</td>
						<td class="normal">Tanggal Selesai</td></tr>
					<?php foreach ($array_pegawai_organisasi as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['NAMA']; ?></td>
						<td class="body"><?php echo $row['KEDUDUKAN']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo $row['NIP_PEJABAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SELESAI']); ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_organisasi_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table>
					<tr>
						<td class="left">&nbsp;</td>
						<td class="normal">Jenis Request</td>
						<td class="normal">Nama</td>
						<td class="normal">Kedudukan</td>
						<td class="normal">No SK</td>
						<td class="normal">NIP Pejabat</td>
						<td class="normal">Tanggal Mulai</td>
						<td class="normal">Tanggal Selesai</td></tr>
					<?php foreach ($array_pegawai_organisasi_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQ_ORGANISASI']); ?></td>
						<td class="body"><?php echo $row['NAMA']; ?></td>
						<td class="body"><?php echo $row['KEDUDUKAN']; ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo $row['NIP_PEJABAT']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_MULAI']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SELESAI']); ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-new" />
			</div>
		</div>
		
		<div class="cnt-form hidden">
			<h1>Riwayat Organisasi</h1>
			
			<form style="width: 80%;" id="form-riwayat-organisasi" action="<?php echo base_url('index.php/pegawai_modul/riwayat_organisasi/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQ_ORGANISASI" value="x" />
				<input type="hidden" name="ID_RIWAYAT_ORGANISASI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQ_ORGANISASI" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Nama</td>
						<td><input type="text" style="width: 85%;" size="50" name="NAMA" class="required" /></td></tr>
					<tr>
						<td>Kedudukan</td>
						<td><input type="text" style="width: 85%;" size="50" name="KEDUDUKAN" class="required" /></td></tr>
					<tr>
						<td>Tanggal Mulai</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_MULAI" class="datepicker" /></td></tr>
					<tr>
						<td>Tanggal Selesai</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_SELESAI" class="datepicker" /></td></tr>
					<tr>
						<td>No SK</td>
						<td><input type="text" style="width: 85%;" size="50" name="NO_SK" class="sk_char" /></td></tr>
					<tr>
						<td>NIP Pejabat</td>
						<td><input type="text" style="width: 85%;" size="50" name="NIP_PEJABAT" class="required" /></td></tr>
					<tr>
						<td>Nama Pejabat</td>
						<td><input type="text" style="width: 85%;" size="50" name="NAMA_PEJABAT" /></td></tr>
					<tr>
						<td>Jabatan Pejabat</td>
						<td><input type="text" style="width: 85%;" size="50" name="JABATAN_PEJABAT" /></td></tr>
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
	InitForm.Start('form-riwayat-organisasi');
	
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
		}
	}
	
	// button
	$('.record-new').click(function() {
		page.show_form();
		
		// reset form
		$('.cnt-form form')[0].reset();
		
		// init form
		$('.cnt-form [name="action"]').val('update_request');
		$('.cnt-form [name="ID_RIWAYAT_ORGANISASI"]').val('x');
		$('.cnt-form [name="JENIS_REQ_ORGANISASI"]').val('I');
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
		
		$('.cnt-form [name="JENIS_REQ_ORGANISASI"]').val(record.JENIS_REQ_ORGANISASI);
		$('.cnt-form [name="ID_RIWAYAT_ORGANISASI"]').val((record.ID_RIWAYAT_ORGANISASI == null) ? 'x' : record.ID_RIWAYAT_ORGANISASI);
		$('.cnt-form [name="ID_REQ_ORGANISASI"]').val((record.ID_REQ_ORGANISASI == null) ? 'x' : record.ID_REQ_ORGANISASI);
		$('.cnt-form [name="NAMA"]').val(record.NAMA);
		$('.cnt-form [name="KEDUDUKAN"]').val(record.KEDUDUKAN);
		$('.cnt-form [name="TGL_MULAI"]').val(Func.swap_date(record.TGL_MULAI));
		$('.cnt-form [name="TGL_SELESAI"]').val(Func.swap_date(record.TGL_SELESAI));
		$('.cnt-form [name="NO_SK"]').val(record.NO_SK);
		$('.cnt-form [name="NIP_PEJABAT"]').val(record.NIP_PEJABAT);
		$('.cnt-form [name="NAMA_PEJABAT"]').val(record.NAMA_PEJABAT);
		$('.cnt-form [name="JABATAN_PEJABAT"]').val(record.JABATAN_PEJABAT);
		
		// update request or valid
		if (action_form == 'update_request') {
			if (action == 'update_valid') {
				$('.cnt-form [name="JENIS_REQ_ORGANISASI"]').val('U');
			} else {
				$('.cnt-form [name="JENIS_REQ_ORGANISASI"]').val(record.JENIS_REQ_ORGANISASI);
			}
		} else if (action_form == 'update_valid') {
			$('.cnt-form [name="JENIS_REQ_ORGANISASI"]').val('U');
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
			param.JENIS_REQ_ORGANISASI = 'D';
			
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
	$('.cnt-form form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form form');
		var ArrayError = InitForm.Validation('form-riwayat-organisasi');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-riwayat-organisasi');
		param.TGL_MULAI = Func.swap_date(param.TGL_MULAI);
		param.TGL_SELESAI = Func.swap_date(param.TGL_SELESAI);
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