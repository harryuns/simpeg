<?php
    $PencarianDetailLastest = (isset($_POST['PencarianDetail'])) ? $_POST['PencarianDetail'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <div id="body">
        <div id="frame">
            <div id="sidebar"><div class="glossymenu"><?php include 'main_menu.php'; ?></div></div>
        
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <h1 style="padding: 0 0 10px 0;">Cetak Data Peserta</h1>
					
					<div></div>
                    
                    <div>
                        <form method="post" id="FormPegawai">
                            <input type="hidden" name="PageActive" value="1" />
                            <input type="hidden" name="DeletePegawai" value="0" />
                            <input type="hidden" name="PencarianDetailLastest" value="<?php echo $PencarianDetailLastest; ?>" />
                            <table style="width: 100%;">
                           		
	                            <tr>
                                    <td>Nomor Peserta</td>
                                    <td><input type="text" style="width: 150px;" maxlength="50" value="<?php if(isset($ArrayPegawai['From'])) echo $ArrayPegawai['From']; ?>" name="NMR_AWAL" /> s/d
                                	<input type="text" style="width: 150px;" maxlength="50" value="<?php if(isset($ArrayPegawai['To'])) echo $ArrayPegawai['To']; ?>" name="NMR_AKHIR" /></td>    
                                </tr>
                                <tr>
                                    <td>Periode</td>
                                    <td>
                                     <select id="TAHUN" name="TAHUN">
										<?foreach($ArrayPeriode as $key=>$value){?>
                                    	<option <?if ($value['K_PERIODE']==$_SESSION['CurrentPeriode']['K_PERIODE']){?>selected=selected<?}?> value="<?php echo $value['K_PERIODE'];?>"><?php echo $value['PERIODE'] .' - '. $value['TAHUN'];?></option>                                    	                                	                                  	
										<?}?>
									</select>
                                    </td></tr>                                  
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>                                    
                                    <input type="submit" name="CariPegawai" value="Cari Data" /></td></tr>
                            </table>
                        </form>                                                
                    </div>
                     <?php
                            if (isset($ArrayPegawai['Pegawai']) && count($ArrayPegawai['Pegawai']) > 0) {
								// current selection
                            	$a = ''; $b = ''; $c = '';
								if (isset($ArrayNomor['C_JENIS'])){
                            		$a = $ArrayNomor['C_JENIS'] == '0' ? 'selected' : '';
                            		$b = $ArrayNomor['C_JENIS'] == '1' ? 'selected' : '';
                            		$c = $ArrayNomor['C_JENIS'] == '2' ? 'selected' : '';
                            	}
								if (empty($a) && empty($b)) {
									$c = 'selected';
								}
								
                            	echo '
<form method="post" id="FormCetak">
<input type="hidden" name="IsCetak" value="1" />
<input type="hidden" name="C_AWAL" value="'.$ArrayNomor['C_AWAL'].'" />
<input type="hidden" name="C_AKHIR" value="'.$ArrayNomor['C_AKHIR'].'" />

<table style="width: 100%;">
<tr>
	<td>Jenis Cetak</td>
	<td>
		<select id="C_JENIS" name="C_JENIS">
			<option value="0" '.$a.' >Cetak Tanda Peserta</option>
			<option value="1" '.$b.'>Cetak Bukti Hadir</option>
			<option value="2" '.$c.'>Cetak Tanda Peserta & Bukti Hadir</option>
		</select>
		<input type="submit" name="CetakPeserta" value="Cetak" />
	</td>
	<td></td>
	<td></td>
</tr>
</table>
									';
                                echo '
                                    <div id="ListPegawai" class="cnt_table_main" style="width: 100%;">
                                        <table>
                                            <tr>                                                
                                                <td class="normal" style="width: 125px;">No.Peserta</td>
                                                <td class="normal" style="width: 250px;">Nama</td>
                                                <td class="normal" style="width: 125px;">Alamat</td>
                                                <td class="normal" style="width: 100px;">Jenjang</td>
                                                <td class="normal" style="width: 125px;">Kualifikasi</td>                                                                                                                                                
                                                </tr>';
                                foreach ($ArrayPegawai['Pegawai'] as $Key => $Array) {                                	
                                    echo '
                                        <tr>                                           
                                            <td class="body">'.$Array['NO_PESERTA'].'</td>
                                            <td class="body">'.$Array['NAMA'].'</td>
                                            <td class="body">'.$Array['ALAMAT'].'&nbsp;</td>
                                            <td class="body">'.$Array['JENJANG'].'&nbsp;</td>
                                            <td class="body">'.$Array['KUALIFIKASI_PEND'].'&nbsp;</td>                                                                                                                         	   
										</tr>';
                                }
                                echo '</table></div>';
                                
                                $PagePegawai = '';
                                if ($ArrayPegawai['PageCount'] > 1) {
                                    $Content = '';
                                    
                                    for ($Counter = -5; $Counter < 5; $Counter++) {
                                        $PageActive = $ArrayPegawai['PageActive'] + $Counter;
                                        
                                        if ($PageActive >= 1 && $PageActive <= $ArrayPegawai['PageCount']) {
                                            $Class = ($Counter == 0) ? 'active' : '';
                                            $Content .= '<a class="'.$Class.'">'.$PageActive.'</a> ';
                                        }
                                    }
                                    
                                    $PagePegawai = '<div id="PagePegawai">'.$Content.'</div>';
                                }
                                
                                echo '
                                    <div id="PageFeature">
                                        '.$PagePegawai.'                                        
                                    </div>
                                ';
                            } else if (isset($_POST['CariPegawai']) && !empty($_POST['CariPegawai'])) {
                                echo '<div style="padding: 10px 0;">Data tidak ditemukan karena tidak ada data yang sesuai dengan kriteria pencarian.</div>';
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>