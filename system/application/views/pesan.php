<?php
//	print_r($ListMessage); exit;
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
                    <h1 style="padding: 0 0 10px 0;">Pesan</h1>
                    <div id="CntPesanForm"><form method="post" action="<?php echo HOST.'/index.php/Pesan'; ?>">
                        <input type="hidden" name="PageActive" value="<?php echo $ListMessage['PageActive']; ?>" />
                        <div style="float: left; width: 150px;">Tanggal :</div>
                        <div style="float: left; width: 160px;"><input type="text" name="Date" value="<?php echo $ListMessage['SearchDate']; ?>" class="datepicker" /></div>
                        <div style="float: left; width: 150px;"><input type="submit" name="Submit" value="Cari" style="width: 80px;" /></div>
                        <div class="clear"></div>
                    </form></div>
                    
                    <div id="CntPesanList">
                        <?php
                            if (count($ListMessage['List']) > 0) {
                                echo '
                                    <div id="InitTable" class="cnt_table_main">
                                        <table>
                                            <tr>
                                                <td class="left" style="width: 125px;">Waktu</td>
                                                <td class="center" style="width: 125px;">NIP</td>
                                                <td class="normal" style="width: 550px;">Pesan</td>
                                                <td class="normal" style="width: 125px; text-align: center;">Link</td>
                                                </tr>';
                                foreach ($ListMessage['List'] as $Key => $Array) {
									$ArrayClean = $Array;
									unset($ArrayClean['PESAN']);
									unset($ArrayClean['LinkPegawaiData']);
									unset($ArrayClean['LinkPegawaiPesan']);
									$JsonArrayClean = json_encode($ArrayClean);
									
									$CommentReply = $LinkPegawaiData = $LinkPegawaiPesan = '';
									if (! empty($Array['LinkPegawaiData'])) {
										$CommentTitle = ($Array['JML_ANSWER'] == 0) ? 'Balas Pesan' : $Array['JML_ANSWER'] . ' Balasan';
										$CommentReply = '<div style="margin: 5px 0 0 0; font-weight: 700; cursor: pointer;" class="CommentReply">'.$CommentTitle.'<span class="hidden JsonClean">'.$JsonArrayClean.'</span></div>';
										
										$LinkPegawaiData = '<a href="'.$Array['LinkPegawaiData'].'"><img src="'.HOST.'/images/Pencil.png" style="width: 15px; border: none;" title="Edit Data Pegawai" /></a>';
										$LinkPegawaiPesan = '<a href="'.$Array['LinkPegawaiPesan'].'"><img src="'.HOST.'/Style/siado/Lens.jpg" style="width: 15px; border: none;" title="Cari berdasarakan NIP pegawai" /></a>';
									}
									
									echo '
                                        <tr>
                                            <td class="licon">'.$Array['WAKTU'].'</td>
                                            <td class="body">'.$Array['SENDER'].'</td>
                                            <td class="body">'.$Array['PESAN'].'</td>
                                            <td class="body" style="text-align: center;">
												'.$LinkPegawaiData.' '.$LinkPegawaiPesan.' '.$CommentReply.'
												
											</td>
                                        </tr>';
                                }
                                echo '</table></div>';
                                
                                $PagePegawai = '';
                                if ($ListMessage['PageCount'] > 1) {
                                    $Content = '';
                                    
                                    for ($Counter = -5; $Counter < 5; $Counter++) {
                                        $PageActive = $ListMessage['PageActive'] + $Counter;
                                        
                                        if ($PageActive >= 1 && $PageActive <= $ListMessage['PageCount']) {
                                            $Class = ($Counter == 0) ? 'active' : '';
                                            $Content .= '<a class="'.$Class.'">'.$PageActive.'</a> ';
                                        }
                                    }
                                    
                                    $PagePegawai = '<div id="PagePegawai">'.$Content.'</div>';
                                }
                                
                                echo '<div id="PageFeature">'.$PagePegawai.'</div>';
                            }
                        ?>
                    </div>
                    <script type="text/javascript">InitMessageModule();</script>
<script type="text/javascript">
	function ReplyComment() {
		var Param = {
			Action: 'ReplayComment',
			K_PEGAWAI: $('input[name="K_PEGAWAI"]').val(),
			ID_REQUEST: $('input[name="ID_REQUEST"]').val(),
			PESAN: $('textarea[name="Comment"]').val()
		}
        $.ajax({ type: "POST", url: Web.HOST + "/index.php/Pesan", data: Param,
            success: function(RawResult) {
				eval('Result = ' + RawResult);
				
				var Infomation = '';
				if (Result.Query == '00000') {
					Infomation = 'Pesan berhasil disimpan';
				} else  {
					Infomation = 'Pesan gagal disimpan';
				}
				
				ShowDialogObject({
					ArrayMessage: [Infomation],
					ArrayButton: [ {
						text: "Ok", click: function() { window.location = Web.HOST + "/index.php/Pesan" }
					} ]
				});
            }
        });
	}
	
	function ShowMessageDialog(Param) {
		var TextTemplate = '<div id="CntMessageReplay" style="padding: 0 0 10px 20px;">' + Param.ListPesan + '</div>';
		TextTemplate += '<div style="text-align: center;">';
		TextTemplate += '<input type="hidden" name="K_PEGAWAI" value="' + Param.SENDER + '" />';
		TextTemplate += '<input type="hidden" name="ID_REQUEST" value="' + Param.ID_REQUEST + '" />';
		TextTemplate += '<textarea name="Comment" style="width: 375px; height: 100px;"></textarea>';
		TextTemplate += '</div>';
		
		ShowDialogObject({
			Width: 425,
			Title: 'Balas Pesan kepada NIP ' + Param.SENDER,
			ArrayMessage: [TextTemplate],
			ArrayButton: [ {
						text: "Kirim", click: function() { $(this).dialog("close"); ReplyComment(); }
				}, {	text: "Tutup", click: function() { $(this).dialog("close"); }
			} ]
		})
	}
	
	$('.CommentReply').click(function() {
		var RawRecord = $(this).children('span.JsonClean').text();
		eval('var Record = ' + RawRecord);
		
		var ParamDialog = {
			ListPesan: '',
			SENDER: Record.SENDER,
			ID_REQUEST: Record.ID_REQUEST
		}
		
		if (Record.JML_ANSWER == 0) {
			ShowMessageDialog(ParamDialog);
			return;
		}
		
		var ParamAjax = { Action: 'GetMessageReply', ID_REQUEST: Record.ID_REQUEST }
        $.ajax({ type: "POST", url: Web.HOST + "/index.php/Pesan", data: ParamAjax,
            success: function(RawResult) {
				eval('Result = ' + RawResult);
				
				for (var i = 0; i < Result.length; i++) {
					ParamDialog.ListPesan += '<li>' + Result[i].PESAN + '</li>';
				}
				ParamDialog.ListPesan = '<div>Balasan pesan :</div><ol>' + ParamDialog.ListPesan + '</ol>';
				
				ShowMessageDialog(ParamDialog);
            }
        });
	});
</script>
                </div>
            </div>
        </div>
    </div>
</body>
</html>