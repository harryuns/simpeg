<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dosen_luaran_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
    function get_array($param = array()) {
        $result = array();
        
		$raw_query = "CALL DB2ADMIN.GETDOSENKEGIATAND('x', '2', 'x', 'x', 'x', '".$param['k_publikasi']."')";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
        while ($row = db2_fetch_assoc($Statement)) {
			$row = array_map("strip_tags", $row);
			$row = array_map("trim", $row);
			
            $result[] = $row;
        }
		
        return $result;
    }
	
	function get_kegiatan($param) {
        $result = array();
		
		$param['tahun_akad'] = (isset($param['tahun_akad'])) ? $param['tahun_akad'] : 'x';
		$param['semester'] = (isset($param['semester'])) ? $param['semester'] : 'x';
		$param['no_kegiatan'] = (isset($param['no_kegiatan'])) ? $param['no_kegiatan'] : 'x';
		$param['k_publikasi'] = (isset($param['k_publikasi'])) ? $param['k_publikasi'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.GETDOSENKEGIATAN(
			'".$param['k_pegawai']."', '".$param['k_kegiatan']."', '".$param['tahun_akad']."', '".$param['semester']."',
			'".$param['no_kegiatan']."', '".$param['k_publikasi']."'
		)";
        $Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
        while ($row = db2_fetch_assoc($Statement)) {
            $result[] = $row;
        }
		
        return $result;
	}
}