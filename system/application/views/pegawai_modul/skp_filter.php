<?php
	$tahun = (empty($tahun)) ? date("Y") : $tahun;
	
	$array_tahun = array(
		array( 'id' => '2013', 'title' => '2013' ),
		array( 'id' => '2014', 'title' => '2014' )
	);
?>
<div class="cnt-filter">
	<div style="float: left; width: 80px;">Tahun :</div>
	<div><select name="TAHUN" style="width: 75px;">
		<?php echo ShowOption(array( 'Array' => $array_tahun, 'Selected' => $tahun )); ?>
	</select></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('select[name="TAHUN"]').change(function() {
		var tahun = $('select[name="TAHUN"]').val();
		var link = window.location.href;
		var link_base = link.replace(new RegExp('\/[0-9]{4}$', 'gi'), '');
		link_base += '/' + tahun;
		window.location = link_base;
	});
});
</script>