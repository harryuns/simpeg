<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jenis_kelamin_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
    function get_array($param = array()) {
        $result = array(
			array( 'ID' => 'L', 'CONTENT' => 'Laki Laki'),
			array( 'ID' => 'P', 'CONTENT' => 'Perempuan')
		);
        return $result;
    }
}