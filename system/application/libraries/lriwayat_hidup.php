<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LRiwayat_Hidup {
    var $CI = null;
    
    function LRiwayat_Hidup() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'CurriculumVitae',
            'PageTitle' => 'Curriculum Vitae'
        );
        return $Array;
    }
	
	function GetArrayLink($K_PEGAWAI) {
		$ArrayType = array(
			0 => array(
				'Link' => HOST.'/index.php/RiwayatHidup/ShowHtml/'.ConvertLink($K_PEGAWAI),
				'Title' => 'HTML'
			),
			1 => array(
				'Link' => HOST.'/index.php/RiwayatHidup/ShowPdf/'.ConvertLink($K_PEGAWAI),
				'Title' => 'PDF'
			),
			2 => array(
				'Link' => HOST.'/index.php/RiwayatHidup/ShowWord/'.ConvertLink($K_PEGAWAI),
				'Title' => 'WORD'
			),
		);
		
		return $ArrayType;
	}
}
?>