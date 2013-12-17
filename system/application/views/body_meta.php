<?php
	$User = $this->llogin->GetUser();
	$notify_status = (isset($notify_status)) ? $notify_status : true;
	
    if (isset($page_title)) {
		$Page['PageTitle'] = $page_title;
	} else if (!isset($Page) || (isset($Page) && !isset($Page['PageTitle']))) {
        $Page['PageTitle'] = '-';
    }
	
	$UserId = isset( $User['UserGroupID'] ) ?  $User['UserGroupID'] : '';
	$Web = array(
		'HOST' => HOST,
		'UserGroupID' => $UserId,
		'IsUserFakultas' => $this->llogin->IsUserFakultas(),
		'admin_group_id' => $this->config->item('admin_group_id')
	);
?>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="author" content="Mohammad Rizal">
    <meta name="keywords" content="Program, Mahasiswa, universitas brawijaya, malang, UB, mandiri">
    <meta name="description" content="Program Mahasiswa Wirausaha">
    <link rel="stylesheet" href="<?php echo HOST."/Style/smoothness/jquery-ui-1.8.5.custom.css"; ?>">
	<link rel="stylesheet" href="<?php echo base_url('JavaScript/lib/autocomplete/jquery.autocomplete.css'); ?>">
	
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/jquery-1.4.2.min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/jquery-ui-1.8.5.custom.min.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/ddaccordion.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/Simpeg.js"; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('JavaScript/lib/autocomplete/jquery.autocomplete.js'); ?>"></script>
	
    <script type="text/javascript">
		var Web = <?php echo json_encode($Web); ?>;
		$(document).ready(function() { InitMainSite(); });
	</script>
	
	<link rel="stylesheet" href="<?php echo HOST."/assets/lib/pde/pde.css"; ?>">
    <script type="text/javascript" src="<?php echo HOST."/assets/lib/pde/pde.js"; ?>"></script>
	
	
    <link href="<?php echo HOST."/Style/Main.css"; ?>" rel="stylesheet" type="text/css" media="screen, tv, projection" >  
    <link href="<?php echo HOST."/Style/Wisuda.css"; ?>" rel="stylesheet" type="text/css" media="screen, tv, projection" >  
    
    <!--[if IE 6]>
    <link href="<?php echo HOST."/Style/Fix.css"; ?>" rel="stylesheet" type="text/css" >
    <![endif]-->
    
    <link rel="shortcut icon" href="<?php echo HOST."/images/ub.ico"; ?>" >
    <title><?php echo $Page['PageTitle']; ?></title>
</head>

<?php if ($notify_status) { ?>
<div class="notif-simpeg">
    <div class="notif-simpeg-ttl">Simpeg Notification</div>
    <div class="notif-simpeg-isi">
        <ul>
        	<li><a href="#">Morbi laoreet leo quis lacus malesuada bibendum.</a></li>
        	<li><a href="#">Sed at enim id urna commodo aliquam sit amet vitae leo.</a></li>
        	<li><a href="#">Pellentesque quis dui non felis luctus hendrerit.</a></li>
        	<li><a href="#">Pellentesque dignissim mi quis purus pellentesque laoreet.</a></li>
        	<li><a href="#">Aliquam non sapien vel ligula venenatis faucibus.</a></li>
        </ul>
    </div>
    <a href="#" class="notif-close">close</a>
</div>
<?php } ?>