<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Libraries
| 2. Helper files
| 3. Plugins
| 4. Custom config files
| 5. Language files
| 6. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your system/application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'session', 'xmlrpc');
*/

$autoload['libraries'] = array(
	'session', 'ldb2', 'llogin', 'lpegawai', 'ldata_asessor', 'lpesan', 'lgolongan', 'llaporan', 'llaporan_ekd', 'lbidang_kerja', 'ldiklat', 'lnegara',
	'lriwayat_diklat', 'lriwayat_pangkat', 'lriwayat_pendidikan', 'ljurusan', 'lagama', 'lpropinsi', 'lkota', 'lasessor', 'lstatus_studi', 'lstatus_kerja',
	'lstatus_dosen', 'lfakultas', 'ljenjang', 'ljenis_kelamin', 'lstatus_kawin', 'ljenis_kerja', 'lstatus_pensiun', 'laktif', 'lpegawai_aktif', 'lasal_sk',
	'lpenjelasan', 'lunit_kerja', 'lprogram_studi', 'ljabatan_fungsional', 'ljabatan_struktural', 'lriwayat_honorer', 'lriwayat_jabatan_struktural',
	'lriwayat_jabatan_fungsional', 'lriwayat_bidang_kerja', 'lriwayat_penghargaan', 'lriwayat_sertifikasi', 'lriwayat_keluarga', 'ljenis_penghargaan',
	'lhubungan_keluarga', 'lkenaikan_gaji', 'lperubahan_gaji', 'lptp', 'lrumpun_ilmu', 'lriwayat_hidup', 'lperguruan_tinggi', 'lriwayat_home_base',
	'lriwayat_hukuman', 'lriwayat_organisasi', 'lriwayat_seminar', 'lhukuman', 'lkedudukan','lseleksi_dosen','lpdf'
);


/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/

$autoload['helper'] = array('html', 'date', 'file', 'common', 'url');


/*
| -------------------------------------------------------------------
|  Auto-load Plugins
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['plugin'] = array('captcha', 'js_calendar');
*/

$autoload['plugin'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/

$autoload['config'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example 
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/

$autoload['language'] = array();


/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('model1', 'model2');
|
*/

$autoload['model'] = array(
	'dosen_luaran_model', 'riwayat_diklat_model', 'riwayat_diklat_request_model', 'directory_gurubesar_model', 'riwayat_homebase_model',
	'riwayat_homebase_request_model', 'riwayat_honorer_model', 'riwayat_honorer_request_model', 'asal_sk_model', 'bidang_kerja_model',
	'riwayat_hukuman_model', 'riwayat_hukuman_request_model', 'riwayat_fungsional_model', 'riwayat_fungsional_request_model',
	'jabatan_fungsional_model', 'riwayat_struktural_model', 'riwayat_struktural_request_model', 'jabatan_struktural_model', 'skp_model'
);



/* End of file autoload.php */
/* Location: ./system/application/config/autoload.php */