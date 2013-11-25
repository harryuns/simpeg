<?php
//	print_r($ArrayPegawaiActive); exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <style>
        .Record { cursor: pointer; }
    </style>
    <div id="body">
        <div id="frame">
            <div id="sidebar">
                <div class="glossymenu"><?php include 'main_menu.php'; ?></div>
                <div class="glossymenu" style="padding: 50px 0 0 0;"><?php include 'main_sub_menu.php'; ?></div>
            </div>
            
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <?php
                        if ($DataAsessor['ShowGrid'] == '1') {
                    ?>
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($DataAsessor['ShowGrid'] == '1' && count($ArrayPegawaiActive) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table style="width: 900px;">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">Tahun Akademik</td>
                                                <td class="normal" style="width: 100px;">Semester</td>
                                                <td class="normal" style="width: 200px;">Asessor 1</td>
                                                <td class="normal" style="width: 200px;">Asessor 2</td>
                                                <td class="normal" style="width: 200px;">Keterangan</td></tr>';
                                foreach ($ArrayPegawaiActive as $Key => $Array) {
                                    $ContentHtmnUpdate = ($Array['THN_AKADEMIK'] >= TAHUN_AKADEMIK)
                                        ? '<a href="'.$Array['LinkEdit'].'" class="Edit"><img class="link" src="'.HOST.'/images/Pencil.png" /></a>'
                                        : '&nbsp;';
                                    
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon">'.$ContentHtmnUpdate.'</td>
                                            <td class="body">'.$Array['TAHUN_AKADEMIK'].'</td>
                                            <td class="body">'.$Array['SEMESTER'].'</td>
                                            <td class="body">'.$Array['K_ASESOR_I_NAME'].'</td>
                                            <td class="body">'.$Array['K_ASESOR_II_NAME'].'</td>
                                            <td class="body">'.$Array['KETERANGAN'].'</td>
                                        </tr>';
                                }
                                echo '</table>';
                                echo '</div>';
                            }
                        ?>
                        <script type="text/javascript">InitTable();</script>
                        
                        <?php if (!empty($DataAsessor['Message'])) { ?>
                        <div class="MessagePopup"><?php echo $DataAsessor['Message']; ?></div>
                        <?php } ?>
                        
                        <div style="width: 500px;" id="FormDataAsessor">
                            <form method="post" action="<?php echo $Pegawai['LinkDataAsessor']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $DataAsessor['ParameterUpdate']; ?>" />
                            <table style="width: 100%;">
                                <tr><td colspan="2" style="">
                                    <input type="submit" name="Tambah" value="Tambah" />
                                </td></tr>
                            </table>
                            </form>
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                            <script type="text/javascript">IntPegawaiActive();</script>
                        </div>
                    </div>
                    <?php
                        } else {
                    ?>
                    <div id="CntRightMid">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormDataAsessor">
                            <?php if (!empty($DataAsessor['Message'])) { ?>
                            <div class="MessagePopup"><?php echo $DataAsessor['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkDataAsessor']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="ParameterUpdate" value="<?php echo $DataAsessor['ParameterUpdate']; ?>" />
                            <table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
                                <tr>
                                    <td style="width: 200px;">Tahun Akademik</td>
                                    <td style="width: 300px;"><select style="width: 150px;" name="THN_AKADEMIK"><?php echo GetOption(false, $ArrayTahunAkademik, $DataAsessor['THN_AKADEMIK']); ?></select></td></tr>
                                <tr>
                                    <td>Semester</td>
                                    <td><select style="width: 150px;" name="IS_GANJIL"><?php echo GetOption(false, array('0' => 'Genap', '1' => 'Ganjil'), $DataAsessor['IS_GANJIL']); ?></select></td></tr>
                                <tr>
                                    <td>NIP Asessor I</td>
                                    <td>
                                        <input type="text" style="width: 150px;" size="50" name="K_ASESOR_I" readonly="readonly" value="<?php echo $DataAsessor['K_ASESOR_I']; ?>" class="required" alt="Silahkan memasukkan NIP Asessor 1" />
                                        <img class="PopupAsessor SearchAsessor1" src="<?php echo HOST; ?>/Style/siado/Lens.jpg" style="width: 18px; height: 18px; margin: 0 0 -3px 0; cursor: pointer;" />
                                    </td></tr>
                                <tr>
                                    <td>Nama Asessor I</td>
                                    <td><input type="text" style="width: 275px;" size="50" name="K_ASESOR_I_NAME" readonly="readonly" value="<?php echo $DataAsessor['K_ASESOR_I_NAME']; ?>" class="required" alt="Silahkan memasukkan Nama Asessor 1" /></td></tr>
                                <tr>
                                    <td>NIP Asessor II</td>
                                    <td>
                                        <input type="text" style="width: 150px;" size="50" name="K_ASESOR_II" readonly="readonly" value="<?php echo $DataAsessor['K_ASESOR_II']; ?>" class="required" alt="Silahkan memasukkan NIP Asessor 2" />
                                        <img class="PopupAsessor SearchAsessor2" src="<?php echo HOST; ?>/Style/siado/Lens.jpg" style="width: 18px; height: 18px; margin: 0 0 -3px 0; cursor: pointer;" />
                                    </td></tr>
                                <tr>
                                    <td>Nama Asessor II</td>
                                    <td><input type="text" style="width: 275px;" size="50" name="K_ASESOR_II_NAME" readonly="readonly" value="<?php echo $DataAsessor['K_ASESOR_II_NAME']; ?>" class="required" alt="Silahkan memasukkan Nama Asessor 2" /></td></tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td><textarea name="KETERANGAN" style="width: 85%; height: 75px;"><?php echo $DataAsessor['KETERANGAN']; ?></textarea></td></tr>
                                <tr>
                                    <td colspan="2" style="padding: 10px 0;">
                                        <input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkDataAsessor']; ?>" />
                                        <input type="reset" name="Reset" value="Reset" />
                                        <input type="submit" name="Submit" value="Save" />
                                    </td></tr>
                            </table>
                            </form>
                            <div id="DialogSearchAsessor" title="Pencarian Asessor" style="display: none; font-size: 11px;"><p>
                                <div style="float: left; width: 100px;">Nama / NIM :</div>
                                <div style="float: left; width: 150px;"><input type="text" name="NamaAsessor" value="" /></div>
                                <div style="float: left; width: 100px;"><input type="button" name="SearchAsessor" value="Search" /></div>
                                <div class="clear"></div>
                                <div id="ResultAsessor"></div>
                            </p></div>
                            <script type="text/javascript">IntDataAsessor();</script>
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