<?php
//	print_r($ArrayRiwayatPangkat); exit;
?>
<body>
		<div id="portal" style="display:true" class="clearfix">
	<div class="logo left">
		<a href="#">Simpeg UB</a>
	</div>
	<div class="hlink right">
    	<ul>
            <li>Login as <a href="#">rizalespe (Rizal Setya Perdana)</a>, </li>
			</ul>
    </div>
    
</div>
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
						<div id="loadingexcel"></div>
						<div style="display: none;" id="form_import">
							<form id="formuploadberkas" action="<?=base_url()?>/index.php/DirGuruBesar/import" method="post" enctype="multipart/form-data">
								<input type="file" name="fileexcel" id="fileexcel" />
							</form>
							<button id="btnUploadexcel" class="btn primary">Import</button>
							<button id="btnCancelUploadexcel" class="btn primary">Cancel</button>
						</div>
						<div id="menu_control">
							<a href='<?=base_url()?>/index.php/DirGuruBesar/insert'>Tambah data</a> 
							&nbsp;|&nbsp;
							<a href='javascript:void(0)' onClick="showformimport()">Import data</a>  
						</div>
						<div id="List" class="cnt_table_main" style="width: 100%; height: 400px;">
						<table id='list-table' >
						<thead>
							<tr>
								<th rowspan='2' class='left' width='3%'>No</th>
								<th rowspan='2' class='normal' width='20%'>NAMA / NIP / TEMPAT / TANGGAL LAHIR</th>
								<th rowspan='2' class='normal' width='5%'>FAK</th>
								<th colspan='2' class='normal' width='35%'>PENGUKUHAN</th>
								<th rowspan='2' class='normal' width='10%'>BIDANG ILMU</th>
								<th rowspan='2' class='normal' width='10%'>PENSIUN</th>
								<th rowspan='2' class='normal' width='17%'>KETERANGAN</th>
								<th rowspan='2' class='normal'>Action</th>
							</tr>
							<tr>
								<th  class='normal'>TANGGAL</th>
								<th  class='normal'>JUDUL ORASI ILMIAH</th>
							</tr >
						</thead>
						<tbody>
							<?$i=1; foreach($list as $key=>$value){?>
							<tr>
								<td class='normal'><?=$i++?></td> 
								<td class='normal'><?=$value['GLR_DPN']." ".$value['NAMA'].$value['GLR_BLKG']?><br/>
								<strong><i>(<?=$value['K_PEGAWAI']?>)</strong></i><br/><?=$value['TGL_LAHIR']?></td>
								<td class='normal'><?=$value['UNIT_KERJA_SINGKAT']?></td>
								<td class='normal'><?=$value['TGL_PENGUKUHAN']?></td>
								<td class='normal'><?=$value['JUDUL_ORASI']?></td>
								<td class='normal'><?=$value['BIDANG_ILMU']?></td>
								<td class='normal'><?=$value['TGL_PENSIUN']?></td>
								<td class='normal'><? if($value['TGL_WAFAT']) echo'(Wafat : '.$value['TGL_WAFAT'].')<br/>';?>
									<?=$value['KETERANGAN']?>
								</td>
								<td><a href='<?=base_url()?>index.php/DirGuruBesar/edit/<?=$value['ID_GURU_BESAR']?>'>Edit</a> 
								<a href='<?=base_url()?>index.php/DirGuruBesar/delete/<?=$value['ID_GURU_BESAR']?>'> Delete</a></td>
							</tr>
							<?}?>
						</tbody>
						</table>
						</div>
                    </div>   
				</div>
            </div>
        </div>
    </div>
    <script>
		function showformimport(){
			$("#form_import").show("medium");
			$("#menu_control").hide("medium");
		}
		
		$("#btnUploadexcel").click(function(){
			$('#loadingexcel').html("<img src=\"<?php echo HOST ?>/images/AjaxLoading.gif\" />");
			$("#formuploadberkas").ajaxForm({
				target: '#loadingexcel',
				success: function(msg){
					// load data
					// $('#loadingexcel').html(msg);
					// $("#form_import").hide("medium");
					// $("#menu_control").show("medium");
					alert(msg);
					location.reload();
				}
			}).submit();
		})
		
		$("#btnCancelUploadexcel").click(function(){
			$("#form_import").hide("medium");
			$("#menu_control").show("medium");
		})
	</script>
</body>
</html>