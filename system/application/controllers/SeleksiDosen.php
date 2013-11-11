<?php

class SeleksiDosen extends Controller {
    function SeleksiDosen() {
        parent::Controller();
    }    
    function index() {    	
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();
    	$Array['IsUserFakultas'] = $this->llogin->IsUserFakultas();    	
    	if (!isset($_SESSION['ArrayPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','x');
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['ArrayPeriode'] = $ArrayPeriode; 
    			$Array['ArrayPeriode'] = $ArrayPeriode;
    		}
    	} else {    		
    		$Array['ArrayPeriode'] = $_SESSION['ArrayPeriode'];
    	}  
		
		if (!isset($_SESSION['CurrentPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','1');
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['CurrentPeriode'] = $ArrayPeriode[0]; 
    		}
    	}
    	if ($_POST) {
    		$Pegawai = $this->lseleksi_dosen->InsUpd();
    		echo '<div class="MessagePopup">'. $Pegawai .'</div>';
    	}    	
        $this->load->view('seleksi_tambah', $Array);
    }
    function UbahPeserta($NPeserta=null){
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();
    	$Array['IsUserFakultas'] = $this->llogin->IsUserFakultas();
    	if (!isset($_SESSION['ArrayPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode();
    		if (count($ArrayPeriode) > 0){
    			$_SESSION['ArrayPeriode'] = $ArrayPeriode[0];
    			$Array['ArrayPeriode'] = $ArrayPeriode[0];    			
    		}
    	} else {
    		$Array['ArrayPeriode'] = $_SESSION['ArrayPeriode'];
    	}
    	if($NPeserta != null) {
    		$NoPeserta = RestoreLink($NPeserta);    	
    		$Array['ArrayPegawai'] = $this->lseleksi_dosen->GetPesertaByNo($NoPeserta);
    	}
    	if ($_POST) {
    		$Pegawai = $this->lseleksi_dosen->InsUpd();
    		//echo '<script>ShowDialogObject("'. $Pegawai .'");</script>';    		
    		echo '<div class="MessagePopup">'. $Pegawai .'</div>';
    		$Array['ArrayPegawai'] = $this->lseleksi_dosen->GetPesertaByNo($_POST['NOMOR']);
    	}
    	$this->load->view('seleksi_tambah', $Array);
    }
    
    function HapusPesertaAll(){
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();
    	$Array['IsUserFakultas'] = $this->llogin->IsUserFakultas();
    	if (!isset($_SESSION['ArrayPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','x');
    		if (count($ArrayPeriode) > 0){
    			$_SESSION['ArrayPeriode'] = $ArrayPeriode;
    			$Array['ArrayPeriode'] = $ArrayPeriode;
    		}
    	} else {
    		$Array['ArrayPeriode'] = $_SESSION['ArrayPeriode'];
    	}
		
		if (!isset($_SESSION['CurrentPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','1');
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['CurrentPeriode'] = $ArrayPeriode[0]; 
    		}
    	}
    	if ($_POST) {
    		if (isset($_POST['TAHUN'])){ 
    			$Pegawai = $this->lseleksi_dosen->DelAllPeserta($_POST['TAHUN']);
    			echo '<div class="MessagePopup">'. $Pegawai .'</div>';
    		}
    	}
    	$this->load->view('seleksi_hapus', $Array);
    }
    function CariPeserta(){
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();
    	$Array['IsUserFakultas'] = $this->llogin->IsUserFakultas();
    	if (!isset($_SESSION['ArrayPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode();
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['ArrayPeriode'] = $ArrayPeriode;
    			$Array['ArrayPeriode'] = $ArrayPeriode;
    		}
    	} else {
    		$Array['ArrayPeriode'] = $_SESSION['ArrayPeriode'];
    	}
		if (!isset($_SESSION['CurrentPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','1'); 
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['CurrentPeriode'] = $ArrayPeriode[0]; 
    		}
    	}
    	if ($_POST){
    		$this->lseleksi_dosen->DelPeserta($_POST['DeletePegawai']);
    	}
    	$Array['ArrayPegawai'] = $this->lseleksi_dosen->GetArrayPeserta($_POST);
    	$this->load->view('seleksi_cari', $Array);
    }
    function UnggahPeserta(){
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();    	
    	$Array['IsUserFakultas'] = $this->llogin->IsUserFakultas();
		
		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode();
		$Array['ArrayPeriode'] = $ArrayPeriode[0];
		
		// check upload
    	if (!empty($_POST)){   		    		    		
    		$Array['ArrayPegawai'] =  $this->lseleksi_dosen->ReadExcelPeserta($_POST);
    	}
		
    	$this->load->view('seleksi_unggah', $Array);
    }
    function CetakHadir($From=0, $To=0) {
		ini_set("memory_limit", "124M");
		$pdf = $this->lpdf->load();
		
		// prepare data
		$array_peserta = $this->lseleksi_dosen->GetArrayCetak($From, $To);
		
		// generate page for each peserta
		$template = '';
		foreach ($array_peserta['Pegawai'] as $key => $row) {
			if (!empty($template) && (($key & 2) == 0)) {
				$pdf->AddPage();
			}
			
			$template = $this->load->view( 'seleksi_cetak_hadir', array( 'peserta' => $row ), true );
			$pdf->WriteHTML($template);
		}
		$pdf->Output();
    }
    function CetakPeserta($From=0, $To=0){
    	$Name = date("YmdHis").".pdf";
    	$PdfFilePath = PATH."/files/Pdf/". $Name ;    	    	
		if (!isset($_SESSION['CurrentPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','1');
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['CurrentPeriode'] = $ArrayPeriode[0];
    		}
    	} 
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();
    	$Array['ArrayPegawai'] = $this->lseleksi_dosen->GetArrayCetak($From, $To,$_SESSION['CurrentPeriode']['K_PERIODE']);
    	
    	if (file_exists($PdfFilePath) == FALSE)
    	{
    		ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley firstChild">
    		$html = $this->load->view('seleksi_cetak_peserta', $Array, true); // render the view into HTML    		 
    		//$this->load->library('lpdf');
    		$pdf = $this->lpdf->load();
    		//$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
    		$pdf->WriteHTML($html); // write the HTML into the PDF
    		$pdf->Output($PdfFilePath, 'F'); // save to file because we can
    	}
    	header("Location: ".HOST."/files/Pdf/".$Name);
    	exit;
		    	
    	//$this->load->view('seleksi_cetak_peserta', $Array);
    }
	function CetakPesertaHadir($From=0, $To=0){
		ini_set("memory_limit", "124M");
		$pdf = $this->lpdf->load();
		
		// prepare data
		$array_peserta = $this->lseleksi_dosen->GetArrayCetak($From, $To);
		
		// generate page for each peserta
		$template = '';
		foreach ($array_peserta['Pegawai'] as $row) {
			if (!empty($template)) {
				$pdf->AddPage();
			}
			
			$template = $this->load->view( 'seleksi_cetak_peserta_bukti_hadir', array( 'peserta' => $row ), true );
			$pdf->WriteHTML($template);
		}
		$pdf->Output();
    }
    function Cetak(){
    	$Data = $_POST;
		
    	if (!isset($_SESSION['ArrayPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode();
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['ArrayPeriode'] = $ArrayPeriode;
    			$Array['ArrayPeriode'] = $ArrayPeriode;
    		}
    	} else {
    		$Array['ArrayPeriode'] = $_SESSION['ArrayPeriode'];
    	}
		
		if (!isset($_SESSION['CurrentPeriode'])){
    		$ArrayPeriode = $this->lseleksi_dosen->GetPeriode('x','x','1');
    		if (count($ArrayPeriode) > 0) {
    			$_SESSION['CurrentPeriode'] = $ArrayPeriode[0];
    			$Array['CurrentPeriode'] = $ArrayPeriode[0];
    		}
    	} else {
    		$Array['CurrentPeriode'] = $_SESSION['CurrentPeriode'];
    	}
		
    	if (isset($_POST['IsCetak'])) {
    		if ($_POST['C_JENIS'] == '0') {
    			$Url = HOST.'/index.php/SeleksiDosen/CetakPeserta/'.$_POST['C_AWAL'].'/'.$_POST['C_AKHIR'];
    		} else if ($_POST['C_JENIS'] == '1') {
    			$Url = HOST.'/index.php/SeleksiDosen/CetakHadir/'.$_POST['C_AWAL'].'/'.$_POST['C_AKHIR'];
    		} else if ($_POST['C_JENIS'] == '2') {
    			$Url = HOST.'/index.php/SeleksiDosen/CetakPesertaHadir/'.$_POST['C_AWAL'].'/'.$_POST['C_AKHIR'];
    		}
    		echo '<script>window.open("'.$Url.'","_blank");</script>';    
			
    		$Data['NMR_AWAL'] = $_POST['C_AWAL'];
    		$Data['NMR_AKHIR'] = $_POST['C_AKHIR'];
    		$Data['TAHUN'] = (!empty($Data['TAHUN'])) ? $Data['TAHUN'] : $_SESSION['CurrentPeriode'];
    	}
		
    	$Array['Page'] = $this->lseleksi_dosen->GetProperty();
    	if (isset($Data['NMR_AWAL']) && isset($Data['NMR_AKHIR'])){
    		$Array['ArrayPegawai'] = $this->lseleksi_dosen->GetArrayCetak($Data['NMR_AWAL'], $Data['NMR_AKHIR'],$Data['TAHUN']);
    	}
    	$Nomor['C_AWAL'] = 0;
    	$Nomor['C_AKHIR'] = 0;
    	if (isset($Data['NMR_AWAL']) && isset($Data['NMR_AKHIR'])){    		
    		$Nomor['C_AWAL'] = $Data['NMR_AWAL'];
    		$Nomor['C_AKHIR'] = $Data['NMR_AKHIR'];
    		if (isset($_POST['IsCetak'])){
    			$Nomor['C_JENIS'] = $Data['C_JENIS'];    			
    		}    		     	
    	}
    	$Array['ArrayNomor'] = $Nomor;
    	$this->load->view('seleksi_cetak', $Array);
    }
}