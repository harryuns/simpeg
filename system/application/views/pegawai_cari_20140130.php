<?php
    $PencarianDetailLastest = (isset($_POST['PencarianDetail'])) ? $_POST['PencarianDetail'] : '';
	
	$ArraySearchCriteria = array(
		0 => array('id' => '0', 'title' => 'Jenis Kerja'),
		1 => array('id' => '1', 'title' => 'Unit Kerja')
//		2 => array('id' => '2', 'title' => 'Status Kerja'),
//		3 => array('id' => '3', 'title' => 'Status Aktif')
	);
	$array_sorting = array( '1' => "NIP", '2' => "DUK" );
	
	$user_fakultas_id = $_SESSION['UserLogin']['Fakultas']['ID'];
	
	// unit kerja
	$k_unit_kerja = (isset($_POST['K_UNIT_KERJA'])) ? $_POST['K_UNIT_KERJA'] : '';
	$unit_kerja = $this->lunit_kerja->GetById($k_unit_kerja);
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
                    <h1 style="padding: 0 0 10px 0;">Pencarian Pegawai</h1>
					
					<!--
					<?php if ($this->llogin->IsUserFakultas() == 1) { ?>
						<div style="color: #FF0000; padding: 0 0 0 5px;">Maaf, untuk user fakultas untuk sementara tidak bisa mengubah data kepegawaian.</div>
					<?php } ?>
					-->
					
					<div></div>
                    
                    <div>
                        <form method="post" id="FormPegawai">
                            <input type="hidden" name="PageActive" value="1" />
                            <input type="hidden" name="DeletePegawai" value="0" />
                            <input type="hidden" name="PencarianDetailLastest" value="<?php echo $PencarianDetailLastest; ?>" />
                            <input type="hidden" name="user_fakultas_id" value="<?php echo $user_fakultas_id; ?>" />
							<?php if ($this->llogin->IsUserFakultas() == 1) { ?>
								<input type="hidden" name="K_PARENT" value="14" />
							<?php } ?>
							
                            <table style="width: 100%;">
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" style="width: 300px;" maxlength="50" value="<?php echo $_POST['NAMA']; ?>" name="NAMA" /></td></tr>
                                <tr class="hidden">
                                    <td>Berdasarkan</td>
                                    <td><select style="width: 200px;" name="PencarianDetail">
                                        <?php echo ShowOption(array('Array' => $ArraySearchCriteria, 'Selected' => $PencarianDetailLastest)); ?>
                                    </select></td></tr>
                                <tr class="SearchDetail hidden">
                                    <td>Jenis Kerja</td>
                                    <td><select style="width: 200px;" name="K_JENIS_KERJA"><?php echo GetOption(false, $ArrayJenisKerja, $_POST['K_JENIS_KERJA']); ?></select></td></tr>
                                <tr class="SearchDetail hidden">
                                    <td>Unit Kerja</td>
                                    <td>
										<input type="hidden" name="K_UNIT_KERJA" value="<?php echo @$unit_kerja['K_UNIT_KERJA']; ?>" />
										<input type="text" name="UNIT_KERJA" style="width: 200px;" size="50" value="<?php echo @$unit_kerja['CONTENT']; ?>" class="unit-kerja" readonly="readonly" />
										<input type="button" style="width: 75px;" class="show_unitkerja" data-target=".unit-kerja" value="Pilih" />
									</td></tr>
                                <tr class="SearchDetail hidden">
                                    <td>Status Kerja</td>
                                    <td><select style="width: 200px;" name="K_STATUS_KERJA"><?php echo GetOption(false, $ArrayStatusKerja, $_POST['K_STATUS_KERJA']); ?></select></td></tr>
                                <tr class="SearchDetail hidden">
                                    <td>Status Aktif</td>
                                    <td><select style="width: 200px;" name="K_AKTIF"><?php echo GetOption(false, $ArrayStatusPensiun, $_POST['K_AKTIF']); ?></select></td></tr>
								<tr>
                                    <td>Diurutkan berdasarkan</td>
                                    <td><select style="width: 200px;" name="SORTING"><?php echo GetOption(false, $array_sorting, @$_POST['SORTING']); ?></select></td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="CariPegawai" value="Cari Data" /></td></tr>
                            </table>
                        </form>
                        
						<?php if (isset($ArrayPegawai['Pegawai'])) { ?>
							<?php if ($_POST['SORTING'] == 1) { ?>
								<?php $this->load->view( 'grid/pegawai_common', array( 'array_pegawai' => $ArrayPegawai['Pegawai'], 'page_count' => $ArrayPegawai['PageCount'], 'page_active' => $ArrayPegawai['PageActive'] ) ); ?>
							<?php } else if ($_POST['SORTING'] == 2) { ?>
								<?php $this->load->view( 'grid/pegawai_duk', array( 'array_pegawai' => $ArrayPegawai['Pegawai'], 'page_count' => $ArrayPegawai['PageCount'], 'page_active' => $ArrayPegawai['PageActive'] ) ); ?>
							<?php } ?>
						<?php } ?>
						
						<div style="padding: 15px 0 0 25px;">
							* Jika terdapat data double di DUK, dicek kembali :<br />
							<ol>
								<li>Data riwayat pendidikan dengan jenjang, tgl ijazah dan tahun lulus yang sama</li>
								<li>Data riwayat fungsional dengan tmt atau tgl sk yang sama</li>
								<li>Data riwayat homebase dengan tmt atau tgl sk yang sama</li>
								<li>Data riwayat pangkat dengan golongan pangkat atau tmt yang sama</li>
							</ul>
						</div>
						
                        <div id="DialogConfirm" title="Informasi" style="display: none;"><p>&nbsp;</p></div>
                        <div id="DialogProfile" title="Informasi" style="display: none;"><p>&nbsp;</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<?php $this->load->view('common/form_unit_kerja'); ?>
	
	<script type="text/javascript">
