<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LJenis_Kelamin {
    function LJenis_Kelamin() {
    }
    
    function GetArrayJenisKelamin() {
        $Array = array('L' => 'Laki Laki', 'P' => 'Perempuan');
        return $Array;
    }
}
?>