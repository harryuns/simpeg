<?php
//	print_r($ArrayKenaikanGaji); exit;
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
                    <?php
                        if ($KenaikanGaji['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($KenaikanGaji['ShowGrid'] == '1' && count($ArrayKenaikanGaji) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 750px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 125px;">No SK</td>
                                                <td class="normal" style="width: 125px;">TMT</td>
                                                <td class="normal" style="width: 225px;">Gaji</td>
                                                <td class="normal" style="width: 275px;">Perubahan Gaji</td>
                                                <td class="normal" style="width: 50px;">Sertifikat</td></tr>';
                                foreach ($ArrayKenaikanGaji as $Key => $Array) {
									$FileLinkInfo = (empty($Array['FileLink'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TMT']).'</td>
                                            <td class="body">'.$Array['GAJI'].'</td>
                                            <td class="body">'.$Array['PERUBAHAN_GAJI'].'</td>
											<td class="body">'.$FileLinkInfo.'</td>
                                        </tr>';
                                }
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($KenaikanGaji['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $KenaikanGaji['Message']; ?></div>
                        <?php } ?>
                        
                        <form method="post" action="<?php echo $Pegawai['LinkKenaikanGaji']; ?>">
                        <input type="hidden" name="ParameterUpdate" value="<?php echo $KenaikanGaji['ParameterUpdate']; ?>" />
                        <table style="width: 100%;">
                            <tr><td colspan="2" style="">
                                <input type="submit" name="Tambah" value="Tambah" />
                            </td></tr>
                        </table>
                        </form>
                        <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                        <script type="text/javascript">InitKenaikanGaji();</script>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormKenaikanGaji">
                            <?php if (!empty($KenaikanGaji['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $KenaikanGaji['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkKenaikanGaji']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="KenaikanGaji" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $KenaikanGaji['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($KenaikanGaji['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SK_HI" value="<?php echo ConvertLink($KenaikanGaji['NO_SK']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td style="width: 150px;">No SK</td>
										<td style="width: 350px;"><input type="text" style="width: 150px;" size="50" value="<?php echo $KenaikanGaji['NO_SK']; ?>" name="NO_SK" class="required sk_char" alt="Silahkan memasukkan No SK" /></td></tr>
									<tr>
										<td>Gaji</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $KenaikanGaji['GAJI']; ?>" name="GAJI" class="integer" /></td></tr>
									<tr>
										<td>TMT</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($KenaikanGaji['TMT']); ?>" name="TMT" class="required datepicker" alt="Silahkan memasukkan Tanggal TMT" /></td></tr>
									<tr>
										<td>Perubahan Gaji</td>
										<td><select style="width: 225px;" name="K_PERUBAHAN_GAJI"><?php echo GetOption(false, $ArrayPerubahanGaji, $KenaikanGaji['K_PERUBAHAN_GAJI']); ?></select></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkKenaikanGaji']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitKenaikanGaji();</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($KenaikanGaji['Certificate'])) {
                                    $Extention = GetExtention($KenaikanGaji['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$KenaikanGaji['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$KenaikanGaji['Certificate'].'">'.$ImageHtml.'</a>
                                            <div class="position"><img src="'.HOST.'/images/Delete.png" class="cursor" /></div>
                                        </div>';
                                } else {
                                    echo '&nbsp;';
                                }
                            ?>
                            <script type="text/javascript">InitDeleteImage()</script>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>