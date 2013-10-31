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
		$raw_query = "CALL DB2ADMIN.GETDIRGURUBESAR('".$param['K_UNIT_KERJA']."','".$param['ID_GURU_BESAR']."','".$param['K_PEGAWAI']."')";
        //echo $raw_query;
        $Statement = db2_prepare($this->CI->ldb2->Handle, $raw_query);
        db2_execute($Statement);
        while ($row = db2_fetch_assoc($Statement)) {
            $result[] = $row;
        }
		
        return $result;
	}
	
	function update($param = array()){
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
		$raw_query = "CALL DB2ADMIN.INSUPDDIRGURUBESAR('".$param['ID_GURU_BESAR']."','".$param['K_PEGAWAI']."','".$param['NAMA']."','".$param['GELAR_DEPAN']."','".$param['GELAR_BELAKANG']."','".$param['TANGGAL_LAHIR']."','".$param['ID_UNIT_KERJA']."','".$param['TGL_PENGUKUHAN']."','".$param['JUDUL_ORASI']."','".$param['BIDANG_ILMU']."','".$param['KETERANGAN']."','".$param['TGL_PENSIUN']."','".$param['TGL_WAFAT']."','".$param['URL_FOTO']."','".$param['USERID']."')";
        //echo $raw_query;
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
	
	
}