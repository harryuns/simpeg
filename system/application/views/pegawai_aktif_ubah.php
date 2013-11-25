<?php
	$ArrayJenjang = $this->ljenjang->GetArrayJenjang();
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
                        if ($PegawaiAktif['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($PegawaiAktif['ShowGrid'] == '1' && count($ArrayPegawaiActive) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 750px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 175px;">Status Aktif</td>
                                                <td class="normal" style="width: 175px;">No SK</td>
                                                <td class="normal" style="width: 175px;">Tanggal Mulai</td>
                                                <td class="normal" style="width: 175px;">Keterangan</td>
                                                <td class="normal" style="width: 50px;">SK</td></tr>';
                                foreach ($ArrayPegawaiActive as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['STATUS_AKTIF'].'</td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_MULAI']).'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                            <td class="body">'.$FileLinkInfo.'</td></tr>';
                                }
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($PegawaiAktif['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $PegawaiAktif['Message']; ?></div>
                        <?php } ?>
                        
                        <div style="width: 500px;" id="FormPegawaiAktif">
                            <form method="post" action="<?php echo $Pegawai['LinkPegawaiAktif']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $PegawaiAktif['ParameterUpdate']; ?>" />
                            <table style="width: 100%;">
                                <tr><td colspan="2" style="">
                                    <input type="submit" name="Tambah" value="Tambah" />
                                </td></tr>
                            </table>
                            </form>
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">IntPegawaiActive();</script>
                        </div>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormPegawaiAktif">
                            <?php if (!empty($PegawaiAktif['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $PegawaiAktif['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkPegawaiAktif']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="PegawaiAktif" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $PegawaiAktif['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($PegawaiAktif['K_PEGAWAI']); ?>" />
								<input type="hidden" name="K_AKTIF_HI" value="<?php echo ConvertLink($PegawaiAktif['K_AKTIF']); ?>" />
								<input type="hidden" name="NO_SK_HI" value="<?php echo ConvertLink($PegawaiAktif['NO_SK']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td style="width: 200px;">Aktif</td>
										<td style="width: 300px;"><select style="width: 150px;" name="K_AKTIF"><?php echo GetOption(false, $ArrayAktif, $PegawaiAktif['K_AKTIF']); ?></select></td></tr>
									<tr>
										<td>No SK</td>
										<td><input type="text" style="width: 150px" size="50" value="<?php echo $PegawaiAktif['NO_SK']; ?>" name="NO_SK" class="required sk_char" alt="Silahkan memasukkan No SK" /></td></tr>
									<tr class="SubStudiLanjut">
										<td>Jenjang</td>
										<td><select style="width: 200px;" name="K_JENJANG">
											<?php echo ShowOption(array('Array' => $ArrayJenjang, 'ArrayID' => 'K_JENJANG', 'ArrayTitle' => 'Content', 'Selected' => $PegawaiAktif['K_JENJANG'])); ?>
										</select></td></tr>
									<tr class="SubStudiLanjut">
										<td>Universitas</td>
										<td><input type="text" style="width: 200px" size="50" value="<?php echo $PegawaiAktif['PT']; ?>" name="PT" /></td></tr>
									<tr>
										<td>Tanggal Mulai</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($PegawaiAktif['TGL_MULAI']); ?>" name="TGL_MULAI" class="required datepicker" alt="Silahkan memasukkan Tanggal Mulai" /></td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $PegawaiAktif['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload SK</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkPegawaiAktif']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">IntPegawaiActive();</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($PegawaiAktif['Certificate'])) {
                                    $Extention = GetExtention($PegawaiAktif['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$PegawaiAktif['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$PegawaiAktif['Certificate'].'">'.$ImageHtml.'</a>
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