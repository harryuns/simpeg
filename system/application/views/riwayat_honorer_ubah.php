<?php
//	print_r($ArrayRiwayatHonorer); exit;
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
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatHonorer['ShowGrid'] == '1' && count($ArrayRiwayatHonorer) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
										<table style="width: 750px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No SK</td>
                                                <td class="normal" style="width: 125px;">Tanggal SK</td>
                                                <td class="normal" style="width: 225px;">Asal SK</td>
                                                <td class="normal" style="width: 225px;">Unit Kerja</td>
                                                <td class="normal" style="width: 50px;">SK</td></tr>';
                                foreach ($ArrayRiwayatHonorer as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SK']).'</td>
                                            <td class="body">'.$ArrayAsalSk[$Array['K_ASAL_SK']]['Content'].'</td>
                                            <td class="body">'.$ArrayUnitKerja[$Array['K_UNIT_KERJA']]['Content'].'</td>
                                            <td class="body">'.$FileLinkInfo.'</td>
                                        </tr>';
                                }
                                echo '
                                    </table></div>
                                    <script type="text/javascript">InitTable();</script>';
                            }
                        ?>
                    
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatHonorer">
                            <?php if (!empty($RiwayatHonorer['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatHonorer['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatHonorer']; ?>">
								<input type="hidden" name="FormName" value="RiwayatHonorer" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatHonorer['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatHonorer['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SK_HI" value="<?php echo ConvertLink($RiwayatHonorer['NO_SK']); ?>" />
								
								<?php
									if ((isset($_POST['Tambah']) && !empty($_POST['Tambah']))
										|| ($RiwayatHonorer['Error'] == '00001')
										|| (!empty($RiwayatHonorer['NO_SK'])) ) {
								?>
								
                                <table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
                                    <tr>
                                        <td>No SK</td>
                                        <td><input type="text" style="width: 85%;" size="50" value="<?php echo $RiwayatHonorer['NO_SK']; ?>" name="NO_SK" class="sk_char" /></td></tr>
                                    <tr>
                                        <td>Tanggal SK</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatHonorer['TGL_SK']); ?>" name="TGL_SK" class="datepicker" /></td></tr>
                                    <tr>
                                        <td style="width: 200px;">Asal SK</td>
                                        <td style="width: 300px;"><select style="width: 85%;" name="K_ASAL_SK"><?php echo GetOption(false, $ArrayAsalSk, $RiwayatHonorer['K_ASAL_SK']); ?></select></td></tr>
                                    <tr>
                                        <td>TMT</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatHonorer['TMT']); ?>" name="TMT" class="datepicker" /></td></tr>
                                    <tr>
                                        <td style="width: 200px;">Unit Kerja</td>
                                        <td style="width: 300px;">
											<input type="hidden" name="K_UNIT_KERJA" value="<?php echo @$RiwayatHonorer['K_UNIT_KERJA']; ?>" />
											<input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatHonorer['UNIT_KERJA']; ?>" class="unit-kerja" readonly="readonly" />
											<input type="button" style="width: 75px;" class="show_unitkerja" data-target=".unit-kerja" value="Ubah" />
										</td></tr>
                                    <tr>
                                        <td style="width: 200px;">Bidang Kerja</td>
                                        <td style="width: 300px;">
											<select style="width: 130px;" name="K_BIDANG_KERJA"><?php echo GetOption(false, $ArrayBidangKerja, $RiwayatHonorer['K_BIDANG_KERJA']); ?></select>
											<span class="CntBidangKerja"><input type="text" style="width: 130px;" size="50" value="<?php echo $RiwayatHonorer['BIDANG_KERJA']; ?>" name="BIDANG_KERJA" class="" /></span>
									</td></tr>
                                    <tr>
                                        <td style="width: 200px;">Jenjang</td>
                                        <td style="width: 300px;"><select style="width: 85%;" name="K_JENJANG"><?php echo GetOption(false, $ArrayJenjang, $RiwayatHonorer['K_JENJANG']); ?></select></td></tr>
                                    <tr>
                                        <td style="width: 200px;">Fakultas</td>
                                        <td style="width: 300px;"><select style="width: 85%;" name="K_FAKULTAS"><?php echo GetOption(false, $ArrayFakultas, $RiwayatHonorer['K_FAKULTAS']); ?></select></td></tr>
                                    <tr>
                                        <td style="width: 200px;">Jurusan</td>
                                        <td style="width: 300px;"><select style="width: 85%;" name="K_JURUSAN"><?php echo GetOption(false, $ArrayJurusan, $RiwayatHonorer['K_JURUSAN']); ?></select></td></tr>
                                    <tr>
                                        <td style="width: 200px;">Program Studi</td>
                                        <td style="width: 300px;"><select style="width: 85%;" name="K_PROG_STUDI"><?php echo GetOption(false, $ArrayProgramStudi, $RiwayatHonorer['K_PROG_STUDI']); ?></select></td></tr>
                                    <tr>
                                        <td>Gaji Kontrak</td>
                                        <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatHonorer['GAJI']; ?>" name="GAJI" class="integer" /></td></tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatHonorer['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
                                    <tr>
                                        <td colspan="2" style="padding: 10px 0;">
                                            <input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatHonorer']; ?>" />
                                            <input type="reset" name="Reset" value="Reset" />
                                            <input type="submit" name="Submit" value="Save" />
                                        </td></tr>
                                </table>
                            <?php
                                } else {
                            ?>
                                <table style="width: 100%;">
                                    <tr>
                                        <td colspan="2" style="">
                                            <input type="submit" name="Tambah" value="Tambah" />
                                        </td></tr>
                                </table>
                            <?php
                                }
                            ?>
                            </form>
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
<script type="text/javascript">
function InitRiwayatHonorer() {
    InitForm.Start('FormRiwayatHonorer');
    
    var ComboBox = {
        Fakultas: function() {
            var Object = {
                Action: 'GetFakultasByJenjang',
                K_JENJANG : $('select[name="K_JENJANG"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Fakultas", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_FAKULTAS"]').html(ContentHtml);
                    ComboBox.Jurusan();
                }
            });
        },
        Jurusan: function() {
            var Object = {
                Action: 'GetJurusanById',
                K_JENJANG : $('select[name="K_JENJANG"]').val(),
                K_FAKULTAS : $('select[name="K_FAKULTAS"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Jurusan", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_JURUSAN"]').html(ContentHtml);
                    ComboBox.ProgramStudy();
                }
            });
        },
        ProgramStudy: function() {
            var Object = {
                Action: 'GetProgramStudiById',
                K_JENJANG : $('select[name="K_JENJANG"]').val(),
                K_FAKULTAS : $('select[name="K_FAKULTAS"]').val(),
                K_JURUSAN : $('select[name="K_JURUSAN"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/ProgramStudi", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_PROG_STUDI"]').html(ContentHtml);
                }
            });
        },
		BidangKerja: function() {
			var value = $('select[name="K_BIDANG_KERJA"]').val();
			if (value == '99') {
				$('.CntBidangKerja').show();
			} else {
				$('.CntBidangKerja').hide();
			}
		}
    }
    
    $('select[name="K_JENJANG"]').change(function() { ComboBox.Fakultas(); });
    $('select[name="K_FAKULTAS"]').change(function() { ComboBox.Jurusan(); });
    $('select[name="K_JURUSAN"]').change(function() { ComboBox.ProgramStudy(); });
    $('select[name="K_BIDANG_KERJA"]').change(function() { ComboBox.BidangKerja(); });
	$('select[name="K_BIDANG_KERJA"]').change();
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
    }
    
    $('#FormRiwayatHonorer form').submit(function() {
        // Validation
        var ArrayError = [];
        
        if ($('input[name="NO_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan No SK';
        }
        if ($('input[name="TGL_SK"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal SK';
        }
        if ($('input[name="TMT"]').val() == '') {
            ArrayError[ArrayError.length] = 'Silahkan memasukkan Tanggal TMT';
        }
        
        return ShowWarning(ArrayError);
    });
}
InitRiwayatHonorer();
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<?php $this->load->view('common/form_unit_kerja'); ?>
</body>
</html>