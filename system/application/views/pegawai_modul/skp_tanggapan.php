<?php
	$k_pegawai = get_link_pegawai(@$this->uri->segments[4]);
	$tahun = (empty($this->uri->segments[5])) ? date("Y") : $this->uri->segments[5];
	$page = array( 'k_pegawai' => $k_pegawai, 'tahun' => $tahun );
	
	$message = get_flash_message();
	$array_pegawai = $this->skp_model->get_group_validasi(array( 'K_PEJABAT' => $k_pegawai, 'TAHUN' => $tahun ));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Tanggapan SKP' ) ); ?>

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
		
		<?php $this->load->view('pegawai_modul/skp_filter', array( 'tahun' => $tahun )); ?>
		
		<?php foreach ($array_pegawai as $nip => $data) { ?>
		<div class="cnt-grid-validasi">
			<h1>Tanggapan SKP : <?php echo $data['nama_pegawai']; ?></h1>
			<div class="cnt_table_main"><table>
				<tr>
					<td class="left">&nbsp;</td>
					<td class="normal">Kegiatan</td>
					<td class="normal">AK Target</td>
					<td class="normal">KUAN Target</td>
					<td class="normal">KUAL Target</td>
					<td class="normal">Waktu Target</td>
					<td class="normal">Biaya Target</td>
					<td class="normal">AK Real</td>
					<td class="normal">KUAN Real</td>
					<td class="normal">KUAL Real</td>
					<td class="normal">Waktu Real</td>
					<td class="normal">Biaya Real</td>
					<td class="normal">Perhitungan</td>
					<td class="normal">Nilai Capaian</td>
					<td class="normal">Validasi</td></tr>
				<?php foreach ($data['array_kegiatan'] as $row) { ?>
				<tr>
					<td class="licon">
						<span class="record hidden"><?php echo json_encode($row); ?></span>
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
			
			<?php if (isset($data['keberatan']) && !empty($data['keberatan']['KEBERATAN'])) { ?>
			<div style="padding: 10px 0;">
				<div style="padding: 0 0 10px 0;">
					<div style="font-weight: bold;">Keberatan :</div>
					<div><?php echo $data['keberatan']['KEBERATAN']; ?></div>
				</div>
				
				<?php if (isset($data['keputusan']) && !empty($data['keputusan']['KEPUTUSAN'])) { ?>
				<div style="padding: 0 0 10px 0;">
					<div style="font-weight: bold;">Keputusan :</div>
					<div><?php echo $data['keputusan']['KEPUTUSAN']; ?></div>
				</div>
				
				<div style="padding: 0 0 10px 0;" class="cnt-tanggapan">
					<input type="hidden" name="K_PEGAWAI" value="<?php echo $data['k_pegawai']; ?>" />
					<input type="hidden" name="K_PENILAI_PEGAWAI" value="<?php echo $data['keputusan']['K_PENILAI_PEGAWAI']; ?>" />
					
					<div style="font-weight: bold; padding: 0 0 5px 0;">Tanggapan :</div>
					<div class="cnt-tanggapan-view hidden">
						<span><?php echo $data['tanggapan']['TANGGAPAN']; ?></span>
						<a class="btn-tanggapan-show-entry cursor">Ubah</a>
					</div>
					<div class="cnt-tanggapan-entry hidden">
						<div style="float: left; width: 525px;">
							<textarea name="TANGGAPAN" style="width: 500px; height: 65px;"><?php echo $data['tanggapan']['TANGGAPAN']; ?></textarea>
						</div>
						<div style="float: left; width: 150px;">
							<input type="button" class="btn-tanggapan-submit" value="Submit" />
							<input type="button" class="btn-tanggapan-cancel" value="Batal" />
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
		
		<div class="cnt-form-kegiatan hidden">
			<h1>Form Tanggapan SKP</h1>
			
			<form style="width: 80%;" id="form-kegiatan" action="<?php echo base_url('index.php/pegawai_modul/skp_tanggapan/action'); ?>">
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
			
			// tanggapan
			for (var i = 0; i < $('.cnt-tanggapan').length; i++) {
				var value = $('.cnt-tanggapan').eq(i).find('[name="TANGGAPAN"]').val();
				if (value.length == 0) {
					$('.cnt-tanggapan').eq(i).find('.cnt-tanggapan-entry').show();
				} else {
					$('.cnt-tanggapan').eq(i).find('.cnt-tanggapan-view').show();
				}
			}
		},
		show_grid: function() {
			$('.cnt-grid-validasi').show();
			$('.cnt-form-kegiatan').hide();
			window.scrollTo(0,200);
		},
		show_form_kegiatan: function() {
			$('.cnt-grid-validasi').hide();
			$('.cnt-form-kegiatan').show();
		},
		show_form_penilai: function() {
			$('.cnt-grid-validasi').hide();
			$('.cnt-form-kegiatan').hide();
		}
	}
	
	/* Form Kegiatan */
	
	$('.cnt-grid-validasi .btn-edit').click(function() {
		page.show_form_kegiatan();
		
		// populate form
		var raw = $(this).parents('tr').find('.record').html();
		eval('var record = ' + raw);
		
		$('.cnt-form-kegiatan [name="ID_NILAI_TUPOKSI"]').val(record.ID_NILAI_TUPOKSI);
		$('.cnt-form-kegiatan [name="K_PEGAWAI"]').val(record.K_PEGAWAI);
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
	});
	$('.cnt-form-kegiatan .btn-cancel').click(function() {
		page.show_grid();
	});
	
	/* End Form Kegiatan */
	
	/* Komentar */
	
	$('.btn-tanggapan-show-entry').click(function() {
		$(this).parents('.cnt-tanggapan').find('.cnt-tanggapan-view').hide();
		$(this).parents('.cnt-tanggapan').find('.cnt-tanggapan-entry').show();
	});
	$('.btn-tanggapan-cancel').click(function() {
		$(this).parents('.cnt-tanggapan').find('.cnt-tanggapan-view').show();
		$(this).parents('.cnt-tanggapan').find('.cnt-tanggapan-entry').hide();
	});
	$('.btn-tanggapan-submit').click(function() {
		var form = $('.cnt-form-kegiatan form');
		
		// ajax param
		var param = {
			action: 'update_tanggapan',
			K_PEGAWAI: $(this).parents('.cnt-tanggapan').find('[name="K_PEGAWAI"]').val(),
			K_PENILAI_PEGAWAI: $(this).parents('.cnt-tanggapan').find('[name="K_PENILAI_PEGAWAI"]').val(),
			TAHUN: page.data.tahun,
			TANGGAPAN: $(this).parents('.cnt-tanggapan').find('[name="TANGGAPAN"]').val()
		}
		
		// ajax request
		Func.ajax({ url: form.attr('action'), param: param, callback: function(result) {
			if (result.status) {
				window.location = window.location.href
			} else {
				ShowDialogObject({ ArrayMessage: [result.message] });
			}
		} });
	});
	
	/* End Komentar */
	
	page.init();
})();
</script>
	
</div></div>
</body>
</html>