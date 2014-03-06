<?php
	$action = (isset($_POST['action'])) ? $_POST['action'] : '';
	$action_delete = ($action == 'get_upload_valid') ? 'delete_upload_valid' : 'delete_upload_request';
	$action_validate = ($action == 'get_upload_valid') ? 'validate_upload_valid' : 'validate_upload_request';
	$is_request = ($action == 'get_upload_valid') ? false : true;
?>

<?php if (count($array) > 0) { ?>
	<div class="cnt_table_main"><table style="width: 100%; display: table;">
		<tr>
			<td class="left" style="width: 10%;">&nbsp;</td>
			<?php if ($is_request) { ?>
			<td class="normal" style="width: 15%;">Jenis Request</td>
			<?php } ?>
			<td class="normal" style="width: 30%;">No Sertifikat</td>
			<td class="normal" style="width: 45%;">Nama File</td></tr>
		<?php foreach ($array as $row) { ?>
		<tr>
			<td class="licon">
				<span class="record hidden"><?php echo json_encode($row); ?></span>
				<a class="btn-delete-upload" data-action="<?php echo $action_delete; ?>"><img class="link" src="<?php echo HOST; ?>/images/Delete.png" /></a>
				<?php if ($action == 'get_upload_request' && false) { ?>
				<a class="btn-validate-upload" data-action="<?php echo $action_validate; ?>"><img class="link" src="<?php echo HOST; ?>/images/tick.png" /></a>
				<?php } ?>
			</td>
			<?php if ($is_request) { ?>
			<td class="body"><?php echo show_jenis_request(@$row['JENIS_REQ_SERTIFIKASI_FILE']); ?></td>
			<?php } ?>
			<td class="body"><?php echo $row['NO_SERTIFIKAT']; ?></td>
			<td class="body"><a href="<?php echo $row['link_file']; ?>" target="_blank"><?php echo $row['name_file']; ?></a></td></tr>
		<?php } ?>
	</table></div>
<?php } ?>