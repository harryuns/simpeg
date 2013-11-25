<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jabatan_fungsional_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
    function get_array($param = array()) {
        $result = array();
        $param['IS_ACTIVE'] = (isset($param['IS_ACTIVE'])) ? $param['IS_ACTIVE'] : 1;
		
		$raw_query = "CALL DB2ADMIN.GETMJABATANFUNGSIONAL('".$param['IS_DOSEN']."', '".$param['IS_ACTIVE']."')";
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
            $result[] = $row;
        }
		
        return $result;
    }
}