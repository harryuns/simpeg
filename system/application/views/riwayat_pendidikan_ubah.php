<?php
//	print_r($ArrayJenjang); exit;
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
                        if ($RiwayatPendidikan['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatPendidikan['ShowGrid'] == '1' && count($ArrayRiwayatPendidikan) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 1300px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 100px;">Jenjang</td>
                                                <td class="normal" style="width: 150px;">No Ijazah</td>
                                                <td class="normal" style="width: 125px;">Tanggal Ijazah</td>
                                                <td class="normal" style="width: 75px;">IPK</td>
                                                <td class="normal" style="width: 150px;">PT</td>
                                                <td class="normal" style="width: 100px;">Tahun Masuk</td>
                                                <td class="normal" style="width: 300px;">Program Studi</td>
                                                <td class="normal" style="width: 100px;">Bidang Ilmu</td>
                                                <td class="normal" style="width: 100px;">Keterangan</td>
                                                <td class="normal" style="width: 50px;">Ijazah</td>
                                                <td class="normal" style="width: 50px;">Transkrip</td></tr>';
                                foreach ($ArrayRiwayatPendidikan as $Key => $Array) {
									$FileLinkInfo = (empty($Array['FILE_IJAZAH'])) ? '-' : 'Cek';
									$FileTranskripLinkInfo = (empty($Array['FILE_TRANS'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['JENJANG'].'</td>
                                            <td class="body">'.$Array['NO_IJAZAH_BARU'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_IJAZAH']).'</td>
                                            <td class="body">'.$Array['IPK'].'</td>
                                            <td class="body">'.$Array['PT'].'</td>
                                            <td class="body">'.$Array['THN_MASUK'].'</td>
                                            <td class="body">'.$Array['PROG_STUDI'].'</td>
                                            <td class="body">'.$Array['BIDANG_ILMU'].'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                            <td class="body">'.$FileLinkInfo.'</td>
                                            <td class="body">'.$FileTranskripLinkInfo.'</td></tr>';
                                }
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($RiwayatPendidikan['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatPendidikan['Message']; ?></div>
                        <?php } ?>
                        
                        <div style="width: 500px;" id="FormRiwayatPendidikan">
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatPendidikan']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatPendidikan['ParameterUpdate']; ?>" />
                            <table style="width: 100%;"><tr><td colspan="2" style=""><input type="submit" name="Tambah" value="Tambah" /></td></tr></table>
                            </form>
                        </div>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatPendidikan">
                            <?php if (!empty($RiwayatPendidikan['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatPendidikan['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatPendidikan']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="RiwayatPendidikan" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatPendidikan['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatPendidikan['K_PEGAWAI']); ?>" />
								<input type="hidden" name="K_JENJANG_HI" value="<?php echo ConvertLink($RiwayatPendidikan['K_JENJANG']); ?>" />
								<input type="hidden" name="NO_IJAZAH_HI" value="<?php echo ConvertLink($RiwayatPendidikan['NO_IJAZAH']); ?>" />
								<input type="hidden" name="NO_IJAZAH" value="<?php echo $RiwayatPendidikan['NO_IJAZAH']; ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td style="width: 200px;">Jenjang</td>
										<td style="width: 300px;"><select style="width: 150px;" name="K_JENJANG" class="required">
											<?php echo ShowOption(array( 'Array' => $ArrayJenjang, 'ArrayID' => 'Code', 'ArrayTitle' => 'Content', 'Selected' => $RiwayatPendidikan['K_JENJANG'] )); ?>
										</select></td></tr>
									<tr id="CntPt">
										<td>Perguruan Tinggi / Sekolah</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPendidikan['PT']; ?>" name="PT"></td></tr>
									<tr>
										<td>Negara</td>
										<td><select style="width: 150px;" name="K_NEGARA"><?php echo GetOption(false, $ArrayNegara, $RiwayatPendidikan['K_NEGARA']); ?></select></td></tr>
									<tr id="CntProgramStudy">
										<td>Program Studi</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPendidikan['PROG_STUDI']; ?>" name="PROG_STUDI"></td></tr>
									<tr>
										<td>Bidang Ilmu / Peminatan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPendidikan['BIDANG_ILMU']; ?>" name="BIDANG_ILMU"></td></tr>
									<tr class="hidden">
										<td>Profesi</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPendidikan['PROFESI']; ?>" name="PROFESI" class="" /></td></tr>
									<tr>
										<td>Tahun Masuk</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPendidikan['THN_MASUK']; ?>" name="THN_MASUK" class="integer" /></td></tr>
									<tr>
										<td>Status Kuliah / Kelulusan</td>
										<td><select style="width: 150px;" name="K_STATUS_STUDI"><?php echo GetOption(false, $ArrayStatusStudi, $RiwayatPendidikan['K_STATUS_STUDI']); ?></select></td></tr>
									<tr>
										<td>No SK Tubel / Ijin Belajar</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatPendidikan['NO_SK_TUBEL']; ?>" name="NO_SK_TUBEL" /></td></tr>
									<tr>
										<td>TMT Tubel / Ijin Belajar</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$RiwayatPendidikan['TMT_TUBEL']); ?>" name="TMT_TUBEL" class="datepicker" /></td></tr>
									<tr>
										<td>No SK Pembebasan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatPendidikan['NO_SK_PEMBEBASAN']; ?>" name="NO_SK_PEMBEBASAN" /></td></tr>
									<tr>
										<td>TMT Pembebasan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$RiwayatPendidikan['TMT_PEMBEBASAN']); ?>" name="TMT_PEMBEBASAN" class="datepicker" /></td></tr>
									<tr>
										<td>TMT Lulus</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$RiwayatPendidikan['TMT_LULUS']); ?>" name="TMT_LULUS" class="datepicker" /></td></tr>
									<tr>
										<td>No Ijazah</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatPendidikan['NO_IJAZAH_BARU']; ?>" name="NO_IJAZAH_BARU" class="sk_char" /></td></tr>
									<tr>
										<td>Tanggal Ijazah</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatPendidikan['TGL_IJAZAH']); ?>" name="TGL_IJAZAH" class="datepicker" /></td></tr>
									<tr>
										<td>Status Pengaktifan</td>
										<td>
											<input type="checkbox" name="STATUS_PENGAKTIFAN" <?php echo (empty($RiwayatPendidikan['STATUS_PENGAKTIFAN'])) ? '' : 'checked="checked"'; ?> value="1" />
										</td></tr>
									<tr>
										<td>No SK Pengaktifan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatPendidikan['NO_SK_PENGAKTIFAN']; ?>" name="NO_SK_PENGAKTIFAN" /></td></tr>
									<tr>
										<td>TMT Pengaktifan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate(@$RiwayatPendidikan['TMT_PENGAKTIFAN']); ?>" name="TMT_PENGAKTIFAN" class="datepicker" /></td></tr>
									<tr id="CntIpk">
										<td>IPK</td>
										<td>
											<input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPendidikan['IPK']; ?>" name="IPK" class="float" />
											<div>Gunakan tanda titik '.' sebagai pengganti tanda koma ','</div>
										</td></tr>
									<tr>
										<td>Tahun Lulus</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPendidikan['THN_LULUS']; ?>" name="THN_LULUS" class="integer" /></td></tr>
									<tr id="CntAsalPT">
										<td>Asal PT memperoleh pendidikan S3</td>
										<td><select style="width: 150px;" name="K_ASAL_PT_S3DIKTI"><?php echo GetOption(false, $ArrayAsalPerguruanTinggi, $RiwayatPendidikan['K_ASAL_PT_S3DIKTI']); ?></select></td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatPendidikan['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatPendidikan']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitRiwayatPendidikan();</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($RiwayatPendidikan['Certificate'])) {
                                    $Extention = GetExtention($RiwayatPendidikan['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatPendidikan['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative" style="padding: 0 0 10px 0;">
                                            <a href="'.$RiwayatPendidikan['Certificate'].'">'.$ImageHtml.'</a>
                                            <div class="position"><img src="'.HOST.'/images/Delete.png" class="cursor" /></div>
                                        </div>';
                                } else {
                                    echo '&nbsp;';
                                }
                                
                                if (!empty($RiwayatPendidikan['Transkrip'])) {
                                    $Extention = GetExtention($RiwayatPendidikan['Transkrip']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatPendidikan['Transkrip'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative" style="padding: 0 0 10px 0;">
                                            <a href="'.$RiwayatPendidikan['Transkrip'].'">'.$ImageHtml.'</a>
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