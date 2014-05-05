<?php
	$Record = (isset($RiwayatHomeBase['Record'])) ? $RiwayatHomeBase['Record'] : array();
	$Record['K_PEGAWAI'] = $PageParam['K_PEGAWAI'];
	$Record['ID_RIWAYAT_HOMEBASE'] = (isset($PageParam['ID_RIWAYAT_HOMEBASE'])) ? $PageParam['ID_RIWAYAT_HOMEBASE'] : '';
	
	// Populate Data
	if (!empty($Record['ID_RIWAYAT_HOMEBASE'])) {
		$ArrayRecord = $this->lriwayat_home_base->GetArray($Record['K_PEGAWAI'], $Record['ID_RIWAYAT_HOMEBASE']);
	}
	if (isset($ArrayRecord) && count($ArrayRecord) == 1) {
		foreach ($ArrayRecord as $Key => $Array) {
			$Record = $Array;
		}
	} else {
		$Record['NO_SK'] = (isset($Record['NO_SK'])) ? $Record['NO_SK'] : '';
		$Record['TGL_SK'] = (isset($Record['TGL_SK'])) ? $Record['TGL_SK'] : '';
		$Record['K_ASAL_SK'] = (isset($Record['K_ASAL_SK'])) ? $Record['K_ASAL_SK'] : '';
		$Record['TMT'] = (isset($Record['TMT'])) ? $Record['TMT'] : '';
		$Record['K_UNIT_KERJA'] = (isset($Record['K_UNIT_KERJA'])) ? $Record['K_UNIT_KERJA'] : '14';
		$Record['K_JABATAN_FUNGSIONAL'] = (isset($Record['K_JABATAN_FUNGSIONAL'])) ? $Record['K_JABATAN_FUNGSIONAL'] : '';
		$Record['K_JENJANG'] = (isset($Record['K_JENJANG'])) ? $Record['K_JENJANG'] : '01';
		$Record['K_FAKULTAS'] = (isset($Record['K_FAKULTAS'])) ? $Record['K_FAKULTAS'] : 'x';
		$Record['K_JURUSAN'] = (isset($Record['K_JURUSAN'])) ? $Record['K_JURUSAN'] : 'x';
		$Record['K_PROG_STUDI'] = (isset($Record['K_PROG_STUDI'])) ? $Record['K_PROG_STUDI'] : '';
	}
	
	$ArrayAsalSk = $this->lasal_sk->GetArrayAsalSk();
	// $ArrayUnitKerja = $this->lunit_kerja->GetArray(1, 1);
	$ArrayUnitKerja = ($Pegawai['IsDosen'] == 1) ?
		$this->lunit_kerja->GetArray('1', $Pegawai['IsDosen'], $_SESSION['UserLogin']['Fakultas']['ID']) :
		$this->lunit_kerja->GetArrayAll();
	$ArrayJenjang = $this->ljenjang->GetJenjangByUnitKerja($Record['K_UNIT_KERJA']);
	$ArrayFakultas = $this->lfakultas->GetFakultasByJenjangUnitKerja($Record['K_JENJANG'], $Record['K_UNIT_KERJA']);
	$ArrayJurusan = $this->ljurusan->GetById($Record['K_JENJANG'], $Record['K_FAKULTAS']);
	$ArrayProgramStudi = $this->lprogram_studi->GetById($Record['K_JENJANG'], $Record['K_FAKULTAS'], $Record['K_JURUSAN']);
	$ArrayJabatanFungsional = $this->ljabatan_fungsional->GetArrayByJenisKerja($Pegawai['IsDosen']);
	
	$ShowGrid = 1;
	if (isset($_POST['Tambah']) || isset($RiwayatHomeBase['Error']) || !empty($PageParam['ID_RIWAYAT_HOMEBASE'])) {
		$ShowGrid = 0;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include 'body_meta.php'; ?>
<body>
    <div id="body">
        <div id="frame">
            <div id="sidebar">
                <div class="glossymenu"><?php include 'main_menu.php'; ?></div>
            </div>
            
            <div id="content">
            		
            		<div class="contentmenu clearfix"><?php include 'main_sub_menu.php'; ?></div>
                <div class="full" style="min-height: 400px;">
                    <div id="CntRightFull">
                        <?php include 'pegawai_info.php'; ?>
                        
                        <?php
                            if ($ShowGrid == 1 && count($ArrayRiwayatHomeBase) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
										<table style="width: 950px">
                                            <tr>
                                                <td class="left" style="width: 25px;">&nbsp;</td>
                                                <td class="center" style="width: 25px;">&nbsp;</td>
                                                <td class="normal" style="width: 150px;">No SK</td>
                                                <td class="normal" style="width: 150px;">Tanggal SK</td>
                                                <td class="normal" style="width: 225px;">Asal SK</td>
                                                <td class="normal" style="width: 150px;">TMT</td>
                                                <td class="normal" style="width: 225px;">Unit Kerja</td>
                                                <td class="normal" style="width: 225px;">Prodi</td>
                                                <td class="normal" style="width: 50px;">PDPT</td>
                                                <td class="normal" style="width: 50px;">SIMPEG</td>
                                                <td class="normal" style="width: 75px;">SK</td></tr>';
                                foreach ($ArrayRiwayatHomeBase as $Key => $Array) {
									$FileLinkInfo = (empty($Array['JML_FILE'])) ? '-' : 'Cek';
									$is_pdpt = ($Array['IS_PDPT'] == 1) ? 'Ya' : 'Tidak';
									$is_simpeg = ($Array['IS_SIMPEG'] == 1) ? 'Ya' : 'Tidak';
									
                                    echo '
                                        <tr>
                                            <td class="licon"><a href="'.$Array['LinkDelete'].'" class="Delete">
                                                <img class="link" src="'.HOST.'/images/Delete.png" /></a></td>
                                            <td class="icon"><a href="'.$Array['LinkEdit'].'" class="Edit">
                                                <img class="link" src="'.HOST.'/images/Pencil.png" /></a></td>
                                            <td class="body">'.$Array['NO_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TGL_SK']).'</td>
                                            <td class="body">'.$Array['ASAL_SK'].'</td>
                                            <td class="body">'.ConvertDateToString($Array['TMT']).'</td>
                                            <td class="body">'.$Array['UNIT_KERJA'].'</td>
                                            <td class="body">'.$Array['PRODI'].'</td>
                                            <td class="body">'.$is_pdpt.'</td>
                                            <td class="body">'.$is_simpeg.'</td>
                                            <td class="body">'.$FileLinkInfo.'</td>
                                        </tr>';
                                }
                                echo '
                                    </table></div>
                                    <script type="text/javascript">InitTable();</script>';
                            }
                        ?>
                    
                        <div style="width: 550px; padding: 10px 0 0 0;" id="FormRiwayatHomeBase">
                            <?php if (!empty($RiwayatHomeBase['Message'])) { ?>
								<div class="MessagePopup"><?php echo $RiwayatHomeBase['Message']; ?></div>
                            <?php } ?>
                            
                            <form method="post" action="<?php echo $Pegawai['LinkRiwayatHomeBase']; ?>">
								<input type="hidden" name="FormName" value="RiwayatHomeBase" />
								<input type="hidden" name="ID_RIWAYAT_HOMEBASE_HI" value="<?php echo (empty($Record['ID_RIWAYAT_HOMEBASE'])) ? '' : ConvertLink($Record['ID_RIWAYAT_HOMEBASE']); ?>" />
								
								<?php if ($ShowGrid == 0) { ?>
									<table style="width: 100%;" class="tabel" cellspacing="0" cellpadding="5" border="0">
										<tr>
											<td>No SK</td>
											<td><input type="text" style="width: 85%;" size="50" value="<?php echo $Record['NO_SK']; ?>" name="NO_SK" class="required sk_char" alt="No SK kosong" /></td></tr>
										<tr>
											<td>Tanggal SK</td>
											<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($Record['TGL_SK']); ?>" name="TGL_SK" class="required datepicker" alt="Tanggal SK kosong" /></td></tr>
										<tr>
											<td style="width: 200px;">Asal SK</td>
											<td style="width: 300px;"><select style="width: 85%;" name="K_ASAL_SK"><?php echo GetOption(false, $ArrayAsalSk, $Record['K_ASAL_SK']); ?></select></td></tr>
										<tr>
											<td>TMT</td>
											<td><input type="text" style="width: 150px;" size="50" value="<?php echo ChangeFormatDate($Record['TMT']); ?>" name="TMT" class="datepicker" /></td></tr>
										<tr class="hidden">
											<td style="width: 200px;">Jabatan Fungsional</td>
											<td style="width: 300px;"><select style="width: 85%;" name="K_JABATAN_FUNGSIONAL"><?php echo GetOption(false, $ArrayJabatanFungsional, $Record['K_JABATAN_FUNGSIONAL']); ?></select></td></tr>
										<tr>
											<td style="width: 200px;">Unit Kerja</td>
											<td style="width: 300px;">
												<input type="hidden" name="K_UNIT_KERJA" value="<?php echo @$Record['K_UNIT_KERJA']; ?>" data-change="1" data-record="" />
												<input type="text" style="width: 150px;" size="50" value="<?php echo @$Record['UNIT_KERJA']; ?>" class="unit-kerja" readonly="readonly" />
												<input type="button" style="width: 75px;" class="show_unitkerja" data-target=".unit-kerja" value="Ubah" />
											</td></tr>
										<tr class="non_fakultas">
											<td style="width: 200px;">Jenjang</td>
											<td style="width: 300px;"><select style="width: 85%;" name="K_JENJANG"><?php echo GetOption(false, $ArrayJenjang, $Record['K_JENJANG']); ?></select></td></tr>
										<tr class="non_fakultas">
											<td style="width: 200px;">Fakultas</td>
											<td style="width: 300px;"><select style="width: 85%;" name="K_FAKULTAS"><?php echo GetOption(false, $ArrayFakultas, $Record['K_FAKULTAS']); ?></select></td></tr>
										<tr class="non_fakultas">
											<td style="width: 200px;">Jurusan</td>
											<td style="width: 300px;"><select style="width: 85%;" name="K_JURUSAN"><?php echo GetOption(false, $ArrayJurusan, $Record['K_JURUSAN']); ?></select></td></tr>
										<tr class="non_fakultas">
											<td style="width: 200px;">Program Studi</td>
											<td style="width: 300px;"><select style="width: 85%;" name="K_PROG_STUDI"><?php echo GetOption(false, $ArrayProgramStudi, $Record['K_PROG_STUDI']); ?></select></td></tr>
										<tr>
											<td>digunakan untuk PDPT</td>
											<td><input type="checkbox" value="1" <?php echo (@$Record['IS_PDPT'] == 1) ? 'checked' : ''; ?> name="IS_PDPT"></td></tr>
										<tr>
											<td>digunakan untuk SIMPEG</td>
											<td><input type="checkbox" value="1" <?php echo (@$Record['IS_SIMPEG'] == 1) ? 'checked' : ''; ?> name="IS_SIMPEG"></td></tr>
										<tr>
											<td>Upload</td>
											<td><input type="button" name="UploadFile" value="Upload File" /></td></tr>
										<tr>
											<td colspan="2" style="padding: 10px 0;">
												<input type="button" name="Cancel" value="Batal" class="link" alt="<?php echo $Pegawai['LinkRiwayatHomeBase']; ?>" />
												<input type="reset" name="Reset" value="Reset" />
												<input type="submit" name="Submit" value="Save" />
											</td></tr>
									</table>
								<?php } else { ?>
									<table style="width: 100%;">
										<tr>
											<td colspan="2" style="">
												<input type="submit" name="Tambah" value="Tambah" />
											</td></tr>
									</table>
								<?php } ?>
                            </form>
                            <div id="DialogConfirm" title="Warning" style="display: none;"><p>&nbsp;</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<?php $this->load->view('common/form_unit_kerja'); ?>
	
<script type="text/javascript">
	function InitRiwayatHomeBase() {
		InitForm.Start('FormRiwayatHomeBase');
		
		var ComboBox = {
			Jenjang: function() {
				if ($('input[name="K_UNIT_KERJA"]').length == 0) {
					return;
				}
				
				var Object = {
					Action: 'GetJenjangByUnitKerja',
					K_UNIT_KERJA : $('input[name="K_UNIT_KERJA"]').val()
				}
				$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Jenjang", data: Object,
					success: function(ContentHtml) {
						$('select[name="K_JENJANG"]').html(ContentHtml);
						ComboBox.Fakultas();
					}
				});
			},
			Fakultas: function() {
				var Object = {
					Action: 'GetFakultasByJenjangUnitKerja',
					K_JENJANG : $('select[name="K_JENJANG"]').val(),
					K_UNIT_KERJA: $('input[name="K_UNIT_KERJA"]').val()
				}
				$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Fakultas", data: Object,
					success: function(ContentHtml) {
						$('select[name="K_FAKULTAS"]').html(ContentHtml);
						ComboBox.Jurusan();
					}
				});
			},
			Jurusan: function() {
				var Object = {
					Action: 'GetJurusanById',
					K_JENJANG : $('select[name="K_JENJANG"]').val(),
					K_FAKULTAS : $('select[name="K_FAKULTAS"]').val()
				}
				$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Jurusan", data: Object,
					success: function(ContentHtml) {
						$('select[name="K_JURUSAN"]').html(ContentHtml);
						ComboBox.ProgramStudy();
					}
				});
			},
			ProgramStudy: function() {
				var Object = {
					Action: 'GetProgramStudiById',
					K_JENJANG : $('select[name="K_JENJANG"]').val(),
					K_FAKULTAS : $('select[name="K_FAKULTAS"]').val(),
					K_JURUSAN : $('select[name="K_JURUSAN"]').val()
				}
				$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/ProgramStudi", data: Object,
					success: function(ContentHtml) {
						$('select[name="K_PROG_STUDI"]').html(ContentHtml);
					}
				});
			}
		}
		
		$('input[name="K_UNIT_KERJA"]').change(function() {
			var raw_record = $(this).attr('data-record');
			eval('var record = ' + raw_record);
			if (record.K_FAKULTAS == 99) {
				$('.non_fakultas').hide();
			} else {
				$('.non_fakultas').show();
			}
			
			ComboBox.Jenjang();
		});
		$('select[name="K_JENJANG"]').change(function() { ComboBox.Fakultas(); });
		$('select[name="K_FAKULTAS"]').change(function() { ComboBox.Jurusan(); });
		$('select[name="K_JURUSAN"]').change(function() { ComboBox.ProgramStudy(); });
		
		var ParameterUpdate = $('input[name="ParameterUpdate"]').val();
		if (ParameterUpdate == 'update') {
			$('input[name="NO_SK"]').attr('readonly', 'readonly');
		}
		
		$('#FormRiwayatHomeBase form').submit(function() {
			var ArrayError = InitForm.Validation('FormRiwayatHomeBase');
			return ShowWarning(ArrayError);
		});
		
		if ($('[name="NO_SK"]').val() == '') {
			ComboBox.Fakultas();
		}
	}
	
	InitRiwayatHomeBase();
</script>
</body>
</html>