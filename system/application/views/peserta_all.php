
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php header('Access-Control-Allow-Origin: http://kepegawaian.ub.ac.id'); ?>
<body>            
                     <?php
                            if (isset($ArrayPegawai['Pegawai']) && count($ArrayPegawai['Pegawai']) > 0) {
                                echo '                                    
                                        <table id="IdTablePeserta">
											<thead>
                                            <tr>          												                       
                                                <th class="normal" style="width: 125px;">No.Peserta</td>
                                                <th class="normal" style="width: 250px;">Nama</td>                                                
                                                <th class="normal" style="width: 125px;">Jenjang</td>
                                                <th class="normal" style="width: 100px;">Kualifikasi</td>
                                                <th class="normal" style="width: 100px;">Pilihan Pelamar</td>                                                                                                
												<th class="normal" style="width: 100px;">Cetak</td>
                                                </tr></thead><tbody>';
                                 
                                foreach ($ArrayPegawai['Pegawai'] as $Key => $Array) {                                 	                            	               	
                                    echo '
                                        <tr>                                   
                                    		<td >'.$Array['NO_PESERTA'].'</td>
                                    		<td >'.$Array['NAMA'].'</td>                                                                                                      		
                                            <td >'.$Array['JENJANG'].'</td>
                                            <td >'.$Array['KUALIFIKASI_PEND'].'</td>
                                            <td >'.$Array['PILIHAN'].'</td>                   
                                            <td ><a href="'.$Array['LinkCetak1'].'" target="_blank">Tanda Peserta</a> </td>                                        	   
										</tr>';
                                }
                                echo '</tbody></table>';
                                
                               
                            } else {
                                echo '<div style="padding: 10px 0;">Data tidak ditemukan karena tidak ada data yang sesuai dengan kriteria pencarian.</div>';
                            }
                        ?>                       
       
</body>
</html>