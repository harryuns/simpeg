<?php

class Peserta extends Controller {
    function Peserta() {
        parent::Controller();
    }    
    
	function index() {    	
    	$Data = $_POST;
    	if(!isset($_SESSION['CurrentPeriode'])){
			$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','1');
			if (count($ArrayPeriode) > 0) {
					$_SESSION['CurrentPeriode'] = $ArrayPeriode[0];
			}
		}
		if(!isset($_SESSION['ArrayPeriode'])){
			$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','x');
			if (count($ArrayPeriode) > 0) {
					$_SESSION['ArrayPeriode'] = $ArrayPeriode;
					$Array['ArrayPeriode'] = $ArrayPeriode;
			}
		}else $Array['ArrayPeriode'] =$_SESSION['ArrayPeriode'] ;
    	if (isset($_POST['IsCetak'])){
    		if ($_POST['C_JENIS'] == '0') {
    			$Url = HOST.'/index.php/SeleksiDosen/CetakPeserta/'.$_POST['C_AWAL'].'/'.$_POST['C_AKHIR'];
    		} else if ($_POST['C_JENIS'] == '1') {
    			$Url = HOST.'/index.php/SeleksiDosen/CetakHadir/'.$_POST['C_AWAL'].'/'.$_POST['C_AKHIR']; 
    		}  		
    		echo '<script>
    				window.open("'.$Url.'","_blank")
    				</script>
    				';    
    		$Data['NMR'] = $_POST['C_AWAL'];    		
    		$Data['K_PERIODE'] = $_POST['K_PERIODE'];
    	}
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();
    	if (isset($Data['NMR'])){
    		$Array['ArrayPegawai'] = $this->lseleksi_dosen->GetArrayCetak($Data['NMR'], $Data['NMR'],$Data['K_PERIODE']);
    	}
    	$Nomor['C_AWAL'] = 0;
    	$Nomor['C_AKHIR'] = 0;
    	if (isset($Data['NMR'])){    		
    		$Nomor['C_AWAL'] = $Data['NMR'];
    		$Nomor['C_AKHIR'] = $Data['NMR'];
    		if (isset($_POST['IsCetak'])){
    			$Nomor['C_JENIS'] = $Data['C_JENIS'];    			
    		}    		     	
    	}
    	$Array['ArrayNomor'] = $Nomor;    		
        $this->load->view('peserta_home', $Array);
    }
	
    function All(){
		if(!isset($_SESSION['CurrentPeriode'])){
			$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','1');
			if (count($ArrayPeriode) > 0) {
					$_SESSION['CurrentPeriode'] = $ArrayPeriode[0];
			}
		}
		//print_r($_SESSION['CurrentPeriode']);
    	$Data['NOMOR'] = 'x' ;
    	$Data['K_PERIODE'] =$_SESSION['CurrentPeriode']['K_PERIODE'];
    	$Array['ArrayPegawai'] = $this->lseleksi_dosen->GetArrayPeserta($Data, date("Y"));
    	$this->load->view('peserta_all', $Array);
    }
	
	function daftar() {
		$this->load->view('peserta_daftar');
	}
}