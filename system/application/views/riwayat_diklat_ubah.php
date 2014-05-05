<?php
//	print_r($ArrayRiwayatDiklat); exit;
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
                        if ($RiwayatDiklat['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatDiklat['ShowGrid'] == '1' && count($ArrayRiwayatDiklat) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 1300px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No Sertifikat</td>
                                                <td class="normal" style="width: 100px;">Tanggal SK</td>
                                                <td class="normal" style="width: 100px;">Diklat</td>
                                                <td class="normal" style="width: 200px;">Penyelenggara</td>
                                                <td class="normal" style="width: 100px;">Tempat Diklat</td>
                                                <td class="normal" style="width: 100px;">Angkatan</td>
                                                <td class="normal" style="width: 100px;">Tanggal Mulai</td>
                                                <td class="normal" style="width: 100px;">Tanggal Lulus</td>
                                                <td class="normal" style="width: 300px;">Keterangan</td>
                                                <td class="normal" style="width: 50px;">Sertifikat</td></tr>';
                                foreach ($ArrayRiwayatDiklat as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon">
                                                <a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon">
                                                <a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SERTIFIKAT'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SERTIFIKAT']).'</td>
                                            <td class="body">'.$ArrayDiklat[$Array['K_DIKLAT']]['Content'].'</td>
                                            <td class="body">'.$Array['PENYELENGGARA'].'</td>
                                            <td class="body">'.$Array['TMP_DIKLAT'].'</td>
                                            <td class="body">'.$Array['ANGKATAN'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_MULAI']).'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_LULUS']).'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                            <td class="body">'.$FileLinkInfo.'</td></tr>';
                                }
                                echo '</table></div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                            
                        <?php if (!empty($RiwayatDiklat['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatDiklat['Message']; ?></div>
                        <?php } ?>
                        
                        <div style="width: 500px;" id="FormRiwayatDiklat">
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatDiklat']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatDiklat['ParameterUpdate']; ?>" />
                            <table style="width: 100%;">
                            <tr><td colspan="2" style="">
                                <input type="submit" name="Tambah" value="Tambah" />
                            </td></tr>
                            </table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                        </div>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatDiklat">
                            <?php if (!empty($RiwayatDiklat['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatDiklat['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatDiklat']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="RiwayatDiklat" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatDiklat['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatDiklat['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SERTIFIKAT_HI" value="<?php echo ConvertLink($RiwayatDiklat['NO_SERTIFIKAT']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td>No Sertifikat</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatDiklat['NO_SERTIFIKAT']; ?>" name="NO_SERTIFIKAT" class="required sk_char" alt="Silahkan memasukkan No Sertifikat" /></td></tr>
									<tr>
										<td>Tanggal Sertifikat</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatDiklat['TGL_SERTIFIKAT']); ?>" name="TGL_SERTIFIKAT" class="datepicker" /></td></tr>
									<tr>
										<td style="width: 200px;">Diklat</td>
										<td style="width: 300px;">
											<select style="width: 150px;" name="K_DIKLAT"><?php echo GetOption(false, $ArrayDiklat, $RiwayatDiklat['K_DIKLAT']); ?></select>
											<input type="text" style="width: 125px;" size="50" value="<?php echo @$RiwayatDiklat['DIKLAT_NAMA']; ?>" name="DIKLAT_NAMA" class="hidden" />
										</td></tr>
									<tr>
										<td>Penyelenggara</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatDiklat['PENYELENGGARA']; ?>" name="PENYELENGGARA"></td></tr>
									<tr>
										<td>Nama Diklat</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatDiklat['NAMA_DIKLAT']; ?>" name="NAMA_DIKLAT" /></td></tr>
									<tr>
										<td>Tempat Diklat</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatDiklat['TMP_DIKLAT']; ?>" name="TMP_DIKLAT"></td></tr>
									<tr>
										<td>Angkatan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatDiklat['ANGKATAN']; ?>" name="ANGKATAN"></td></tr>
									<tr>
										<td>Tanggal Mulai</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatDiklat['TGL_MULAI']); ?>" name="TGL_MULAI" class="datepicker" /></td></tr>
									<tr>
										<td>Tanggal Lulus</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatDiklat['TGL_LULUS']); ?>" name="TGL_LULUS" class="datepicker" /></td></tr>
									<tr>
										<td>Jumlah Jam</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatDiklat['JUMLAH_JAM']; ?>" name="JUMLAH_JAM" class="integer" /></td></tr>
									<tr>
										<td>Predikat</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatDiklat['PREDIKAT']; ?>" name="PREDIKAT" /></td></tr>
									<tr>
										<td>Diklat Luar Negeri</td>
										<td><input type="checkbox" value="1" <?php echo (@$RiwayatDiklat['IS_LUARNEGERI'] == 1) ? 'checked' : ''; ?> name="IS_LUARNEGERI"></td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatDiklat['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatDiklat']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
							<script type="text/javascript">
function InitRiwayatDiklat() {
    InitForm.Start('FormRiwayatDiklat');
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
    }
	
    $('select[name="K_DIKLAT"]').change(function() {
		var value = $('select[name="K_DIKLAT"]').val();
		(value == '99') ? $('input[name="DIKLAT_NAMA"]').show() : $('input[name="DIKLAT_NAMA"]').hide();
	});
	$('select[name="K_DIKLAT"]').change();
    
    $('#FormRiwayatDiklat form').submit(function() {
        var ArrayError = InitForm.Validation('FormRiwayatDiklat');
        
        var TGL_MULAI = InitForm.GetTimeFromString($('input[name="TGL_MULAI"]').val());
        var TGL_LULUS = InitForm.GetTimeFromString($('input[name="TGL_LULUS"]').val());
        if (TGL_MULAI > TGL_LULUS) {
            ArrayError[ArrayError.length] = 'Tanggal Mulai harus lebih kecil daripada Tanggal Lulus';
        }
        
        return ShowWarning(ArrayError);
    });
}

InitRiwayatDiklat();
							</script>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($RiwayatDiklat['Certificate'])) {
                                    $Extention = GetExtention($RiwayatDiklat['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatDiklat['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$RiwayatDiklat['Certificate'].'">'.$ImageHtml.'</a>
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