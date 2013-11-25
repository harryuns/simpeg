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
                        <h1 style="padding: 0 0 10px 0;"><?php echo $Page['PageTitle']; ?></h1>
                        
                        <form method="post">
                            <input type="hidden" name="NamaLaporan" value="LaporanEkdAssessorActivity" />
                            <input type="hidden" name="PageActive" value="1" />
                            <div style="float: left; width: 200px; padding: 0 0 10px 0;">Fakultas</div>
                            <div style="float: left; width: 350px;"><select name="K_FAKULTAS" style="width: 300px;"><?php echo GetOption(false, $ArrayFakultas, 'x'); ?></select></div>
                            <div class="clear"></div>
                            <div style="float: left; width: 200px; padding: 0 0 10px 0;">Tahun</div>
                            <div style="float: left; width: 350px;"><select name="TAHUN" style="width: 300px;"><?php echo GetOption(false, $ArrayTahun, date("Y") - 1); ?></select></div>
                            <div class="clear"></div>
                            <div id="CntReportFilter"></div>
                            <div style="float: left; width: 200px; padding: 0 0 10px 0;">&nbsp;</div>
                            <div style="float: left; width: 350px;"><input style="width: 100px;" type="button" name="Submit" value="Lihat Report" /></div>
                            <div class="clear"></div>
                        </form>
                        <script type="text/javascript">InitLaporanEkd();</script>
                        
                        <div id="ReportResult" style="padding: 15px 0 0 0;">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>