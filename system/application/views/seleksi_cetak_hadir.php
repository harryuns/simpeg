<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="<?php echo HOST."/Style/form-style.css"; ?>" rel="stylesheet" type="text/css" />
</head>
<body style="background: none; font: 90%/1 Arial, Helvetica, sans-serif;">
<div style="margin: 0 auto; max-width: 800px; min-height: 580px;">
	<div style="border: 3px solid #000000; margin: 0 0 0 125px;">
		<div style="text-align: center; border-bottom: 3px solid #000;">
			<div style="float: left; width: 25%;">
            	<img src="<?php echo HOST."/assets/css/images/ub.png"; ?>" style="padding-top: 3px; width:70px; height:70px;" />
            </div>
            <div style="float: left; width: 65%; padding: 15px 0; font-weight: bold; font-size:13px;">
            	PANITIA SELEKSI PENERIMAAN<br />
				CALON TENAGA KEPENDIDIKAN DAN DOSEN TETAP NON PNS<br />
				UNIVERSITAS BRAWIJAYA<br />
                TAHUN 2013
            </div>
			<div style="clear: both;"></div>
        </div>
		
        <div id="content1">
        	<div style="font-size: 20px; text-align: center; font-weight: bold; margin:0 0 5px 0;">BUKTI HADIR</div>
            <table id="isi" style='font-size:13px;'>
            	<tr>
                	<td id="jarak1">Unit Kerja</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3">Universitas Brawijaya</td>
                </tr>
                <tr>
                	<td id="jarak1">Nomor Peserta</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><b><?php echo $peserta['NO_PESERTA']; ?></b></td>
                </tr>
                <tr>
                	<td id="jarak1">Nama</td>
                    <td id="jarak2">:</td>
                    <td id="jarak2"><?php echo $peserta['NAMA']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Alamat</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $peserta['ALAMAT']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Pilihan Pelamar</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $peserta['PILIHAN']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Jenjang Pendidikan</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $peserta['JENJANG']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Kualifikasi Pendidikan</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $peserta['KUALIFIKASI_PEND']; ?></td>
                </tr>
            </table>
            
			<div style="padding: 20px 0 0 0;">
				<div style="float: left; width: 33%;">
					<div style="width: 120px; height: 160px; margin: 0 auto; border: 1px solid #000000; text-align: center;">
						<div style="padding: 25px 0;">
							Pas Foto<br />
							3 x 4 cm<br /><br />
							Tanda tangan<br />
							Peserta<br />
							kena Photo<br />
						</div>
					</div>
					<div style="padding: 10px 0 0 0;">*) Coret yang tidak perlu</div>
				</div>
				<div style="float: left; width: 33%; text-align: center;">
					<div style="padding: 25px 0;">
						TANGGAL<br /><br /><br /><br /><br /><br />
						<?php echo $peserta['TGL_UJIAN']; ?>
					</div>
				</div>
				<div style="float: left; width: 33%; text-align: center;">
					<div style="padding: 25px 0;">
						TANDA TANGAN<br />
						(Waktu Ujian)<br /><br /><br /><br /><br />
						................................<br /><br />
						................................
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
        </div>
    </div>
	
	<div style="font-weight: bold; font-style: italic; font-size: 12px; padding: 22px 0; text-align: right;">&nbsp;</div> 
	<div style="clear: both;"></div>
</div>
</body>
</html>