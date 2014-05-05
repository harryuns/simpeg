<?php
	$Record = (isset($RiwayatOrganisasi['Record'])) ? $RiwayatOrganisasi['Record'] : array();
	$Record['K_PEGAWAI'] = $PageParam['K_PEGAWAI'];
	$Record['NO_URUT'] = (isset($PageParam['NO_URUT'])) ? $PageParam['NO_URUT'] : '';
	
	// Populate Data
	if (!empty($Record['NO_URUT'])) {
		$ArrayRecord = $this->lriwayat_organisasi->GetArray($Record['K_PEGAWAI'], $Record['NO_URUT']);
		foreach ($ArrayRecord as $Row) {
			$Record = $Row;
		}
	}
	
	$ShowGrid = 1;
	if (isset($_POST['Tambah']) || isset($RiwayatOrganisasi['Error']) || !empty($PageParam['NO_URUT'])) {
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
            </div>
            
            <div id="content">
            		
            		<div class="contentmenu clearfix"><?php include 'main_sub_menu.php'; ?></div>
                <div class="full" style="min-height: 400px;">
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($ShowGrid == 1 && count($ArrayRiwayatOrganisasi) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
										<table style="width: 950px">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">Nama</td>
                                                <td class="normal" style="width: 150px;">Kedudukan</td>
                                                <td class="normal" style="width: 225px;">No SK</td>
                                                <td class="normal" style="width: 150px;">NIP Pejabat</td>
                                                <td class="normal" style="width: 225px;">Tanggal Mulai</td>
                                                <td class="normal" style="width: 225px;">Tanggal Selesai</td></tr>';
                                foreach ($ArrayRiwayatOrganisasi as $Key => $Array) {
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NAMA'].'</td>
                                            <td class="body">'.$Array['KEDUDUKAN'].'</td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.$Array['NIP_PEJABAT'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_MULAI']).'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SELESAI']).'</td>
                                        </tr>';
                                }
                                echo '
                                    </table></div>
                                    <script type="text/javascript">InitTable();</script>';
                            }
                        ?>
                    
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatOrganisasi">
                            <?php if (!empty($RiwayatOrganisasi['Message'])) { ?>
								<div class="MessagePopup"><?php echo $RiwayatOrganisasi['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatOrganisasi']; ?>">
								<input type="hidden" name="FormName" value="RiwayatOrganisasi" />
								<input type="hidden" name="NO_URUT_HI" value="<?php echo (empty($Record['NO_URUT'])) ? '' : ConvertLink($Record['NO_URUT']); ?>" />
								
								<?php if ($ShowGrid == 0) { ?>
									<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
										<tr>
											<td>Nama</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NAMA']; ?>" name="NAMA" class="required" /></td></tr>
										<tr>
											<td>Kedudukan</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['KEDUDUKAN']; ?>" name="KEDUDUKAN" class="required" /></td></tr>
										<tr>
											<td>Tanggal Mulai</td>
											<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$Record['TGL_MULAI']); ?>" name="TGL_MULAI" class="datepicker" /></td></tr>
										<tr>
											<td>Tanggal Selesai</td>
											<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$Record['TGL_SELESAI']); ?>" name="TGL_SELESAI" class="datepicker" /></td></tr>
										<tr>
											<td>No SK</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NO_SK']; ?>" name="NO_SK" class="sk_char" /></td></tr>
										<tr>
											<td>NIP Pejabat</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NIP_PEJABAT']; ?>" name="NIP_PEJABAT" class="required" /></td></tr>
										<tr>
											<td>Nama Pejabat</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['NAMA_PEJABAT']; ?>" name="NAMA_PEJABAT" class="" /></td></tr>
										<tr>
											<td>Jabatan Pejabat</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo @$Record['JABATAN_PEJABAT']; ?>" name="JABATAN_PEJABAT" class="" /></td></tr>
										<tr>
											<td colspan="2" style="padding: 10px 0;">
												<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatOrganisasi']; ?>" />
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
	function InitRiwayatOrganisasi() {
		InitForm.Start('FormRiwayatOrganisasi');
		
		$('#FormRiwayatOrganisasi form').submit(function() {
			var ArrayError = InitForm.Validation('FormRiwayatOrganisasi');
			return ShowWarning(ArrayError);
		});
	}
	
	InitRiwayatOrganisasi();
</script>
</body>
</html>