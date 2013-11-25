<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');

class LSeleksi_Dosen extends Controller {
    var $CI = null;
    
    function LSeleksi_Dosen() {
        $this->CI =& get_instance();
    }
    
    function GetProperty() {
        $Array = array(
            'PageName' => 'DataPegawai',
            'PageTitle' => 'Seleksi Dosen'
        );
        return $Array;
    }
    function InsUpd($Peserta=null){
    	$Tambah = $this->CI->input->post('Tambah');
    	$Submit = $this->CI->input->post('Submit');    	
    	if (!empty($Submit)) { 
    		$Message = 'Data Gagal Disimpan !';
    		$Data['INNO_PESERTA'] = $this->CI->input->post('NOMOR');
    		$Data['INTAHUN'] = $this->CI->input->post('TAHUN');
    		$Data['INNAMA'] = $this->CI->input->post('NAMA');
    		$Data['INPILIHAN'] = $this->CI->input->post('PILIHAN');
    		$Data['INUNIT'] = $this->CI->input->post('UNIT');
    		$Data['INALAMAT'] = $this->CI->input->post('ALAMAT');
    		$Data['INID_JENJANG'] = $this->CI->input->post('JENJANG');
    		$Data['INKUALIFIKASI_PEND'] = $this->CI->input->post('KUALIFIKASI');
    		$Data['TGL_UJIAN'] = $this->CI->input->post('TGL_UJIAN');
    		$Data['PUKUL'] = $this->CI->input->post('PUKUL');
    		$Data['UID'] = $_SESSION['UserLogin']['UserID'];
			
			if (!empty($Data['TGL_UJIAN'])) {
				$Data['TGL_UJIAN'] = ChangeFormatDate($Data['TGL_UJIAN']);
			}
    		if (!is_numeric($Data['INNO_PESERTA'])){    			
    			return $Message;
    		}
			
	    	$RawQuery = "
				CALL PP.INSUPDPESERTA(
					'".$Data['INNO_PESERTA']."', '".$Data['INTAHUN']."', 
					'".$Data['INNAMA']."', '".$Data['INALAMAT']."','".$Data['INID_JENJANG']."',
					'".$Data['INKUALIFIKASI_PEND']."',
					'".$Data['INUNIT']."', '".$Data['INPILIHAN']."','".$Data['UID']."',
					'".$Data['TGL_UJIAN']."','".$Data['PUKUL']."'
				)
			";
			
	    	try {
		    	$Query = @db2_prepare($this->CI->ldb2->Handle, $RawQuery);
		    	$Result = @db2_execute($Query);// or die(db2_stmt_errormsg($Query));
		    	//	print_r($Result);	    	
		    	while ($Row = @db2_fetch_assoc($Query)) {
					//	print_r($Row);	    		
		    		$Message = $Row['MSG'];	    		
		    	}	 
	    	} catch (Exception $e) {
	    		//echo $RawQuery;
	    		$Message = 'Proses Simpan Data Gagal Dieksekusi ...';
	    	}  	
	    	return $Message;
    	}
    }
    function InsUpdPeserta($Peserta) {
    	if (empty($Peserta))
    		return;
		
    	$Message = 'Data Gagal Disimpan !';
    	$Data['INNO_PESERTA'] = $Peserta[0];
    	$Data['INTAHUN'] = '20133';
    	$Data['INNAMA'] = $Peserta[1];
    	$Data['INALAMAT'] = $Peserta[2];
    	$Data['INID_JENJANG'] = $Peserta[3];
    	$Data['INKUALIFIKASI_PEND'] = $Peserta[4];    	
    	$Data['INUNIT'] = $Peserta[5];
    	$Data['INPILIHAN'] = $Peserta[6];
    	$Data['TGL_UJIAN'] = (isset($Peserta[7])) ? $Peserta[7] : date("Y-m-d");
		$Data['PUKUL'] = (isset($Peserta[8])) ? $Peserta[8] : '08:00 WIB';
    	$Data['UID'] = $_SESSION['UserLogin']['UserID'];
		
		// convert to int
		$Data['INNO_PESERTA'] = preg_replace('/[^0-9]/i', '', $Data['INNO_PESERTA']);
		$Data['INNO_PESERTA'] = intval($Data['INNO_PESERTA']);
		if (!is_numeric($Data['INNO_PESERTA'])){
    		return $Message;
    	}
		
    	$Nama = str_replace("'","`",$Data['INNAMA']);
    	$Alamat = str_replace("'","`",$Data['INALAMAT']);
		
    	$RawQuery = "
			CALL PP.INSUPDPESERTA(
				'".$Data['INNO_PESERTA']."', '".$Data['INTAHUN']."',
				'".$Nama."', '".$Alamat."','".$Data['INID_JENJANG']."',
				'".$Data['INKUALIFIKASI_PEND']."',
				'".$Data['INUNIT']."', '".$Data['INPILIHAN']."','".$Data['UID']."',
				'".$Data['TGL_UJIAN']."','".$Data['PUKUL']."'
			)
		";
		
    	// try {
	    	$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
	    	$Result = db2_execute($Query) or die(db2_stmt_errormsg($Query));
	    	
	    	while ($Row = db2_fetch_assoc($Query)) {    		
	    		$Message = $Row['MSG'];
	    	}
		/*
    	} catch (Exception $e) {
    		$Message = 'Proses Simpan Data Gagal Dieksekusi ...';
    	}
		/*	*/
		
    	return $Message;
    }
    function DelAllPeserta($Periode){
    	$RawQuery = " CALL PP.DELALLPESERTA('".$Periode."') ";
    	$Message = $RawQuery;
    	//WriteLog($_SESSION['UserLogin']['UserID'], $RawQuery);
    	try {
    		$Query = @db2_prepare($this->CI->ldb2->Handle, $RawQuery);
    		$Result = @db2_execute($Query);// or die(db2_stmt_errormsg($Query));
    		 
    		while ($Row = @db2_fetch_assoc($Query)) {
    			$Message = $Row['MSG'];
    		}
    	} catch (Exception $e) {
    		$Message = 'Proses Simpan Data Gagal Dieksekusi ...';
    	}
    	return $Message;
    }
    function DelPeserta($No=null){
    	if ($No == null){
    		return 'No.Peserta kosong !';
    	}
    	$RawQuery = " CALL PP.DELPESERTA('".$No."') ";
    	$Message = $RawQuery;
    	//WriteLog($_SESSION['UserLogin']['UserID'], $RawQuery);
    	try {
    		$Query = @db2_prepare($this->CI->ldb2->Handle, $RawQuery);
    		$Result = @db2_execute($Query);// or die(db2_stmt_errormsg($Query));
    		 
    		while ($Row = @db2_fetch_assoc($Query)) {
    			$Message = $Row['MSG'];
    		}
    	} catch (Exception $e) {
    		$Message = 'Proses Simpan Data Gagal Dieksekusi ...';
    	}
    	return $Message;
    }
    function GetArrayCetak($From=null, $To=null, $k_periode = 'x'){
    	$ArrayPegawai = array();
    	$PageActive = 1;
    	$PageCount = 1;
    	$RawQuery = "
			CALL PP.GETPESERTARANGE('".$From."','".$To."', '$k_periode')
		";
    	if (is_numeric($From) && is_numeric($To)){
	    	$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
	    	db2_execute($Query);
	    	if (!empty($Query)) {
		    	while ($Row = db2_fetch_assoc($Query)) {
					if (!empty($Row['TGL_UJIAN'])) {
						$Row['TGL_UJIAN'] = ChangeFormatDate($Row['TGL_UJIAN']);
					}
					
		    		$ArrayPegawai[$Row['NO_PESERTA']] = $Row;
		    	}
	    	}
    	}
    	$Array = array(
    			'Pegawai' =>$ArrayPegawai,
    			'PageActive' => $PageActive,
    			'PageCount' => $PageCount,
    			'From' => $From,
    			'To'  => $To
    	);
		
    	return $Array;
    }
    function GetArrayCetakPeserta($Data){
    	$ArrayPegawai = array();    	
    	$PageActive = 1;
    	$PageCount = 1;
    	$Data['Export'] = (isset($Data['Export'])) ? $Data['Export'] : '';
    	$Data['PageActive'] = (empty($Data['PageActive'])) ? 1 : $Data['PageActive'];
    	$Data['PageOffset'] = (empty($Data['PageOffset'])) ? 1000 : $Data['PageOffset'];
    	if (!empty($Data['NMR_AWAL'])) {
    		$Data['INNO_PESERTA'] = $Data['NMR_AWAL'];
    		$Data['INTAHUN'] =  $Data['TAHUN'];
    		$RawQuery = "
		                    CALL PP.GETPESERTA(
		                        '".$Data['INNO_PESERTA']."', '".$Data['INTAHUN']."'
							)
						";    		
    		//WriteLog($Data['UID'], $RawQuery);
    		$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
    		db2_execute($Query);
    		while ($Row = db2_fetch_assoc($Query)) {
    			$ArrayPegawai[$Row['NO_PESERTA']] = $Row;
    		}
    		$PegawaiTotal = count($ArrayPegawai);
    		$PageActive = $Data['PageActive'];
    		$PageCount = ceil($PegawaiTotal / $Data['PageOffset']);
    		$Array = array(
    				'Pegawai' =>$ArrayPegawai,
    				'PageActive' => $PageActive,
    				'PageCount' => $PageCount
    		);
    		return $Array;
    	}
    }
    function GetPesertaByNo($No, $Tahun='20133'){
    	$ArrayPegawai = array();
    	$RawQuery = "
		                    CALL PP.GETPESERTA(
		                        '".$No."', '".$Tahun."'
							)
						";
    	//echo $RawQuery;
    	$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
    	db2_execute($Query);
    	$i=0;
    	while ($Row = db2_fetch_assoc($Query)) {
			if (!empty($Row['TGL_UJIAN'])) {
				$Row['TGL_UJIAN'] = ChangeFormatDate($Row['TGL_UJIAN']);
			}
			
    		$ArrayPegawai[$i] = $Row;
    		$i++;
    	}
    	$Array = array(
    			'Pegawai' =>$ArrayPegawai    			
    	);
    	//print_r($ArrayPegawai);
    	return $Array;
    }
	
