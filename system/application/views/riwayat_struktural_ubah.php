<?php
//	print_r($ArrayFakultas);
//	print_r($RiwayatStruktural); exit;
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
                        if ($RiwayatStruktural['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($RiwayatStruktural['ShowGrid'] == '1' && count($ArrayRiwayatStruktural) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 1400px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 100px;">No SK</td>
                                                <td class="normal" style="width: 150px;">Tanggal SK</td>
                                                <td class="normal" style="width: 200px;">Asal SK</td>
                                                <td class="normal" style="width: 150px;">TMT</td>
                                                <td class="normal" style="width: 200px;">Unit Kerja</td>
                                                <td class="normal" style="width: 200px;">Jabatan Struktural</td>
                                                <td class="normal" style="width: 100px;">Tunjangan Struktural</td>
                                                <td class="normal" style="width: 200px;">Keterangan</td>
                                                <td class="normal" style="width: 50px;">SK</td></tr>';
                                foreach ($ArrayRiwayatStruktural as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SK']).'</td>
                                            <td class="body">'.$Array['ASAL_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TMT']).'</td>
                                            <td class="body">'.$Array['UNIT_KERJA'].'</td>
                                            <td class="body">'.$Array['JAB_STRUKTURAL'].'</td>
                                            <td class="body">'.$Array['TUNJANGAN_STRUKTURAL'].'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
											<td class="body">'.$FileLinkInfo.'</td></tr>';
                                }
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($RiwayatStruktural['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $RiwayatStruktural['Message']; ?></div>
                        <?php } ?>
                        
                        <form method="post" action="<?php echo $Pegawai['LinkRiwayatStruktural']; ?>">
                        <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatStruktural['ParameterUpdate']; ?>" />
                        <table style="width: 100%;"><tr><td colspan="2" style=""><input type="submit" name="Tambah" value="Tambah" /></td></tr></table>
                        </form>
                        <div id="DialogConfirm" title="Konfirmasi" style="display: none;"><p>&nbsp;</p></div>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatStruktural">
                            <?php if (!empty($RiwayatStruktural['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $RiwayatStruktural['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatStruktural']; ?>" enctype="multipart/form-data">
								<input type="hidden" name="FormName" value="RiwayatJabatanStruktural" />
								<input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatStruktural['ParameterUpdate']; ?>" />
								<input type="hidden" name="K_PEGAWAI_HI" value="<?php echo ConvertLink($RiwayatStruktural['K_PEGAWAI']); ?>" />
								<input type="hidden" name="NO_SK_HI" value="<?php echo ConvertLink($RiwayatStruktural['NO_SK']); ?>" />
								
								<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
									<tr>
										<td style="width: 200px;">No SK</td>
										<td style="width: 300px;"><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatStruktural['NO_SK']; ?>" name="NO_SK" class="sk_char" /></td></tr>
									<tr>
										<td>Tanggal SK</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatStruktural['TGL_SK']); ?>" name="TGL_SK" class="datepicker" /></td></tr>
									<tr>
										<td>Asal SK</td>
										<td><select style="width: 85%;" name="K_ASAL_SK"><?php echo GetOption(false, $ArrayAsalSk, $RiwayatStruktural['K_ASAL_SK']); ?></select></td></tr>
									<tr>
										<td>TMT</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatStruktural['TMT']); ?>" name="TMT" class="datepicker" /></td></tr>
									<tr class="hidden">
										<td>TMT Selesai</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($RiwayatStruktural['TMT_SELESAI']); ?>" name="TMT_SELESAI" class="datepicker" /></td></tr>
									<tr>
										<td>Unit Kerja</td>
										<td>
											<input type="hidden" name="K_UNIT_KERJA" value="<?php echo @$RiwayatStruktural['K_UNIT_KERJA']; ?>" data-change="1" />
											<input type="text" style="width: 150px;" size="50" value="<?php echo @$RiwayatStruktural['UNIT_KERJA']; ?>" class="unit-kerja" readonly="readonly" />
											<input type="button" style="width: 75px;" class="show_unitkerja" data-target=".unit-kerja" value="Ubah" />
										</td></tr>
									<tr>
										<td>Jabatan Struktural</td>
										<td><select style="width: 85%;" name="K_JABATAN_STRUKTURAL"><?php echo GetOption(false, $ArrayJabatanStruktural, $RiwayatStruktural['K_JABATAN_STRUKTURAL']); ?></select></td></tr>
									<tr id="RowBidangKerja">
										<td>Bidang Kerja</td>
										<td><select style="width: 85%;" name="K_BIDANG_KERJA"><?php echo GetOption(false, $ArrayBidangKerja, $RiwayatStruktural['K_BIDANG_KERJA']); ?></select></td></tr>
									<tr>
										<td colspan="2">
											<div style="padding: 0pt 0pt 10px;">Jabatan Struktural yang dipegang</div>
											<table cellspacing="0" cellpadding="5" border="0" class="tabel" style="width: 100%; background: none repeat scroll 0% 0% transparent; border: 2px solid rgb(180, 212, 224);"><tbody>
												<tr>
													<td style="width: 202px;">Jenjang</td>
													<td><select style="width: 85%;" name="K_JENJANG"><?php echo GetOption(false, $ArrayJenjang, $RiwayatStruktural['K_JENJANG']); ?></select></td></tr>
												<tr>
													<td>Fakultas</td>
													<td><select style="width: 85%;" name="K_FAKULTAS"><?php echo GetOption(false, $ArrayFakultas, $RiwayatStruktural['K_FAKULTAS']); ?></select></td></tr>
												<tr>
													<td>Jurusan</td>
													<td><select style="width: 85%;" name="K_JURUSAN"><?php echo GetOption(false, $ArrayJurusan, $RiwayatStruktural['K_JURUSAN']); ?></select></td></tr>
												<tr>
													<td>Program Studi</td>
													<td><select style="width: 85%;" name="K_PROG_STUDI"><?php echo GetOption(false, $ArrayProgramStudi, $RiwayatStruktural['K_PROG_STUDI']); ?></select></td></tr>
											</tbody></table>
										</td></tr>
									<tr>
										<td>Tunjangan Struktural</td>
										<td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatStruktural['TUNJANGAN_STRUKTURAL']; ?>" name="TUNJANGAN_STRUKTURAL" class="integer" /></td></tr>
									<tr>
										<td>Keterangan</td>
										<td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $RiwayatStruktural['KETERANGAN']; ?></textarea></td></tr>
									<tr>
										<td>Upload</td>
										<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
									<tr>
										<td colspan="2" style="padding: 10px 0;">
											<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatStruktural']; ?>" />
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
                                if (!empty($RiwayatStruktural['Certificate'])) {
                                    $Extention = GetExtention($RiwayatStruktural['Certificate']);
                                    
                                    $ImageHtml = '';
                                    if ($Extention == 'pdf') {
                                        $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                                    } else {
                                        $ImageHtml = '<img src="'.$RiwayatStruktural['Certificate'].'" class="landscape" />';
                                    }
                                    
                                    echo '
                                        <div class="Relative">
                                            <a href="'.$RiwayatStruktural['Certificate'].'">'.$ImageHtml.'</a>
                                            <div class="position"><img src="'.HOST.'/images/Delete.png" class="cursor" /></div>
                                        </div>';
                                } else {
                                    echo '&nbsp;';
                                }
                            ?>
                            <script type="text/javascript">InitDeleteImage()</script>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
	
	<?php $this->load->view('common/form_unit_kerja'); ?>
	
<script>
function InitRiwayatStruktural() {
    InitForm.Start('FormRiwayatStruktural');
    
    var ComboBox = {
        Jenjang: function() {
            var Object = {
                Action: 'GetJenjangByUnitKerja',
                K_UNIT_KERJA : $('input[name="K_UNIT_KERJA"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Jenjang", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_JENJANG"]').html(ContentHtml);
                    ComboBox.Fakultas();
                }
            });
        },
        JabatanStruktural: function() {
            var Object = {
                Action: 'GetArrayByUnitKerja',
                K_UNIT_KERJA : $('input[name="K_UNIT_KERJA"]').val()
            }
            $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/JabatanStruktural", data: Object,
                success: function(ContentHtml) {
                    $('select[name="K_JABATAN_STRUKTURAL"]').html(ContentHtml);
                }
            });
        },
        Fakultas: function() {
            var Object = {
                Action: 'GetFakultasByJenjangUnitKerja',
                K_JENJANG: $('select[name="K_JENJANG"]').val(),
                K_UNIT_KERJA: $('input[name="K_UNIT_KERJA"]').val()
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
        }
    }
    
    var BidangKerja = function() {
        if ($('select[name="K_JABATAN_STRUKTURAL"]').val() == '99') {
            $('#RowBidangKerja').show();
        } else {
            $('#RowBidangKerja').hide();
        }
    }
    
    $('input[name="K_UNIT_KERJA"]').change(function() {
        ComboBox.JabatanStruktural();
        ComboBox.Jenjang();
    });
    $('select[name="K_JENJANG"]').change(function() {
        ComboBox.Fakultas();
    });
    $('select[name="K_FAKULTAS"]').change(function() {
        ComboBox.Jurusan();
    });
    $('select[name="K_JURUSAN"]').change(function() {
        ComboBox.ProgramStudy();
    });
    $('select[name="K_JABATAN_STRUKTURAL"]').change(function() {
        BidangKerja();
    });
    
    var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
    if (ParameterUpdate == 'update') {
        $('input[name="NO_SK"]').attr('readonly', 'readonly');
    }
    
    $('#FormRiwayatStruktural form').submit(function() {
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
    
    BidangKerja();
}

InitRiwayatStruktural();
</script>
</body>
</html>