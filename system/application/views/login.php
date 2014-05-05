<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en-AU">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Mohammad Rizal">
<meta name="keywords" content="Program, Mahasiswa, universitas brawijaya, malang, UB, mandiri">
<meta name="description" content="Program Mahasiswa Wirausaha">
<title>Sistem Informasi Pegawai UB</title>
    <link href="<?php echo HTTPS; ?>/Style/reset.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo HTTPS; ?>/Style/Main.css" rel="stylesheet" type="text/css" media="screen, tv, projection" >
    <link href="<?php echo HTTPS; ?>/Style/style.css" rel="stylesheet" type="text/css" media="screen" >
	<link href="<?php echo HTTPS; ?>/Style/smoothness/jquery-ui-1.8.5.custom.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo HTTPS; ?>/JavaScript/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTPS; ?>/JavaScript/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTPS; ?>/JavaScript/Simpeg.js"></script>
</head>

<body id="login">

<div id="header-login">
<div class="wrap-login wrap">
<div class="logo-login left">
<a href="">UB Simpeg</a>
</div>
</div>
</div>

<div id="main-login">
	
  <div class="content-login">
  	<div class="wrap-login wrap">
    	<div class="login-info left">
      	<div class="m-10 sdw-r">
          <div class="title-app">
          	<h1>UB Simpeg</h1>
            <p>UB Simpeg <em>(Sistem Informasi Pegawai)</em> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
          </div>
          <div class="info">
            <h2>Bantuan</h2>
            <ul>
            	<li>Panduan mencetak laporan EKD dapat didownload <a href="<?php echo HTTPS; ?>/Document/Pengaturan Pencetakan pada Browser.docx">di sini</a>.</li>
            	<li>lupa password, klik <a href="#">di sini</a></li>
            </ul>
            <p></p>
          </div>
        </div >
      </div>
      
      <div class="login-form left">
      	<div class="m-10" style="padding-left:40px">
        
      	<h2>Masuk Simpeg</h2>
      	<form action="" method="post" class="wrap">
                <input  class="login-input" type="hidden" name="LoginPageLink" id="LoginPageLink" value ="<?php echo HTTPS; ?>/" />
                
                <input class="login-input" type="text" name="LoginName" placeholder="Username" />
                <input class="login-input" type="password" name="LoginPass" placeholder="Password" />
                
                <input class="login-button" type="submit" name="LoginSubmit" value="Login" />
                
                <?php echo $Message; ?>
            </form>
            
            
         </div>
      </div>
    </div>
  </div>
  <div id="footer-login">
  	<div class="wrap-login wrap" style="border-top: double 3px #ccc">
    <center>
    	<small style=" padding:20px 0; display:block">&copy;2014&nbsp;&mdash;&nbsp;PPTI Universitas Brawijaya</small>
    </center>
    </div>
  </div>
  
</div>




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