function InitSearch() {
	var user_fakultas_id = $('[name="user_fakultas_id"]').val();
	
    var Form = {
        PencarianDetail: function() {
			$('.SearchDetail').eq(0).show();
			$('.SearchDetail').eq(1).show();
        },
		UnitKerja: function() {
			var k_jenis_kerja = $('[name="K_JENIS_KERJA"]').val();
			
			if (user_fakultas_id == 'x') {
				if (k_jenis_kerja == '01') {
					$('[name="K_UNIT_KERJA"]').val('99');
					$('[name="UNIT_KERJA"]').val('Seluruh Fakultas');
				} else {
					$('[name="K_UNIT_KERJA"]').val('x');
					$('[name="UNIT_KERJA"]').val('SELURUH UNIT');
				}
				
				$('.show_unitkerja').show();
				return;
			}
			
			// $('.show_unitkerja').hide();
			var ajax_data = { Action: 'GetUnitKerjaByID', K_JENIS_KERJA: $('select[name="K_JENIS_KERJA"]').val() }
			$.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/UnitKerja", data: ajax_data,
				success: function(RawResult) {
					eval('var unit_kerja = ' + RawResult);
					$('[name="K_UNIT_KERJA"]').val(unit_kerja.id);
					$('[name="UNIT_KERJA"]').val(unit_kerja.Content);
					$('[name="K_PARENT"]').val(unit_kerja.id);
				}
			});
		},
        InitPaging: function() {
            $('#PagePegawai a').click(function() {
                var Page = $(this).text();
                $('input[name="PageActive"]').val(Page);
                $('#FormPegawai').submit();
            });
        },
        InitExport: function() {
            $('#PageFeature .Excel img').click(function() {
                var Data = InitForm.GetValue('FormPegawai');
                Data.Export = 1;
                Data.ExportType = 'Excel';
                Data.ExportName = 'PencarianPegawai';
                
                $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/ExportPegawai", data: Data,
                    success: function(RawResult) {
                        eval('var Result = ' + RawResult);
                        window.location = Result.LinkExcel;
                    }
                });
            });
        }
    }
    
    $('input[name="TambahPegawai"]').click(function() {
        window.location = Web.HOST + '/index.php/Pegawai/Tambah';
    });
    $('#ListPegawai .DeletePegawai').click(function() {
    	alert("Test");
        var K_PEGAWAI = $(this).parent('td').parent('tr').children('td').eq(2).text();
        alert(K_PEGAWAI); 
        $('#DialogConfirm p').html('Apa anda yakin akan menghapus data pegawai <strong>' + K_PEGAWAI + '</strong> ini ?');
        
        $("#DialogConfirm").dialog({
            resizable: false, modal: true, height: 140,
            buttons: {
                "Ya": function() {
                    $('input[name="DeletePegawai"]').val(K_PEGAWAI);
                    $('#FormPegawai').submit();
                },
                'Tidak': function() {
                    $(this).dialog( "close" );
                }
            }
        });
    });
    $('#ListPegawai .Detail').click(function() {
        var Object = {
            K_PEGAWAI: $(this).parents('tr').children('td').eq(2).text(),
            Action: 'GetPreviewPegawai'
        }
        $.ajax({ type: "POST", url: Web.HOST + "/index.php/Ajax/Pegawai", data: Object,
            success: function(ContentHtml) {
                $('#DialogProfile p').html(ContentHtml);
                $("#DialogProfile").dialog({ resizable: false, modal: true, buttons: null, width: 750 });
            }
        });
    });
    $('select[name="PencarianDetail"]').change(function() { Form.PencarianDetail(); });
    $('select[name="K_JENIS_KERJA"]').change(function() { Form.UnitKerja(); });
    
    $('select[name="PencarianDetail"]').val($('input[name="PencarianDetailLastest"]').val());
    
    Form.PencarianDetail();
    Form.InitPaging();
    Form.InitExport();
	
	if (user_fakultas_id != 'x') {
		Form.UnitKerja();
	}
}

InitSearch();
	</script>

</body>
</html>