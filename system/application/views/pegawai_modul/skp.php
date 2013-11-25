<?php
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$page = array( 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_pegawai_skp = $this->skp_model->get_array(array( 'K_PEGAWAI' => $k_pegawai ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'SKP' ) ); ?>

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
			<?php if (count($array_pegawai_skp) > 0) { ?>
				<h1>SKP</h1>
				<div class="cnt_table_main record-valid"><table style="width: 900px;">
					<tr>
						<td class="left" style="width: 175px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">No SK</td>
						<td class="normal" style="width: 150px;">Tanggal SK</td>
						<td class="normal" style="width: 150px;">TMT</td>
						<td class="normal" style="width: 125px;">NIP Pejabat</td>
						<td class="normal" style="width: 125px;">Nama Pejabat</td></tr>
					<?php foreach ($array_pegawai_skp as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_tupoksi"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
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
			<h1>SKP</h1>
			
			<form style="width: 80%;" id="form-skp" action="<?php echo base_url('index.php/pegawai_modul/skp/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_NILAI_TUPOKSI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Tahun</td>
						<td><input type="text" style="width: 30%;" size="50" name="TAHUN" class="required int" alt="Tahun kosong" /></td></tr>
					<tr>
						<td>Kegiatan</td>
						<td><input type="text" style="width: 85%;" size="50" name="KEGIATAN" class="required" alt="Kegiatan kosong" /></td></tr>
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
	</div></div></div>

<script type="text/javascript">
(function() {
	InitForm.Start('form-skp');
	
	var page = {
		init: function() {
			var raw = $('.cnt-page').text();
			eval('var data = ' + raw);
			page.data = data;
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
		$('.cnt-form [name="action"]').val('update_tupoksi');
		$('.cnt-form [name="ID_NILAI_TUPOKSI"]').val('x');
	});
	$('.cnt-grid .btn-edit').click(function() {
		page.show_form();
		
		// set action
		var action = $(this).attr('data-action');
		$('.cnt-form [name="action"]').val(action_form);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form [name="ID_NILAI_TUPOKSI"]').val((record.ID_NILAI_TUPOKSI == null) ? 'x' : record.ID_NILAI_TUPOKSI);
		$('.cnt-form [name="TAHUN"]').val(record.TAHUN);
		$('.cnt-form [name="KEGIATAN"]').val(record.KEGIATAN);
		$('.cnt-form [name="AK_TARGET"]').val(record.AK_TARGET);
		$('.cnt-form [name="KUAN_TARGET"]').val(record.KUAN_TARGET);
		$('.cnt-form [name="KUAL_TARGET"]').val(record.KUAL_TARGET);
		$('.cnt-form [name="WAKTU_TARGET"]').val(record.WAKTU_TARGET);
		$('.cnt-form [name="BIAYA_TARGET"]').val(record.BIAYA_TARGET);
		$('.cnt-form [name="AK_REAL"]').val(record.AK_REAL);
		$('.cnt-form [name="KUAN_REAL"]').val(record.KUAN_REAL);
		$('.cnt-form [name="KUAL_REAL"]').val(record.KUAL_REAL);
		$('.cnt-form [name="WAKTU_REAL"]').val(record.WAKTU_REAL);
		$('.cnt-form [name="BIAYA_REAL"]').val(record.BIAYA_REAL);
	});
	$('.cnt-grid .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		record.action = $(this).attr('data-action');
		Func.rec_delete({ action: $('.cnt-form form').attr('action'), param: record });
	});
	$('.cnt-form .btn-cancel').click(function() {
		page.show_grid();
	});
	
	// init form
	$('.cnt-form form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form form');
		var ArrayError = InitForm.Validation('form-skp');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-skp');
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