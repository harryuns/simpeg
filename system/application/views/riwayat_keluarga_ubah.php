<?php
	$ArrayJenisKelamin = $this->ljenis_kelamin->GetArrayJenisKelamin();
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
                        if ($RiwayatKeluarga['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatKeluarga['ShowGrid'] == '1' && count($ArrayRiwayatKeluarga) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 1200px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 125px;">Nama</td>
                                                <td class="normal" style="width: 150px;">Hub. Keluarga</td>
                                                <td class="normal" style="width: 125px;">Tanggal Lahir</td>
                                                <td class="normal" style="width: 150px;">Tempat Lahir</td>
                                                <td class="normal" style="width: 150px;">Pendidikan</td>
                                                <td class="normal" style="width: 150px;">Alamat</td>
                                                <td class="normal" style="width: 150px;">Pekerjaan</td>
                                                <td class="normal" style="width: 150px;">Keterangan</td>
											</tr>';
                                foreach ($ArrayRiwayatKeluarga as $Key => $Array) {
									$Alamat = (empty($Array['ALAMAT'])) ? '&nbsp;' : $Array['ALAMAT'];
									$TempatLahir = (empty($Array['TMP_LAHIR'])) ? '&nbsp;' : $Array['TMP_LAHIR'];
									$Jenjang = (empty($ArrayJenjang[$Array['K_JENJANG']]['Content'])) ? '&nbsp;' : $ArrayJenjang[$Array['K_JENJANG']]['Content'];
									$HubunganKeluarga = (empty($ArrayHubunganKeluarga[$Array['K_KELUARGA']]['Content'])) ? '&nbsp;' : $ArrayHubunganKeluarga[$Array['K_KELUARGA']]['Content'];
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.ucwords($Array['NAMA']).'</td>
                                            <td class="body">'.$HubunganKeluarga.'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_LAHIR']).'</td>
                                            <td class="body">'.$TempatLahir.'</td>
                                            <td class="body">'.$Jenjang.'</td>
                                            <td class="body">'.$Alamat.'</td>
                                            <td class="body">'.$Array['PEKERJAAN'].'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                        </tr>';
                                }
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($RiwayatKeluarga['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatKeluarga['Message']; ?></div>
                        <?php } ?>
                        
                        <form method="post" action="<?php echo $Pegawai['LinkRiwayatKeluarga']; ?>">
                        <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatKeluarga['ParameterUpdate']; ?>" />
                        <table style="width: 100%;">
                            <tr><td colspan="2" style="">
                                <input type="submit" name="Tambah" value="Tambah" />
                            </td></tr>
                        </table>
                        </form>
                        <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                        <script type="text/javascript">InitRiwayatKeluarga();</script>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatKeluarga">
                            <?php if (!empty($RiwayatKeluarga['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatKeluarga['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatKeluarga']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatKeluarga['ParameterUpdate']; ?>" />
                            <input type="hidden" name="KeluargaID" value="<?php echo $RiwayatKeluarga['KeluargaID']; ?>" />
                            <table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
                                <tr>
                                    <td>NAMA</td>
                                    <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatKeluarga['NAMA']; ?>" name="NAMA" class="required" alt="Silahkan memasukkan Nama" /></td></tr>
                                <tr>
                                    <td style="width: 200px;">Hubungan Keluarga</td>
                                    <td style="width: 300px;"><select style="width: 150px;" name="K_KELUARGA"><?php echo GetOption(false, $ArrayHubunganKeluarga, $RiwayatKeluarga['K_KELUARGA']); ?></select></td></tr>
                                <tr class="CntTanggalNikah">
                                    <td>Kartu Nikah</td>
                                    <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatKeluarga['KARTU_NIKAH']; ?>" name="KARTU_NIKAH"></td></tr>
                                <tr class="CntTanggalNikah">
                                    <td>Tanggal Nikah</td>
                                    <td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatKeluarga['TGL_NIKAH']); ?>" name="TGL_NIKAH" class="datepicker" /></td></tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatKeluarga['TMP_LAHIR']; ?>" name="TMP_LAHIR"></td></tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><select style="width: 150px;" name="KELAMIN"><?php echo GetOption(false, $ArrayJenisKelamin, $RiwayatKeluarga['KELAMIN']); ?></select></td></tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatKeluarga['TGL_LAHIR']); ?>" name="TGL_LAHIR" class="required datepicker" alt="Silahkan memasukkan Tanggal Lahir" /></td></tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatKeluarga['ALAMAT']; ?>" name="ALAMAT"></td></tr>
                                <tr>
                                    <td>Pendidikan Terakhir</td>
                                    <td>
										<select style="width: 150px;" name="K_JENJANG"><?php echo GetOption(false, $ArrayJenjang, $RiwayatKeluarga['K_JENJANG']); ?></select>
										<input type="hidden" name="PENDIDIKAN_AKHIR" value="" />
									</td></tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatKeluarga['PEKERJAAN']; ?>" name="PEKERJAAN"></td></tr>
                                <tr>
                                    <td>Almarhum</td>
                                    <td><input type="checkbox" value="1" <?php echo ($RiwayatKeluarga['IS_ALM'] == 1) ? 'checked' : ''; ?> name="IS_ALM"></td></tr>
                                <tr>
                                    <td>Cerai</td>
                                    <td><input type="checkbox" value="1" <?php echo (@$RiwayatKeluarga['IS_CERAI'] == 1) ? 'checked' : ''; ?> name="IS_CERAI"></td></tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatKeluarga['KETERANGAN']; ?></textarea></td></tr>
                                <tr>
                                    <td colspan="2" style="padding: 10px 0;">
                                        <input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatKeluarga']; ?>" />
                                        <input type="reset" name="Reset" value="Reset" />
                                        <input type="submit" name="Submit" value="Save" />
                                    </td></tr>
                            </table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitRiwayatKeluarga();</script>
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