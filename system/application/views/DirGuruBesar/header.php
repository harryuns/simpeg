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
    <meta name="title" content="SIMPEG">
    <meta name="keywords" content="kepegawaian">
    <meta name="description" content="Sistem Kepegawaian Universitas Brawijaya">
    <link rel="stylesheet" href="<?php echo HOST."/Style/smoothness/jquery-ui-1.8.5.custom.css"; ?>">
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/jQuery.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/jquery-ui.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/jquery.dataTables.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/ddaccordion.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo HOST."/JavaScript/jquery.form.js"; ?>"></script>
  
  
	<link rel="stylesheet" href="<?php echo HOST."/assets/lib/pde/pde.css"; ?>">
    <script type="text/javascript" src="<?php echo HOST."/assets/lib/pde/pde.js"; ?>"></script>
	
	
    <link href="<?php echo HOST."/Style/Main.css"; ?>" rel="stylesheet" type="text/css" media="screen, tv, projection" >  
    <link href="<?php echo HOST."/Style/jquery.dataTables.css"; ?>" rel="stylesheet" type="text/css" media="screen, tv, projection" >  
    <link href="<?php echo HOST."/Style/Wisuda.css"; ?>" rel="stylesheet" type="text/css" media="screen, tv, projection" >  
    
    <!--[if IE 6]>
    <link href="<?php echo HOST."/Style/Fix.css"; ?>" rel="stylesheet" type="text/css" >
    <![endif]-->
    
    <link rel="shortcut icon" href="<?php echo HOST."/images/ub.ico"; ?>" >
    <title><?php echo $Page['PageTitle']; ?></title>
	
</head>
