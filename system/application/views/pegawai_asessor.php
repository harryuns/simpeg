<?php
    $_POST['NAMA'] = (isset($_POST['NAMA'])) ? $_POST['NAMA'] : '';
    $_POST['K_JENIS_KERJA'] = (isset($_POST['K_JENIS_KERJA'])) ? $_POST['K_JENIS_KERJA'] : '';
    $_POST['K_STATUS_KERJA'] = (isset($_POST['K_STATUS_KERJA'])) ? $_POST['K_STATUS_KERJA'] : '';
    $_POST['K_AKTIF'] = (isset($_POST['K_AKTIF'])) ? $_POST['K_AKTIF'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <style>
        .Record { cursor: pointer; }
    </style>
    <div id="body">
        <div id="frame">
            <div id="sidebar"><div class="glossymenu"><?php include 'main_menu.php'; ?></div></div>
            
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <h1 style="padding: 0 0 10px 0;">Asessor</h1>
                    
                    <div>
                        <div id="AsessorEntry" style="padding: 0 0 15px 0;">
                            <div style="float: left; width: 125px;">NIP</div>
                            <div style="float: left; width: 250px; padding: 0 0 5px 0;">
                                :
                                <input type="text" style="width: 150px;" name="NIP_0" class="required" alt="Tolong masukkan NIP Asessor 1" readonly="readonly" />
                                <img class="PopupAsessor SearchAsessor1" src="<?php echo HOST; ?>/Style/siado/Lens.jpg" style="width: 18px; height: 18px; margin: 0 0 -3px 0; cursor: pointer;" />
                            </div>
                            <div class="clear"></div>
                            <div style="float: left; width: 125px;">Nama</div>
                            <div style="float: left; width: 250px; padding: 0 0 5px 0;">: <input type="text" style="width: 150px;" name="NAMA_0" class="required" alt="Tolong masukkan Nama Asessor 1" readonly="readonly" /></div>
                            <div class="clear"></div>
                            <div style="float: left; width: 125px;">Asessor ke </div>
                            <div style="float: left; width: 250px; padding: 0 0 5px 0;">: 
                                <select name="ASESOR_KE" style="width: 150px;"><option value="1">1</option><option value="2">2</option></select>
                            </div>
                            <div class="clear"></div>
                            <div style="float: left; width: 125px;">Tahun Akademik</div>
                            <div style="float: left; width: 250px; padding: 0 0 5px 0;">: <select style="width: 150px;" name="TAHUN_AKADEMIK"><?php echo GetOption(false, $ArrayTahunAkademik, ''); ?></select></div>
                            <div class="clear"></div>
                            <div style="float: left; width: 125px;">Semester</div>
                            <div style="float: left; width: 250px; padding: 0 0 5px 0;">: <select name="SEMESTER" style="width: 150px;"><option value="0">Genap</option><option value="1">Ganjil</option></select></div>
                            <div class="clear"></div>
                        </div>
                        
                        <div id="AsessorSearch">
                            <input type="hidden" name="PencarianDetail" value="0" />
                            <input type="hidden" name="K_AKTIF" value="01" />
                            <input type="hidden" name="K_JENIS_KERJA" value="01" />
                            <input type="hidden" name="K_STATUS_KERJA" value="01" />
                            <input type="hidden" name="PageActive" value="1" />
                            <div style="float: left; width: 125px;">Cari Dosen</div>
                            <div style="float: left; width: 250px; padding: 0 0 5px 0;">:
                                <input type="text" style="width: 150px;" name="NAMA" />
                                <input type="button" style="width: 75px;" name="CariPegawai" value="Cari" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        
                        <div id="DialogSearchAsessor" title="Pencarian Asessor" style="display: none; font-size: 11px;"><p>
                            <div style="float: left; width: 100px;">Nama / NIM :</div>
                            <div style="float: left; width: 150px;"><input type="text" name="NamaAsessor" value="" /></div>
                            <div style="float: left; width: 100px;"><input type="button" name="SearchAsessor" value="Search" /></div>
                            <div class="clear"></div>
                            <div id="ResultAsessor"></div>
                        </p></div>
                        
                        <div class="cnt_table_main" id="ListAsessor">&nbsp;</div>
                        <script type="text/javascript">InitAsessor();</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>