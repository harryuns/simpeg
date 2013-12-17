<?php
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$tahun = (empty($this->uri->segments[5])) ? date("Y") : $this->uri->segments[5];
	$page = array( 'k_pegawai' => $k_pegawai );
	
	$message = get_flash_message();
	$pejabat = $this->skp_model->get_pejabat_penilai(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
	$array_kegiatan_skp = $this->skp_model->get_array_kegiatan(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
	
	// keberatan
	if (!empty($pejabat['K_PENILAI_PEGAWAI'])) {
		$keberatan = $this->skp_model->get_keberatan(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun, 'K_PENILAI_PEGAWAI' => $pejabat['K_PENILAI_PEGAWAI'] ));
	}
	
	// kreativitas & tugas tambahan
	$array_kreativitas = $this->skp_model->get_array_kreativitas_pegawai(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
	$array_tugas_tambahan = $this->skp_model->get_array_tugas_tambahan_pegawai(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
	
	// perilaku
	$array_perilaku = $this->skp_model->get_array_perilaku();
	$array_perilaku_pegawai = $this->skp_model->get_array_perilaku_pegawai(array( 'K_PEGAWAI' => $k_pegawai, 'TAHUN' => $tahun ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'SKP Realisasi' ) ); ?>

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
		
		<div class="cnt-grid-kegiatan">
			<h1>SKP REALISASI</h1>
			<?php if (count($array_kegiatan_skp) > 0) { ?>
				<div class="cnt_table_main"><table style="width: 1550px;">
					<tr>
						<td class="left" style="width: 100px;">&nbsp;</td>
						<td class="normal" style="width: 150px;">Kegiatan</td>
						<td class="normal" style="width: 100px;">AK Target</td>
						<td class="normal" style="width: 100px;">KUAN Target</td>
						<td class="normal" style="width: 100px;">KUAL Target</td>
						<td class="normal" style="width: 100px;">Waktu Target</td>
						<td class="normal" style="width: 100px;">Biaya Target</td>
						<td class="normal" style="width: 100px;">AK Real</td>
						<td class="normal" style="width: 100px;">KUAN Real</td>
						<td class="normal" style="width: 100px;">KUAL Real</td>
						<td class="normal" style="width: 100px;">Waktu Real</td>
						<td class="normal" style="width: 100px;">Biaya Real</td>
						<td class="normal" style="width: 100px;">Perhitungan</td>
						<td class="normal" style="width: 100px;">Nilai Capaian</td>
						<td class="normal" style="width: 100px;">Validasi</td></tr>
					<?php foreach ($array_kegiatan_skp as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete" data-action="delete_penilaian"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit" data-action="update_penilaian"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['KEGIATAN']; ?></td>
						<td class="body"><?php echo $row['AK_TARGET']; ?></td>
						<td class="body"><?php echo $row['KUAN_TARGET']; ?></td>
						<td class="body"><?php echo $row['KUAL_TARGET']; ?></td>
						<td class="body"><?php echo $row['WAKTU_TARGET']; ?></td>
						<td class="body"><?php echo $row['BIAYA_TARGET']; ?></td>
						<td class="body"><?php echo $row['AK_REAL']; ?></td>
						<td class="body"><?php echo $row['KUAN_REAL']; ?></td>
						<td class="body"><?php echo $row['KUAL_REAL']; ?></td>
						<td class="body"><?php echo $row['WAKTU_REAL']; ?></td>
						<td class="body"><?php echo $row['BIAYA_REAL']; ?></td>
						<td class="body"><?php echo $row['PERHITUNGAN']; ?></td>
						<td class="body"><?php echo $row['NILAI_CAPAIAN']; ?></td>
						<td class="body"><?php echo $row['VALID_TEXT']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<?php if (!empty($pejabat['link_print_capaian_kerja'])) { ?>
			<div class="btn-action">
				<input type="button" name="Keberatan" value="Keberatan" class="btn-keberatan" />
				<input type="button" name="Cetak" value="Cetak" style="float: right;" onclick="location.href='<?php echo $pejabat['link_print_capaian_kerja']; ?>'" />
			</div>
			<?php } ?>
		</div>
		
		<div class="cnt-grid-kreativitas">
			<h1>SKP KREATIVITAS</h1>
			<?php if (count($array_kreativitas) > 0) { ?>
				<div class="cnt_table_main"><table style="width: 550px;">
					<tr>
						<td class="left" style="width: 100px;">&nbsp;</td>
						<td class="normal" style="width: 350px;">Kegiatan</td>
						<td class="normal" style="width: 100px;">Nilai</td></tr>
					<?php foreach ($array_kreativitas as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['KEGIATAN']; ?></td>
						<td class="body"><?php echo $row['NILAI']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" value="Tambah" class="btn-kreativitas-new" />
			</div>
		</div>
		
		<div class="cnt-grid-tugas-tambahan">
			<h1>SKP TUGAS TAMBAHAN</h1>
			<?php if (count($array_tugas_tambahan) > 0) { ?>
				<div class="cnt_table_main"><table style="width: 550px;">
					<tr>
						<td class="left" style="width: 100px;">&nbsp;</td>
						<td class="normal" style="width: 350px;">Kegiatan</td>
						<td class="normal" style="width: 100px;">Nilai</td></tr>
					<?php foreach ($array_tugas_tambahan as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['KEGIATAN']; ?></td>
						<td class="body"><?php echo $row['NILAI']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" value="Tambah" class="btn-tugas-tambahan-new" />
			</div>
		</div>
		
		<div class="cnt-grid-perilaku">
			<h1>SKP PERILAKU KERJA</h1>
			<?php if (count($array_perilaku_pegawai) > 0) { ?>
				<div class="cnt_table_main"><table style="width: 550px;">
					<tr>
						<td class="left" style="width: 100px;">&nbsp;</td>
						<td class="normal" style="width: 350px;">Perilaku</td>
						<td class="normal" style="width: 100px;">Nilai</td></tr>
					<?php foreach ($array_perilaku_pegawai as $row) { ?>
					<tr>
						<td class="licon">
							<span class="record hidden"><?php echo json_encode($row); ?></span>
							<a class="btn-delete"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
							<a class="btn-edit"><img class="link" src="<?php echo HOST; ?>/images/Pencil.png" /></a>
						</td>
						<td class="body"><?php echo $row['PERILAKU']; ?></td>
						<td class="body"><?php echo $row['NILAI']; ?></td></tr>
					<?php } ?>
				</table></div>
			<?php } ?>
			
			<div class="btn-action">
				<input type="button" value="Tambah" class="btn-perilaku-new" />
			</div>
		</div>
		
		<div class="cnt-form-kegiatan hidden">
			<h1>FORM SKP REALISASI</h1>
			
			<form style="width: 80%;" id="form-kegiatan" action="<?php echo base_url('index.php/pegawai_modul/skp_penilaian/action'); ?>">
				<input type="hidden" name="action" />
				<input type="hidden" name="ID_NILAI_TUPOKSI" value="x" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Kegiatan</td>
						<td><textarea name="KEGIATAN" class="required" alt="Kegiatan kosong" style="width: 75%; height: 60px;"></textarea></td></tr>
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
		
		<div class="cnt-form-keberatan hidden">
			<h1>FORM KEBERATAN</h1>
			
			<form style="width: 80%;" id="form-keberatan" action="<?php echo base_url('index.php/pegawai_modul/skp_penilaian/action'); ?>">
				<input type="hidden" name="action" value="update_keberatan" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="K_PENILAI_PEGAWAI" value="<?php echo @$pejabat['K_PENILAI_PEGAWAI']; ?>" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Keberatan</td>
						<td><textarea name="KEBERATAN" class="required" alt="Keberatan kosong" style="width: 75%; height: 100px;"><?php echo @$keberatan['KEBERATAN']; ?></textarea></td></tr>
					<tr>
						<td colspan="2" style="padding: 10px 0;">
							<input type="button" class="btn-cancel" value="Batal" />
							<input type="submit" class="btn-submit" value="Save" />
						</td></tr>
				</table>
			</form>
		</div>
		
		<div class="cnt-form-kreativitas hidden">
			<h1>FORM SKP KREATIVITAS</h1>
			
			<form style="width: 80%;" id="form-kreativitas" action="<?php echo base_url('index.php/pegawai_modul/skp_penilaian/action'); ?>">
				<input type="hidden" name="action" value="update_kreativitas" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="ID_KREATIFITAS" value="x" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Kegiatan</td>
						<td><textarea name="KEGIATAN" class="required" alt="Kegiatan kosong" style="width: 75%; height: 60px;"></textarea></td></tr>
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
		
		<div class="cnt-form-tugas-tambahan hidden">
			<h1>FORM SKP TUGAS TAMBAHAN</h1>
			
			<form style="width: 80%;" id="form-tugas-tambahan" action="<?php echo base_url('index.php/pegawai_modul/skp_penilaian/action'); ?>">
				<input type="hidden" name="action" value="update_tugas_tambahan" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				<input type="hidden" name="ID_TUGAS_TAMBAHAN" value="x" />
				
				<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
					<tr>
						<td>Kegiatan</td>
						<td><textarea name="KEGIATAN" class="required" alt="Kegiatan kosong" style="width: 75%; height: 60px;"></textarea></td></tr>
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
		
		<div class="cnt-form-perilaku hidden">
			<h1>FORM SKP PERILAKU KERJA</h1>
			
			<form style="width: 80%;" id="form-perilaku" action="<?php echo base_url('index.php/pegawai_modul/skp_penilaian/action'); ?>">
				<input type="hidden" name="action" value="update_perilaku" />
				<input type="hidden" name="TAHUN" value="<?php echo $tahun; ?>" />
				<input type="hidden" name="K_PEGAWAI" value="<?php echo $k_pegawai; ?>" />
				
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
	InitForm.Start('form-kegiatan');
	
	var page = {
		init: function() {
			var raw = $('.cnt-page').text();
			eval('var data = ' + raw);
			page.data = data;
			
			Site.autocomplate({ action: 'pegawai' });
		},
		show_grid: function() {
			$('.cnt-grid-kegiatan').show();
			$('.cnt-grid-perilaku').show();
			$('.cnt-grid-kreativitas').show();
			$('.cnt-grid-tugas-tambahan').show();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-perilaku').hide();
			$('.cnt-form-keberatan').hide();
			$('.cnt-form-kreativitas').hide();
			$('.cnt-form-tugas-tambahan').hide();
			window.scrollTo(0,200);
		},
		show_form_kegiatan: function() {
			$('.cnt-grid-kegiatan').hide();
			$('.cnt-grid-perilaku').hide();
			$('.cnt-grid-kreativitas').hide();
			$('.cnt-grid-tugas-tambahan').hide();
			$('.cnt-form-kegiatan').show();
			$('.cnt-form-perilaku').hide();
			$('.cnt-form-keberatan').hide();
			$('.cnt-form-kreativitas').hide();
			$('.cnt-form-tugas-tambahan').hide();
		},
		show_form_keberatan: function() {
			$('.cnt-grid-kegiatan').hide();
			$('.cnt-grid-perilaku').hide();
			$('.cnt-grid-kreativitas').hide();
			$('.cnt-grid-tugas-tambahan').hide();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-perilaku').hide();
			$('.cnt-form-keberatan').show();
			$('.cnt-form-kreativitas').hide();
			$('.cnt-form-tugas-tambahan').hide();
		},
		show_form_kreativitas: function() {
			$('.cnt-grid-kegiatan').hide();
			$('.cnt-grid-perilaku').hide();
			$('.cnt-grid-kreativitas').hide();
			$('.cnt-grid-tugas-tambahan').hide();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-perilaku').hide();
			$('.cnt-form-keberatan').hide();
			$('.cnt-form-kreativitas').show();
			$('.cnt-form-tugas-tambahan').hide();
		},
		show_form_tugas_tambahan: function() {
			$('.cnt-grid-kegiatan').hide();
			$('.cnt-grid-perilaku').hide();
			$('.cnt-grid-kreativitas').hide();
			$('.cnt-grid-tugas-tambahan').hide();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-perilaku').hide();
			$('.cnt-form-keberatan').hide();
			$('.cnt-form-kreativitas').hide();
			$('.cnt-form-tugas-tambahan').show();
		},
		show_form_perilaku: function() {
			$('.cnt-grid-kegiatan').hide();
			$('.cnt-grid-perilaku').hide();
			$('.cnt-grid-kreativitas').hide();
			$('.cnt-grid-tugas-tambahan').hide();
			$('.cnt-form-kegiatan').hide();
			$('.cnt-form-perilaku').show();
			$('.cnt-form-keberatan').hide();
			$('.cnt-form-kreativitas').hide();
			$('.cnt-form-tugas-tambahan').hide();
		}
	}
	
	/* Form Kegiatan */
	
	$('.cnt-grid-kegiatan .btn-edit').click(function() {
		page.show_form_kegiatan();
		
		// set action
		var action = $(this).attr('data-action');
		$('.cnt-form-kegiatan [name="action"]').val(action);
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-kegiatan [name="ID_NILAI_TUPOKSI"]').val((record.ID_NILAI_TUPOKSI == null) ? 'x' : record.ID_NILAI_TUPOKSI);
		$('.cnt-form-kegiatan [name="K_PEGAWAI"]').val(page.data.k_pegawai);
		$('.cnt-form-kegiatan [name="TAHUN"]').val(record.TAHUN);
		$('.cnt-form-kegiatan [name="K_JENIS_SKP"]').val(record.K_JENIS_SKP);
		$('.cnt-form-kegiatan [name="KEGIATAN"]').val(record.KEGIATAN);
		$('.cnt-form-kegiatan [name="AK_TARGET"]').val(record.AK_TARGET);
		$('.cnt-form-kegiatan [name="KUAN_TARGET"]').val(record.KUAN_TARGET);
		$('.cnt-form-kegiatan [name="KUAL_TARGET"]').val(record.KUAL_TARGET);
		$('.cnt-form-kegiatan [name="WAKTU_TARGET"]').val(record.WAKTU_TARGET);
		$('.cnt-form-kegiatan [name="BIAYA_TARGET"]').val(record.BIAYA_TARGET);
		$('.cnt-form-kegiatan [name="AK_REAL"]').val(record.AK_REAL);
		$('.cnt-form-kegiatan [name="KUAN_REAL"]').val(record.KUAN_REAL);
		$('.cnt-form-kegiatan [name="KUAL_REAL"]').val(record.KUAL_REAL);
		$('.cnt-form-kegiatan [name="WAKTU_REAL"]').val(record.WAKTU_REAL);
		$('.cnt-form-kegiatan [name="BIAYA_REAL"]').val(record.BIAYA_REAL);
		
		if (record.IS_VALID == 1) {
			$('.cnt-form-kegiatan .btn-submit').hide();
		} else {
			$('.cnt-form-kegiatan .btn-submit').show();
		}
	});
	$('.cnt-grid-kegiatan .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		record.action = $(this).attr('data-action');
		Func.rec_delete({ action: $('.cnt-form-kegiatan form').attr('action'), param: record });
	});
	$('.cnt-form-kegiatan .btn-cancel').click(function() {
		page.show_grid();
	});
	$('.cnt-form-kegiatan form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form-kegiatan form');
		var ArrayError = InitForm.Validation('form-kegiatan');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-kegiatan');
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Form Kegiatan */
	
	/* Form Keberatan */
	
	$('.cnt-grid-kegiatan .btn-keberatan').click(function() {
		page.show_form_keberatan();
	});
	$('.cnt-form-keberatan .btn-cancel').click(function() {
		page.show_grid();
	});
	$('.cnt-form-keberatan form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form-keberatan form');
		var ArrayError = InitForm.Validation('form-keberatan');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-keberatan');
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Form Keberatan */
	
	/* Form Kreativitas */
	
	$('.btn-kreativitas-new').click(function() {
		page.show_form_kreativitas();
		
		// reset form
		$('.cnt-form-kreativitas form')[0].reset();
		$('.cnt-form-kreativitas [name="ID_KREATIFITAS"]').val('x');
	});
	$('.cnt-grid-kreativitas .btn-edit').click(function() {
		page.show_form_kreativitas();
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-kreativitas [name="ID_KREATIFITAS"]').val(record.ID_KREATIFITAS);
		$('.cnt-form-kreativitas [name="KEGIATAN"]').val(record.KEGIATAN);
		$('.cnt-form-kreativitas [name="NILAI"]').val(record.NILAI);
	});
	$('.cnt-grid-kreativitas .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		record.action = 'delete_kreativitas';
		Func.rec_delete({ action: $('.cnt-form-kreativitas form').attr('action'), param: record });
	});
	$('.cnt-form-kreativitas .btn-cancel').click(function() {
		page.show_grid();
	});
	$('.cnt-form-kreativitas form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form-kreativitas form');
		var ArrayError = InitForm.Validation('form-kreativitas');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-kreativitas');
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Form Kreativitas */
	
	/* Form Tugas Tambahan */
	
	$('.btn-tugas-tambahan-new').click(function() {
		page.show_form_tugas_tambahan();
		
		// reset form
		$('.cnt-form-tugas-tambahan form')[0].reset();
		$('.cnt-form-tugas-tambahan [name="ID_TUGAS_TAMBAHAN"]').val('x');
	});
	$('.cnt-grid-tugas-tambahan .btn-edit').click(function() {
		page.show_form_tugas_tambahan();
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-tugas-tambahan [name="ID_TUGAS_TAMBAHAN"]').val(record.ID_TUGAS_TAMBAHAN);
		$('.cnt-form-tugas-tambahan [name="KEGIATAN"]').val(record.KEGIATAN);
		$('.cnt-form-tugas-tambahan [name="NILAI"]').val(record.NILAI);
	});
	$('.cnt-grid-tugas-tambahan .btn-delete').click(function() {
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		record.action = 'delete_tugas_tambahan';
		Func.rec_delete({ action: $('.cnt-form-tugas-tambahan form').attr('action'), param: record });
	});
	$('.cnt-form-tugas-tambahan .btn-cancel').click(function() {
		page.show_grid();
	});
	$('.cnt-form-tugas-tambahan form').submit(function(event) {
		event.preventDefault();
		
		var form = $('.cnt-form-tugas-tambahan form');
		var ArrayError = InitForm.Validation('form-tugas-tambahan');
		
		// validation
		if (ArrayError.length > 0) {
			return ShowWarning(ArrayError);
		}
		
		// submit
		var param = Site.Form.GetValue('form-tugas-tambahan');
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Form Tugas Tambahan */
	
	/* Form Perilaku */
	
	$('.btn-perilaku-new').click(function() {
		page.show_form_perilaku();
		
		// reset form
		$('.cnt-form-perilaku form')[0].reset();
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
		record.action = 'delete_perilaku';
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
	
	/* End Form Perilaku */
	
	page.init();
})();
</script>
	
</div></div>
</body>
</html>