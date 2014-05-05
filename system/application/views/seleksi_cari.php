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
                    <h1 style="padding: 0 0 10px 0;">Pencarian Peserta</h1>
					
					<!--
					<?php if ($this->llogin->IsUserFakultas() == 1) { ?>
						<div style="color: #FF0000; padding: 0 0 0 5px;">Maaf, untuk user fakultas untuk sementara tidak bisa mengubah data kepegawaian.</div>
					<?php } ?>
					-->
					
					<div></div>
                    
                    <div class="clearfix">
                    		
                        <form method="post" id="FormPegawai" class="clearfix">
                        		
                        		<legend>Form Pencarian</legend>
                            <input type="hidden" name="PageActive" value="1" />
                            <input type="hidden" name="DeletePegawai" value="" />
                            <input type="hidden" name="PencarianDetailLastest" value="<?php echo $PencarianDetailLastest; ?>" />
                            
                            <div class="left  form-block">
                            <label><strong>Nomor Peserta : </strong></label>
                            <input type="text" style="width: 300px;" maxlength="50" value="<?php if ($_POST) echo $_POST['NOMOR']; ?>" name="NOMOR" />
                            
                            </div>
                            
                            <div class="left form-block">
                            <label><strong>Periode :</strong></label>
                            <select id="TAHUN" name="TAHUN">
									 <?foreach($ArrayPeriode as $key=>$value){?>
                                    	<option value="<?php echo $value['K_PERIODE'];?>"><?php echo $value['PERIODE'] .' - '. $value['TAHUN'];?></option>                                    	                                	                                  	
										<?}?>
									</select>
                  					</div>
                  					<div class="left form-block">
                            	<input type="submit" name="CariPegawai" value="Cari Data" />
                            </div>
                            
                        </form>                                                
                    </div>
                     <?php
                            if (isset($ArrayPegawai['Pegawai']) && count($ArrayPegawai['Pegawai']) > 0) {
                                echo '
                                    <div id="ListPegawai" class="cnt_table_main" style="width: 100%;">
                                        <table>
                                            <tr>												
												<td class="normal" style="width: 100px;">Unit Kerja</td>          												                       
                                                <td class="normal" style="width: 80px;">No.Peserta</td>
                                                <td class="normal" style="width: 250px;">Nama</td>
                                                <td class="normal" style="width: 250px;">Alamat</td>
												<td class="normal" style="width: 125px;">Pilihan Pelamar</td>
                                                <td class="normal" style="width: 70px;">Jenjang</td>
                                                <td class="normal" style="width: 125px;">Kualifikasi</td>
												<td class="left" style="width: 25px;">Hapus</td>                                                                                        
                                           </tr>';
								//print_r($ArrayPegawai['Pegawai']);
                                foreach ($ArrayPegawai['Pegawai'] as $Key => $Array) {
                                	/**
									$LinkDownload = ($Array['IsPns'] == 1)
										? '<a href="' . HOST . '/Document/download/' . $Array['K_PEGAWAI'] . '.xlsx"><img src="' . HOST . '/images/Excel.jpg" style="width: 25px;" /></a>'
										: '&nbsp;';
									*/
                                    echo '
                                        <tr>                                    		
                                    		<td class="body">'.$Array['UNIT'].'&nbsp;</td>                                   
                                    		<td class="body"><a href="'.$Array['LinkEdit'].'">'.$Array['NO_PESERTA'].'</a></td>
                                    		<td class="body"><a href="'.$Array['LinkEdit'].'">'.$Array['NAMA'].'</a></td>                                                  
                                            <td class="body">'.$Array['ALAMAT'].'&nbsp;</td>
                                    		<td class="body">'.$Array['PILIHAN'].'&nbsp;</td>
                                            <td class="body">'.$Array['JENJANG'].'&nbsp;</td>
                                            <td class="body">'.$Array['KUALIFIKASI_PEND'].'&nbsp;</td>
                        		<td class="licon">
                                            <img src="'.HOST.'/images/Delete.png" style="width:15px;height:15px;" title="Delete" onclick="HapusPeserta(\''.$Array['NO_PESERTA'].'\')"/></td>                                                                                                                    	   
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
<script>
    function HapusPeserta(No){
        if (confirm("Apakah Anda yakin untuk menghapus Data Peserta No: "+No+" ?") == true){
        	$('input[name="DeletePegawai"]').val(No);
            $('#FormPegawai').submit();
        }		
    }                    
</script>