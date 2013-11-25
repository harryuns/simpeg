<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <div id="body">
        <div id="frame">
            <div id="sidebar"><div class="glossymenu"><?php include 'main_menu.php'; ?></div>
				<?php if (isset($Pegawai) && is_array($Pegawai) && $Pegawai['IsNewPegawai'] == '0') { ?>
					<div class="glossymenu" style="padding: 50px 0 0 0;"><?php include 'main_sub_menu.php'; ?></div>
				<?php } ?>
			</div>
            
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <h1><a href="<?php echo HOST.'/Document/Panduan.pdf'; ?>">Download Panduan Simpeg</a></h1>
                    <h1><a href="<?php echo HOST.'/Document/Panduan Asesor.pdf'; ?>">Download Panduan Asesor</a></h1>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</body>
</html>