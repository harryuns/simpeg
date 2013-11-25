<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <div id="body">
        <div id="frame">
            <div id="sidebar"><div class="glossymenu"><?php include 'main_menu.php'; ?></div></div>
            
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <div id="CntLaporan">
                        <h1 style="padding: 0 0 10px 0;">Laporan Kepegawaian</h1>
                        
                        <form method="post">
                        <div style="font-weight: 700; margin: 0 0 10px 0;">Silahkan memilih laporan berikut :</div>
                        <div style="float: left; width: 200px; padding: 0 0 10px 0;">Jenis Laporan</div>
                        <div style="float: left; width: 350px;"><select name="JenisLaporan" style="width: 300px;"><?php echo GetOption(false, $ArrayJenisLaporan, ''); ?></select></div>
                        <div class="clear"></div>
                        <div style="float: left; width: 200px; padding: 0 0 10px 0;">Nama Laporan</div>
                        <div style="float: left; width: 350px;"><select name="NamaLaporan" style="width: 300px;"><?php echo GetOption(false, $ArrayNamaLaporan, ''); ?></select></div>
                        <div class="clear"></div>
                        <div id="CntReportFilter"></div>
                        <div style="float: left; width: 200px; padding: 0 0 10px 0;">&nbsp;</div>
                        <div style="float: left; width: 350px;"><input style="width: 100px;" type="button" name="Submit" value="Lihat Report" /></div>
                        <div class="clear"></div>
                        </form>
                        <script type="text/javascript">InitLaporan();</script>
                        
                        <div id="ReportResult">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<?php $this->load->view('common/form_unit_kerja'); ?>
</body>
</html>