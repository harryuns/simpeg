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
            </div>
            
            <div id="content">
            		<div class="contentmenu clearfix"><?php include 'main_sub_menu.php'; ?></div>
                <div class="full" style="min-height: 400px;">
                    <div id="CntRightMid">
                        <div id="FormPegawaiEntry">
                            <h1 style="padding: 0 0 10px 0;">Data Pegawai</h1>
                            
                            <?php if (!empty($Pegawai['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $Pegawai['Message']; ?></div>
                            <?php } ?>
                            
                            <div class="clearfix">
                            <form method="post" enctype="multipart/form-data" class="clearfix">
                            
                            <input type="hidden" name="IsUserFakultas" value="<?php echo $IsUserFakultas; ?>" />
                            <input type="hidden" name="IsNewPegawai" value="<?php echo $Pegawai['IsNewPegawai']; ?>" />
                            <input type="hidden" name="GAJI" value="<?php echo $Pegawai['GAJI']; ?>" />
                            <input type="hidden" name="MASA_KERJA_KESELURUHAN" value="<?php echo $Pegawai['MASA_KERJA_KESELURUHAN']; ?>" />
                            <input type="hidden" name="MASA_KERJA_GOLONGAN" value="<?php echo $Pegawai['MASA_KERJA_GOLONGAN']; ?>" />
                            <input type="hidden" name="K_NEGARA_ASAL" value="<?php echo $Pegawai['K_NEGARA_ASAL']; ?>" />
							
                            <input type="hidden" name="FILEKARPEG_BACKUP" value="<?php echo $Pegawai['FILEKARPEG']; ?>" />
                            <input type="hidden" name="FILEKTP_BACKUP" value="<?php echo $Pegawai['FILEKTP']; ?>" />
                            
                            <div class="form-block left">
                            
                            		<div class="form-row">
                                		<label>NIP :</label>
                                    <input style="width:280px" type="text" size="50" value="<?php echo $Pegawai['K_PEGAWAI']; ?>" name="K_PEGAWAI" class="integer" />
                                </div>
                            		<div class="form-row">
                                		<label>Nama</label>
                                    <input style="width:280px" type="text" size="50" value="<?php echo $Pegawai['NAMA']; ?>" name="NAMA">
                                </div>
                            		<div class="form-row">
                                		<label>Tempat Lahir</label>
                                    <input style="width:95px" type="text" size="50" value="<?php echo $Pegawai['TMP_LAHIR']; ?>" name="TMP_LAHIR">
                                    <label style="width:90px">Tanggal Lahir</label>
                                    <input style="width:70px" type="text" size="50" value="<?php echo ChangeFormatDate($Pegawai['TGL_LAHIR']); ?>" name="TGL_LAHIR" class="datepicker" />
                                </div>
                            		<div class="form-row">
                                		<label>No KTP</label>
                                    <input style="width:115px" type="text" size="50" value="<?php echo $Pegawai['KTP']; ?>" name="KTP" class="sk_char_wo_space" />
                                    <label style="width:92px">Jenis Kelamin</label>
                                    <select style="width: 60px;" name="JENIS_KELAMIN"><?php echo GetOption(false, $ArrayJenisKelamin, $Pegawai['JENIS_KELAMIN']); ?></select>
                                </div>
                            		<div class="form-row">
                                		<label>Gelar Depan</label>
                                    <input type="text" style="width: 100px;" size="50" value="<?php echo $Pegawai['GLR_DPN']; ?>" name="GLR_DPN" class="NonInteger" />
                                    <label style="width:55px">Belakang</label>
                                    <input type="text" style="width: 100px;" size="50" value="<?php echo $Pegawai['GLR_BLKG']; ?>" name="GLR_BLKG" class="NonInteger" />
                                </div>
                            		<div class="form-row">
                                		<label>Bidang Ilmu</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo $Pegawai['BIDANG_ILMU']; ?>" name="BIDANG_ILMU" />
                                </div>
                            		<div class="form-row">
                                		<label>Alamat di Malang</label>
                                    <textarea name="ALAMAT" style="width:280px ; height: 50px;"><?php echo $Pegawai['ALAMAT']; ?></textarea>
                                </div>
                                
                            		<div class="form-row">
                                		<label>Alamat Asal</label>
                                    <textarea name="ALAMAT_ASAL" style="width:280px ; height: 50px;"><?php echo $Pegawai['ALAMAT_ASAL']; ?></textarea>
                                </div>
                            		<div class="form-row">
                                		<label>Kota Asal</label>
                                    <select style="width:292px ;" name="K_KOTA_ASAL"><?php echo GetOption(false, $ArrayKota, $Pegawai['K_KOTA_ASAL']); ?></select>
                                </div>
                            		<div class="form-row">
                                		<label>Propinsi Asal</label>
                                    <select style="width:292px" name="K_PROPINSI_ASAL"><?php echo GetOption(false, $ArrayPropinsi, $Pegawai['K_PROPINSI_ASAL']); ?></select>
                                </div>
                            		<div class="form-row">
                                		<label>Agama</label>
                                    <select style="width: 90px;" name="K_AGAMA"><?php echo GetOption(false, $ArrayAgama, $Pegawai['K_AGAMA']); ?></select>
                                    <label style="width:92px;">Status Kawin :</label>
                                    <select style="width: 97px;" name="K_STATUS_KAWIN"><?php echo GetOption(false, $ArrayStatusKawin, $Pegawai['K_STATUS_KAWIN']); ?></select>
                                </div>
                            		<div class="form-row">
                                		<label>No Telepon</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo $Pegawai['TLP_RMH']; ?>" name="TLP_RMH" class="integer" />
                                </div>
                            		<div class="form-row">
                                		<label>No HP</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo $Pegawai['NO_HP']; ?>" name="NO_HP" class="integer" />
                                </div>
                            		<div class="form-row">
                                		<label>Email UB</label>
                                    <input type="text" style=" width: 280px;" size="50" value="<?php echo $Pegawai['EMAIL']; ?>" name="EMAIL" />
                                </div>
                            		<div class="form-row">
                                		<label>No Odner</label>
                                    <input type="text" style=" width: 280px;" size="50" value="<?php echo $Pegawai['NO_ODNER']; ?>" name="NO_ODNER">
                                </div>
                            		<div class="form-row">
                                		<label>Status Kerja</label>
                                    <select style=" width: 292px;" name="K_STATUS_KERJA"><?php echo GetOption(false, $ArrayStatusKerja, $Pegawai['K_STATUS_KERJA']); ?></select>
                                </div>
                            		<div class="form-row">
                                		<label>Jenis Kerja</label>
                                    <select style=" width: 292px;" name="K_JENIS_KERJA"><?php echo GetOption(false, $ArrayJenisKerja, $Pegawai['K_JENIS_KERJA']); ?></select>
                                </div>
                                <div class="form-row">
                                		<label>Status Dosen</label>
                                    <select style=" width: 292px;" name="K_STATUS_DOSEN"><?php echo GetOption(false, $ArrayStatusDosen, $Pegawai['K_STATUS_DOSEN']); ?></select>
                                </div>
                            		<div class="form-row">
                                		<label>NIDN</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo $Pegawai['NIDN']; ?>" name="NIDN" class="integer" />
                                </div>
                            		<div class="form-row">
                                		<label>Tahun Masuk</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo $Pegawai['THN_MASUK']; ?>" name="THN_MASUK" class="integer" />
                                </div>
                            </div>
                            
                            <div class="form-block left">
                            		
                            		<div class="form-row">
                                		<label>Gaji Pokok :</label>
                                    <em style="line-height:28px"><?php echo $Pegawai['GAJI']; ?></em>
                                </div>
                            		<div class="form-row">
                                		<label>Masa Kerja Keseluruhan :</label>
                                    <em style="line-height:28px"><?php echo $Pegawai['MASA_KERJA_KESELURUHAN']; ?></em>
                                </div>
                            		<div class="form-row">
                                		<label>Masa Kerja Golongan :</label>
                                    <em style="line-height:28px"><?php echo $Pegawai['MASA_KERJA_GOLONGAN']; ?></em>
                                </div>
                            		<div class="form-row">
                                		<label>NO SK CPNS :</label>
                                    <em style="line-height:28px"><?php echo $Pegawai['SK_CPNS']; ?></em>
											<input type="hidden" style="width: 150px;" size="50" value="<?php echo $Pegawai['SK_CPNS']; ?>" name="SK_CPNS">
                                </div>
                            		<div class="form-row">
                                		<label>TMT CPNS :</label>
                                    <em style="line-height:28px"><?php echo ChangeFormatDate($Pegawai['TMT_CPNS']); ?></em>
											<input type="hidden" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($Pegawai['TMT_CPNS']); ?>" name="TMT_CPNS" />
                                </div>
                            		<div class="form-row">
                                		<label>NO SK PNS</label>
                                    <?php echo $Pegawai['SK_PNS']; ?>
											<input type="hidden" style="width: 280px;" size="50" value="<?php echo $Pegawai['SK_PNS']; ?>" name="SK_PNS">
                                </div>
                            		<div class="form-row">
                                		<label>TMT PNS</label>
                                    <?php echo ChangeFormatDate($Pegawai['TMT_PNS']); ?>
											<input type="hidden" style="width: 280px;" size="50" value="<?php echo ChangeFormatDate($Pegawai['TMT_PNS']); ?>" name="TMT_PNS" />
                                </div>
                            		<div class="form-row">
                                		<label>NIK</label>
                                     <input type="text" style="width: 280px;" size="50" value="<?php echo $Pegawai['NIK']; ?>" name="NIK" class="sk_char_wo_space" />
                                            <img class="Info" title="Harap diisikan bagi CPNS/PNS yang sebelumnya adalah honorer" src="<?php echo base_url('images/Info.png'); ?>" style="width:20px;vertical-align:middle" />
                                </div>
                            		<div class="form-row">
                                		<label>Karpeg</label>
                                    <input type="text" style="width: 280px; ;" size="50" value="<?php echo $Pegawai['KARPEG']; ?>" name="KARPEG" class="sk_char_wo_space" />
                                    <small>Jika tidak ada data karpeg silahkan diisi sama dengan NIP</small>
                                </div>
                            		<div class="form-row">
                                		<label>NIRA</label>
                                    <input type="text" style="width: 280px; ;" size="50" value="<?php echo $Pegawai['NIRA']; ?>" name="NIRA" maxlength="24" />
                                    <small>khusus bagi dosen yang sebagai asesor</small>
                                </div>
                            		<div class="form-row">
                                		<label>Nip Lama</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo @$Pegawai['NIPLAMA']; ?>" name="NIPLAMA" />
                                </div>
                            		<div class="form-row">
                                		<label>Taspen</label>
                                    <input type="checkbox" value="1" <?php echo (@$Pegawai['ISTASPEN'] == 1) ? 'checked' : ''; ?> name="ISTASPEN">
                                </div>
                            		<div class="form-row">
                                		<label>Instansi Awal</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo @$Pegawai['INSTASIASAL']; ?>" name="INSTASIASAL" />
                                </div>
                            		<div class="form-row">
                                		<label>NPWP</label>
                                    <input type="text" style="width: 280px;" size="50" value="<?php echo @$Pegawai['NPWP']; ?>" name="NPWP" />
                                </div>
                            		<div class="form-row clearfix">
                                
                                		<div class="left">
                                    	<div class="clearfix">
                                      	<label class="left">File Karpeg</label>
                                        <div class="dPhoto left">
                                        <?php if (!empty($Pegawai['FILEKARPEG'])) { ?>
                                        <a href="<?php echo $Pegawai['LINK_FILEKARPEG']; ?>">
                                          <img src="<?php echo $Pegawai['LINK_FILEKARPEG']; ?>" class="portrait" title="File Karpeg" />
                                        </a>
                                      <?php } ?>
                                        <input type="file" name="FILEKARPEG">
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <div class="left">
                                		<div class="clearfix">
                                		<label class="left" style="width:60px">Foto</label>
                                    <div class="dPhoto left">
																				<?php
                                        if (!empty($Pegawai['Foto'])) {
                                            $Extention = GetExtention($Pegawai['Foto']);
                                            
                                            $ImageHtml = '';
                                            if ($Extention == 'pdf') {
                                                $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                            } else {
                                                $ImageHtml = '<img class="portrait" src="'.$Pegawai['Foto'].'" class="portrait" />';
                                            }
                                            
                                            echo '
                                                    <a href="'.$Pegawai['Foto'].'">'.$ImageHtml.'</a>
																										<img src="'.HOST.'/images/cross_button.png" class="cursor delete" />
                                                ';
                                        } else {
                                            echo '&nbsp;';
                                        }
                                        ?>
                                        
                                        <input type="file" name="Image">
                                    </div>
                                  	</div>
                                    </div>
                                </div>
                            		<div class="form-row clearfix">
                                		<label class="left">File KTP</label>
                                    <div class="dPhoto left">
                                    
                                    <?php if (!empty($Pegawai['FILEKTP'])) { ?>
                                      <a href="<?php echo $Pegawai['LINK_FILEKTP']; ?>">
                                        <img style="width:300px!important" src="<?php echo $Pegawai['LINK_FILEKTP']; ?>" class="portrait" title="File KTP" />
                                      </a>
                                    <?php } ?>
                                    
                                    <input type="file" name="FILEKTP">
                                    </div>
                                </div>
                            		<div class="form-row clearfix">
                                		
                                </div>
                                
                            		<div class="form-row">
                                		<label></label>
                                    <input type="reset" name="Reset" value="Reset" />
                                            <input type="submit" name="Submit" value="Save" />
											<?php if (isset($Pegawai['LinkCetak']) && !empty($Pegawai['LinkCetak']) && !empty($Pegawai['K_PEGAWAI'])) { ?>
												<input type="button" name="Print" value="Cetak" class="link" alt="<?php echo $Pegawai['LinkCetak']; ?>" />
											<?php } ?>
                                </div>
                            </div>
                            
                            
                            </form>
                            
                            </div>
                            
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">InitPegawai();</script>
                        </div>
                    </div>
                    <div id="CntImage" style="display:none">
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