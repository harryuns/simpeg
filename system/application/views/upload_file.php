<?php
//	print_r($ResultUpload); exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('body_meta', array( 'page_title' => 'Upload File', 'notify_status' => false ) ); ?>
<body style="background: none; margin: 0px; padding: 0px;">
	<style>
#table-upload { font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; width:100%; border-collapse:collapse; }
#table-upload td, #table-upload th { font-size:1.2em; border:1px solid #98bf21; padding:3px 7px 2px 7px; }
#table-upload th { font-size:1.4em; text-align:left; padding-top:5px; padding-bottom:4px; background-color:#A7C942; color:#fff; }
#table-upload tr.alt td { color:#000; background-color:#EAF2D3; }
	</style>
	
	<div id="ResultUpload" class="hidden">
		<?php echo json_encode($ResultUpload); ?>
	</div>
	
	<div style="padding: 0 0 20px 0; margin: 0 auto;">
		<input type="hidden" name="FormName" value="<?php echo $ArrayParam['FormName']; ?>" />
		<table id="table-upload" style="width: 100%;">
			<tr>
				<td style="width: 80%; text-align: center;">Nama File</td>
				<td style="width: 20%; text-align: center;">Aksi</td></tr>
				<?php foreach ($ArrayFile as $Key => $Array) { ?>
					<?php $JsonArray = json_encode($Array); ?>
						<tr>
							<td><a href="<?php echo $Array['LinkFile']; ?>" target="_blank"><?php echo $Array['NameFile']; ?></a></td>
							<td style="text-align: center;"><span class="DelFile cursor">Hapus<span class="hidden"><?php echo $JsonArray; ?></span></span></td></tr>
				<?php } ?>
		</table>
	</div>
	
	<div style="padding: 10px;">
		<form method="post" enctype="multipart/form-data">
			<div style="float: left; width: 150px; padding: 0 0 15px 0;">Upload File</div>
			<div style="float: left; width: 250px;"><input type="file" name="Image"></div>
			<div class="clear"></div>
			<?php if ($ArrayParam['FormName'] == 'RiwayatPendidikan') { ?>
				<div style="float: left; width: 150px; padding: 0 0 15px 0;">Ijazah</div>
				<div style="float: left; width: 250px;"><input type="checkbox" name="IS_IJAZAH" value="1" /></div>
				<div class="clear"></div>
			<?php } ?>
			<div style="float: left; width: 150px;">&nbsp;</div>
			<div style="float: left; width: 250px;"><input type="submit" name="Upload" value="Upload" style="width: 100px;" /></div>
			<div class="clear"></div>
		</form>
	</div>
	
	<script type="text/javascript">
		var RawResultUpload = $.trim($('#ResultUpload').html());
		if (RawResultUpload.length > 0) {
			eval('var ResultUpload = ' + RawResultUpload);
			
			if (ResultUpload.MSG != null)
				ShowDialogObject({ ArrayMessage: [ResultUpload.MSG] });
		}
		
		$('.DelFile').click(function() {
			var RawRecord = $(this).children('span').html();
			eval('var Param = ' + RawRecord);
			Param.FormName = $('input[name="FormName"]').val();
			
			$.ajax({ type: "POST", url: Web.HOST + '/index.php/UploadFile/Delete', data: Param,
				success: function(RawResult) {
					eval('var Result = ' + RawResult);
					
					var CallBack = (Result.ERROR == '00000') ? function() { window.location = window.location.href; } : null;
					ShowDialogObject({ ArrayMessage: [Result.MSG], OnClose: CallBack });
				}
			});
		});
	</script>
</body>
</html>