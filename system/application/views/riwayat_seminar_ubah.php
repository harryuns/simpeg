<?php
	$Record = (isset($RiwayatSeminar['Record'])) ? $RiwayatSeminar['Record'] : array();
	$Record['K_PEGAWAI'] = $PageParam['K_PEGAWAI'];
	$Record['NO_URUT'] = (isset($PageParam['NO_URUT'])) ? $PageParam['NO_URUT'] : '';
	
	// Populate Data
	if (!empty($Record['NO_URUT'])) {
		$ArrayRecord = $this->lriwayat_seminar->GetArray($Record['K_PEGAWAI'], $Record['NO_URUT']);
		foreach ($ArrayRecord as $Row) {
			$Record = $Row;
		}
	}
	
	$ArrayKedudukan = $this->lkedudukan->Getarray();
	
	$ShowGrid = 1;
	if (isset($_POST['Tambah']) || isset($RiwayatSeminar['Error']) || !empty($PageParam['NO_URUT'])) {
		$ShowGrid = 0;
	}
?>
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
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($ShowGrid == 1 && count($ArrayRiwayatSeminar) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
										<table style="width: 950px">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">Tahun</td>
                                                <td class="normal" style="width: 150px;">Nama</td>
                                                <td class="normal" style="width: 225px;">Lokasi</td>
                                                <td class="normal" style="width: 150px;">Tingkat</td>
                                                <td class="normal" style="width: 225px;">Penyelenggara</td></tr>';
                                foreach ($ArrayRiwayatSeminar as $Key => $Array) {
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['TAHUN'].'</td>
                                            <td class="body">'.$Array['NAMA'].'</td>
                                            <td class="body">'.$Array['LOKASI'].'</td>
                                            <td class="body">'.$Array['TINGKAT'].'</td>
                                            <td class="body">'.$Array['PENYELENGGARA'].'</td>
                                        </tr>';
                                }
                                echo '
                                    </table></div>
                                    <script type="text/javascript">InitTable();</script>';
                            }
                        ?>
                    
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatSeminar">
                            <?php if (!empty($RiwayatSeminar['Message'])) { ?>
								<div class="MessagePopup"><?php echo $RiwayatSeminar['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatSeminar']; ?>">
								<input type="hidden" name="FormName" value="RiwayatSeminar" />
								<input type="hidden" name="NO_URUT_HI" value="<?php echo (empty($Record['NO_URUT'])) ? '' : ConvertLink($Record['NO_URUT']); ?>" />
								
								<?php if ($ShowGrid == 0) { ?>
									<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
										<tr>
											<td>Tahun</td>
											<td><input type="text" style="width: 100px;" maxlength="4" value="<?php echo @$Record['TAHUN']; ?>" name="TAHUN" class="required integer" alt="Tahun kosong" /></td></tr>
										<tr>
											<td>Nama</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NAMA']; ?>" name="NAMA" class="required" alt="Nama kosong" /></td></tr>
										<tr>
											<td>Lokasi</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['LOKASI']; ?>" name="LOKASI" /></td></tr>
										<tr>
											<td>Tingkat</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['TINGKAT']; ?>" name="TINGKAT" /></td></tr>
										<tr>
											<td>Penyelenggara</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['PENYELENGGARA']; ?>" name="PENYELENGGARA" /></td></tr>
										<tr>
											<td style="width: 200px;">Kedudukan</td>
											<td style="width: 300px;"><select style="width: 85%;" name="ID_KEDUDUKAN">
												<?php echo ShowOption(array('Array' => $ArrayKedudukan, 'ArrayID' => 'ID_KEDUDUKAN', 'ArrayTitle' => 'CONTENT', 'Selected' => @$Record['ID_KEDUDUKAN'])); ?>
											</select></td></tr>
										<tr>
											<td colspan="2" style="padding: 10px 0;">
												<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatSeminar']; ?>" />
												<input type="reset" name="Reset" value="Reset" />
												<input type="submit" name="Submit" value="Save" />
											</td></tr>
									</table>
								<?php } else { ?>
									<table style="width: 100%;">
										<tr>
											<td colspan="2" style="">
												<input type="submit" name="Tambah" value="Tambah" />
											</td></tr>
									</table>
								<?php } ?>
                            </form>
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
<script type="text/javascript">
	function InitRiwayatSeminar() {
		InitForm.Start('FormRiwayatSeminar');
		
		$('#FormRiwayatSeminar form').submit(function() {
			var ArrayError = InitForm.Validation('FormRiwayatSeminar');
			return ShowWarning(ArrayError);
		});
	}
	
	InitRiwayatSeminar();
</script>
</body>
</html>