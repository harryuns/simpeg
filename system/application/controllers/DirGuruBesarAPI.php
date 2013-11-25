<?php

class DirGuruBesarAPI extends Controller {
    var $Action = null;
    
    function DirGuruBesarAPI() {
    	define('API_KEY','UB-D1R-GURUB3S4R2013');
		$_SERVER['no_login'] = true;
        parent::Controller();
    }
    
    function CallGetDirectoryGuruBesar() {
			
			$Result = '';
			if(isset($_GET['K_UNIT_KERJA']))
				$param['K_UNIT_KERJA'] = $this->input->get('K_UNIT_KERJA');
			else $param['K_UNIT_KERJA'] = 'x';
			if(isset($_GET['ID_GURU_BESAR']))
				$param['ID_GURU_BESAR'] = $this->input->get('ID_GURU_BESAR');
			else $param['ID_GURU_BESAR'] = 'x';
			if(isset($_GET['K_PEGAWAI']))
				$param['K_PEGAWAI'] = $this->input->get('K_PEGAWAI');
			else $param['K_PEGAWAI'] = 'x';
		
		$param['user_id'] 			= 'rezki';
		$param['IN_KEY']			= crypt($param['user_id'],API_KEY);
			
		if($param['IN_KEY']==crypt($param['user_id'],API_KEY))
        {
        	//echo json_encode($this->directory_gurubesar_model->get($param))
            echo gzcompress(base64_encode(json_encode($this->directory_gurubesar_model->get($param))));
        }
        else
        {
            $error[0]=array("ERROR"=>"00001","MESSAGE"=>"Invalid API Key");
            echo gzcompress(base64_encode(json_encode($error)));
        }
		//$Result = $this->directory_gurubesar_model->get($param);
        //echo json_encode($Result);
        exit;
    }
	
	function CallInsUpdDirectoryGuruBesar(){
		
			$Result = '';
			$param['ID_GURU_BESAR'] 	= $this->input->get('ID_GURU_BESAR');
			$param['K_PEGAWAI'] 		= $this->input->get('K_PEGAWAI');
			$param['NAMA'] 				= $this->input->get('NAMA');
			$param['GELAR_DEPAN'] 		= $this->input->get('GELAR_DEPAN');
			$param['GELAR_BELAKANG'] 	= $this->input->get('GELAR_BELAKANG');
			$param['TANGGAL_LAHIR'] 		= $this->input->get('TANGGAL_LAHIR');
			$param['ID_UNIT_KERJA'] 	= $this->input->get('ID_UNIT_KERJA');
			$param['TGL_PENGUKUHAN'] 	= $this->input->get('TGL_PENGUKUHAN');
			$param['JUDUL_ORASI'] 		= $this->input->get('JUDUL_ORASI');
			$param['BIDANG_ILMU'] 		= $this->input->get('BIDANG_ILMU');
			$param['KETERANGAN'] 		= $this->input->get('KETERANGAN');
			$param['TGL_PENSIUN'] 		= $this->input->get('TGL_PENSIUN');
			$param['TGL_WAFAT'] 		= $this->input->get('TGL_WAFAT');
			$param['URL_FOTO'] 			= $this->input->get('URL_FOTO');
			$param['USERID'] 			= $this->input->get('USERID');
			//$param['IN_KEY']			= crypt($param['user_id'],API_KEY);
			
			if($param['IN_KEY']==crypt($param['user_id'],API_KEY))
	        {
	            echo gzcompress(base64_encode(json_encode($this->directory_gurubesar_model->update($param))));
	        }
	        else
	        {
	            $error[0]=array("ERROR"=>"00001","MESSAGE"=>"Invalid API Key");
	            echo gzcompress(base64_encode(json_encode($error)));
	        }
         //$Result = $this->directory_gurubesar_model->update($param);
        
        //echo json_encode($Result);
        exit;
		
	}

	function CallDelDirGuruBesar() {
			
			$Result = '';
			
			$param['ID_GURU_BESAR'] = $this->input->get('ID_GURU_BESAR');
			//$param['user_id'] 			= 'rezki';
			//$param['id_guru_besar'] = 'x';
           	
           	$param['IN_KEY']			= crypt($param['user_id'],API_KEY);
			
			if($param['IN_KEY']==crypt($param['user_id'],API_KEY))
	        {
	            echo gzcompress(base64_encode(json_encode($this->directory_gurubesar_model->delete($param))));
	        }
	        else
	        {
	            $error[0]=array("ERROR"=>"00001","MESSAGE"=>"Invalid API Key");
	            echo gzcompress(base64_encode(json_encode($error)));
	        }
           	//$Result = $this->directory_gurubesar_model->delete($param);
        
        	//echo json_encode($Result);
        	exit;
		
    }
	
	
    
}
?>