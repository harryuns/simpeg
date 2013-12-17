<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class directory_gurubesar_model extends Model {
    function __construct() {
		parent::__construct();
        $this->CI =& get_instance();
    }
	
	function get($param = array()){
		 $result = array();
         /**
		  params :
		  * INK_UNIT_KERJA
			INID_GURU_BESAR
			INK_PEGAWAI
		  */
		$raw_query = "CALL DB2ADMIN.GETDIRGURUBESAR('".$param['K_UNIT_KERJA']."','".$param['ID_GURU_BESAR']."','".$param['K_PEGAWAI']."','".$param['NAMA']."')";
        //echo $raw_query;
        $Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
        while ($row = db2_fetch_assoc($Statement)) {
            $result[] = $row;
        }
		
        return $result;
	}
	
	function insertupdate($param = array()){
		 $result = array();
         /**
		  params :
		  * INID_GURU_BESAR
			INK_PEGAWAI
			INNAMA
			INGLR_DPN
			INGLR_BLKG
			INTGL_LAHIR
			INID_UNIT_KERJA
			INTGL_PENGUKUHAN
			INJUDUL_ORASI
			INBIDANG_ILMU
			INKETERANGAN
			INTGL_PENSIUN
			INTGL_WAFAT
			INURL_FOTO
			INUSERID
		  */
		$raw_query = "CALL DB2ADMIN.INSUPDDIRGURUBESAR('".$param['ID_GURU_BESAR']."','".$param['K_PEGAWAI']."','".$param['NAMA']."','".$param['GLR_DPN']."','".$param['GLR_BLKG']."','".$param['TGL_LAHIR']."','".$param['ID_UNIT_KERJA']."','".$param['TGL_PENGUKUHAN']."','".$param['JUDUL_ORASI']."','".$param['BIDANG_ILMU']."','".$param['KETERANGAN']."','".$param['TGL_PENSIUN']."','".$param['TGL_WAFAT']."','".$param['USERID']."')";
        echo $raw_query;
        //WriteLog($param['K_PEGAWAI'], $raw_query);
        $Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement); 
        while ($row = db2_fetch_assoc($Statement)) {
            $result[] = $row;
        }
		
        return $result;
	}

	function delete($param = array()){
		 $result = array();
         /**
		  params :
		  * INID_GURU_BESAR
		  */
		$raw_query = "CALL DB2ADMIN.DELDIRGURUBESAR('".$param['ID_GURU_BESAR']."')";
		//echo $raw_query;
		//WriteLog($param['K_PEGAWAI'], $raw_query);
        $Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
        while ($row = db2_fetch_assoc($Statement)) {
            $result[] = $row;
        }
		
        return $result;
	}
	
	function importXML($params){
		$lengthXML = strlen($params['xml']);
		$jumlahloop = ceil($lengthXML/2000);
		$start = 0;
		for($i=0;$i<$jumlahloop;$i++){
			$params['subxml'] = substr($params['xml'], $start, 2000);
			$resultxml = $this->appendXML($params);
			$start += 2000;
		}
		
		$result = $this->executeXML($params);
		return $result;
	}
	
	function appendXML($params){
		$result = array();
		$raw_query = "CALL DB2ADMIN.insdirgurubesarxml('".$params['k_input']."',
				  '".db2_escape_string($params['subxml'])."','".$_SESSION['UserLogin']['UserID']."')";
		// echo $raw_query;
		$Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
        
		// while ($row = db2_fetch_assoc($Statement)) {
            // $result[] = $row;
        // }
		
		// print_r($result);
	}
	
	function executeXML($params){
		$result = array();
		$raw_query = "CALL DB2ADMIN.insupddirektorigurubesar('".$params['k_input']."')";
		echo $raw_query;
		$Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
		
		while ($row = db2_fetch_assoc($Statement)) {
            $result[] = $row;
        }
		
        return $result;
	}
}