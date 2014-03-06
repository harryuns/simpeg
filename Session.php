<?php
	session_start();
	print_r($_SESSION);
	print_r($_COOKIE);
	
	$_SESSION['UserLogin'] = array(
		'UserID' => 'adminsimpeg',
		'UserName' => 'adminsimpeg',
		'UserDisplay' => 'adminsimpeg',
		'UserGroupID' => '1013',
		'TimeActive' => time(),
		'ApplicationRequest' => 'Simpeg',
		'LinkIndex' => 'http://devel184.ub.ac.id/simpeg/index.php/Pegawai',
		'Fakultas' => array( 'Title' => 'Seluruh fakultas', 'ID' => 'x' )
	);
?>