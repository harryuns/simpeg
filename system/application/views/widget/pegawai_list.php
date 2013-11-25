<?php
	// param url
	$param_pegawai['K_JENIS_KERJA'] = (isset($_REQUEST['K_JENIS_KERJA'])) ? $_REQUEST['K_JENIS_KERJA'] : '01';
	$param_pegawai['K_UNIT_KERJA'] = (isset($_REQUEST['K_UNIT_KERJA'])) ? $_REQUEST['K_UNIT_KERJA'] : '14';
	
	// param fix
	$param_pegawai['SORTING'] = 2;
	$param_pegawai['PencarianDetail'] = 0;
	$param_pegawai['PageOffset'] = 1000000;
	$array_pegawai = $this->lpegawai->GetArrayPegawai($param_pegawai);
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
<div id="container">
	<div id="content">
		<div class="wrapper">
			<div class="widget grid-view">
				<div class="table-overflow">
					<table class="table table-striped table-bordered" id="data-table">
						<thead>
							<tr>
								<th>Nama Pegawai</th>
<!--
								<th>NIP</th>
								<th>Unit Kerja</th>
								<th>Jenjang</th>
-->
								<th>Jurusan</th>
								<th>Prodi</th>
								<th>Golongan</th>
								<th>Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($array_pegawai['Pegawai'] as $key => $pegawai) { ?>
							<tr>
								<td><?php echo $pegawai['NAMA_LENGKAP']; ?></td>
<!--
								<td><?php echo $pegawai['K_PEGAWAI']; ?></td>
								<td><?php echo $pegawai['UNIT_KERJA']; ?></td>
								<td><?php echo $pegawai['JENJANG']; ?></td>
-->
								<td><?php echo $pegawai['JURUSAN']; ?></td>
								<td><?php echo $pegawai['PRODI']; ?></td>
								<td><?php echo $pegawai['GOL']; ?></td>
								<td class="align-center"><ul class="table-controls"><li><a class="btn tip cursor" title="View Detail" data-k_pegawai="<?php echo $pegawai['K_PEGAWAI']; ?>"><i class="icon-plus"></i></a></li></ul></td></tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="detail-view"></div>
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
		Func.Ajax({
			is_json: false, url: web.host + '/index.php/Ajax/Pegawai',
			param: { Action: 'GetWidgetDetail', RequestReport: 1, K_PEGAWAI: $(this).attr('data-k_pegawai') },
			callback: function(content) {
				// render html
				$('.detail-view').html(content);
				$('.data-table-detail').dataTable({
					"bJQueryUI": false, "bAutoWidth": false,
					"sPaginationType": "full_numbers", "iDisplayLength": 10,
					"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
					"oLanguage": {
						"sSearch": "<span>Filter records:</span> _INPUT_",
						"sLengthMenu": "<span>Show entries:</span> _MENU_",
						"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
					}
				});
				
				$('.grid-view').hide();
				$('.detail-view').show();
				
				// init callback
				$('.accordion .navbar').click(function() {
					var cnt = $(this).next();
					
					if (cnt.css('display') == 'none') {
						for (var i = 0; i < $('.accordion .table-overflow').length; i++) {
							if ($('.accordion .table-overflow').eq(i).css('display') == 'block') {
								$('.accordion .table-overflow').eq(i).slideUp('slow');
							}
						}
						
						cnt.slideDown('slow');
					} else {
						cnt.slideUp('slow');
					}
				});
				$('.form-actions .btn-danger').click(function() {
					$('.detail-view').hide();
					$('.grid-view').show();
				});
			}
		});
    } );
});
</script>
</body>
</html>