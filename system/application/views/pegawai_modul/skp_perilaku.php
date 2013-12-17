<?php
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$tahun = (empty($this->uri->segments[5])) ? date("Y") : $this->uri->segments[5];
	$page = array( 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$array_perilaku = $this->skp_model->get_array_perilaku();
	$array_perilaku_pegawai = $this->skp_model->get_array_perilaku_pegawai(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'SKP Perilaku' ) ); ?>

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
		
		<?php $this->load->view('pegawai_modul/skp_filter', array( 'tahun' => $tahun )); ?>
		
		<div class="cnt-grid-perilaku">
			<h1>SKP Perilaku</h1>
			<?php if (count($array_perilaku_pegawai) > 0) { ?>
				<div class="cnt_table_main"><table style="width: 350px;">
					<tr>
						<td class="left" style="width: 100px;">&nbsp;</td>
						<td class="normal" style="width: 250px;">Perilaku</td>
						<td class="normal" style="width: 100px;">Nilai</td></tr>
					<?php foreach ($array_perilaku_pegawai as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_perilaku"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_perilaku"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['PERILAKU']; ?></td>
						<td class="body"><?php echo $row['NILAI']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" name="Tambah" value="Tambah" class="btn-perilaku-new" />
			</div>
		</div>
		
		<div class="cnt-form-perilaku hidden">
			<h1>Form SKP Perilaku</h1>
			
			<form style="width: 80%;" id="form-perilaku" action="<?php echo base_url('index.php/pegawai_modul/skp_perilaku/action'); ?>">
				<input type="hidden" name="action" value="update_perilaku" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td style="width: 200px;">Perilaku</td>
						<td style="width: 300px;"><select style="width: 85%;" name="K_PERILAKU">
							<?php echo ShowOption(array( 'Array' => $array_perilaku, 'ArrayID' => 'K_PERILAKU', 'ArrayTitle' => 'PERILAKU' )); ?>
						</select></td></tr>
					<tr>
						<td>Nilai</td>
						<td><input type="text" style="width: 30%;" size="50" name="NILAI" class="required integer" alt="Nilai kosong" /></td></tr>
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
	InitForm.Start('form-perilaku');
	InitForm.Start('form-penilai');
	
	var page = {
		init: function() {
			var raw = $('.cnt-page').text();
			eval('var data = ' + raw);
			page.data = data;
		},
		show_grid: function() {
			$('.cnt-grid-perilaku').show();
			$('.cnt-form-perilaku').hide();
			window.scrollTo(0,200);
		},
		show_form_perilaku: function() {
			$('.cnt-grid-perilaku').hide();
			$('.cnt-form-perilaku').show();
		}
	}
	
	/* Form Kegiatan */
	
	$('.btn-perilaku-new').click(function() {
		page.show_form_perilaku();
		
		// reset form
		$('.cnt-form-perilaku form')[0].reset();
		
		// init form
		$('.cnt-form-perilaku [name="action"]').val('update_perilaku');
		$('.cnt-form-perilaku [name="TAHUN"]').val($('select[name="TAHUN"]').val());
		$('.cnt-form-perilaku .btn-submit').show();
	});
	$('.cnt-grid-perilaku .btn-edit').click(function() {
		page.show_form_perilaku();
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-perilaku [name="K_PERILAKU"]').val(record.K_PERILAKU);
		$('.cnt-form-perilaku [name="NILAI"]').val(record.NILAI);
	});
	$('.cnt-grid-perilaku .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		record.action = $(this).attr('data-action');
		Func.rec_delete({ action: $('.cnt-form-perilaku form').attr('action'), param: record });
	});
	$('.cnt-form-perilaku .btn-cancel').click(function() {
		page.show_grid();
	});
	$('.cnt-form-perilaku form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form-perilaku form');
		var ArrayError = InitForm.Validation('form-perilaku');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-perilaku');
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Form Kegiatan */
	
	page.init();
})();
</script>
	
</div></div>
</body>
</html>