
<body>
    <div id="body">
        <div id="frame">
            <div id="sidebar">
                <div class="glossymenu"><?php include APPPATH.'views/main_menu.php'; ?></div>
                <div class="glossymenu" style="padding: 50px 0 0 0;"><?php include APPPATH.'views/main_sub_menu.php'; ?></div>
            </div>
            <div id="content">
                <div class="full" style="min-height: 400px;">
                    <div id="CntRightFull">
						<?if($this->session->flashdata('err_msg')){?>
							<div id='err_msg-div'><?= $this->session->flashdata('err_msg')?></div>
						<?}?>
						<div id="List" class="CntRightMid" style="width: 100%;float:left">
						<form method='POST'>
						<table id='form-table' >
						<tbody>
							<input type='hidden' name='ID_GURU_BESAR' value='<?=isset($ID_GURU_BESAR)?$ID_GURU_BESAR:'';?>'/>
							<tr>
								<td>NIP</td> 
								<td>:</td>
								<td><input type='text' name='K_PEGAWAI' value='<?=isset($K_PEGAWAI)?$K_PEGAWAI:'';?>'/></td>
							</tr>
							<tr>
								<td >NAMA</td> 
								<td> : </td>
								<td><input type='text' name='NAMA' value='<?=isset($NAMA)?$NAMA:'';?>' style='width:350px'/></td>
								<?/*<td class='normal'><?=$value['GLR_DPN']." ".$value['NAMA'].$value['GLR_BLKG']?><br/><strong><i>(<?=$value['K_PEGAWAI']?>)</i></strong><br/><?=$value['TGL_LAHIR']?></td>
								<td class='normal'><?=$value['UNIT_KERJA_SINGKAT']?></td>
								<td class='normal'><?=$value['TGL_PENGUKUHAN']?></td>
								<td class='normal'><?=$value['JUDUL_ORASI']?></td> 
								<td class='normal'><?=$value['BIDANG_ILMU']?></td>
								<td class='normal'><?=$value['TGL_PENSIUN']?></td>
								<td class='normal'><? if($value['TGL_WAFAT']) echo'( Wafat : '.$value['TGL_WAFAT'].' )<br/>';?>
									<?=$value['KETERANGAN']?>a 
								</td>
								<td><a href='<?=base_url()?>/index.php/DirGuruBesar/edit?id=<?=$value['ID_GURU_BESAR']?>'>Edit</a> 
								<a href='<?=base_url()?>/index.php/DirGuruBesar/delete?id=<?=$value['ID_GURU_BESAR']?>'> Delete</a></td>  */?>
							</tr>
							<tr>
								<td>GELAR DEPAN</td> 
								<td>:</td>
								<td><input style='width:200px' type='text' name='GLR_DPN' value='<?=isset($GLR_DPN)?$GLR_DPN:'';?>'/></td>
							</tr>
							<tr> 
								<td>GELAR BELAKANG</td> 
								<td>:</td>
								<td><input style='width:200px' type='text' name='GLR_BLKG' value='<?=isset($GLR_BLKG)?$GLR_BLKG:'';?>'/></td>
							</tr>
							<tr>
								<td>TANGGAL LAHIR</td> 
								<td>:</td>
								<td><input type='text' id='inp-tgl_lahir' class='datepicker' name='TGL_LAHIR' value='<?=isset($TGL_LAHIR)?$TGL_LAHIR:'';?>'/></td>
							</tr>
							<tr>
								<td>FAKULTAS</td> 
								<td>:</td>
								<td><select name='ID_UNIT_KERJA'>
									<?if($list_uk)foreach($list_uk as $key=>$value){
										if($key==$K_UNIT_KERJA){
										?>
											<option value='<?=$key?>' selected=selected><?=$value['Content']?></option>
										<?}else{?>
											<option value='<?=$key?>'><?=$value['Content']?></option>
										<?}?>
									<?}?>
									</select>
							</tr>
							<tr>
								<td>TANGGAL PENGUKUHAN</td> 
								<td>:</td>
								<td><input type='text' id='inp-tgl_pengukuhan' class='datepicker' name='TGL_PENGUKUHAN' value='<?=isset($TGL_PENGUKUHAN)?$TGL_PENGUKUHAN:'';?>'/></td>
							</tr>
							<tr>
								<td>JUDUL ORASI</td> 
								<td>:</td>
								<td><textarea type='text' name='JUDUL_ORASI' style='width:450px;height:85px'><?=isset($JUDUL_ORASI)?$JUDUL_ORASI:'';?></textarea></td>
							</tr>
							<tr>
								<td>BIDANG ILMU</td> 
								<td>:</td>
								<td><input type='text' name='BIDANG_ILMU' size='80' value='<?=isset($BIDANG_ILMU)?$BIDANG_ILMU:'';?>'/></td>
							</tr>
							<tr>
								<td>KETERANGAN</td> 
								<td>:</td>
								<td><textarea name='KETERANGAN' style='width:450px;height:85px'/><?=isset($KETERANGAN)?$KETERANGAN:'';?></textarea>
							</tr>
							<tr>
								<td>TANGGAL PENSIUN</td> 
								<td>:</td>
								<td><input type='text' class='datepicker' name='TGL_PENSIUN' value='<?=isset($TGL_PENSIUN)?$TGL_PENSIUN:'';?>'/></td>
							</tr>
							<tr>
								<td>TANGGAL WAFAT</td> 
								<td>:</td>
								<td><input type='text' id='inp-tgl_wafat' class='datepicker' name='TGL_WAFAT' value='<?=isset($TGL_WAFAT)?$TGL_WAFAT:'';?>'/></td>
							</tr>
							<tr>
								<td colspan='3'><input type='submit' id='submit-inp' value='Simpan' name='submit'/></td>
							</tr>
							<?/*IN "INID_GURU_BESAR" VARCHAR(35), 
  IN "INTGL_LAHIR" VARCHAR(35), 
  IN "INID_UNIT_KERJA" VARCHAR(15), 
  IN "INTGL_PENGUKUHAN" VARCHAR(35), 
  IN "INJUDUL_ORASI" VARCHAR(300), 
  IN "INBIDANG_ILMU" VARCHAR(100), 
  IN "INKETERANGAN" VARCHAR(255), 
  IN "INTGL_PENSIUN" VARCHAR(35), 
  IN "INTGL_WAFAT" VARCHAR(35), 
  IN "INURL_FOTO" VARCHAR(35), 
  IN "INUSERID" VARCHAR(25)*/?>
						</tbody>
						</table>
						</form>
						</div>
						<div>
							<img src='<?=isset($URL_FOTO)?$URL_FOTO:'';?>'/>
						</div>
						<div style='float:clear'></div>
                    </div>   
				</div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
	$(document).ready(function(){
		$('.datepicker').datepicker({ dateFormat:'yy-mm-dd'});
	});
</script>
