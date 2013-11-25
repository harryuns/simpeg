<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <div id="body">
        <div id="frame">
            <div id="sidebar">
				<div class="glossymenu"><?php include 'main_menu.php'; ?></div>
				<div class="glossymenu" style="padding: 50px 0 0 0;"><?php include 'main_sub_menu.php'; ?></div>
			</div>
            
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <div id="CntLaporan">
                        <h1 style="padding: 0 0 10px 0;">Curriculum Vitae</h1>
                        
                        <form method="post">
                        <div style="font-weight: 700; margin: 0 0 10px 0;">Silahkan memilih curriculum vitae dalam format berikut :</div>
						<?php foreach ($ArrayLink as $Key => $Array) { ?>
							<div style="padding: 0 0 10px 0;">- <a href="<?php echo $Array['Link']; ?>" target="_blank"><?php echo $Array['Title']; ?></a></div>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>