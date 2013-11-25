?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <div class="bg"><div class="cnt_bg">
        <?php include 'body_header.php'; ?>
        
        <div class="bd"><div class="bd_top"><div class="bd_right"><div class="bd_bottom"><div class="bd_left">
        <div class="bd_topleft"><div class="bd_topright"><div class="bd_bottomleft"><div class="bd_bottomright">
        
            <div id="CntLeft">
                <?php include 'main_menu.php'; ?>
                <?php include 'main_sub_menu.php'; ?>
            </div>
            <div id="CntRight">
                <?php include 'pegawai_info.php'; ?>
                
                <?php
                    if ($RiwayatBidangKerja['ShowGrid'] == '1' && count($ArrayRiwayatBidangKerja) > 0) {
                        echo '
                            <div class="cnt_table_main">
                                <table>
                                    <tr>
                                        <td class="left" style="width: 25px;">&nbsp;</td>
                                        <td class="center" style="width: 25px;">&nbsp;</td>
                                        <td class="normal" style="width: 100px;">No SK</td>
                                        <td class="normal" style="width: 125px;">Tanggal SK</td>
                                        <td class="normal" style="width: 200px;">Asal SK</td>
                                        <td class="normal" style="width: 200px;">Unit Kerja</td></tr>';
                        foreach ($ArrayRiwayatBidangKerja as $Key => $Array) {
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
                                </tr>';
                        }
                        echo '</table>';
                        echo '</div>';
                    }
                ?>
                
                <div style="width: 500px;" id="FormRiwayatBidangKerja">
                    
                    <?php if (!empty($RiwayatBidangKerja['Message'])) { ?>
                    <div style="color: #FF0000; padding: 10px 0;"><?php echo $RiwayatBidangKerja['Message']; ?></div>
                    <?php } ?>
                    
                    <form method="post" action="<?php echo HOST.'/index.php/RiwayatBidangKerja/Ubah/'.$Pegawai['K_PEGAWAI']; ?>">
                    <input type="hidden" name="ParameterUpdate" value="<?php echo $RiwayatBidangKerja['ParameterUpdate']; ?>" />
                    <table style="width: 100%;">
                    <?php
                        if ((isset($_POST['Tambah']) && !empty($_POST['Tambah']))
                            || ($RiwayatBidangKerja['Error'] == '00001')
                            || (!empty($RiwayatBidangKerja['NO_SK'])) ) {
                    ?>
                            <tr>
                                <td>No SK</td>
                                <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatBidangKerja['NO_SK']; ?>" name="NO_SK"></td></tr>
                            <tr>
                                <td>Tanggal SK</td>
                                <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatBidangKerja['TGL_SK']; ?>" name="TGL_SK"></td></tr>
                            <tr>
                                <td style="width: 200px;">Asal SK</td>
                                <td style="width: 300px;"><select style="width: 100%;" name="K_ASAL_SK"><?php echo GetOption(false, $ArrayAsalSk, $RiwayatBidangKerja['K_ASAL_SK']); ?></select></td></tr>
                            <tr>
                                <td>TMT</td>
                                <td><input type="text" style="width: 150px;" size="50" value="<?php echo $RiwayatBidangKerja['TMT']; ?>" name="TMT"></td></tr>
                            <tr>
                                <td style="width: 200px;">Unit Kerja</td>
                                <td style="width: 300px;"><select style="width: 100%;" name="K_UNIT_KERJA"><?php echo GetOption(false, $ArrayUnitKerja, $RiwayatBidangKerja['K_UNIT_KERJA']); ?></select></td></tr>
                            <tr>
                                <td style="width: 200px;">Posisi</td>
                                <td style="width: 300px;"><select style="width: 150px;" name="K_JABATAN_STRUKTURAL"><?php echo GetOption(false, $ArrayJabatanStruktural, $RiwayatBidangKerja['K_JABATAN_STRUKTURAL']); ?></select></td></tr>
                            <tr>
                                <td style="width: 200px;">Bidang Kerja</td>
                                <td style="width: 300px;"><select style="width: 100%;" name="K_BIDANG_KERJA"><?php echo GetOption(false, $ArrayBidangKerja, $RiwayatBidangKerja['K_BIDANG_KERJA']); ?></select></td></tr>
                            <tr>
                                <td style="width: 200px;">Jenjang</td>
                                <td style="width: 300px;"><select style="width: 100%;" name="K_JENJANG"><?php echo GetOption(false, $ArrayJenjang, $RiwayatBidangKerja['K_JENJANG']); ?></select></td></tr>
                            <tr>
                                <td style="width: 200px;">Fakultas</td>
                                <td style="width: 300px;"><select style="width: 100%;" name="K_FAKULTAS"><?php echo GetOption(false, $ArrayFakultas, $RiwayatBidangKerja['K_FAKULTAS']); ?></select></td></tr>
                            <tr>
                                <td style="width: 200px;">Jurusan</td>
                                <td style="width: 300px;"><select style="width: 100%;" name="K_JURUSAN"><?php echo GetOption(false, $ArrayJurusan, $RiwayatBidangKerja['K_JURUSAN']); ?></select></td></tr>
                            <tr>
                                <td style="width: 200px;">Program Studi</td>
                                <td style="width: 300px;"><select style="width: 100%;" name="K_PROG_STUDI"><?php echo GetOption(false, $ArrayProgramStudi, $RiwayatBidangKerja['K_PROG_STUDI']); ?></select></td></tr>
                            <tr>
                                <td>Keterangan</td>
                                <td><textarea name="KETERANGAN" style="width: 100%; height: 75px;"><?php echo $RiwayatBidangKerja['KETERANGAN']; ?></textarea></td></tr>
                            <tr>
                                <td colspan="2" style="padding: 10px 0;">
                                    <input type="button" name="Cancel" value="Batal" />
                                    <input type="reset" name="Reset" value="Reset" />
                                    <input type="submit" name="Submit" value="Save" />
                                </td></tr>
                    <?php
                        } else {
                    ?>
                            <tr>
                                <td colspan="2" style="">
                                    <input type="submit" name="Tambah" value="Tambah" />
                                </td></tr>
                    <?php
                        }
                    ?>
                    </table>
                    </form>
                    <div id="dialog" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                    <script type="text/javascript">
                        function InitRiwayatBidangKerja() {
                            var ComboBox = {
                                Jenjang: function() {
                                    var Object = {
                                        Action: 'GetJenjangByUnitKerja',
                                        K_UNIT_KERJA : $('select[name="K_UNIT_KERJA"]').val()
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
                                        K_UNIT_KERJA : $('select[name="K_UNIT_KERJA"]').val()
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
                                        K_UNIT_KERJA: $('select[name="K_UNIT_KERJA"]').val()
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
                            
                            $('input[name="TGL_SK"]').datepicker({ dateFormat: 'yy-mm-dd' });
                            $('input[name="TMT"]').datepicker({ dateFormat: 'yy-mm-dd' });
                            $('input[name="Cancel"]').click(function() {
                                window.location = $('#FormRiwayatBidangKerja form').attr('action');
                            });
                            $('select[name="K_UNIT_KERJA"]').change(function() {
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
                            
                            var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
                            if (ParameterUpdate == 'update') {
                                $('input[name="NO_SK"]').attr('readonly', 'readonly');
                            }
                        }
                        InitRiwayatBidangKerja();
                    </script>
                </div>
            </div>
            <div class="clear"></div>
        
        </div></div></div></div></div>
        </div></div></div></div>
        
        <?php include 'body_footer.php'; ?>
    </div></div>
</body>
</html>