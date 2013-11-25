<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jabatan_struktural_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
    function get_array($param = array()) {
        $result = array();
        $param['IS_ACTIVE'] = (isset($param['IS_ACTIVE'])) ? $param['IS_ACTIVE'] : 1;
		
		if (isset($param['K_UNIT_KERJA'])) {
			$raw_query = "SELECT * FROM DB2ADMIN.M_JABATAN_STRUKTURAL WHERE K_UNIT_KERJA = '".$param['K_UNIT_KERJA']."'";
		} else if (isset($param['K_JABATAN_STRUKTURAL'])) {
			$raw_query = "SELECT * FROM DB2ADMIN.M_JABATAN_STRUKTURAL WHERE K_JABATAN_STRUKTURAL = '".$param['K_JABATAN_STRUKTURAL']."'";
		} else {
			$raw_query = "SELECT * FROM DB2ADMIN.M_JABATAN_STRUKTURAL";
		}
		
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
            $result[] = $row;
        }
		
        return $result;
    }
}