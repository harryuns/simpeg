<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tanda Peserta</title>
<link href="<?php echo HOST."/Style/form-style.css"; ?>" rel="stylesheet" type="text/css" >
</head>

<body>
<?php 
if (isset($ArrayPegawai['Pegawai']) && count($ArrayPegawai['Pegawai']) > 0) {
	foreach ($ArrayPegawai['Pegawai'] as $Key => $Array) {
?>
<div id="wrapper1">
   	  <div id="header">
        	<div id="logo">
            	<img src="<?php echo HOST."/assets/css/images/ub.png"; ?>" style="padding-top:10px; width:80px;height:80px;" />
            </div>
            <div id="text-logo">            
            	kementerian pendidikan dan kebudayaan<br />
                panitia seleksi penerimaan <br />
                tenaga calon asisten dosen dan dosen tetap non pns <br />
                universitas brawijaya<br/>
                periode II tahun 2013
            </div>
            <div class="namaform">PESERTA</div>
        </div>
        <div id="content1">
        	<center><p style="font-size:14px; font-weight:bold; margin:0 0 5px 0;">TANDA PESERTA</p></center>
            <table id="isi">
            	<tr>
                	<td id="jarak1">Unit Kerja</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3">Universitas Brawijaya</td>
                </tr>
                <tr>
                	<td id="jarak1">Nomor Peserta</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><b><?php echo $Array['NO_PESERTA']; ?></b></td>
                </tr>
                <tr>
                	<td id="jarak1">Nama</td>
                    <td id="jarak2">:</td>
                    <td id="jarak2"><?php echo $Array['NAMA']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Alamat</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $Array['ALAMAT']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1"></td>
                    <td id="jarak2"></td>
                    <td id="jarak3"></td>
                </tr>
                <tr>
                	<td id="jarak1">Pilihan Pelamar</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $Array['PILIHAN']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Jenjang Pendidikan</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $Array['JENJANG']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Kualifikasi Pendidikan</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3"><?php echo $Array['KUALIFIKASI_PEND']; ?></td>
                </tr>
                <tr>
                	<td id="jarak1">Hari/Tanggal Seleksi</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3">Rabu, 10 Juli 2013</td>
                </tr>
                <tr>
                	<td id="jarak1">Tempat</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3">Gedung Samantha Krida Universitas Brawijaya</td>
                </tr>
                <tr>
                	<td id="jarak1">Pukul</td>
                    <td id="jarak2">:</td>
                    <td id="jarak3">08.00 WIB - sampai selesai</td>
                </tr>
            </table>
            <div id="bawah">
                <div id="catatan" style="font-size:11px; font-style:italic">
                    	<p>
                            <b>Catatan :</b>
                            <table style="font-size:11px;">
								<tr>
                                	<td style="vertical-align:top">1.</td>
                                    <td>Tanda Peserta harus bawa pada <b>saat Ujian</b></td>
                                </tr>
                                <tr>
                                	<td style="vertical-align:top">2.</td>
                                    <td>Saat seleksi harap membawa <b>Pensil 2B, Penghapus</b> dan <b>Rautan</b></td>
                                </tr>
                            </table>
                        </p>
                </div>
                <div id="foto" style="margin-left:60px">
                	<center>
                    	<p style="line-height:18px; text-align: center">
                        	Pas Foto<br/>
                            3 &times; 4 cm<br/>
                            <br/>
                            Tanda tangan<br />
                            Peserta<br />
                            kena Photo<br />
                        </p>
                    </center>       
                </div>
                <div style="float:left; margin-left:120px; margin-top:40px">
                <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>&chld=H|0" style=" width:120px;height:120px;" />
                </div>
            </div>
            <div class="coret">
            *) Coret yang tidak perlu
            </div>
            <div id="clear"></div>
        </div>
    </div>
    <pagebreak />
	<?php 
		}
		}
	?>
</body>
</html>
<script>
window.print();
</script>
