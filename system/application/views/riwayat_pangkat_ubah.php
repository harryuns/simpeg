<?php
//	print_r($ArrayRiwayatPangkat); exit;
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
                    <?php
                        if ($RiwayatPangkat['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatPangkat['ShowGrid'] == '1' && count($ArrayRiwayatPangkat) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 1700px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No SK</td>
                                                <td class="normal" style="width: 150px;">Tanggal SK</td>
                                                <td class="normal" style="width: 150px;">Pangkat</td>
                                                <td class="normal" style="width: 150px;">Golongan</td>
                                                <td class="normal" style="width: 200px;">Asal SK</td>
                                                <td class="normal" style="width: 200px;">Penjelasan</td>
                                                <td class="normal" style="width: 150px;">TMT</td>
                                                <td class="normal" style="width: 150px;">Gaji Pokok</td>
                                                <td class="normal" style="width: 200px;">Keterangan</td>
                                                <td class="normal" style="width: 200px;">Penandatangan SK</td>
                                                <td class="normal" style="width: 50px;">SK</td></tr>';
                                foreach ($ArrayRiwayatPangkat as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SK']).'</td>
											<td class="body">'.$Array['PANGKAT'].'</td>
											<td class="body">'.$Array['GOLONGAN'].' '.$Array['RUANG'].'</td>
                                            <td class="body">'.$ArrayAsalSk[$Array['K_ASAL_SK']]['Content'].'</td>
                                            <td class="body">'.$ArrayPenjelasan[$Array['K_PENJELASAN']]['Content'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TMT']).'</td>
                                            <td class="body">'.$Array['GAJI_POKOK'].'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                            <td class="body">'.$Array['PENANDATANGAN_SK'].'</td>
                                            <td class="body">'.$FileLinkInfo.'</td></tr>';
                                }
                                echo '
                                        </table>
                                    </div>
                                    <script type="text/javascript">InitTable();</script>';
                            }
                        ?>
                        
                        <?php if (!empty($RiwayatPangkat['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatPangkat['Message']; ?></div>
                        <?php } ?>
                        
                        <div style="width: 500px;" id="FormRiwayatPangkat">
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatPangkat']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatPangkat['ParameterUpdate']; ?>" />
                            <table style="width: 100%;">
                            <tr>
                                <td colspan="2" style="">
                                    <input type="submit" name="Tambah" value="Tambah" />
                                </td></tr>
                            </table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">RiwayatPangkat();</script>
                        </div>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatPangkat">
                            <?php if (!empty($RiwayatPangkat['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatPangkat['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatPangkat']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="RiwayatPangkat" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatPangkat['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatPangkat['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SK_HI" value="<?php echo ConvertLink($RiwayatPangkat['NO_SK']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td style="width: 200px;">No SK</td>
										<td style="width: 300px;"><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPangkat['NO_SK']; ?>" name="NO_SK" class="sk_char" /></td></tr>
									<tr>
										<td>Tanggal SK</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatPangkat['TGL_SK']); ?>" name="TGL_SK" class="datepicker" /></td></tr>
									<tr>
										<td>SK Asal</td>
										<td><select style="width: 85%;" name="K_ASAL_SK"><?php echo GetOption(false, $ArrayAsalSk, $RiwayatPangkat['K_ASAL_SK']); ?></select></td></tr>
									<tr>
										<td>Penjelasan</td>
										<td><select style="width: 85%;" name="K_PENJELASAN"><?php echo GetOption(false, $ArrayPenjelasan, $RiwayatPangkat['K_PENJELASAN']); ?></select></td></tr>
									<tr>
										<td>Golongan</td>
										<td><select style="width: 85%;" name="K_GOLONGAN"><?php echo GetOption(false, $ArrayGolongan, $RiwayatPangkat['K_GOLONGAN']); ?></select></td></tr>
									<tr>
										<td>TMT</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatPangkat['TMT']); ?>" name="TMT" class="datepicker" /></td></tr>
									<tr>
										<td>Gaji Pokok</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPangkat['GAJI_POKOK']; ?>" name="GAJI_POKOK" class="integer" /></td></tr>
									<tr>
										<td>Masa Kerja Keseluruhan</td>
										<td><?php echo $Pegawai['MASA_KERJA_KESELURUHAN']; ?></td></tr>
									<tr>
										<td>Masa Kerja Golongan</td>
										<td><?php echo $Pegawai['MASA_KERJA_GOLONGAN']; ?></td></tr>
									<tr>
										<td>Penandatangan SK</td>
										<td><textarea name="PENANDATANGAN_SK" style="width: 85%; height: 75px;"><?php echo $RiwayatPangkat['PENANDATANGAN_SK']; ?></textarea></td></tr>
									<tr class="CntMasaKerjaTambahan">
										<td>Masa Kerja Tambahan</td>
										<td>
											<input type="text" style="width: 40px;" size="5" value="<?php echo $RiwayatPangkat['TAHUN_JABATAN_TAMBAHAN']; ?>" name="TAHUN_JABATAN_TAMBAHAN" class="integer" /> Tahun
											<input type="text" style="width: 40px;" size="5" value="<?php echo $RiwayatPangkat['BULAN_JABATAN_TAMBAHAN']; ?>" name="BULAN_JABATAN_TAMBAHAN" class="integer" /> Bulan
										</td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatPangkat['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatPangkat']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">RiwayatPangkat();</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($RiwayatPangkat['Certificate'])) {
                                    $Extention = GetExtention($RiwayatPangkat['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatPangkat['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$RiwayatPangkat['Certificate'].'">'.$ImageHtml.'</a>
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