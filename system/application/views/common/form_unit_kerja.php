<div class="hidden" id="form-unit-kerja"></div>

<script>
$(document).ready(function() {
	pde_param = {
		init: function(p) {
			for (var i = 0; i < $('.auto_show_unitkerja').length; i++) {
				$('.auto_show_unitkerja').eq(i).click(function() {
					pde_param.target = $(this).attr('data-target');
					pde_param.exec({});
				});
				$('.auto_show_unitkerja').eq(i).removeClass('auto_show_unitkerja');
			}
		},
		exec: function(p) {
			var ajax_param = {};
			ajax_param.Action = 'GetPopupUnitKerja';
			
			if ($('[name="IS_FAKULTAS"]').length == 1)
				ajax_param.IS_FAKULTAS = $('[name="IS_FAKULTAS"]').val();
			if ($('[name="K_PARENT"]').length == 1)
				ajax_param.K_PARENT = $('[name="K_PARENT"]').val();
			
			$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/UnitKerja", data: ajax_param,
				success: function(content) {
					// prepare tree
					$('#form-unit-kerja').html(content);
					pde.init();
					
					// show dialog
					$('#form-unit-kerja').dialog({ title: 'Form Unit Kerja', width: 800 });
					
					// add event
					$('.pde .select').click(function() {
						var raw_record = $(this).attr('data-row');
						eval('var record = ' + raw_record);
						$(pde_param.target).val(record.CONTENT);
						$(pde_param.target).prev().val(record.K_UNIT_KERJA);
						$('#form-unit-kerja').dialog('close');
						
						// init callback
						$(pde_param.target).prev().attr('data-record', raw_record);
						var data_change = $(pde_param.target).prev().attr('data-change');
						if (data_change == 1) {
							$(pde_param.target).prev().change();
						}
					});
				}
			});
		}
	};
	setInterval(pde_param.init, 1000);
	
	$('.show_unitkerja').click(function() {
		pde_param.target = $(this).attr('data-target');
		pde_param.exec({});
	});
});
</script>