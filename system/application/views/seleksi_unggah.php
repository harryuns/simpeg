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
                    <h1 style="padding: 0 0 10px 0;">Unggah Data Peserta</h1>													
					<div>
					<table style="width: 100%;">
	                            <tr>
                                    <td>1. Download template (Format Excel) &nbsp; : &nbsp;
                                    <a href="<?php echo HOST.'/assets/seleksi_peserta.xlsx'; ?>" target="_blank">Klik disini</a></td></tr>   
                    </table>                
					</div>                    
                    <div style="width: 550px;" id="FormPegawai">
                    	<form method="post" enctype="multipart/form-data">                        
                            <input type="hidden" name="PageActive" value="1" />
                            <input type="hidden" name="DeletePegawai" value="0" />                            
                            <table style="width: 100%;">
	                            <tr>
                                    <td>2. Pilih File Peserta (Format Excel)</td>
                                    <td><input type="file" name="FILEPESERTA"></td></tr>                                                                  
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>                                    
                                    <input type="submit" name="Submit" value="Unggah" />
                                    </td>
                                </tr>
                            </table>
                        </form>                                                
                    </div>  
                  
                     <?php
                     
                            if (isset($ArrayPegawai['Pegawai']) && count($ArrayPegawai['Pegawai']) > 0) {
                                echo '
                                    <div id="ListPegawai" class="cnt_table_main" style="width: 100%;">
                                        <table>
                                            <tr>                                                
												<td class="normal" style="width: 25px;">No</td>
                                                <td class="normal" style="width: 125px;">No.Peserta</td>
                                                <td class="normal" style="width: 125px;">Nama</td>
                                                <td class="normal" style="width: 125px;">Alamat</td>
                                                <td class="normal" style="width: 125px;">Jenjang</td>
                                                <td class="normal" style="width: 125px;">Kualifikasi</td>
												<td class="normal" style="width: 125px;">Status</td>                                                                                                                                                   
                                                </tr>';
                                $No =0;
                                foreach ($ArrayPegawai['Pegawai'] as $Key => $Array) {
                                	$No++;                                	
                                    echo '
                                        <tr>                                   
                            				<td class="body">'.$No.'</td>        
                                            <td class="body">'.$Array[0].'</td>
                                            <td class="body">'.$Array[1].'</td>
                                            <td class="body">'.$Array[2].'&nbsp;</td>
                                            <td class="body">'.$Array[3].'&nbsp;</td>
                                            <td class="body">'.$Array[4].'&nbsp;</td>
                                    		<td class="body">'.$Array[(count($Array) - 1)].'&nbsp;</td>                                                                                                                 	   
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