    function GetPeriode($tahun='x',$k_periode='x',$is_current='x'){
    	$ArrayPegawai = array();
    	$RawQuery = "CALL PP.GETPERIODE('$tahun','$k_periode','$is_current')";
    	$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
    	db2_execute($Query);
    	$i=0;
    	while ($Row = db2_fetch_assoc($Query)) {
			$Row['LABEL'] = $Row['PERIODE'].' - '.$Row['TAHUN'];
    		$ArrayPegawai[$i] = $Row;
    		$i++;
    	}
		
    	return $ArrayPegawai;
    }
	
    function GetArrayPeserta($Data){
    	$ArrayPegawai = array();
    	$PageActive = 1;
    	$PageCount = 1;
    	$Data['Export'] = (isset($Data['Export'])) ? $Data['Export'] : '';
    	$Data['PageActive'] = (empty($Data['PageActive'])) ? 1 : $Data['PageActive'];
    	$Data['PageOffset'] = (empty($Data['PageOffset'])) ? 1000 : $Data['PageOffset'];
    	if (!empty($Data['NOMOR'])) {
	    	$Data['INNO_PESERTA'] = $Data['NOMOR'];
	    	$Data['INK_PERIODE'] =  $Data['K_PERIODE'];
	    	$RawQuery = "
		                    CALL PP.GETPESERTA(
		                        '".$Data['INNO_PESERTA']."', '".$Data['INK_PERIODE']."'	                        
							)
						";
	    	//WriteLog($Data['UID'], $RawQuery);
	    	//echo $RawQuery;
	    	$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
	    	db2_execute($Query);	    
	    	while ($Row = db2_fetch_assoc($Query)) {
	    		$Row['LinkEdit'] = HOST.'/index.php/SeleksiDosen/UbahPeserta/'.ConvertLink($Row['NO_PESERTA']);
	    		$Row['LinkCetak1'] = HOST.'/index.php/SeleksiDosen/CetakPeserta/'.$Row['NO_PESERTA'].'/'.$Row['NO_PESERTA'];
	    		$Row['LinkCetak2'] = HOST.'/index.php/SeleksiDosen/CetakHadir/'.$Row['NO_PESERTA'].'/'.$Row['NO_PESERTA'];
	    		$ArrayPegawai[$Row['NO_PESERTA']] = $Row;
	    	}   		    	
	    	$PegawaiTotal = count($ArrayPegawai);
	    	$PageActive = $Data['PageActive'];	    	
	    	$PageCount = ceil($PegawaiTotal / $Data['PageOffset']);	    	
	    	$Array = array(
	    			'Pegawai' =>$ArrayPegawai,
	    			'PageActive' => $PageActive,
            		'PageCount' => $PageCount
	    	);
	    	return $Array;
    	}
    }  
    
