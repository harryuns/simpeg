<?php
//	print_r($ArrayStatusKerja);
//	print_r($Pegawai);
//	exit;
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
                    <div id="CntRightMid">
                        <div style="width: 550px;" id="FormPegawaiEntry">
                            <h1 style="padding: 0 0 10px 0;">Data Pegawai</h1>
                            
                            <?php if (!empty($Pegawai['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $Pegawai['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="IsUserFakultas" value="<?php echo $IsUserFakultas; ?>" />
                            <input type="hidden" name="IsNewPegawai" value="<?php echo $Pegawai['IsNewPegawai']; ?>" />
                            <input type="hidden" name="GAJI" value="<?php echo $Pegawai['GAJI']; ?>" />
                            <input type="hidden" name="MASA_KERJA_KESELURUHAN" value="<?php echo $Pegawai['MASA_KERJA_KESELURUHAN']; ?>" />
                            <input type="hidden" name="MASA_KERJA_GOLONGAN" value="<?php echo $Pegawai['MASA_KERJA_GOLONGAN']; ?>" />
                            <input type="hidden" name="K_NEGARA_ASAL" value="<?php echo $Pegawai['K_NEGARA_ASAL']; ?>" />
							
                            <input type="hidden" name="FILEKARPEG_BACKUP" value="<?php echo $Pegawai['FILEKARPEG']; ?>" />
                            <input type="hidden" name="FILEKTP_BACKUP" value="<?php echo $Pegawai['FILEKTP']; ?>" />
                                <table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
                                    <tr>
                                        <td style="width: 200px;">NIP</td>
                                        <td style="width: 300px;"><input type="text" style="width: 85%;" size="50" value="<?php echo $Pegawai['K_PEGAWAI']; ?>" name="K_PEGAWAI" class="integer" /></td></tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td><input type="text" style="width: 85%;" size="50" value="<?php echo $Pegawai['NAMA']; ?>" name="NAMA"></td></tr>
                                    <tr>
                                        <td>Tempat Lahir</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['TMP_LAHIR']; ?>" name="TMP_LAHIR"></td></tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($Pegawai['TGL_LAHIR']); ?>" name="TGL_LAHIR" class="datepicker" /></td></tr>
                                    <tr>
                                        <td>No KTP</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['KTP']; ?>" name="KTP" class="sk_char_wo_space" /></td></tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td><select style="width: 150px;" name="JENIS_KELAMIN"><?php echo GetOption(false, $ArrayJenisKelamin, $Pegawai['JENIS_KELAMIN']); ?></select></td></tr>
                                    <tr>
                                        <td>Gelar Depan</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['GLR_DPN']; ?>" name="GLR_DPN" class="NonInteger" /></td></tr>
                                    <tr>
                                        <td>Gelar Belakang</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['GLR_BLKG']; ?>" name="GLR_BLKG" class="NonInteger" /></td></tr>
                                    <tr>
                                        <td>Bidang Ilmu</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['BIDANG_ILMU']; ?>" name="BIDANG_ILMU" /></td></tr>
                                    <tr>
                                        <td>Alamat di Malang</td>
                                        <td><textarea name="ALAMAT" style="width: 85%; height: 75px;"><?php echo $Pegawai['ALAMAT']; ?></textarea></td></tr>
                                    <tr>
                                        <td>Propinsi Asal</td>
                                        <td><select style="width: 85%;" name="K_PROPINSI_ASAL"><?php echo GetOption(false, $ArrayPropinsi, $Pegawai['K_PROPINSI_ASAL']); ?></select></td></tr>
                                    <tr>
                                        <td>Kota Asal</td>
                                        <td><select style="width: 85%;" name="K_KOTA_ASAL"><?php echo GetOption(false, $ArrayKota, $Pegawai['K_KOTA_ASAL']); ?></select></td></tr>
                                    <tr>
                                        <td>Alamat Asal</td>
                                        <td>
											<textarea name="ALAMAT_ASAL" style="width: 85%; height: 75px;"><?php echo $Pegawai['ALAMAT_ASAL']; ?></textarea>
										</td></tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td><select style="width: 150px;" name="K_AGAMA"><?php echo GetOption(false, $ArrayAgama, $Pegawai['K_AGAMA']); ?></select></td></tr>
                                    <tr>
                                        <td>Status Kawin</td>
                                        <td><select style="width: 150px;" name="K_STATUS_KAWIN"><?php echo GetOption(false, $ArrayStatusKawin, $Pegawai['K_STATUS_KAWIN']); ?></select></td></tr>
                                    <tr>
                                        <td>No Telepon</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['TLP_RMH']; ?>" name="TLP_RMH" class="integer" /></td></tr>
                                    <tr>
                                        <td>No HP</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['NO_HP']; ?>" name="NO_HP" class="integer" /></td></tr>
                                    <tr>
                                        <td>Email UB</td>
                                        <td><input type="text" style="width: 85%;" size="50" value="<?php echo $Pegawai['EMAIL']; ?>" name="EMAIL" /></td></tr>                                    <tr>
                                    <tr>
                                        <td>No Odner</td>
                                        <td><input type="text" style="width: 85%;" size="50" value="<?php echo $Pegawai['NO_ODNER']; ?>" name="NO_ODNER"></td></tr>
                                    <tr>
                                        <td>Status Kerja</td>
                                        <td><select style="width: 85%;" name="K_STATUS_KERJA"><?php echo GetOption(false, $ArrayStatusKerja, $Pegawai['K_STATUS_KERJA']); ?></select></td></tr>
                                    <tr>
                                        <td>Jenis Kerja</td>
                                        <td><select style="width: 85%;" name="K_JENIS_KERJA"><?php echo GetOption(false, $ArrayJenisKerja, $Pegawai['K_JENIS_KERJA']); ?></select></td></tr>
                                    <tr id="CntStatusDosen">
                                        <td>Status Dosen</td>
                                        <td><select style="width: 85%;" name="K_STATUS_DOSEN"><?php echo GetOption(false, $ArrayStatusDosen, $Pegawai['K_STATUS_DOSEN']); ?></select></td></tr>
                                    <tr id="CntNidn">
                                        <td>NIDN</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['NIDN']; ?>" name="NIDN" class="integer" /></td></tr>
                                    <tr>
                                        <td>Tahun Masuk</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['THN_MASUK']; ?>" name="THN_MASUK" class="integer" /></td></tr>
                                    <tr>
                                        <td>Gaji Pokok</td>
                                        <td><?php echo $Pegawai['GAJI']; ?></td></tr>
                                    <tr>
                                        <td>Masa Kerja Keseluruhan</td>
                                        <td><?php echo $Pegawai['MASA_KERJA_KESELURUHAN']; ?></td></tr>
                                    <tr id="CntMasaKerjaGolongan">
                                        <td>Masa Kerja Golongan</td>
                                        <td><?php echo $Pegawai['MASA_KERJA_GOLONGAN']; ?></td></tr>
                                    <tr id="CntNoSkCpns">
                                        <td>NO SK CPNS</td>
                                        <td>
											<?php echo $Pegawai['SK_CPNS']; ?>
											<input type="hidden" style="width: 150px;" size="50" value="<?php echo $Pegawai['SK_CPNS']; ?>" name="SK_CPNS">
										</td></tr>
                                    <tr id="CntTmtCpns">
                                        <td>TMT CPNS</td>
                                        <td>
											<?php echo ChangeFormatDate($Pegawai['TMT_CPNS']); ?>
											<input type="hidden" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($Pegawai['TMT_CPNS']); ?>" name="TMT_CPNS" />
										</td></tr>
                                    <tr id="CntNoSkPns">
                                        <td>NO SK PNS</td>
                                        <td>
											<?php echo $Pegawai['SK_PNS']; ?>
											<input type="hidden" style="width: 150px;" size="50" value="<?php echo $Pegawai['SK_PNS']; ?>" name="SK_PNS">
										</td></tr>
                                    <tr id="CntTmtPns">
                                        <td>TMT PNS</td>
                                        <td>
											<?php echo ChangeFormatDate($Pegawai['TMT_PNS']); ?>
											<input type="hidden" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($Pegawai['TMT_PNS']); ?>" name="TMT_PNS" />
										</td></tr>
                                    <tr id="CntNik">
                                        <td>NIK</td>
                                        <td>
                                            <input type="text" style="width: 150px;" size="50" value="<?php echo $Pegawai['NIK']; ?>" name="NIK" class="sk_char_wo_space" />
                                            <img class="Info" title="Harap diisikan bagi CPNS/PNS yang sebelumnya adalah honorer" src="<?php echo HOST; ?>/images/Info.png" />
                                        </td></tr>
                                    <tr id="CntKarpeg" style="display: none;">
                                        <td valign="top">Karpeg</td>
                                        <td>
                                            <div><input type="text" style="width: 85%;" size="50" value="<?php echo $Pegawai['KARPEG']; ?>" name="KARPEG" class="sk_char_wo_space" /></div>
                                            <div>Jika tidak ada data karpeg silahkan diisi sama dengan NIP</div>
                                        </td></tr>
                                    <tr id="CntNira">
                                        <td valign="top">NIRA</td>
                                        <td>
                                            <div><input type="text" style="width: 85%;" size="50" value="<?php echo $Pegawai['NIRA']; ?>" name="NIRA" maxlength="24" /></div>
                                            <div>khusus bagi dosen yang sebagai asesor</div>
                                        </td></tr>
                                    <tr style="display: none;">
                                        <td>Nip Lama</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo @$Pegawai['NIPLAMA']; ?>" name="NIPLAMA" /></td></tr>
									<tr style="display: none;">
										<td>Taspen</td>
										<td><input type="checkbox" value="1" <?php echo (@$Pegawai['ISTASPEN'] == 1) ? 'checked' : ''; ?> name="ISTASPEN"></td></tr>
                                    <tr style="display: none;">
                                        <td>Instansi Awal</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo @$Pegawai['INSTASIASAL']; ?>" name="INSTASIASAL" /></td></tr>
                                    <tr style="display: none;">
                                        <td>NPWP</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo @$Pegawai['NPWP']; ?>" name="NPWP" /></td></tr>
                                    <tr>
                                        <td>Foto</td>
                                        <td><input type="file" name="Image"></td></tr>
                                    <tr>
                                        <td>File KTP</td>
                                        <td><input type="file" name="FILEKTP"></td></tr>
                                    <tr>
                                        <td>File Karpeg</td>
                                        <td><input type="file" name="FILEKARPEG"></td></tr>
                                    <tr>
                                        <td colspan="2" style="padding: 10px 0;">
                                            <input type="reset" name="Reset" value="Reset" />
                                            <input type="submit" name="Submit" value="Save" />
											<?php if (isset($Pegawai['LinkCetak']) && !empty($Pegawai['LinkCetak']) && !empty($Pegawai['K_PEGAWAI'])) { ?>
												<input type="button" name="Print" value="Cetak" class="link" alt="<?php echo $Pegawai['LinkCetak']; ?>" />
											<?php } ?>
                                        </td></tr>
                                </table>
                            </form>
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitPegawai();</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 50px 0 0 0;">
                            <?php
                                if (!empty($Pegawai['Foto'])) {
                                    $Extention = GetExtention($Pegawai['Foto']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$Pegawai['Foto'].'" class="portrait" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$Pegawai['Foto'].'">'.$ImageHtml.'</a>
                                            <div class="position"><img src="'.HOST.'/images/Delete.png" class="cursor" /></div>
                                        </div>';
                                } else {
                                    echo '&nbsp;';
                                }
                            ?>
							
							<?php if (!empty($Pegawai['FILEKTP'])) { ?>
								<div style="padding: 10px 0 0 0;"><a href="<?php echo $Pegawai['LINK_FILEKTP']; ?>">
									<img src="<?php echo $Pegawai['LINK_FILEKTP']; ?>" class="portrait" title="File KTP" />
								</a></div>
							<?php } ?>
							<?php if (!empty($Pegawai['FILEKARPEG'])) { ?>
								<div style="padding: 10px 0 0 0;"><a href="<?php echo $Pegawai['LINK_FILEKARPEG']; ?>">
									<img src="<?php echo $Pegawai['LINK_FILEKARPEG']; ?>" class="portrait" title="File Karpeg" />
								</a></div>
							<?php } ?>
                            <script type="text/javascript">InitDeleteImage()</script>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>