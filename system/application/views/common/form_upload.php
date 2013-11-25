<?php
	// how to use ?
	// html code : <iframe name="iframe_thumbnail" src="..."></iframe>
	// js code : $('#WinLetter .btn-upload').click(function() { window.iframe_name.browse() });
	// js code : upload_letter = function(p) { console.log(p); }
	
	$filetype = (!empty($_GET['filetype'])) ? $_GET['filetype'] : '';
	$callback_name = (!empty($_GET['callback_name'])) ? $_GET['callback_name'] : 'upload_document';
	$upload_result = upload_simpeg('document', $this->config->item('base_path') . '/images/_Temp');
	
	$upload = array( 'file_name' => '', 'file_link' => '', 'message' => '' );
	$file_name = $file_link = $message = '';
	if ($upload_result['Result'] == 1) {
		$upload['file_name'] = $upload_result['FileDirName'];
		$upload['file_link'] = base_url('static/upload/'.$file_name);
	} else {
		$upload['message'] = @$upload_result['Message'];
	}
	
	// set callback
	$callback_exec = (strlen($upload['file_name']) > 0 || strlen($upload['message']) > 0) ? 1 : 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<script src="<?php echo base_url(); ?>JavaScript/jquery-1.4.2.min.js"></script>
	<script type="text/javascript">
		var func_callback = window.parent.<?php echo $callback_name; ?>;
	</script>
</head>
<body>
	<form method="post" enctype="multipart/form-data" id="form-upload">
		<input type="hidden" name="callback_exec" value="<?php echo $callback_exec; ?>">
		<div style="display: none;"><div class="cnt-upload"><?php echo json_encode($upload); ?></div></div>
		
		<input type="file" name="document" size="50" />
		<input type="submit" name="Submit" value="Upload File" />
	</form>
	<script type="text/javascript">
		// it will call by parent window
		var browse = function() { $('[name="document"]').click(); }
		$('[name="document"]').change(function() { $('#form-upload').submit(); });
		
		var callback_exec = $('[name="callback_exec"]').val();
		if (callback_exec == 1) {
			var raw = $('.cnt-upload').text();
			eval('var upload = ' + raw);
			
			if (func_callback != null) { 
				func_callback(upload);
			}
		}
	</script>
</body>
</html>