	function get_array_pendaftar($param = array()) {
		$result = array();
		$param['IS_DOSEN'] = (!isset($param['IS_DOSEN'])) ? 'x' : $param['IS_DOSEN'];
		$param['NO_PESERTA'] = (!isset($param['NO_PESERTA'])) ? 'x' : $param['NO_PESERTA'];
		
		$RawQuery = "CALL PP.GETPESERTACURRENT('".$param['NO_PESERTA']."', '".$param['IS_DOSEN']."')";
		$Query = db2_prepare($this->CI->ldb2->Handle, $RawQuery);
		db2_execute($Query);	    
		while ($row = db2_fetch_assoc($Query)) {
			$row['LINK_CETAK'] = base_url('index.php/SeleksiDosen/CetakPesertaHadir/'.$row['NO_PESERTA'].'/'.$row['NO_PESERTA']);
			$result[] = $row;
		}
		
		return $result;
	}
		
	function ReadExcelPeserta($Data){   	 	
    	$FilePeserta = 'FILEPESERTA';
    	if (isset($_FILES) && isset($_FILES[$FilePeserta]) && isset($_FILES[$FilePeserta]['name']) && !empty($_FILES[$FilePeserta]['name'])) {
    		$ResultQuery = array();
    		$File = array(
    				'Path' => SFTP_PATH.'/files/Seldos/',
    				'Name' => date("Ymd_His_") . rand(1000,9999),
    				'WithCreateDir' => 1,
    				'Extention' => strtolower(GetExtention($_FILES[$FilePeserta]['name']))
    		);
    		$ResultUpload = Upload($File, $FilePeserta);   	    			    		
    		if (isset($ResultUpload['Status']) && $ResultUpload['Status'] == '1') {   	    					
    			$Path = $File['Path'] . $ResultUpload['FileName'];     			
    			$PageActive = 1;
    			$PageCount = 1;
    			$Data['PageActive'] = (empty($Data['PageActive'])) ? 1 : $Data['PageActive'];
    			$Data['PageOffset'] = (empty($Data['PageOffset'])) ? 20 : $Data['PageOffset'];
    			$ArrayPegawai = $this->GetArrayFromExcel($Path,9,5000);
				
    			$PegawaiTotal = count($ArrayPegawai);
    			$PageActive = $Data['PageActive'];
    			$PageCount = ceil($PegawaiTotal / $Data['PageOffset']);
    			$Array = array(
    					'Pegawai' =>$ArrayPegawai,
    					'PageActive' => $PageActive,
    					'PageCount' => $PageCount
    			);
    			return $Array;
    		}
    	}       
    	return null;    	
    }      
    function GetArrayFromExcel($Path,$ColNum,$RowNum){
    	require_once PATH.'/system/application/libraries/PHPExcel.php';
    	 
    	//ini_set('memory_limit', '5G');
    	$objPHPExcel = new PHPExcel();
    	$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    	->setLastModifiedBy("")
    	->setTitle("Office 2007 XLSX Test Document")
    	->setSubject("Office 2007 XLSX Test Document")
    	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    	->setKeywords("office 2007 openxml php")
    	->setCategory("Test result file");
		
    	$arr_data = array();    	
    	$arr_cols = array(
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
			'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
		);
		
    	try {
    		$objPHPExcel = PHPExcel_IOFactory::load($Path);
    		for ($i=2; $i<$RowNum+1; $i++){
    			$data = array();
    			$IsData = true;
    			for ($j=1; $j<=$ColNum; $j++) {
					$Ce = $arr_cols[$j-1].''.$i;
					
					// save value
					$value = $objPHPExcel->getActiveSheet()->getCell($Ce)->getValue();
					$data[$j-1] = strtoupper(trim($value));
					
    				if (($j == 1) && (trim($data[$j-1]) == '')){
    					$IsData = false;
    					break;
    				}
    			}
				
    			if (!$IsData){
    				break;
    			}
				
    			$arr_data[$i-2] = $data;
    		}
    	} catch(Exception $e){
    		return null;
    	}
		
		
		// update to db
		foreach ($arr_data as $key => $row) {
			$arr_data[$key][] = $this->InsUpdPeserta($row);
		}
		
    	return $arr_data;
    }
}