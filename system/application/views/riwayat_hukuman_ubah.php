<?php
	$Record = (isset($RiwayatHukuman['Record'])) ? $RiwayatHukuman['Record'] : array();
	$Record['K_PEGAWAI'] = $PageParam['K_PEGAWAI'];
	$Record['NO_URUT'] = (isset($PageParam['NO_URUT'])) ? $PageParam['NO_URUT'] : '';
	
	// Populate Data
	if (!empty($Record['NO_URUT'])) {
		$ArrayRecord = $this->lriwayat_hukuman->GetArray($Record['K_PEGAWAI'], $Record['NO_URUT']);
		foreach ($ArrayRecord as $Row) {
			$Record = $Row;
		}
	}
	
	$ArrayHukuman = $this->lhukuman->Getarray();
	
	$ShowGrid = 1;
	if (isset($_POST['Tambah']) || isset($RiwayatHukuman['Error']) || !empty($PageParam['NO_URUT'])) {
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
                            if ($ShowGrid == 1 && count($ArrayRiwayatHukuman) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
										<table style="width: 950px">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No SK</td>
                                                <td class="normal" style="width: 150px;">Tanggal SK</td>
                                                <td class="normal" style="width: 225px;">TMT</td>
                                                <td class="normal" style="width: 150px;">NIP Pejabat</td></tr>';
                                foreach ($ArrayRiwayatHukuman as $Key => $Array) {
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SK']).'</td>
                                            <td class="body">'.ConvertDateToString($Array['TMT']).'</td>
                                            <td class="body">'.$Array['NIP_PEJABAT'].'</td>
                                        </tr>';
                                }
                                echo '
                                    </table></div>
                                    <script type="text/javascript">InitTable();</script>';
                            }
                        ?>
                    
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatHukuman">
                            <?php if (!empty($RiwayatHukuman['Message'])) { ?>
								<div class="MessagePopup"><?php echo $RiwayatHukuman['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatHukuman']; ?>">
								<input type="hidden" name="FormName" value="RiwayatHukuman" />
								<input type="hidden" name="NO_URUT_HI" value="<?php echo (empty($Record['NO_URUT'])) ? '' : ConvertLink($Record['NO_URUT']); ?>" />
								
								<?php if ($ShowGrid == 0) { ?>
									<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
										<tr>
											<td style="width: 200px;">Hukuman</td>
											<td style="width: 300px;"><select style="width: 85%;" name="ID_HUKUMAN">
												<?php echo ShowOption(array('Array' => $ArrayHukuman, 'ArrayID' => 'ID_HUKUMAN', 'ArrayTitle' => 'CONTENT', 'Selected' => @$Record['ID_HUKUMAN'])); ?>
											</select></td></tr>
										<tr>
											<td>No SK</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NO_SK']; ?>" name="NO_SK" class="sk_char" /></td></tr>
										<tr>
											<td>Tanggal SK</td>
											<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$Record['TGL_SK']); ?>" name="TGL_SK" class="datepicker" /></td></tr>
										<tr>
											<td>TMT</td>
											<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$Record['TMT']); ?>" name="TMT" class="datepicker" /></td></tr>
										<tr>
											<td>NIP Pejabat</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NIP_PEJABAT']; ?>" name="NIP_PEJABAT" /></td></tr>
										<tr>
											<td>Nama Pejabat</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NAMA_PEJABAT']; ?>" name="NAMA_PEJABAT" /></td></tr>
										<tr>
											<td colspan="2" style="padding: 10px 0;">
												<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatHukuman']; ?>" />
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
	function InitRiwayatHukuman() {
		InitForm.Start('FormRiwayatHukuman');
		
		$('#FormRiwayatHukuman form').submit(function() {
			var ArrayError = InitForm.Validation('FormRiwayatHukuman');
			return ShowWarning(ArrayError);
		});
	}
	
	InitRiwayatHukuman();
</script>
</body>
</html>