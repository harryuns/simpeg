<?php
    $PencarianDetailLastest = (isset($_POST['PencarianDetail'])) ? $_POST['PencarianDetail'] : '';
	
	$ArraySearchCriteria = array(
		0 => array('id' => '0', 'title' => 'Jenis Kerja'),
		1 => array('id' => '1', 'title' => 'Unit Kerja')
//		2 => array('id' => '2', 'title' => 'Status Kerja'),
//		3 => array('id' => '3', 'title' => 'Status Aktif')
	);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <div id="body">
        <div id="frame">
            <div id="sidebar"><div class="glossymenu"><?php include 'main_menu.php'; ?></div></div>
        
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <h1 style="padding: 0 0 10px 0;">Tanda Peserta</h1>
					
                    <div class="clearfix">
                        <form method="post" id="FormPegawai" class="clearfix">
                        
                        		
                            <input type="hidden" name="PageActive" value="1" />
                            <input type="hidden" name="DeletePegawai" value="0" />
                            <input type="hidden" name="PencarianDetailLastest" value="<?php echo $PencarianDetailLastest; ?>" />
                            
                            <div class="left">
                            	<div class="form-row">
                              	<label>Unit Kerja :</label>
                                <input type="text" style="width: 240px;" maxlength="50" value="<?php  if (isset($ArrayPegawai['Pegawai'])) echo $ArrayPegawai['Pegawai'][0]['UNIT']; ?>" name="UNIT" />
                              </div>
                              <div class="form-row">
                              	<label>Nomor Peserta</label>
                                <input type="text" style="width: 240px;" maxlength="50" value="<?php  if (isset($ArrayPegawai['Pegawai'])) echo $ArrayPegawai['Pegawai'][0]['NO_PESERTA']; ?>" name="NOMOR" />
                              </div>
                              <div class="form-row">
                              	<label>Periode</label>
                                <select id="TAHUN" name="TAHUN">
																	<? foreach($ArrayPeriode as $key=>$value){?>
                                  <option value="<?php echo $value['K_PERIODE'];?>"><?php echo $value['PERIODE'] .' - '. $value['TAHUN'];?></option>
                                  <?}?>
                                </select> 
                              </div>
                              <div class="form-row">
                              	<label>N a m a</label>
                                <input type="text" style="width: 240px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['NAMA']; ?>" name="NAMA" />
                              </div>
                              <div class="form-row">
                              	<label>A l a m a t</label>
                                <textarea rows="3" style="width:240px; height:100px" cols="60" id="ALAMAT" name="ALAMAT" ><?php echo @$ArrayPegawai['Pegawai'][0]['ALAMAT']; ?></textarea>
                              </div>
                              <div class="form-row">
                              	<label></label>
                                
                              </div>
                            
                            </div>
                            
                            
                            <div class="left">
                            		<div class="form-row">
                              	<label>Pilihan Pelamar</label>
                                <input type="text" style="width: 240px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['PILIHAN']; ?>" name="PILIHAN" />
                              	</div>
                                <div class="form-row">
                              	<label>Jenjang</label>
                                <input type="text" style="width: 240px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['JENJANG']; ?>" name="JENJANG" />
                              	</div>
                                <div class="form-row">
                              	<label>Kualifikasi Pendidikan</label>
                                <textarea rows="3" style="width:240px;height:100px" cols="60" id="KUALIFIKASI"  name="KUALIFIKASI"><?php echo @$ArrayPegawai['Pegawai'][0]['KUALIFIKASI_PEND']; ?></textarea>
                              	</div>
                                <div class="form-row">
                              	<label>Tanggal Ujian</label>
                                <input type="text" style="width: 240px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['TGL_UJIAN']; ?>" name="TGL_UJIAN" class="datepicker" />
                              	</div>
                                <div class="form-row">
                              	<label>Waktu Ujian</label>
                                <input type="text" style="width: 240px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['PUKUL']; ?>" name="PUKUL" />
                              	</div>
                                
                                
                              
                            
                            </div>
                            
                            <div style="clear:both"></div>
                            
                            <div class="clearfix">
                              <div class="form-row">
                                  <label></label>
                                  <input type="reset" name="Reset" value="Reset" />
                                  <input type="submit" name="Submit" value="Submit" />
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
		InitForm.Start('FormPegawai');
	</script>
</body>
</html>