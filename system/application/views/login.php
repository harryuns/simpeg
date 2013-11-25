<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en-AU">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Mohammad Rizal">
<meta name="keywords" content="Program, Mahasiswa, universitas brawijaya, malang, UB, mandiri">
<meta name="description" content="Program Mahasiswa Wirausaha">
<title>Sistem Informasi Pegawai UB</title>
    <link href="<?php echo HTTPS; ?>/Style/Main.css" rel="stylesheet" type="text/css" media="screen, tv, projection" >
	<link href="<?php echo HTTPS; ?>/Style/smoothness/jquery-ui-1.8.5.custom.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo HTTPS; ?>/JavaScript/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTPS; ?>/JavaScript/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTPS; ?>/JavaScript/Simpeg.js"></script>
</head>

<body>
<div id="body">
	<div id="login_frame">&nbsp;</div>
    <div id="login_wrap">
        <div id="content" style="margin-top:150px;">
        	<div class="simpeg-info">
            	<h3>SIMPEG INFO</h3>
                <p>Panduan mencetak laporan EKD dapat didownload <a href="<?php echo HTTPS; ?>/Document/Pengaturan Pencetakan pada Browser.docx">disini</a>.</p>
            </div>
            <div class="simpeg-login">
            	<form action="" method="post">
                <input type="hidden" name="LoginPageLink" id="LoginPageLink" value ="<?php echo HTTPS; ?>/" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0">
                  <tbody><tr>
                    <td valign="top">Nama</td>
                    <td width="1%" valign="top">:</td>
                    <td><input type="text" name="LoginName" value="" /></td>
                  </tr>
                  <tr>
                    <td valign="top">Password</td>
                    <td width="1%" valign="top">:</td>
                    <td><input type="password" name="LoginPass" value="" /></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td width="1%" valign="top">&nbsp;</td>
                    <td>
                        <input type="submit" name="LoginSubmit" value="Login" />
                    </td>
                    </tr>
                </tbody></table>
                <?php echo $Message; ?>
            </form>
            </div>
    	</div><!-- Akhir Content -->
    </div><!-- Ahkir #wrap -->
    
</div><!-- Akhir #body -->
<script type="text/javascript">
    var LoginPageLink = document.getElementById('LoginPageLink').value;
    if (window.location.href != LoginPageLink) {
        window.location = LoginPageLink;
    }
	
	/*
	ShowDialogObject({
		Title: 'Pengumuman',
		ArrayMessage: ['<span style="font-size: 14px;">untuk kepentingan workshop pemutahiran data kepegawaian, SIMPEG akan dinon-aktifkan pada tgl 10 September 2013 pukul 15.00</span>'],
//		ArrayMessage: ['<span style="font-size: 14px;">Terkait dengan issue security, maka mulai hari ini (01 Oktober 2012), untuk akses file yang diupload di <strong>arsip.ub.ac.id/files</strong> menggunakan login sesuai dengan <strong>username</strong> dan <strong>password email</strong></span>'],
		Width: 400
	});
	/*	*/
</script>

</body>
</html>
