<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_rekap_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
    function get_request_summary($param = array()) {
        $result = array();
        
		$raw_query = "CALL DB2ADMIN.LAPORANRIWAYAT()";
		$statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($statement);
        while ($row = db2_fetch_assoc($statement)) {
            $result[] = $row;
        }
		
        return $result;
    }
}