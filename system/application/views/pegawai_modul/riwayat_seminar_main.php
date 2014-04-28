<?php
	$is_user_fakultas = $this->llogin->is_user_fakultas();
//	$is_user_fakultas = true;
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'is_user_fakultas' => $is_user_fakultas, 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_asal_sk = $this->asal_sk_model->get_array();
	$array_jabatan_fungsional = array();
	$array_pegawai_hukuman = $this->riwayat_hukuman_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
	$array_pegawai_hukuman_request = $this->riwayat_hukuman_request_model->get_array(array( 'K_PEGAWAI' => $k_pegawai, 'IS_VALIDATE' => 0 ));
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Riwayat Home Base' ) ); ?>

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
			<?php if (count($array_pegawai_hukuman) > 0) { ?>
				<h1>Riwayat Hukuman</h1>
				<div class="cnt_table_main record-valid"><table style="width: 900px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 125px;">NIP Pejabat</td>
						<td class="normal" style="width: 125px;">Nama Pejabat</td></tr>
					<?php foreach ($array_pegawai_hukuman as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_valid"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_valid"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['NIP_PEJABAT']; ?></td>
						<td class="body"><?php echo $row['NAMA_PEJABAT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (count($array_pegawai_hukuman_request) > 0) { ?>
				<h1>Riwayat yang belum tervalidasi</h1>
				<div class="cnt_table_main record-request"><table style="width: 1050px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Jenis Request</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 125px;">NIP Pejabat</td>
						<td class="normal" style="width: 125px;">Nama Pejabat</td></tr>
					<?php foreach ($array_pegawai_hukuman_request as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_request"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_request"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
							<a class="btn-validate"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
						</td>
						<td class="body"><?php echo show_jenis_request($row['JENIS_REQ_HUKUMAN']); ?></td>
						<td class="body"><?php echo $row['NO_SK']; ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TGL_SK']); ?></td>
						<td class="body"><?php echo ConvertDateToString($row['TMT']); ?></td>
						<td class="body"><?php echo $row['NIP_PEJABAT']; ?></td>
						<td class="body"><?php echo $row['NAMA_PEJABAT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="record-new" />
			</div>
		</div>
		
		<div class="cnt-form hidden">
			<h1>Riwayat Hukuman</h1>
			
			<form style="width: 80%;" id="form-riwayat-hukuman" action="<?php echo base_url('index.php/pegawai_modul/riwayat_hukuman/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_REQ_HUKUMAN" value="x" />
				<input type="hidden" name="ID_RIWAYAT_HUKUMAN" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="JENIS_REQ_HUKUMAN" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>No SK</td>
						<td><input type="text" style="width: 85%;" size="50" name="NO_SK" class="required sk_char" alt="No SK kosong" /></td></tr>
					<tr>
						<td>Tanggal SK</td>
						<td><input type="text" style="width: 150px;" size="50" name="TGL_SK" class="required datepicker" alt="Tanggal SK kosong" /></td></tr>
					<tr>
						<td>TMT</td>
						<td><input type="text" style="width: 150px;" size="50" name="TMT" class="datepicker" /></td></tr>
					<tr>
						<td>NIP Pejabat</td>
						<td><input type="text" style="width: 85%;" size="50" name="NIP_PEJABAT" /></td></tr>
					<tr>
						<td>Nama Pejabat</td>
						<td><input type="text" style="width: 85%;" size="50" name="NAMA_PEJABAT" /></td></tr>
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
	InitForm.Start('form-riwayat-hukuman');
	
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
		$('.cnt-form [name="ID_RIWAYAT_HUKUMAN"]').val('x');
		$('.cnt-form [name="JENIS_REQ_HUKUMAN"]').val('I');
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
		
		$('.cnt-form [name="JENIS_REQ_HUKUMAN"]').val(record.JENIS_REQ_HUKUMAN);
		$('.cnt-form [name="ID_RIWAYAT_HUKUMAN"]').val((record.ID_RIWAYAT_HUKUMAN == null) ? 'x' : record.ID_RIWAYAT_HUKUMAN);
		$('.cnt-form [name="ID_REQ_HUKUMAN"]').val((record.ID_REQ_HUKUMAN == null) ? 'x' : record.ID_REQ_HUKUMAN);
		$('.cnt-form [name="NO_SK"]').val(record.NO_SK);
		$('.cnt-form [name="TGL_SK"]').val(Func.swap_date(record.TGL_SK));
		$('.cnt-form [name="TMT"]').val(Func.swap_date(record.TMT));
		$('.cnt-form [name="NIP_PEJABAT"]').val(record.NIP_PEJABAT);
		$('.cnt-form [name="NAMA_PEJABAT"]').val(record.NAMA_PEJABAT);
		
		// update request or valid
		if (action_form == 'update_request') {
			if (action == 'update_valid') {
				$('.cnt-form [name="JENIS_REQ_HUKUMAN"]').val('U');
			} else {
				$('.cnt-form [name="JENIS_REQ_HUKUMAN"]').val(record.JENIS_REQ_HUKUMAN);
			}
		} else if (action_form == 'update_valid') {
			$('.cnt-form [name="JENIS_REQ_HUKUMAN"]').val('U');
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
			param.JENIS_REQ_HUKUMAN = 'D';
			
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
		var ArrayError = InitForm.Validation('form-riwayat-hukuman');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-riwayat-hukuman');
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
	
	page.init();
})();
</script>
	
</div></div>
</body>
</html>