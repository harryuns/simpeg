<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rumpun_ilmu_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
    function get_array($param = array()) {
        $result = array();
        $param['RUMPUN_ILMU'] = (isset($param['RUMPUN_ILMU'])) ? $param['RUMPUN_ILMU'] : 'x';
		
		$raw_query = "CALL DB2ADMIN.GETRUMPUNILMU('".$param['RUMPUN_ILMU']."')";
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
            $result[] = $row;
        }
		
        return $result;
    }
}