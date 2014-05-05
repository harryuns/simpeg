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
                    <h1 style="padding: 0 0 10px 0;">Hapus Data Peserta</h1>
					
					<!--
					<?php if ($this->llogin->IsUserFakultas() == 1) { ?>
						<div style="color: #FF0000; padding: 0 0 0 5px;">Maaf, untuk user fakultas untuk sementara tidak bisa mengubah data kepegawaian.</div>
					<?php } ?>
					-->
					
					<div></div>
                    
                    <div class="clearfix">
                    	
                            <form method="post" id="FormDelPegawai" class="clearfix">
                       <div class="left  form-block">
                       			
                            <label><strong>Periode : </strong></label>
                             <select id="TAHUN" name="TAHUN">
									  <?foreach($ArrayPeriode as $key=>$value){?>
                                    	<option value="<?php echo $value['K_PERIODE'];?>"><?php echo $value['PERIODE'] .' - '. $value['TAHUN'];?></option>                                    	                                	                                  	
										<?}?>
									</select>
                            
                            </div>
                            
                            <div class="left form-block">
                            <button id="BtnHapus" name="BtnHapus" onclick="HapusDataPeserta()">Hapus Data</button>
                  					</div>

                     		</form>                                       
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
function HapusDataPeserta(){
	if (confirm("Apakah Anda yakin untuk menghapus semua data peserta ini?") == true){
		$("#FormDelPegawai").submit();
	}		
}
</script>