<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

// get ip remote address
$is_ip_ppti = false;
preg_match('/172\.18\.3\.\d+$/i', $_SERVER['REMOTE_ADDR'], $match);
if (!empty($match[0])) {
	$is_ip_ppti = true;
}

/*	USER SIMPEG */
define('USER_ADMIN_SIMPEG', 					'1013');

define('SERVICE_ID', 'SI15');
define('SALT', 'War Craft');
define('TAHUN_AKADEMIK', '2010');
define('IDLE_TIME', 3600);
define('QUERY_STATUS_SUCCESS', '00000');
define('EMPTY_DATE', '1950-01-01');

/* URL */
if ($_SERVER['HTTP_HOST'] == 'develweb.ub.ac.id') {
	define('LOGIN_URL', 'http://devel184.ub.ac.id/baisdev/api/Login/xmlapi/');
    define('HOST', 'http://develweb.ub.ac.id/simpeg');
    define('PATH', '/var/www/html/simpeg');
} else if ($_SERVER['HTTP_HOST'] == 'devel184.ub.ac.id') {
	define('LOGIN_URL', 'http://devel184.ub.ac.id/baisdev/api/Login/xmlapi/');
    define('HOST', 'http://devel184.ub.ac.id/simpeg');
    define('PATH', '/home/var/www/html/simpeg');
} else if ($_SERVER['HTTP_HOST'] == 'simpeg.ub.ac.id') {
	define('LOGIN_URL', 'http://bais.ub.ac.id/api/login/xmlapi/');
    define('HOST', 'http://simpeg.ub.ac.id');
	define('HTTPS', 'https://simpeg.ub.ac.id');
    define('PATH', '/home/var/www/html/simpeg');
} else if ($_SERVER['HTTP_HOST'] == '175.45.186.14') {
	define('LOGIN_URL', 'http://bais.ub.ac.id/api/login/xmlapi/');
    define('HOST', 'http://175.45.186.14/simpeg');
	define('HTTPS', 'https://175.45.186.14/simpeg');
    define('PATH', '/var/www/html/simpeg');
}

if (! defined('HTTPS')) {
	define('HTTPS', HOST);
}

/* DATABASE */
if ($_SERVER['HTTP_HOST'] == 'simpeg.ub.ac.id') {
	define('DB_USER', 'db2admin');
	define('DB_PASSWORD', 'db2ready2serveub');
	define('DB_NAME', 'pegawai');
	define('DB_PORT', true);
	define('DB_PORT_IP', '175.45.184.194');
	define('DB_PORT_NO', '11111');
	define('SIADO_REDIRECT', 'http://siado.ub.ac.id/login/');
	
	// old db
	/*
	define('DB_USER', 'db2admin');
	define('DB_PASSWORD', 'db2ready2serveub');
	define('DB_NAME', 'pegawai');
	define('DB_PORT', false);
	define('SIADO_REDIRECT', 'http://siado.ub.ac.id/login/');
	/*	*/
	
	define('SFTP_HOST', 'simpeg.ub.ac.id');
	define('SFTP_USER', 'upFilesUser');
	define('SFTP_PASS', 'filesU132012');
	define('SFTP_PATH', '/home/var/www/html/simpeg');
} else if ($_SERVER['HTTP_HOST'] == '175.45.186.14') {
    define('DB_USER', 'db2admin');
    define('DB_PASSWORD', 'd3v3ldbun1br4w');
    define('DB_NAME', 'pegawai');
	define('DB_PORT', true);
	define('DB_PORT_IP', '175.45.186.15');
	define('DB_PORT_NO', '11111');
	define('SIADO_REDIRECT', 'http://siado.ub.ac.id/login/');
	
	define('SFTP_HOST', '175.45.186.14');
	define('SFTP_USER', 'userapp');
	define('SFTP_PASS', 'us3r4pp');
	define('SFTP_PATH', '/var/www/html/simpeg');
} else {
    define('DB_USER', 'db2admin');
    define('DB_PASSWORD', 'd3v3ldbun1br4w');
    define('DB_NAME', 'PEGAWAI');
    define('DB_PORT', true);
	define('DB_PORT_IP', '175.45.184.192');
	define('DB_PORT_NO', '11111');
	define('SIADO_REDIRECT', 'http://develweb.ub.ac.id/siado/login/');
	
	define('SFTP_HOST', 'devel184.ub.ac.id');
	define('SFTP_USER', 'ferdika');
	define('SFTP_PASS', 'devel.l4479nm');
	define('SFTP_PATH', '/home/var/www/html/simpeg');
}

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */