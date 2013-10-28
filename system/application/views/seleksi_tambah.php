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
					
                    <div>
                        <form method="post" id="FormPegawai">
                            <input type="hidden" name="PageActive" value="1" />
                            <input type="hidden" name="DeletePegawai" value="0" />
                            <input type="hidden" name="PencarianDetailLastest" value="<?php echo $PencarianDetailLastest; ?>" />
                            <table style="width: 100%;">
                            	<tr>
                                    <td>Unit Kerja</td>
                                    <td><input type="text" style="width: 300px;" maxlength="50" value="<?php  if (isset($ArrayPegawai['Pegawai'])) echo $ArrayPegawai['Pegawai'][0]['UNIT']; ?>" name="UNIT" /></td></tr>                                
	                            <tr>
                                    <td>Nomor Peserta</td>
                                    <td><input type="text" style="width: 300px;" maxlength="50" value="<?php  if (isset($ArrayPegawai['Pegawai'])) echo $ArrayPegawai['Pegawai'][0]['NO_PESERTA']; ?>" name="NOMOR" /></td></tr>
                                <tr>
                                    <td>Periode</td>
                                    <td>
										<select id="TAHUN" name="TAHUN">
											<? foreach($ArrayPeriode as $key=>$value){?>
											<option value="<?php echo $value['K_PERIODE'];?>"><?php echo $value['PERIODE'] .' - '. $value['TAHUN'];?></option>
											<?}?>
										</select> 
                                    </td></tr>    
                                <tr>
                                    <td>N a m a</td>
                                    <td><input type="text" style="width: 300px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['NAMA']; ?>" name="NAMA" /></td></tr>
                               <tr>
                                    <td>A l a m a t</td>
                                    <td><textarea rows="3" cols="60" id="ALAMAT" name="ALAMAT" ><?php echo @$ArrayPegawai['Pegawai'][0]['ALAMAT']; ?></textarea></td></tr>
                               <tr>
                                    <td>Pilihan Pelamar</td>
                                    <td><input type="text" style="width: 300px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['PILIHAN']; ?>" name="PILIHAN" /></td></tr>
							   <tr>
                                    <td>Jenjang</td>
                                    <td>
                                    <input type="text" style="width: 300px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['JENJANG']; ?>" name="JENJANG" />
                                    </td></tr>
                                <tr>
                                    <td>Kualifikasi Pendidikan</td>
                                    <td><textarea rows="3" cols="60" id="KUALIFIKASI"  name="KUALIFIKASI"><?php echo @$ArrayPegawai['Pegawai'][0]['KUALIFIKASI_PEND']; ?></textarea></td></tr>
								<tr>
                                    <td>Tanggal Ujian</td>
                                    <td><input type="text" style="width: 300px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['TGL_UJIAN']; ?>" name="TGL_UJIAN" class="datepicker" /></td></tr>
                                <tr>
                                    <td>Waktu Ujian</td>
                                    <td><input type="text" style="width: 300px;" maxlength="50" value="<?php echo @$ArrayPegawai['Pegawai'][0]['PUKUL']; ?>" name="PUKUL" /></td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                    <input type="reset" name="Reset" value="Reset" />
                                    <input type="submit" name="Submit" value="Submit" /></td></tr>
                            </table>
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