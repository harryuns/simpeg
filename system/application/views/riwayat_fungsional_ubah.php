<?php
	$array_jabatan_pekerjaan = $this->jabatan_pekerjaan_model->get_array();
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
                        if ($RiwayatFungsional['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatFungsional['ShowGrid'] == '1' && count($ArrayRiwayatFungsional) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 1400px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No SK</td>
                                                <td class="normal" style="width: 200px;">Jabatan Fungsional</td>
												<td class="normal" style="width: 200px;">Unit Kerja</td>
                                                <td class="normal" style="width: 150px;">Tanggal SK</td>
                                                <td class="normal" style="width: 225px;">Asal SK</td>
                                                <td class="normal" style="width: 150px;">TMT</td>
                                                <td class="normal" style="width: 100px;">Angka Kredit</td>
                                                <td class="normal" style="width: 200px;">Keterangan</td>
                                                <td class="normal" style="width: 50px;">SK</td></tr>';
                                foreach ($ArrayRiwayatFungsional as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.$Array['JAB_FUNGSIONAL'].'</td>
											<td class="body">'.$Array['UNIT_KERJA'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SK']).'</td>
                                            <td class="body">'.$Array['ASAL_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TMT']).'</td>
                                            <td class="body">'.$Array['ANGKA_KREDIT'].'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                            <td class="body">'.$FileLinkInfo.'</td></tr>';
                                }
								
                                echo '
                                        </table>
                                    </div>
                                    <script type="text/javascript">InitTable();</script>
                                ';
                            }
                        ?>
                        
                        <?php if (!empty($RiwayatFungsional['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatFungsional['Message']; ?></div>
                        <?php } ?>
                        
                        <div style="width: 500px;" id="FormRiwayatFungsional">
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatFungsional']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatFungsional['ParameterUpdate']; ?>" />
                            <table style="width: 100%;"><tr><td colspan="2" style=""><input type="submit" name="Tambah" value="Tambah" /></td></tr></table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitRiwayatFungsional();</script>
                        </div>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatFungsional">
                            <?php if (!empty($RiwayatFungsional['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatFungsional['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatFungsional']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="RiwayatJabatanFungsional" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatFungsional['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatFungsional['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SK_HI" value="<?php echo ConvertLink($RiwayatFungsional['NO_SK']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td style="width: 200px;">No SK</td>
										<td style="width: 300px;"><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatFungsional['NO_SK']; ?>" name="NO_SK" class="sk_char" /></td></tr>
									<tr>
										<td>Tanggal SK</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatFungsional['TGL_SK']); ?>" name="TGL_SK" class="datepicker" /></td></tr>
									<tr>
										<td>Asal SK</td>
										<td><select style="width: 85%;" name="K_ASAL_SK"><?php echo GetOption(false, $ArrayAsalSk, $RiwayatFungsional['K_ASAL_SK']); ?></select></td></tr>
									<tr>
										<td>TMT</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatFungsional['TMT']); ?>" name="TMT" class="datepicker" /></td></tr>
									<tr>
										<td>Unit Kerja</td>
										<td>
											<input type="hidden" name="K_UNIT_KERJA" value="<?php echo @$RiwayatFungsional['K_UNIT_KERJA']; ?>" />
											<input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatFungsional['UNIT_KERJA']; ?>" class="unit-kerja" readonly="readonly" />
											<input type="button" style="width: 75px;" class="show_unitkerja" data-target=".unit-kerja" value="Ubah" />
										</td></tr>
									<tr>
										<td>Jabatan Fungsional</td>
										<td><select style="width: 150px;" name="K_JABATAN_FUNGSIONAL"><?php echo GetOption(false, $ArrayJabatanFungsional, $RiwayatFungsional['K_JABATAN_FUNGSIONAL']); ?></select></td></tr>
									<tr id="CntBidangIlmu">
										<td>Bidang Ilmu</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatFungsional['BIDANG_ILMU']; ?>" name="BIDANG_ILMU" /></td></tr>
									<tr>
										<td style="width: 200px;">Jabatan Pekerjaan</td>
										<td style="width: 300px;"><select style="width: 85%;" name="JABATAN_LAIN">
											<?php echo ShowOption(array( 'Array' => $array_jabatan_pekerjaan, 'ArrayID' => 'K_JABATAN_PEKERJAAN', 'ArrayTitle' => 'CONTENT', 'Selected' => $RiwayatFungsional['JABATAN_LAIN'] )); ?>
										</select></td>
									</tr>
									<tr>
										<td>Penandatangan SK</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatFungsional['PENANDATANGAN_SK']; ?>" name="PENANDATANGAN_SK" /></td></tr>
									<tr class="hidden">
										<td colspan="2">
											<div style="padding: 0pt 0pt 10px;">Jabatan Fungsional yang dipegang</div>
											<table cellspacing="0" cellpadding="5" border="0" class="tabel" style="width: 100%; background: none repeat scroll 0% 0% transparent; border: 2px solid rgb(180, 212, 224);"><tbody>
												<tr>
													<td style="width: 202px;">Jenjang</td>
													<td><select style="width: 85%;" name="K_JENJANG"><?php echo GetOption(false, $ArrayJenjang, $RiwayatFungsional['K_JENJANG']); ?></select></td></tr>
												<tr>
													<td>Fakultas</td>
													<td><select style="width: 85%;" name="K_FAKULTAS"><?php echo GetOption(false, $ArrayFakultas, $RiwayatFungsional['K_FAKULTAS']); ?></select></td></tr>
												<tr>
													<td>Jurusan</td>
													<td><select style="width: 85%;" name="K_JURUSAN"><?php echo GetOption(false, $ArrayJurusan, $RiwayatFungsional['K_JURUSAN']); ?></select></td></tr>
												<tr>
													<td>Program Studi</td>
													<td><select style="width: 85%;" name="K_PROG_STUDI"><?php echo GetOption(false, $ArrayProgramStudi, $RiwayatFungsional['K_PROG_STUDI']); ?></select></td></tr>
											</tbody></table>
										</td></tr>
									<tr>
										<td>Tunjangan Fungsional</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatFungsional['TUNJANGAN_FUNGSIONAL']; ?>" name="TUNJANGAN_FUNGSIONAL" class="integer" /></td></tr>
									<tr>
										<td>Angka Kredit</td>
										<td>
											<input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatFungsional['ANGKA_KREDIT']; ?>" name="ANGKA_KREDIT" maxlength="10" class="" />
											<div>Gunakan tanda titik '.' sebagai pengganti tanda koma ','</div>
										</td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatFungsional['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatFungsional']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitRiwayatFungsional();</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($RiwayatFungsional['Certificate'])) {
                                    $Extention = GetExtention($RiwayatFungsional['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatFungsional['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$RiwayatFungsional['Certificate'].'">'.$ImageHtml.'</a>
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
	
	<?php $this->load->view('common/form_unit_kerja'); ?>
</body>
</html>