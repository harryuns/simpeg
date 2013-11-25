<?php
//	print_r($ContentReport['Data']); exit;
?>
<html>
<head>
    <title><?php echo $PageTitle; ?></title>
    <style>
    body { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; }
    table { font-family:  Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; }
    ol { margin-top: 3px; padding-top: 0px; }
    .pagetitle { font-size: 18px; font-weight: bold; line-height: 25px; text-align: center; margin-bottom: 15px; }
    .box { margin-bottom: 10px; width: 27cm; }
    table.ipdet { border-collapse: collapse; }
    table.ipdet td { border: 1px solid black; padding: 0 3px 0 3px; width: 80px; }
    .materai-box { border: 1px solid black; font-size: 10px; height: 50px; margin: 15px 0 15px 0; text-align: center; width: 50px; }
    .debugborder1 { border: 1px solid black }
    .debugborder2 { border: 1px solid red }
    .form { border: 1px solid black; text-align: right; width: auto; float: right; font-weight: bold; padding: 3px; }
    .textHeader{ font-size: 14px; font-family: Arial, Helvetica, sans-serif; }
    .imageborder{ padding:4px; border :1px solid black; background-color:white; }
    .tableClass { padding:0px;  border: none; }
    .tableClass th { border: 1px solid black; vertical-align:middle; text-align: center; font-size: 9pt; }
    .tableClass td { padding:  5px; border: none; }
    </style>
</head>
<body>
<div class="box">
    <table border="0" cellpadding="2" width="100%">
    <tr>
        <td width="10%"></td>
        <td width="15%"></td>
        <td style="border:1px solid black; text-transform:uppercase; font-size: 13pt; text-align: center;"><?php echo $ReportTitle; ?></td>
        <td width="15%"></td>
        <td width="10%"></td></tr>
    <tr><td colspan="5" style="text-transform:uppercase; font-size: 10pt; text-align: center;"><?php echo $ReportDesc; ?></td></tr>
    <tr>
        <td colspan="5">
            <div style="float: left; width: 175px;"><?php echo $PageTopTitle; ?></div>
            <div style="float: left; width: 500px;">: <?php echo $PageTopDesc; ?></div>
            <div style="clear: both;"></div>
        </td></tr>
    <tr>
        <td colspan="5">
            <div style="float: left; width: 175px;"><?php echo $PageBottomTitle; ?></div>
            <div style="float: left; width: 500px;">: <?php echo $PageBottomDesc; ?></div>
            <div style="clear: both;"></div>
        </td></tr>
    <tr><td colspan="5"><hr style="border:none; border-bottom:2px solid black;"></td></tr>
    </table>
    <br />
	
	Jumlah dosen dengan  kesimpulan T = <?php echo $ContentReport['Data']['TotalT']; ?><br />
	Jumlah dosen dengan  kesimpulan M = <?php echo $ContentReport['Data']['TotalM']; ?><br /><br />
	
	<?php
		$Counter = 1;
		$Content = '';
        foreach ($ContentReport['Record'] as $Key => $Array) {
            $Content .= '
                <tr>
                    <td>'.$Counter.'</th>
                    <td>'.$Array['K_PEGAWAI'].'</td>
                    <td>'.$Array['NAMA'].'</td>
                    <td>'.$Array['PD_GANJIL'].'</td>
                    <td>'.$Array['PL_GANJIL'].'</td>
                    <td>'.$Array['PG_GANJIL'].'</td>
                    <td>'.$Array['PK_GANJIL'].'</td>
                    <td>'.$Array['PD_GENAP'].'</td>
                    <td>'.$Array['PL_GENAP'].'</td>
                    <td>'.$Array['PG_GENAP'].'</td>
                    <td>'.$Array['PK_GENAP'].'</td>
                    <td>'.$Array['KK_PROF'].'</td>
                    <td>'.$Array['STATUS'].'</td>
                    <td>'.$Array['KESIMPULAN'].'</td></tr>
            ';
            $Counter++;
        }
        
        echo '
            <table class="tableClass" cellpadding="4" cellspacing="-1" width="100%">
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">NIP</th>
                <th rowspan="2">Nama Dosen</th>
                <th colspan="4">Semester Gasal</th>
                <th colspan="4">Semester Genap</th>
                <th rowspan="2">Kewajiban<br>Khusus<br>Profesor</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Kesimpulan</th></tr>
            <tr>
                <th>PD</th>
                <th>PL</th>
                <th>PG</th>
                <th>PK</th>
                <th>PD</th>
                <th>PL</th>
                <th>PG</th>
                <th>PK</th></tr>
            '.$Content.'
            </table>';
	?>
    
	<!--
    <table border="0" cellpadding="2" width="100%">
        <tr><td colspan="5"><hr style="border:none; border-bottom:2px solid black;"></td></tr>
        <tr><td colspan="5" style="text-align: center; text-transform:uppercase; font-family: Monotype Corsiva; font-size: 12pt;">Pernyataan  <?php echo $HeadOfficer; ?></td></tr>
        <tr><td colspan="5" style="text-align: center; font-family: Monotype Corsiva; font-size: 11pt;"><em>Saya sudah memeriksa dan bisa menyetujui laporan evaluasi ini</em></td></tr>
        <tr><td colspan="5" style="text-align: center; padding-top:30px;">Malang, Tanggal <?php echo $CurrentDate; ?></td></tr>
        <tr><td colspan="5" style="text-align: center;">Mengesahkan <?php echo $HeadOfficer; ?>, <br><br><br><br><br><br><br><?php echo $NamaPejabat; ?></td></tr>
    </table>
	-->
</div>
</body>
</html>