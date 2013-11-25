<?php
	$array_asal_sk = $this->lasal_sk->GetArrayAsalSk();
	
//	print_r($RiwayatPenghargaan); exit;
//	print_r($ArrayRiwayatPenghargaan); exit;
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
                        if ($RiwayatPenghargaan['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatPenghargaan['ShowGrid'] == '1' && count($ArrayRiwayatPenghargaan) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 950px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No SK</td>
                                                <td class="normal" style="width: 150px;">Tanggal SK</td>
                                                <td class="normal" style="width: 200px;">Asal SK</td>
                                                <td class="normal" style="width: 200px;">Nama Penghargaan</td>
                                                <td class="normal" style="width: 200px;">Keterangan</td>
                                                <td class="normal" style="width: 50px;">SK</td></tr>';
                                foreach ($ArrayRiwayatPenghargaan as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SK']).'</td>
                                            <td class="body">'.@$Array['PEMBERI'].'</td>
                                            <td class="body">'.$Array['NAMA_PENGHARGAAN'].'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                            <td class="body">'.$FileLinkInfo.'</td></tr>';
                                }
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($RiwayatPenghargaan['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatPenghargaan['Message']; ?></div>
                        <?php } ?>
                        
                        <form method="post" action="<?php echo $Pegawai['LinkRiwayatPenghargaan']; ?>">
                        <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatPenghargaan['ParameterUpdate']; ?>" />
                        <table style="width: 100%;">
                            <tr><td colspan="2" style="">
                                <input type="submit" name="Tambah" value="Tambah" />
                            </td></tr>
                        </table>
                        </form>
                        <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                        <script type="text/javascript">InitRiwayatPenghargaan();</script>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatPenghargaan">
                            <?php if (!empty($RiwayatPenghargaan['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatPenghargaan['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatPenghargaan']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="RiwayatPenghargaan" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatPenghargaan['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatPenghargaan['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SK_HI" value="<?php echo ConvertLink($RiwayatPenghargaan['NO_SK']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td>No SK</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPenghargaan['NO_SK']; ?>" name="NO_SK" class="sk_char" /></td></tr>
									<tr>
										<td>Tanggal SK</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatPenghargaan['TGL_SK']); ?>" name="TGL_SK" class="datepicker" /></td></tr>
									<tr class="hidden">
										<td style="width: 200px;">Asal SK</td>
										<td style="width: 300px;"><select style="width: 85%;" name="K_ASAL_SK">
											<?php echo ShowOption(array('Array' => $array_asal_sk, 'ArrayID' => 'id', 'ArrayTitle' => 'Content', 'Selected' => (isset($RiwayatPenghargaan['K_ASAL_SK'])) ? $RiwayatPenghargaan['K_ASAL_SK'] : 99 )); ?>
										</select></td></tr>
									<tr class="cnt_pemberi">
										<td>Pemberi</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPenghargaan['PEMBERI']; ?>" name="PEMBERI"></td></tr>
									<tr class="hidden">
										<td style="width: 200px;">Jenis Penghargaan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPenghargaan['JENIS_PENGHARGAAN']; ?>" name="JENIS_PENGHARGAAN"></td></tr>
									<tr>
										<td>Nama Penghargaan</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPenghargaan['NAMA_PENGHARGAAN']; ?>" name="NAMA_PENGHARGAAN"></td></tr>
									<tr>
										<td>Pejabat Pemberi</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatPenghargaan['JABATAN_PEMBERI']; ?>" name="JABATAN_PEMBERI"></td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatPenghargaan['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatPenghargaan']; ?>" />
											<input type="reset" name="Reset" value="Reset" />
											<input type="submit" name="Submit" value="Save" />
										</td></tr>
								</table>
                            </form>
                            <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                        </div>
                    </div>
                    <div id="CntImage">
                        <div style="padding: 130px 0 0 0;">
                            <?php
                                if (!empty($RiwayatPenghargaan['Certificate'])) {
                                    $Extention = GetExtention($RiwayatPenghargaan['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatPenghargaan['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$RiwayatPenghargaan['Certificate'].'">'.$ImageHtml.'</a>
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
	<script type="text/javascript">
function InitRiwayatPenghargaan() {
    InitForm.Start('FormRiwayatPenghargaan');
    
	/*	
	$('[name="K_ASAL_SK"]').change(function() {
		var value = $('[name="K_ASAL_SK"]').val();
		if (value == '99') {
			$('.cnt_pemberi').show();
		} else {
			$('.cnt_pemberi').hide();
		}
	});
	$('[name="K_ASAL_SK"]').change();
	/*	*/
	
    $('#FormRiwayatPenghargaan form').submit(function() {
        // Validation
        var ArrayError = [];
        
        if ($('input[name="NO_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan No SK';
        }
        if ($('input[name="TGL_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal SK';
        }
        
        var Result = ShowWarning(ArrayError);
        
        return Result;
    });
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
    }
}

InitRiwayatPenghargaan();
	</script>
</body>
</html>