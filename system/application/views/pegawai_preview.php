<?php
    $Agama = (isset($ArrayAgama[$Pegawai['K_AGAMA']])) ? $ArrayAgama[$Pegawai['K_AGAMA']] : '&nbsp;';
    $StatusKawin = (isset($ArrayStatusKawin[$Pegawai['K_STATUS_KAWIN']])) ? $ArrayStatusKawin[$Pegawai['K_STATUS_KAWIN']]['Content'] : '&nbsp;';
?>
<style>
#Preview { font-size: 11px }
#Preview .cnt_identity { float: left; width: 450px; }
#Preview .cnt_foto { float: left; width: 250px; }
#Preview .cnt_left { float: left; width: 150px; }
#Preview .cnt_right { float: left; width: 250px; }
#Preview .cnt_foto .portrait { border: 1px solid #7494AE; width:100px; height:130px; padding:2px; }
</style>
<div id="Preview">
    <div style="">
        <div class="cnt_identity">
            <div class="cnt_left">NIP</div>
            <div class="cnt_right"><?php echo $Pegawai['K_PEGAWAI']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Nama</div>
            <div class="cnt_right"><?php echo $Pegawai['NAMA']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Tempat Lahir</div>
            <div class="cnt_right"><?php echo $Pegawai['TMP_LAHIR']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Tanggal Lahir</div>
            <div class="cnt_right"><?php echo ConvertDateToString($Pegawai['TGL_LAHIR']); ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Jenis Kelamin</div>
            <div class="cnt_right"><?php echo $Pegawai['JENIS_KELAMIN']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Alamat</div>
            <div class="cnt_right"><pre><?php echo $Pegawai['ALAMAT']; ?></pre></div>
            <div class="clear"></div>
            <div class="cnt_left">Agama</div>
            <div class="cnt_right"><?php echo $Agama; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Status Kawin</div>
            <div class="cnt_right"><?php echo $StatusKawin; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Telepon Rumah</div>
            <div class="cnt_right"><?php echo $Pegawai['TLP_RMH']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">No HP</div>
            <div class="cnt_right"><?php echo $Pegawai['NO_HP']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Email</div>
            <div class="cnt_right"><?php echo $Pegawai['EMAIL']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Status Kerja</div>
            <div class="cnt_right"><?php echo $ArrayStatusKerja[$Pegawai['K_STATUS_KERJA']]['Content']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Jenis Kerja</div>
            <div class="cnt_right"><?php echo $ArrayJenisKerja[$Pegawai['K_JENIS_KERJA']]['Content']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Tahun Masuk</div>
            <div class="cnt_right"><?php echo $Pegawai['THN_MASUK']; ?></div>
            <div class="clear"></div>
            <div class="cnt_left">Karpeg</div>
            <div class="cnt_right"><?php echo $Pegawai['KARPEG']; ?></div>
            <div class="clear"></div>
        </div>
        <div class="cnt_foto">
            <?php
                if (empty($Pegawai['Foto'])) {
                    echo '&nbsp;';
                } else {
                    echo '<img src="'.$Pegawai['Foto'].'" class="portrait" />';
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    
    <?php
        // Riwayat Pendidikan
        if (count($ArrayRiwayatPendidikan) > 0) {
            echo '
                <div class="cnt_table_main" style="padding: 15px 0 0 0;">
                    <div class="title">Riwayat Pendidikan</div>
                    <table>
                        <tr>
                            <td class="left" style="width: 100px;">Jenjang</td>
                            <td class="center" style="width: 100px;">No Ijazah</td>
                            <td class="normal" style="width: 125px; text-align: center;">Tanggal Ijazah</td>
                            <td class="normal" style="width: 100px; text-align: center;">Tahun Masuk</td></tr>';
            foreach ($ArrayRiwayatPendidikan as $Key => $Array) {
                echo '
                    <tr>
                        <td class="licon">'.$ArrayJenjang[$Array['K_JENJANG']]['Content'].'</td>
                        <td class="icon">'.$Array['NO_IJAZAH'].'</td>
                        <td class="body" style="text-align: center;">'.ConvertDateToString($Array['TGL_IJAZAH']).'</td>
                        <td class="body" style="text-align: center;">'.$Array['THN_MASUK'].'</td>
                    </tr>';
            }
            echo '</table></div>';
        }
        
        // Pegawai Aktif
        if (count($ArrayPegawaiAktif) > 0) {
            echo '
                <div class="cnt_table_main" style="padding: 15px 0 0 0;">
                    <div class="title">Pegawai Aktif</div>
                    <table>
                        <tr>
                            <td class="left" style="width: 100px;">Aktif</td>
                            <td class="center" style="width: 100px;">No SK</td>
                            <td class="normal" style="width: 125px; text-align: center;">Tanggal Mulai</td>
						</tr>';
            foreach ($ArrayPegawaiAktif as $Key => $Array) {
                echo '
                    <tr>
                        <td class="licon">'.$ArrayAktif[$Array['K_AKTIF']]['Content'].'</td>
                        <td class="icon">'.$Array['NO_SK'].'</td>
                        <td class="body" style="text-align: center;">'.ConvertDateToString($Array['TGL_MULAI']).'</td>
                    </tr>';
            }
            echo '</table>';
            echo '</div>';
        }
        
        // Riwayat Diklat
        if (count($ArrayRiwayatDiklat) > 0) {
            echo '
                <div class="cnt_table_main" style="padding: 15px 0 0 0;">
                    <div class="title">Riwayat Diklat</div>
                    <table>
                        <tr>
                            <td class="left" style="width: 150px;">No SK</td>
                            <td class="center" style="width: 125px;">Tanggal SK</td>
                            <td class="normal" style="width: 200px; text-align: center;">Diklat</td>
                            <td class="normal" style="width: 200px; text-align: center;">Tingkat</td></tr>';
            foreach ($ArrayRiwayatDiklat as $Key => $Array) {
                echo '
                    <tr>
                        <td class="licon">'.$Array['NO_SERTIFIKAT'].'</td>
                        <td class="icon">'.ConvertDateToString($Array['TGL_SERTIFIKAT']).'</td>
                        <td class="body" style="text-align: center;">'.$ArrayDiklat[$Array['K_DIKLAT']]['Content'].'</td>
                        <td class="body">'.$Array['TINGKAT'].'</td></tr>';
            }
            echo '</table></div>';
        }
        
        // Riwayat Pangkat
        if (count($ArrayRiwayatPangkat) > 0) {
            echo '
                <div class="cnt_table_main" style="padding: 15px 0 0 0;">
                    <div class="title">Riwayat Pangkat</div>
                    <table>
                        <tr>
                            <td class="left" style="width: 150px;">No SK</td>
                            <td class="normal" style="width: 125px; text-align: center;">Tanggal SK</td>
                            <td class="normal" style="width: 200px; text-align: center;">Penjelasan</td>
                            <td class="center" style="width: 200px;">Asal SK</td></tr>';
            foreach ($ArrayRiwayatPangkat as $Key => $Array) {
                echo '
                    <tr>
                        <td class="licon">'.$Array['NO_SK'].'</td>
                        <td class="icon" style="text-align: center;">'.ConvertDateToString($Array['TGL_SK']).'</td>
                        <td class="body">'.$ArrayPenjelasan[$Array['K_PENJELASAN']]['Content'].'</td>
                        <td class="body">'.$ArrayAsalSk[$Array['K_ASAL_SK']]['Content'].'</td>
                    </tr>';
            }
            echo '</table></div>';
        }
        
        // Riwayat Honorer
        if (count($ArrayRiwayatHonorer) > 0) {
            echo '
                <div class="cnt_table_main" style="padding: 15px 0 0 0;">
                    <div class="title">Riwayat Honorer</div>
                    <table>
                        <tr>
                            <td class="left" style="width: 150px;">No SK</td>
                            <td class="center" style="width: 125px;">Tanggal SK</td>
                            <td class="normal" style="width: 200px; text-align: center;">Unit Kerja</td>
                            <td class="normal" style="width: 200px; text-align: center;">Asal SK</td></tr>';
            foreach ($ArrayRiwayatHonorer as $Key => $Array) {
                echo '
                    <tr>
                        <td class="licon">'.$Array['NO_SK'].'</td>
                        <td class="icon">'.ConvertDateToString($Array['TGL_SK']).'</td>
                        <td class="body">'.$ArrayUnitKerja[$Array['K_UNIT_KERJA']]['Content'].'</td>
                        <td class="body">'.$ArrayAsalSk[$Array['K_ASAL_SK']]['Content'].'</td>
                    </tr>';
            }
            echo '</table></div>';
        }
        
        if (count($ArrayRiwayatFungsional) > 0) {
            echo '
                <div class="cnt_table_main" style="padding: 15px 0 0 0;">
                    <div class="title">Riwayat Fungsional</div>
                    <table>
                        <tr>
                            <td class="left" style="width: 150px;">No SK</td>
                            <td class="center" style="width: 125px;">Tanggal SK</td>
                            <td class="normal" style="width: 200px; text-align: center;">Unit Kerja</td>
                            <td class="normal" style="width: 200px; text-align: center;">Asal SK</td></tr>';
            foreach ($ArrayRiwayatFungsional as $Key => $Array) {
                echo '
                    <tr>
                        <td class="licon">'.$Array['NO_SK'].'</td>
                        <td class="icon">'.ConvertDateToString($Array['TGL_SK']).'</td>
                        <td class="body">'.$ArrayUnitKerja[$Array['K_UNIT_KERJA']]['Content'].'</td>
                        <td class="body">'.$ArrayAsalSk[$Array['K_ASAL_SK']]['Content'].'</td>
                    </tr>';
            }
            echo '</table></div>';
        }
        
        if (count($ArrayRiwayatStruktural) > 0) {
            echo '
                <div class="cnt_table_main" style="padding: 15px 0 0 0;">
                    <div class="title">Riwayat Struktural</div>
                    <table>
                        <tr>
                            <td class="left" style="width: 150px;">No SK</td>
                            <td class="center" style="width: 125px;">Tanggal SK</td>
                            <td class="normal" style="width: 200px; text-align: center;">Unit Kerja</td>
                            <td class="normal" style="width: 200px; text-align: center;">Asal SK</td></tr>';
            foreach ($ArrayRiwayatStruktural as $Key => $Array) {
                $UnitKerja = (isset($ArrayUnitKerja[$Array['K_UNIT_KERJA']])) ? $ArrayUnitKerja[$Array['K_UNIT_KERJA']]['Content'] : '&nbsp;';
                $AsalSk = (isset($ArrayAsalSk[$Array['K_ASAL_SK']])) ? $ArrayAsalSk[$Array['K_ASAL_SK']]['Content'] : '&nbsp;';
                echo '
                    <tr>
                        <td class="licon">'.$Array['NO_SK'].'</td>
                        <td class="icon">'.ConvertDateToString($Array['TGL_SK']).'</td>
                        <td class="body">'.$UnitKerja.'</td>
                        <td class="body">'.$AsalSk.'</td>
                    </tr>';
            }
            echo '</table>';
            echo '</div>';
        }
?>
</div>