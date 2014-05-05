<?php
	$User = $this->llogin->GetUser();
	$notify_status = (isset($notify_status)) ? $notify_status : true;
	$array_laporan_rekap = $this->laporan_rekap_model->get_request_summary();
	$is_user_fakultas = $this->llogin->is_user_fakultas();
	
    if (isset($page_title)) {
		$Page['PageTitle'] = $page_title;
	} else if (!isset($Page) || (isset($Page) && !isset($Page['PageTitle']))) {
        $Page['PageTitle'] = '-';
    }
	
	$UserId = isset( $User['UserGroupID'] ) ?  $User['UserGroupID'] : '';
	$Web = array(
		'HOST' => HTTPS,
		'UserGroupID' => $UserId,
		'IsUserFakultas' => $this->llogin->IsUserFakultas(),
		'admin_group_id' => $this->config->item('admin_group_id')
	);
?><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="author" content="Mohammad Rizal">
    <meta name="keywords" content="Program, Mahasiswa, universitas brawijaya, malang, UB, mandiri">
    <meta name="description" content="Program Mahasiswa Wirausaha">
    <link rel="stylesheet" href="<?php echo HTTPS."/Style/smoothness/jquery-ui-1.8.5.custom.css"; ?>">
	<link rel="stylesheet" href="<?php echo base_url('JavaScript/lib/autocomplete/jquery.autocomplete.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('static/css/font-awesome.css'); ?>">
	
    <script type="text/javascript" src="<?php echo HTTPS."/JavaScript/jquery-1.4.2.min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HTTPS."/JavaScript/jquery-ui-1.8.5.custom.min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HTTPS."/JavaScript/ddaccordion.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HTTPS."/JavaScript/Simpeg.js"; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('JavaScript/lib/autocomplete/jquery.autocomplete.js'); ?>"></script>
	
    <script type="text/javascript">
		var Web = <?php echo json_encode($Web); ?>;
		$(document).ready(function() { InitMainSite(); });
	</script>
	
	<link rel="stylesheet" href="<?php echo HTTPS."/assets/lib/pde/pde.css"; ?>">
    <script type="text/javascript" src="<?php echo HTTPS."/assets/lib/pde/pde.js"; ?>"></script>
	
	
    <link href="<?php echo HTTPS; ?>/Style/reset.css" rel="stylesheet" type="text/css" media="all" >
    <link href="<?php echo HTTPS; ?>/Style/style.css" rel="stylesheet" type="text/css" media="screen" >
    
    <!--[if IE 6]>
    <link href="<?php echo HTTPS."/Style/Fix.css"; ?>" rel="stylesheet" type="text/css" >
    <![endif]-->
    
    <link rel="shortcut icon" href="<?php echo HTTPS."/images/ub.ico"; ?>" >
    <title><?php echo $Page['PageTitle']; ?></title>
</head>

<?php if ($notify_status && ! $is_user_fakultas) { ?>
<?php $link = base_url('index.php/pegawai_modul/riwayat_rekap'); ?>

<div class="notif-simpeg">
    <div class="notif-simpeg-ttl">Simpeg Request Notification</div>
    <div class="notif-simpeg-isi">
        <ul>
			<?php 
				$totalnotif = 0;
				foreach ($array_laporan_rekap as $key => $row) { ?>
        	<li><a href="<?php $totalnotif = $totalnotif+$row['JUMLAH']; echo $link; ?>"><?php echo $row['NAMA'].' ('.$row['JUMLAH'].')'; ?></a></li>
			<?php } ?>
      		<li>Jumlah Notifikasi <a href="<?php echo $link; ?>"><?php echo $totalnotif;  ?></a></li>
        </ul>
    </div>
    <a href="#" class="notif-close">close</a>
</div>
<script>
$('.notif-simpeg .notif-close').click(function() {
	$('.notif-simpeg').hide();
});
</script>
<?php } ?>


<div id="portal" style="display:true" class="clearfix">
	<div class="logo left">
		<a href="#">Simpeg UB</a>
	</div>
	<div class="hlink right">
		Login as <a href="#"><?php echo $User['UserName']; ?></a>
		<?php if (! $is_user_fakultas) { ?>
			, Notifikasi <a href="<?php echo $link; ?>"><?php echo $totalnotif;  ?></a>
		<?php } ?>
    </div>
</div>