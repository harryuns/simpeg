<?php
	ini_set('memory_limit','124M');
	$param_luaran['k_publikasi'] = 4;
	$array_luaran = $this->dosen_luaran_model->get_array($param_luaran);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Simpeg</title>
	<link href="<?php echo HOST; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<!--[if IE 8]><link href="<?php echo HOST; ?>/assets/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
	
	<script type="text/javascript" src="<?php echo HOST; ?>/assets/js/jquery.1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo HOST; ?>/assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo HOST; ?>/assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo HOST; ?>/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo HOST; ?>/assets/js/ext.common.js"></script>
	<script type="text/javascript">var web = <?php echo json_encode(array( 'host' => HOST )); ?>;</script>
	<style>
		.cursor { cursor: pointer; }
		.detail-view { display: none; }
	</style>
</head>

<body style="padding: 10px 0 0 0;">
<div id="container" style="min-width: 450px;">
	<div id="content">
		<div class="wrapper">
			<div class="widget grid-view">
				<div class="table-overflow">
					<table class="table table-striped table-bordered" id="data-table">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Jenis Publikasi</th>
								<th>Judul</th>
								<th>Penerbit</th>
								<th>No Volume</th>
								<th>Edisi</th>
								<th>ISSN</th>
								<th>Halaman</th>
								<th>Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($array_luaran as $key => $row) { ?>
							<tr>
								<td><?php echo $row['NAMA']; ?></td>
								<td><?php echo $row['JENIS_PUBLIKASI']; ?></td>
								<td><?php echo get_length_char(strip_tags($row['JUDUL']), 100, ' ...'); ?></td>
								<td><?php echo $row['PENERBIT']; ?></td>
								<td><?php echo $row['NO_VOLUME']; ?></td>
								<td><?php echo $row['EDISI']; ?></td>
								<td><?php echo $row['ISSN']; ?></td>
								<td><?php echo $row['HALAMAN']; ?></td>
								<td class="align-center">
									<ul class="table-controls"><li>
										<a class="btn tip cursor" title="View Detail"><i class="icon-plus"></i></a>
									</li></ul>
									
									<span class="hide"><?php echo json_encode($row); ?></span>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="detail-view">
				<div class="widget">
					<div class="navbar"><div class="navbar-inner"><h6>Biodata</h6></div></div>
					<div class="table-overflow">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>Nama</td>
									<td class="record-NAMA">&nbsp;</td></tr>
								<tr>
									<td>Jenis Publikasi</td>
									<td class="record-JENIS_PUBLIKASI">&nbsp;</td></tr>
								<tr>
									<td>Judul</td>
									<td class="record-JUDUL">&nbsp;</td></tr>
								<tr>
									<td>Penerbit</td>
									<td class="record-PENERBIT">&nbsp;</td></tr>
								<tr>
									<td>No Volume</td>
									<td class="record-NO_VOLUME">&nbsp;</td></tr>
								<tr>
									<td>Edisi</td>
									<td class="record-EDISI">&nbsp;</td></tr>
								<tr>
									<td>ISSN</td>
									<td class="record-ISSN">&nbsp;</td></tr>
								<tr>
									<td>Halaman</td>
									<td class="record-HALAMAN">&nbsp;</td></tr>
								<tr>
									<td>Abstrak</td>
									<td class="record-ABSTRAKSI">&nbsp;</td></tr>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="form-actions" style="text-align: center;">
					<button type="button" class="btn btn-danger">Kembali</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	$('.tip').tooltip();
	$('.focustip').tooltip({'trigger':'focus'});
	
	oTable = $('#data-table').dataTable({
		"bJQueryUI": false, "bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		}
    });
	oTable.$('tr').find('.table-controls a').on('click', function () {
		var raw_record = $(this).parents('.table-controls').next('span').text();
		eval('var record = ' + raw_record);
		
		$('.detail-view .record-NAMA').text(record.NAMA);
		$('.detail-view .record-JENIS_PUBLIKASI').text(record.JENIS_PUBLIKASI);
		$('.detail-view .record-JUDUL').text(record.JUDUL);
		$('.detail-view .record-PENERBIT').text(record.PENERBIT);
		$('.detail-view .record-NO_VOLUME').text(record.NO_VOLUME);
		$('.detail-view .record-EDISI').text(record.EDISI);
		$('.detail-view .record-ISSN').text(record.ISSN);
		$('.detail-view .record-HALAMAN').text(record.HALAMAN);
		$('.detail-view .record-ABSTRAKSI').text(record.ABSTRAKSI);
		
		$('.grid-view').hide();
		$('.detail-view').show();
    } );
	$('.form-actions .btn-danger').click(function() {
		$('.detail-view').hide();
		$('.grid-view').show();
	});
});
</script>
</body>
</html>