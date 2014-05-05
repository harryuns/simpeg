<?php
//	print_r($RiwayatSertifikasi); exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>asdf
    <div id="body">
        <div id="frame">
            <div id="sidebar">
                <div class="glossymenu"><?php include 'main_menu.php'; ?></div>
            </div>
            
            <div id="contentxx">
            		<div class="contentmenu clearfix"><?php include 'main_sub_menu.php'; ?></div>
                <div class="full" style="min-height: 400px;">
                    <?php
                        if ($RiwayatSertifikasi['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatSertifikasi['ShowGrid'] == '1' && count($ArrayRiwayatSertifikasi) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 1400px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No Sertifikat</td>
                                                <td class="normal" style="width: 125px;">Tanggal Sertifikat</td>
                                                <td class="normal" style="width: 150px;">No Peserta</td>
                                                <td class="normal" style="width: 200px;">Pejabat TT</td>
                                                <td class="normal" style="width: 100px;">Tunjangan</td>
                                                <td class="normal" style="width: 150px;">Tanggal Akhir</td>
                                                <td class="normal" style="width: 200px;">Keterangan</td>
                                                <td class="normal" style="width: 50px;">Sertifikat</td></tr>';
                                foreach ($ArrayRiwayatSertifikasi as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SERTIFIKAT'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SERTIFIKAT']).'</td>
                                            <td class="body">'.$Array['NO_PESERTA'].'</td>
                                            <td class="body">'.$Array['PEJABAT_TT'].'</td>
                                            <td class="body">'.$Array['TUNJANGAN_SERTIFIKASI'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_AKHIR']).'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
											<td class="body">'.$FileLinkInfo.'</td></tr>';
                                }
								
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($RiwayatSertifikasi['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatSertifikasi['Message']; ?></div>
                        <?php } ?>
                        
                        <form method="post" action="<?php echo $Pegawai['LinkRiwayatSertifikasi']; ?>">
                        <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatSertifikasi['ParameterUpdate']; ?>" />
                        <table style="width: 100%;">
                            <tr><td colspan="2" style="">
                                <input type="submit" name="Tambah" value="Tambah" />
                            </td></tr>
                        </table>
                        </form>
                        <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                        <script type="text/javascript">InitRiwayatSertifikasi();</script>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatSertifikasi">
                            <?php if (!empty($RiwayatSertifikasi['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatSertifikasi['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatSertifikasi']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="RiwayatSertifikasi" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatSertifikasi['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatSertifikasi['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SERTIFIKAT_HI" value="<?php echo ConvertLink($RiwayatSertifikasi['NO_SERTIFIKAT']); ?>" />
								<input type="hidden" name="NO_PESERTA_HI" value="<?php echo ConvertLink($RiwayatSertifikasi['NO_PESERTA']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td>No Sertifikat</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatSertifikasi['NO_SERTIFIKAT']; ?>" name="NO_SERTIFIKAT" class="required sk_char" alt="Silahkan memasukkan No SK" /></td></tr>
									<tr>
										<td>Tanggal Sertifikat</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatSertifikasi['TGL_SERTIFIKAT']); ?>" name="TGL_SERTIFIKAT" class="datepicker required" alt="Silahkan memasukkan Tanggal Sertifikat" /></td></tr>
									<tr>
										<td>No Peserta</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatSertifikasi['NO_PESERTA']; ?>" name="NO_PESERTA" class="required sk_char" alt="Silahkan memasukkan No Peserta" /></td></tr>
									<tr>
										<td>PTP Serdos</td>
										<td><select style="width: 250px;" name="K_PTP"><?php echo GetOption(false, $ArrayPtp, $RiwayatSertifikasi['K_PTP']); ?></select></td></tr>
									<tr>
										<td>Pejabat TT</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatSertifikasi['PEJABAT_TT']; ?>" name="PEJABAT_TT" class="required" alt="Silahkan memasukkan Pejabat TT" /></td></tr>
									<tr>
										<td>Rumpun Ilmu</td>
										<td><select style="width: 250px;" name="K_RUMPUN_ILMU"><?php echo GetOption(false, $ArrayRumpunIlmu, $RiwayatSertifikasi['K_RUMPUN_ILMU']); ?></select></td></tr>
									<tr>
										<td>Tunjangan Sertifikasi</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatSertifikasi['TUNJANGAN_SERTIFIKASI']; ?>" name="TUNJANGAN_SERTIFIKASI"class="integer required" alt="Silahkan memasukkan Tunjangan Sertifikat yang sesuai" /></td></tr>
									<tr>
										<td>Tanggal Akhir</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatSertifikasi['TGL_AKHIR']); ?>" name="TGL_AKHIR" class="datepicker required" alt="Silahkan memasukkan Tanggal Akhir" /></td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatSertifikasi['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatSertifikasi']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitRiwayatSertifikasi();</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($RiwayatSertifikasi['Certificate'])) {
                                    $Extention = GetExtention($RiwayatSertifikasi['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatSertifikasi['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$RiwayatSertifikasi['Certificate'].'">'.$ImageHtml.'</a>
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