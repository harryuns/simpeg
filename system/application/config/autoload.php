<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['libraries'] = array(
	'session', 'ldb2', 'llogin', 'lpegawai', 'ldata_asessor', 'lpesan', 'lgolongan', 'llaporan', 'llaporan_ekd', 'lbidang_kerja', 'ldiklat', 'lnegara',
	'lriwayat_diklat', 'lriwayat_pangkat', 'lriwayat_pendidikan', 'ljurusan', 'lagama', 'lpropinsi', 'lkota', 'lasessor', 'lstatus_studi', 'lstatus_kerja',
	'lstatus_dosen', 'lfakultas', 'ljenjang', 'ljenis_kelamin', 'lstatus_kawin', 'ljenis_kerja', 'lstatus_pensiun', 'laktif', 'lpegawai_aktif', 'lasal_sk',
	'lpenjelasan', 'lunit_kerja', 'lprogram_studi', 'ljabatan_fungsional', 'ljabatan_struktural', 'lriwayat_honorer', 'lriwayat_jabatan_struktural',
	'lriwayat_jabatan_fungsional', 'lriwayat_bidang_kerja', 'lriwayat_penghargaan', 'lriwayat_sertifikasi', 'lriwayat_keluarga', 'ljenis_penghargaan',
	'lhubungan_keluarga', 'lkenaikan_gaji', 'lperubahan_gaji', 'lptp', 'lrumpun_ilmu', 'lriwayat_hidup', 'lperguruan_tinggi', 'lriwayat_home_base',
	'lriwayat_hukuman', 'lriwayat_organisasi', 'lriwayat_seminar', 'lhukuman', 'lkedudukan','lseleksi_dosen','lpdf'
);

$autoload['helper'] = array('html', 'date', 'file', 'common', 'url', 'mcrypt' );

$autoload['plugin'] = array();

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array(
	'dosen_luaran_model', 'riwayat_diklat_model', 'riwayat_diklat_request_model', 'directory_gurubesar_model', 'riwayat_homebase_model',
	'riwayat_homebase_request_model', 'riwayat_honorer_model', 'riwayat_honorer_request_model', 'asal_sk_model', 'bidang_kerja_model',
	'riwayat_hukuman_model', 'riwayat_hukuman_request_model', 'riwayat_fungsional_model', 'riwayat_fungsional_request_model',
	'jabatan_fungsional_model', 'riwayat_struktural_model', 'riwayat_struktural_request_model', 'jabatan_struktural_model', 'skp_model',
	'jenis_skp_model', 'jabatan_pekerjaan_model', 'riwayat_organisasi_model', 'riwayat_organisasi_request_model', 'riwayat_pangkat_model',
	'riwayat_pangkat_request_model', 'penjelasan_model', 'golongan_model', 'riwayat_pendidikan_model', 'riwayat_pendidikan_request_model',
	'jenjang_model', 'negara_model', 'status_studi_model', 'perguruan_tinggi_model', 'riwayat_aktif_model', 'riwayat_aktif_request_model',
	'aktif_model', 'rumpun_ilmu_model', 'ptp_model', 'riwayat_sertifikasi_model', 'riwayat_sertifikasi_request_model', 'perubahan_gaji_model',
	'riwayat_perubahan_gaji_request_model', 'riwayat_perubahan_gaji_model', 'riwayat_penghargaan_model', 'riwayat_penghargaan_request_model',
	'riwayat_seminar_model', 'riwayat_seminar_request_model', 'kedudukan_model', 'riwayat_keluarga_model', 'riwayat_keluarga_request_model',
	'hubungan_keluarga_model', 'jenis_kelamin_model', 'laporan_rekap_model'
);