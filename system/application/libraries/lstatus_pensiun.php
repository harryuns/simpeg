<?php
if ( ! defined('BASEPATH'))
exit('No direct script access allowed');

class LStatus_Pensiun {
    var $CI = null;
    
    function LStatus_Pensiun() {
        $this->CI =& get_instance();
    }
    
    function GetArrayStatusPensiun() {
        $Array = array('0' => 'Belum', '1' => 'Sudah');
        return $Array;
    }
}
?>