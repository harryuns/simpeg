<?php
    $StatusKawin = (isset($ArrayStatusKawin[$Pegawai['K_STATUS_KAWIN']])) ? $ArrayStatusKawin[$Pegawai['K_STATUS_KAWIN']]['Content'] : '';
    $StatusKerja = (isset($ArrayStatusKerja[$Pegawai['K_STATUS_KERJA']])) ? $ArrayStatusKerja[$Pegawai['K_STATUS_KERJA']]['Content'] : '';
    $JenisKerja = (isset($ArrayJenisKerja[$Pegawai['K_JENIS_KERJA']])) ? $ArrayJenisKerja[$Pegawai['K_JENIS_KERJA']]['Content'] : '';
    $StatusDosen = (isset($ArrayStatusDosen[$Pegawai['K_STATUS_DOSEN']])) ? $ArrayStatusDosen[$Pegawai['K_STATUS_DOSEN']]['Content'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<style>
    table td { padding: 7px 0; }
</style>
<body style="background: none; color: #000000; padding: 20px;">
    <div style="float: left; width: 600px;">
        <input type="hidden" name="K_STATUS_KERJA" value="<?php echo $Pegawai['K_STATUS_KERJA']; ?>" />
        <input type="hidden" name="K_JENIS_KERJA" value="<?php echo $Pegawai['K_JENIS_KERJA']; ?>" />
        <table style="width: 100%;" cellspacing="0" cellpadding="5" border="0">
            <tr>
                <td style="width: 200px;">NIP</td>
                <td style="width: 300px;"><?php echo $Pegawai['K_PEGAWAI']; ?></td></tr>
            <tr>
                <td>Nama</td>
                <td><?php echo $Pegawai['NAMA']; ?></td></tr>
            <tr>
                <td>Tempat Lahir</td>
                <td><?php echo $Pegawai['TMP_LAHIR']; ?></td></tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><?php echo ChangeFormatDate($Pegawai['TGL_LAHIR']); ?></td></tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><?php echo $ArrayJenisKelamin[$Pegawai['JENIS_KELAMIN']]; ?></td></tr>
            <tr>
                <td>Gelar Depan</td>
                <td><?php echo $Pegawai['GLR_DPN']; ?></td></tr>
            <tr>
                <td>Gelar  Belakang</td>
                <td><?php echo $Pegawai['GLR_BLKG']; ?></td></tr>
            <tr>
                <td>Alamat</td>
                <td><?php echo $Pegawai['ALAMAT']; ?></td></tr>
            <tr>
                <td>Agama</td>
                <td><?php echo $ArrayAgama[$Pegawai['K_AGAMA']]; ?></td></tr>
            <tr>
                <td>Status Kawin</td>
                <td><?php echo $StatusKawin; ?></td></tr>
            <tr>
                <td>No Telepon</td>
                <td><?php echo $Pegawai['TLP_RMH']; ?></td></tr>
            <tr>
                <td>No HP</td>
                <td><?php echo $Pegawai['NO_HP']; ?></td></tr>
            <tr>
                <td>Email</td>
                <td><?php echo $Pegawai['EMAIL']; ?></td></tr>
            <tr>
                <td>Status Kerja</td>
                <td><?php echo $StatusKerja; ?></td></tr>
            <tr>
                <td>Jenis Kerja</td>
                <td><?php echo $JenisKerja; ?></td></tr>
            <tr id="CntStatusDosen">
                <td>Status Dosen</td>
                <td><?php echo $StatusDosen; ?></td></tr>
            <tr id="CntNidn">
                <td>NIDN</td>
                <td><?php echo $Pegawai['NIDN']; ?></td></tr>
            <tr>
                <td>Tahun Masuk</td>
                <td><?php echo $Pegawai['THN_MASUK']; ?></td></tr>
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
                <td><?php echo $Pegawai['SK_CPNS']; ?></td></tr>
            <tr id="CntTmtCpns">
                <td>TMT CPNS</td>
                <td><?php echo ChangeFormatDate($Pegawai['TMT_CPNS']); ?></td></tr>
            <tr id="CntNoSkPns">
                <td>NO SK PNS</td>
                <td><?php echo $Pegawai['SK_PNS']; ?></td></tr>
            <tr id="CntTmtPns">
                <td>TMT PNS</td>
                <td><?php echo ChangeFormatDate($Pegawai['TMT_PNS']); ?></td></tr>
            <tr id="CntNik">
                <td>NIK</td>
                <td><?php echo $Pegawai['NIK']; ?></td></tr>
            <tr id="CntKarpeg" style="display: none;">
                <td valign="top">Karpeg</td>
                <td><?php echo $Pegawai['KARPEG']; ?></td></tr>
            <tr id="CntNira">
                <td valign="top">NIRA</td>
                <td><?php echo $Pegawai['NIRA']; ?></td></tr>
        </table>
    </div>
    <div style="float: left; width: 200px;">
        <?php
            if (!empty($Pegawai['Foto'])) {
                $Extention = GetExtention($Pegawai['Foto']);
                
                $ImageHtml = '';
                if ($Extention == 'pdf') {
                    $ImageHtml = '<img src="'.HOST.'/images/PdfIcon.png" class="pdf" />';
                } else {
                    $ImageHtml = '<img src="'.$Pegawai['Foto'].'" class="portrait" />';
                }
                
                echo '<div id="CntImage"><a href="'.$Pegawai['Foto'].'">'.$ImageHtml.'</a></div>';
            } else {
                echo '&nbsp;';
            }
        ?>
    </div>
    <div class="clear"></div>
    <script type="text/javascript">InitPegawaiBioDataCetak();</script>
</body>
</html>